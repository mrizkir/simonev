<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\SubOrganisasiModel;

class SubOrganisasiController extends Controller {     
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                
        $this->hasPermissionTo('UNIT KERJA_BROWSE');

        $tahun=$request->input('tahun');
        $this->validate($request, [            
            'tahun'=>'required',
            
        ]);     
        
        $user=$this->guard()->user();
        if ($user->hasRole(['superadmin','bapelitbang']))
        {
            $data = SubOrganisasiModel::where('TA',$tahun)
                                ->orderBy('kode_suborganisasi','ASC')
                                ->get();
        }       
        else if ($user->hasRole('opd'))
        {
            $daftar_unitkerja=json_decode($user->payload,true);
            $data = SubOrganisasiModel::where('TA',$tahun)
                                ->whereIn('OrgID',$daftar_unitkerja)
                                ->orderBy('kode_suborganisasi','ASC')
                                ->get();
        }
        

        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'unitkerja'=>$data,
                                'jumlah_apbd'=>$data->sum('PaguDana1'),
                                'jumlah_apbdp'=>$data->sum('PaguDana2'),
                                'message'=>'Fetch data unit kerjaberhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);    
        
    }
    /**
     * load data unit kerja 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadpaguapbdp(Request $request)
    {        
        $this->hasPermissionTo('UNIT KERJA_STORE');

        $this->validate($request, [            
            'tahun'=>'required',            
        ]);
        $tahun=$request->input('tahun');
        
        $str_update_jumlah_program = 'UPDATE "tmSOrg" SET "JumlahProgram2"=level3.jumlah_program FROM ( 
            SELECT kode_suborganisasi, COUNT(kode_program) jumlah_program FROM (
                SELECT * FROM 
                    (SELECT kode_suborganisasi, kode_program FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 GROUP BY "kode_program",kode_suborganisasi ORDER BY kode_program ASC) AS level1
            ) AS level2 GROUP BY kode_suborganisasi ORDER BY kode_suborganisasi
        ) AS level3 WHERE level3.kode_suborganisasi="tmSOrg".kode_suborganisasi';

        \DB::statement($str_update_jumlah_program); 
        
        $str_update_jumlah_kegiatan = 'UPDATE "tmSOrg" SET "JumlahKegiatan2"=level2.jumlah_kegiatan FROM 
        (
            SELECT kode_suborganisasi,COUNT(kode_kegiatan) AS jumlah_kegiatan FROM 
            (
                SELECT 
                    DISTINCT(kode_kegiatan),				
                    "kode_suborganisasi"				
                FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2
                ORDER BY kode_suborganisasi ASC
            ) AS level1 GROUP BY kode_suborganisasi
        ) AS level2 WHERE level2.kode_suborganisasi="tmSOrg".kode_suborganisasi';

        \DB::statement($str_update_jumlah_kegiatan); 
        
        $str_statistik_unitkerja1 = '
            UPDATE "tmSOrg" SET "PaguDana2"=level1."PaguUraian2" FROM
            (SELECT kode_suborganisasi,SUM("PaguUraian2") AS "PaguUraian2" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 GROUP BY kode_suborganisasi) AS level1
            WHERE level1.kode_suborganisasi="tmSOrg".kode_suborganisasi AND "TA"='.$tahun.'
        ';

        \DB::statement($str_statistik_unitkerja1); 

        $data = SubOrganisasiModel::where('TA',$tahun)->get();
        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'unitkerja'=>$data,
                                'jumlah_apbd'=>$data->sum('PaguDana1'),
                                'jumlah_apbdp'=>$data->sum('PaguDana2'),
                                'message'=>'Fetch data unit kerja berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
    }
    /**
     * load data unit kerja
     *
     * @return \Illuminate\Http\Response
     */
    public function loadunitkerja(Request $request)
    {        
        $this->hasPermissionTo('UNIT KERJA_STORE');

        $this->validate($request, [            
            'tahun'=>'required',            
        ]);
        $tahun=$request->input('tahun');
        SubOrganisasiModel::where('TA',$tahun)                                    
                                ->delete();
       
        $str_unitkerja = '
            INSERT INTO "tmSOrg" (
                "SOrgID",
                "OrgID",
                "Nm_Urusan",                 
                "kode_organisasi",
                "OrgNm",
                "kode_suborganisasi",
                "SOrgNm",
                "SOrgAlias",
                "Alamat",
                "NamaKepalaUnitKerja",
                "NIPKepalaUnitKerja",
                "Descr",
                "TA",
                "created_at", 
                "updated_at"
            )
            SELECT
                DISTINCT(CONCAT(\''.$tahun.'\',\'-\',REPLACE(kode_suborganisasi,\'.\',\'-\'))) AS "SOrgID",
                CONCAT(\''.$tahun.'\',\'-\',REPLACE(kode_organisasi,\'.\',\'-\')) AS "OrgID",
                \'\' AS "Nm_Urusan",                
                kode_organisasi,
                "OrgNm",
                kode_suborganisasi,
                "SOrgNm",
                "SOrgNm" AS "SOrgAlias",
                \'\' AS "Alamat",
                \'\' AS "NamaKepalaUnitKerja",
                \'\' AS "NIPKepalaUnitKerja",
                \'Imported from SIMDA\' AS "Descr",
                '.$tahun.' AS "TA",
                NOW() AS created_at,
                NOW() AS updated_at
            FROM
                simda 
            WHERE
                "TA" = '.$tahun.' 
                AND "Kd_Urusan" IS NOT NULL            
            ORDER BY
                kode_suborganisasi ASC
        ';

        \DB::statement($str_unitkerja); 

        $str_update_urusan = '
        UPDATE "tmSOrg" SET "Nm_Urusan"=level2.bidang FROM 
        (SELECT
                kode_suborganisasi,
                STRING_AGG ( "Nm_Bidang", \', \' ) AS bidang 
            FROM ( SELECT kode_suborganisasi,"Nm_Bidang" FROM simda WHERE "Nm_Bidang" IS NOT NULL AND "TA"='.$tahun.' GROUP BY kode_suborganisasi,"Nm_Bidang" ) AS level1 
        GROUP BY kode_suborganisasi) AS level2
        WHERE level2.kode_suborganisasi="tmSOrg".kode_suborganisasi AND "TA"='.$tahun.'' ;

        \DB::statement($str_update_urusan); 
        
        $str_update_jumlah_program = 'UPDATE "tmSOrg" SET "JumlahProgram1"=level3.jumlah_program FROM ( 
            SELECT kode_suborganisasi, COUNT(kode_program) jumlah_program FROM (
                SELECT * FROM 
                    (SELECT kode_suborganisasi, kode_program FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=1 GROUP BY "kode_program",kode_suborganisasi ORDER BY kode_program ASC) AS level1
            ) AS level2 GROUP BY kode_suborganisasi ORDER BY kode_suborganisasi
        ) AS level3 WHERE level3.kode_suborganisasi="tmSOrg".kode_suborganisasi';

        \DB::statement($str_update_jumlah_program); 

        $str_update_jumlah_kegiatan = 'UPDATE "tmSOrg" SET "JumlahKegiatan1"=level2.jumlah_kegiatan FROM 
        (
            SELECT kode_suborganisasi,COUNT(kode_kegiatan) AS jumlah_kegiatan FROM 
            (
                SELECT 
                    DISTINCT(kode_kegiatan),				
                    "kode_suborganisasi"				
                FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=1
                ORDER BY kode_suborganisasi ASC
            ) AS level1 GROUP BY kode_suborganisasi
        ) AS level2 WHERE level2.kode_suborganisasi="tmSOrg".kode_suborganisasi';

        \DB::statement($str_update_jumlah_kegiatan); 

        $str_statistik_unitkerja1 = '
            UPDATE "tmSOrg" SET "PaguDana1"=level1."PaguUraian1" FROM
            (SELECT kode_suborganisasi,SUM("PaguUraian1") AS "PaguUraian1" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=1 GROUP BY kode_suborganisasi) AS level1
            WHERE level1.kode_suborganisasi="tmSOrg".kode_suborganisasi AND "TA"='.$tahun.'
        ';

        \DB::statement($str_statistik_unitkerja1); 
        
        \App\Models\Settings\ActivityLog::log($request,[
                                        'object' => $this->guard()->user(), 
                                        'object_id' => $this->getUserid(), 
                                        'user_id' => $this->getUserid(), 
                                        'message' => 'Meload ulang data OPD kembali'
                                    ]);
                                    
        $data = SubOrganisasiModel::where('TA',$tahun)->get();
        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'unitkerja'=>$data,
                                'jumlah_apbd'=>$data->sum('PaguDana1'),
                                'jumlah_apbdp'=>$data->sum('PaguDana2'),
                                'message'=>'Fetch data unit kerja berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
    }
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->hasPermissionTo('UNIT KERJA_UPDATE');

        $this->validate($request, [            
            'SOrgAlias'=>'required',
            'NIPKepalaUnitKerja'=>'required|min:5',
            'NamaKepalaUnitKerja'=>'required|min:5',
            'Alamat'=>'required|min:5',
        ]);

        $sub_organisasi = SubOrganisasiModel::find($id);
        $sub_organisasi->SOrgAlias = $request->input('SOrgAlias');
        $sub_organisasi->NamaKepalaUnitKerja = $request->input('NamaKepalaUnitKerja');
        $sub_organisasi->NIPKepalaUnitKerja = $request->input('NIPKepalaUnitKerja');
        $sub_organisasi->Alamat = $request->input('Alamat');
        $sub_organisasi->Descr = $request->input('Descr');
        $sub_organisasi->save();
        
        $str_update_jumlah_program = 'UPDATE "tmSOrg" SET "JumlahProgram1"=level3.jumlah_program FROM ( 
            SELECT kode_suborganisasi, COUNT(kode_program) jumlah_program FROM (
                SELECT * FROM 
                    (SELECT kode_suborganisasi, kode_program FROM simda WHERE "TA"='.$sub_organisasi->TA.' AND kode_suborganisasi=\''.$sub_organisasi->kode_suborganisasi.'\' AND "EntryLvl"=1 GROUP BY "kode_program",kode_suborganisasi ORDER BY kode_program ASC) AS level1
            ) AS level2 GROUP BY kode_suborganisasi ORDER BY kode_suborganisasi
        ) AS level3 WHERE level3.kode_suborganisasi="tmSOrg".kode_suborganisasi';

        \DB::statement($str_update_jumlah_program); 

        $str_update_jumlah_kegiatan = 'UPDATE "tmSOrg" SET "JumlahKegiatan1"=level2.jumlah_kegiatan FROM 
        (
            SELECT kode_suborganisasi,COUNT(kode_kegiatan) AS jumlah_kegiatan FROM 
            (
                SELECT 
                    DISTINCT(kode_kegiatan),				
                    "kode_suborganisasi"				
                FROM simda WHERE "TA"='.$sub_organisasi->TA.' AND kode_suborganisasi=\''.$sub_organisasi->kode_suborganisasi.'\' AND "EntryLvl"=1
                ORDER BY kode_suborganisasi ASC
            ) AS level1 GROUP BY kode_suborganisasi
        ) AS level2 WHERE level2.kode_suborganisasi="tmSOrg".kode_suborganisasi';

        \DB::statement($str_update_jumlah_kegiatan);
        
        $str_statistik_unitkerja1 = '
            UPDATE "tmSOrg" SET 
                "PaguDana1"=level1."PaguUraian1"                
            FROM
                (
                    SELECT 
                        kode_suborganisasi,
                        SUM("PaguUraian1") AS "PaguUraian1"                                               
                    FROM simda 
                    WHERE kode_suborganisasi=\''.$sub_organisasi->kode_suborganisasi.'\' 
                    GROUP BY kode_suborganisasi
                ) AS level1
            WHERE "tmSOrg".kode_suborganisasi=level1.kode_suborganisasi
        ';
        \DB::statement($str_statistik_unitkerja1); 
        
        $sub_organisasi = SubOrganisasiModel::find($id);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'unitkerja'=>$sub_organisasi,                                    
                                    'message'=>'Data unit kerja '.$sub_organisasi->SOrgNm.' berhasil diubah.'
                                ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
    
    }
}