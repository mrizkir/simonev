<?php

namespace App\Http\Controllers\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\DMaster\SubOrganisasiModel;
use App\Models\DMaster\SIMDAModel;
use App\Models\Belanja\RKAModel;
use App\Models\Belanja\RKARincianModel;
use App\Models\Belanja\RKARencanaTargetModel;
use App\Models\Belanja\RKARealisasiModel;

class DataMentahMurniController extends Controller 
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {             
        $this->hasPermissionTo('RKA MURNI_BROWSE');
        
        $this->validate($request, [            
            'tahun'=>'required',            
            'SOrgID'=>'required|exists:tmSOrg,SOrgID',            
        ]);
        $tahun = $request->input('tahun');
        $SOrgID = $request->input('SOrgID');
        $unitkerja = SubOrganisasiModel::find($SOrgID);
     
        $data = SimdaModel::select(\DB::raw('
                            DISTINCT(kode_kegiatan) AS kode_kegiatan,
                            "KgtNm",
                            kode_program,                                                        
                            "PrgNm",
                            0 AS "PaguDana1",
                            \'BELUM DICOPY\' AS status,                                                                                    
                            "TA"
                        '))
                        ->where('kode_suborganisasi',$unitkerja->kode_suborganisasi)
                        ->where('TA',$tahun)
                        ->where('EntryLvl',1)
                        ->orderBy('kode_program','ASC')
                        ->orderBy('kode_kegiatan','ASC')
                        ->get();        
        
        $data->transform(function($item,$key) use ($unitkerja){
            $rka = \DB::table('trRKA')
                        ->where('kode_suborganisasi',$unitkerja->kode_suborganisasi)
                        ->where('TA',$unitkerja->TA)
                        ->where('EntryLvl',1)
                        ->where('kode_kegiatan',$item->kode_kegiatan)
                        ->get();

            if (isset($rka[0]))
            {
                $item->status='SUDAH DICOPY';
            }
            $item->PaguDana1=\DB::table('simda')
                                ->where('EntryLvl',1)
                                ->where('TA',$unitkerja->TA)
                                ->where('kode_kegiatan',$item->kode_kegiatan)
                                ->sum('PaguUraian1');
            return $item;
        });
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'unitkerja'=>$unitkerja,
                                'rka'=>$data,
                                'message'=>'Fetch data rka murni berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);              
    }   
    
}