<?php

namespace App\Http\Controllers\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\DMaster\OrganisasiModel;
use App\Models\DMaster\SIMDAModel;

class DataMentahPerubahanController extends Controller 
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {             
        $this->hasPermissionTo('RKA PERUBAHAN_BROWSE');
        
        $this->validate($request, [            
            'tahun'=>'required',            
            'OrgID'=>'required|exists:tmOrg,OrgID',            
        ]);
        $tahun = $request->input('tahun');
        $OrgID = $request->input('OrgID');
        $organisasi = OrganisasiModel::find($OrgID);
     
        $data = SimdaModel::select(\DB::raw('                            
                            DISTINCT(kode_kegiatan) AS kode_kegiatan,                            
                            "Kd_Urusan",
                            "Nm_Urusan",
                            "Kd_Bidang",
                            "Nm_Bidang",
                            "KgtNm",
                            kode_program,                                                        
                            "PrgNm",
                            0 AS "PaguDana2",
                            \'BELUM DICOPY\' AS status,                                                                                    
                            "TA"
                        '))
                        ->where('kode_organisasi',$organisasi->kode_organisasi)
                        ->where('TA',$tahun)
                        ->where('EntryLvl',2)
                        ->orderBy('kode_program','ASC')
                        ->orderBy('kode_kegiatan','ASC')
                        ->get();        
        
        $data->transform(function($item,$key) use ($organisasi){
            $rka = \DB::table('trRKA')
                        ->where('kode_organisasi',$organisasi->kode_organisasi)
                        ->where('TA',$organisasi->TA)
                        ->where('EntryLvl',2)
                        ->where('kode_kegiatan',$item->kode_kegiatan)
                        ->get();
            $item->Kd_Urusan=$item->Kd_Urusan;
            $item->Kd_Bidang=$item->Kd_Urusan.'.'.$item->Kd_Bidang;
            if (isset($rka[0]))
            {
                $item->status='SUDAH DICOPY';
            }
            $item->PaguDana2=\DB::table('simda')
                                ->where('EntryLvl',2)
                                ->where('TA',$organisasi->TA)
                                ->where('kode_kegiatan',$item->kode_kegiatan)
                                ->sum('PaguUraian2');
            return $item;
        });
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'organisasi'=>$organisasi,
                                'rka'=>$data,
                                'message'=>'Fetch data rka murni berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);              
    }   
    public function copyrka(Request $request)
    {
        $this->validate($request, [             
            'OrgID'=>'required|exists:tmOrg,OrgID',            
            'kode_kegiatan'=>'required',            
        ]);
        
        $OrgID=$request->input('OrgID');
        $opd = OrganisasiModel::find($OrgID);
        $kode_kegiatan = $request->input('kode_kegiatan');
        
        $user_id=$this->getUserid();

        $str_insert = '
        INSERT INTO "trRKA" (
            "RKAID",
            kode_kegiatan,
            kode_urusan,
            kode_bidang,
            kode_organisasi,
            "kode_suborganisasi",
            kode_program,
            "Nm_Urusan",
            "Nm_Bidang",
            "OrgNm",
            "SOrgNm",
            "PrgNm",
            "KgtNm",
            "PaguDana1",
            "PaguDana2",
            "RealisasiKeuangan1",
            "RealisasiKeuangan2",
            "user_id",
            "EntryLvl",
            "TA",
            "Locked",
            created_at,
            updated_at
        )
        SELECT
            REPLACE(SUBSTRING(CONCAT(\'uid\',uuid_in(md5(random()::text || clock_timestamp()::text)::cstring)) from 1 for 16),\'-\',\'\') AS "RKAID",
            * 
        FROM
        (
            SELECT 
                DISTINCT(kode_kegiatan),
                CASE 
                    WHEN "Kd_Urusan" IS NULL THEN
                            SPLIT_PART(kode_organisasi, \'.\', 1)
                    ELSE
                            "Kd_Urusan"
                END AS kode_urusan,
                CASE 
                    WHEN "Kd_Bidang" IS NULL THEN
                            CONCAT(SPLIT_PART(kode_organisasi, \'.\', 1),\'.\',SPLIT_PART(kode_organisasi, \'.\', 2))
                    ELSE
                            CONCAT("Kd_Urusan",\'.\',"Kd_Bidang")
                END AS kode_bidang,	
                "kode_organisasi",
                "kode_suborganisasi",
                kode_program,		
                CASE 
                    WHEN "Kd_Urusan" IS NULL THEN
                            \'Non-Urusan\'
                    ELSE
                        "Nm_Urusan"
                END AS "Nm_Urusan",
                CASE 
                    WHEN "Kd_Bidang" IS NULL THEN
                            \'Non-Urusan\'
                    ELSE
                        "Nm_Bidang"
                END AS "Nm_Bidang",
                "OrgNm",
                "SOrgNm",
                "PrgNm",
                "KgtNm",	
                0 AS "PaguDana1",
                0 AS "PaguDana2",
                0 AS "RealisasiKeuangan1",
                0 AS "RealisasiKeuangan2",
                '.$user_id.' AS "user_id",
                "EntryLvl",
                "TA",
                false AS "Locked",
                NOW() AS created_at,
                NOW() AS updated_at
            FROM simda WHERE kode_kegiatan=\''.$kode_kegiatan.'\' AND 
                            kode_organisasi=\''.$opd->kode_organisasi.'\' AND 
                            "TA"='.$opd->TA.' AND      
                            "EntryLvl"=2
        ) AS temp
        ';
        \DB::statement($str_insert); 

        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',                                
                                'message'=>'Salin kegiatan dari data mentar ke RKA Perubahan berhasil'
                            ],200);    
    }
}