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
            'kode_kegiatan'=>'required|exists:simda,kode_kegiatan',            
        ]);

        
    }
}