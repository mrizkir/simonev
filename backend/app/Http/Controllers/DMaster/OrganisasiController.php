<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\OrganisasiModel;
use App\Models\Statistik1Model;
use App\Helpers\Helper;

class OrganisasiController extends Controller {     
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                
        $this->hasPermissionTo('OPD_BROWSE');

        $this->validate($request, [            
            'tahun'=>'required',            
        ]);             
        $tahun=$request->input('tahun');

        $user=$this->guard()->user();
        if ($user->hasRole(['superadmin','bapelitbang']))
        {
            $data = OrganisasiModel::where('TA',$tahun)
                                ->orderBy('kode_organisasi','ASC')
                                ->get();
        }       
        else if ($user->hasRole('opd'))
        {
            $daftar_opd=json_decode($user->payload,true);
            $data = OrganisasiModel::where('TA',$tahun)
                                ->whereIn('OrgID',$daftar_opd)
                                ->orderBy('kode_organisasi','ASC')
                                ->get();
        }
        

        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'opd'=>$data,
                                'jumlah_apbd'=>$data->sum('PaguDana1'),
                                'jumlah_apbdp'=>$data->sum('PaguDana2'),
                                'message'=>'Fetch data opd berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);    
        
    }
    /**
     * load data opd 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadpaguapbdp(Request $request)
    {        
        $this->hasPermissionTo('OPD_STORE');
        
        $this->validate($request, [            
            'tahun'=>'required',            
        ]); 
        $tahun=$request->input('tahun');
        
        $str_statistik_opd1 = '
            UPDATE "tmOrg" SET "PaguDana2"=level1."PaguUraian2" FROM
            (SELECT kode_organisasi,SUM("PaguUraian2") AS "PaguUraian2" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 GROUP BY kode_organisasi) AS level1
            WHERE level1.kode_organisasi="tmOrg".kode_organisasi AND "TA"='.$tahun.'
        ';
        
        \DB::statement($str_statistik_opd1); 

        $str_update_jumlah_program = 'UPDATE "tmOrg" SET "JumlahProgram2"=level3.jumlah_program FROM ( 
            SELECT kode_organisasi, COUNT(kode_program) jumlah_program FROM (
                SELECT * FROM 
                    (SELECT kode_organisasi, kode_program FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 GROUP BY "kode_program",kode_organisasi ORDER BY kode_program ASC) AS level1
            ) AS level2 GROUP BY kode_organisasi ORDER BY kode_organisasi
        ) AS level3 WHERE level3.kode_organisasi="tmOrg".kode_organisasi';

        \DB::statement($str_update_jumlah_program); 
        
        $str_update_jumlah_kegiatan = 'UPDATE "tmOrg" SET "JumlahKegiatan2"=level2.jumlah_kegiatan FROM 
        (
            SELECT kode_organisasi,COUNT(kode_kegiatan) AS jumlah_kegiatan FROM 
            (
                SELECT 
                    DISTINCT(kode_kegiatan),				
                    "kode_organisasi"				
                FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2
                ORDER BY kode_organisasi ASC
            ) AS level1 GROUP BY kode_organisasi
        ) AS level2 WHERE level2.kode_organisasi="tmOrg".kode_organisasi';
        
        \DB::statement($str_update_jumlah_kegiatan);

        $data = OrganisasiModel::where('TA',$tahun)->get();
        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'opd'=>$data,
                                'jumlah_apbd'=>$data->sum('PaguDana1'),
                                'jumlah_apbdp'=>$data->sum('PaguDana2'),
                                'message'=>'Fetch data opd berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
    }
    /**
     * load data opd 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadopd(Request $request)
    {        
        $this->hasPermissionTo('OPD_STORE');

        $this->validate($request, [            
            'tahun'=>'required',            
        ]);
        $tahun=$request->input('tahun');
        OrganisasiModel::where('TA',$tahun)                                    
                                ->delete();

        Statistik1Model::where('statistikID',$tahun)                                    
                                ->delete();

        $str_opd = '
            INSERT INTO "tmOrg" (
                "OrgID",
                "Nm_Urusan", 
                "kode_organisasi",
                "OrgNm",
                "OrgAlias",
                "Alamat",
                "NamaKepalaSKPD",
                "NIPKepalaSKPD",
                "Descr",
                "TA",
                "created_at", 
                "updated_at"
            )
            SELECT
                CONCAT(\''.$tahun.'\',\'-\',REPLACE(kode_organisasi,\'.\',\'-\')) AS "OrgID",
                \'\' AS "Nm_Urusan",                
                kode_organisasi,
                "OrgNm",
                "OrgNm" AS "OrgAlias",
                \'\' AS "Alamat",
                \'\' AS "NamaKepalaSKPD",
                \'\' AS "NIPKepalaSKPD",
                \'Imported from SIMDA\' AS "Descr",
                '.$tahun.' AS "TA",
                NOW() AS created_at,
                NOW() AS updated_at
            FROM
                simda 
            WHERE
                "TA" = '.$tahun.' AND 
                "EntryLvl"=1 AND 
                "Kd_Urusan" IS NOT NULL 
            GROUP BY
                kode_organisasi,
                "OrgNm"	
            ORDER BY
                kode_organisasi ASC
        ';

        \DB::statement($str_opd); 

        $str_update_urusan = '
        UPDATE "tmOrg" SET "Nm_Urusan"=level2.bidang FROM 
        (SELECT
                kode_organisasi,
                STRING_AGG ( "Nm_Bidang", \', \' ) AS bidang 
            FROM ( SELECT kode_organisasi,"Nm_Bidang" FROM simda WHERE "Nm_Bidang" IS NOT NULL AND "TA"='.$tahun.' AND "EntryLvl"=1 GROUP BY kode_organisasi,"Nm_Bidang" ) AS level1 
        GROUP BY kode_organisasi) AS level2
        WHERE level2.kode_organisasi="tmOrg".kode_organisasi AND "TA"='.$tahun.'' ;

        \DB::statement($str_update_urusan); 
        
        $str_update_jumlah_program = 'UPDATE "tmOrg" SET "JumlahProgram1"=level3.jumlah_program FROM ( 
            SELECT kode_organisasi, COUNT(kode_program) jumlah_program FROM (
                SELECT * FROM 
                    (SELECT kode_organisasi, kode_program FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=1 GROUP BY "kode_program",kode_organisasi ORDER BY kode_program ASC) AS level1
            ) AS level2 GROUP BY kode_organisasi ORDER BY kode_organisasi
        ) AS level3 WHERE level3.kode_organisasi="tmOrg".kode_organisasi';

        \DB::statement($str_update_jumlah_program); 

        $str_update_jumlah_kegiatan = 'UPDATE "tmOrg" SET "JumlahKegiatan1"=level2.jumlah_kegiatan FROM 
        (
            SELECT kode_organisasi,COUNT(kode_kegiatan) AS jumlah_kegiatan FROM 
            (
                SELECT 
                    DISTINCT(kode_kegiatan),				
                    "kode_organisasi"				
                FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=1
                ORDER BY kode_organisasi ASC
            ) AS level1 GROUP BY kode_organisasi
        ) AS level2 WHERE level2.kode_organisasi="tmOrg".kode_organisasi';

        \DB::statement($str_update_jumlah_kegiatan); 

        $str_statistik_opd1 = '
            UPDATE "tmOrg" SET "PaguDana1"=level1."PaguUraian1" FROM
            (SELECT kode_organisasi,SUM("PaguUraian1") AS "PaguUraian1" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=1 GROUP BY kode_organisasi) AS level1
            WHERE level1.kode_organisasi="tmOrg".kode_organisasi AND "TA"='.$tahun.'
        ';

        \DB::statement($str_statistik_opd1); 
        
        $pagu=\DB::table('tmOrg')
                ->select(\DB::raw('SUM("PaguDana1") AS "PaguDana1"'))
                ->where('TA',$tahun)                
                ->get();        
        
        $statisik1=Statistik1Model::firstOrCreate ([
                    'statistikID'=>$tahun, 
                    'PaguDana1'=>$pagu[0]->PaguDana1, 
                    'PaguDana2'=>0,
                    'JumlahProgram1'=>0, 
                    'JumlahProgram2'=>0, 
                    'JumlahKegiatan1'=>0, 
                    'JumlahKegiatan2'=>0, 
                    'RealisasiKeuangan1'=>0, 
                    'RealisasiKeuangan2'=>0,
                    'RealisasiFisik1'=>0,
                    'RealisasiFisik2'=>0           
                ]);

        $str_jumlah_program1='UPDATE statistik1 SET "JumlahProgram1"=level2.jumlah_program FROM (
            SELECT COUNT("Kd_Prog") AS jumlah_program FROM 
            (SELECT "Kd_Prog" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=1 GROUP BY "Kd_Prog") AS level1

        )level2 WHERE statistik1."statistikID"='.$tahun;

        \DB::statement($str_jumlah_program1); 

        $str_jumlah_kegiatan1='UPDATE statistik1 SET "JumlahKegiatan1"=level2.jumlah_kegiatan FROM (
            SELECT COUNT("Kd_Keg") AS jumlah_kegiatan FROM 
            (SELECT "Kd_Keg" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=1 GROUP BY "Kd_Prog","Kd_Keg") AS level1

        )level2 WHERE statistik1."statistikID"='.$tahun;

        \DB::statement($str_jumlah_kegiatan1); 

        \App\Models\Settings\ActivityLog::log($request,[
                                        'object' => $this->guard()->user(), 
                                        'object_id' => $this->getUserid(), 
                                        'user_id' => $this->getUserid(), 
                                        'message' => 'Meload ulang data OPD kembali'
                                    ]);
                                    
        $data = OrganisasiModel::where('TA',$tahun)->get();
        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'opd'=>$data,
                                'jumlah_apbd'=>$data->sum('PaguDana1'),
                                'jumlah_apbdp'=>$data->sum('PaguDana2'),
                                'message'=>'Fetch data opd berhasil diperoleh'
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
        $this->hasPermissionTo('OPD_UPDATE');

        $this->validate($request, [            
            'OrgAlias'=>'required',
            'NIPKepalaSKPD'=>'required|min:5',
            'NamaKepalaSKPD'=>'required|min:5',
            'Alamat'=>'required|min:5',
        ]);

        $organisasi = OrganisasiModel::find($id);
        $organisasi->OrgAlias = $request->input('OrgAlias');
        $organisasi->NamaKepalaSKPD = $request->input('NamaKepalaSKPD');
        $organisasi->NIPKepalaSKPD = $request->input('NIPKepalaSKPD');
        $organisasi->Alamat = $request->input('Alamat');
        $organisasi->Descr = $request->input('Descr');
        $organisasi->save();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'opd'=>$organisasi,                                    
                                    'message'=>'Data organisasi '.$organisasi->OrgNm.' berhasil diubah.'
                                ],200); 
    
    }
    /**
     * digunakan untuk mendapat unit kerja berdasarkan OrgID
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function opdunitkerja ($id)
    {
        $organisasi = OrganisasiModel::find($id);
        $unitkerja = $organisasi->unitkerja()->orderBy('kode_suborganisasi','ASC')->get();        
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'organisasi'=>$organisasi,
                                    'unitkerja'=>$unitkerja,                                    
                                    'message'=>'Data unit kerja berdasarkan id '.$organisasi->OrgNm.' berhasil diubah.'
                                ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
    }
    /**
     * digunakan untuk mendapat pejabat  berdasarkan OrgID
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pejabatopd ($id)
    {
        $pejabat = \DB::table('tmASN')
                        ->select(\DB::raw('"trRiwayatJabatanASN"."ASNID","tmASN"."Nm_ASN","Jenis_Jabatan"'))
                        ->join('trRiwayatJabatanASN','trRiwayatJabatanASN.ASNID','tmASN.ASNID')
                        ->where('trRiwayatJabatanASN.OrgID',$id)
                        ->get();

        $pa=[];
        $kpa=[];
        $ppk=[];
        $pptk=[];
        foreach ($pejabat as $item)
        {
            switch ($item->Jenis_Jabatan)
            {
                case 'pa' :
                    $pa[]=[
                        'text'=>$item->Nm_ASN,
                        'value'=>$item->ASNID
                    ];
                break;                    
                case 'kpa' :
                    $kpa[]=[
                        'text'=>$item->Nm_ASN,
                        'value'=>$item->ASNID
                    ];;
                break;                    
                case 'ppk' :
                    $ppk[]=[
                        'text'=>$item->Nm_ASN,
                        'value'=>$item->ASNID
                    ];
                break;                    
                case 'pptk' :
                    $pptk[]=[
                        'text'=>$item->Nm_ASN,
                        'value'=>$item->ASNID
                    ];
                break;                   
            }
        }        
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',                                    
                                    'pejabat'=>[
                                        'pa'=>$pa,
                                        'kpa'=>$kpa,
                                        'ppk'=>$ppk,
                                        'pptk'=>$pptk,
                                    ],                                    
                                    'message'=>'Data unit kerja berdasarkan id '.$id.' berhasil diubah.'
                                ],200); 
    }
}