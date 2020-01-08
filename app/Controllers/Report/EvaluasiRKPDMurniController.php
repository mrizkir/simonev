<?php

namespace App\Controllers\Report;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\RKA\RKAKegiatanModel;
use App\Models\RKA\RKARincianKegiatanModel;
use App\Models\RKA\RKARealisasiRincianKegiatanModel;
use App\Models\Report\RekapEvaluasiRKPDMurniModel;

class EvaluasiRKPDMurniController extends Controller 
{
    private $dataRKA;
     /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth']);
        //set nama session 
        $this->SessionName=$this->getNameForSession();      
        //set nama halaman saat ini
        $this->NameOfPage = \Helper::getNameOfPage();
    }
    /**
     * collect data from resources for index view
     *
     * @return \Illuminate\Http\Response
     */
    public function populateData (Request $request) 
    {  
        //hapus rekap      
        RekapEvaluasiRKPDMurniModel::where('TA',\HelperKegiatan::getTahunPerencanaan())
                                            ->delete();
        //dapatkan daftar sasaran
        \DB::table('tmPrioritasSasaranKab')
                        ->select(\DB::raw('"PrioritasSasaranKabID","Nm_Sasaran"'))
                        ->where('TA',\HelperKegiatan::getRPJMDTahunMulai())
                        ->orderBy('Nm_Sasaran','ASC')
                        ->chunk(25, function($daftar_sasaran){                            
                            foreach ($daftar_sasaran as $item)
                            {
                                $PrioritasSasaranKabID=$item->PrioritasSasaranKabID;
                                $Nm_Sasaran=$item->Nm_Sasaran;
                                $sasaran=['TA'=>\HelperKegiatan::getTahunPerencanaan(),
                                        'kode'=>'',
                                        'PrioritasSasaranKabID'=>$PrioritasSasaranKabID,                       
                                        'Nm_Sasaran'=>$Nm_Sasaran,                       
                                        'Nm_Urusan'=>'',                       
                                        'Nm_Bidang'=>'',                       
                                        'PrgNm'=>'',                       
                                        'KgtNm'=>'',                       
                                        'ik_program'=>0,                       
                                        'ik_kegiatan'=>0,                       
                                        't_rpjmd_n_k'=>0,                       
                                        't_rpjmd_n_rp'=>0,                       
                                        'rck_rpjmd_n_min_2_k'=>0,                       
                                        'rck_rpjmd_n_min_2_rp'=>0,                       
                                        'tk_rkpd_n_min_1_k'=>0,                       
                                        'tk_rkpd_n_min_1_rp'=>0,                       
                                        'rk_tw1_k'=>0,                       
                                        'rk_tw1_rp'=>0,                       
                                        'rk_tw2_k'=>0,                       
                                        'rk_tw2_rp'=>0,                       
                                        'rk_tw3_k'=>0,                       
                                        'rk_tw3_rp'=>0,                       
                                        'rk_tw4_k'=>0,                       
                                        'rk_tw4_rp'=>0,                       
                                        'rck_rkpd_k'=>0,                       
                                        'rck_rkpd_rp'=>0,                       
                                        'rk_rpjmd_sd_n_k'=>0,                       
                                        'rk_rpjmd_sd_n_rp'=>0,                       
                                        'OrgID'=>null,                       
                                        'OrgNm'=>null];

                                RekapEvaluasiRKPDMurniModel::create($sasaran);
                                
                                //dapatkan urusan
                                $subquery=\DB::table('trRpjmdProgramPembangunan')
                                                ->select('UrsID')
                                                ->where('PrioritasSasaranKabID',$PrioritasSasaranKabID)
                                                ->groupBy('UrsID');

                                $urusan = \DB::table('v_urusan')
                                                ->select(\DB::raw('"v_urusan"."UrsID","v_urusan"."Nm_Urusan","v_urusan"."Kode_Bidang","v_urusan"."Nm_Bidang"'))
                                                ->joinSub($subquery,'B',function($join){
                                                    $join->on('v_urusan.UrsID','=','B.UrsID');
                                                })
                                                ->get();
                             
                                foreach ($urusan as $item)
                                {
                                    $kode_bidang=$item->Kode_Bidang;
                                    $nama_urusan=$item->Nm_Urusan;
                                    $nama_bidang=$item->Nm_Bidang;
                                    $data_urusan=['TA'=>\HelperKegiatan::getTahunPerencanaan(),
                                        'kode'=>$kode_bidang,
                                        'PrioritasSasaranKabID'=>$PrioritasSasaranKabID,                       
                                        'Nm_Sasaran'=>$Nm_Sasaran,                       
                                        'Nm_Urusan'=>$nama_urusan,  
                                        'Nm_Bidang'=>$nama_bidang,                     
                                        'PrgNm'=>'',                       
                                        'KgtNm'=>'',                       
                                        'ik_program'=>0,                       
                                        'ik_kegiatan'=>0,                       
                                        't_rpjmd_n_k'=>0,                       
                                        't_rpjmd_n_rp'=>0,                       
                                        'rck_rpjmd_n_min_2_k'=>0,                       
                                        'rck_rpjmd_n_min_2_rp'=>0,                       
                                        'tk_rkpd_n_min_1_k'=>0,                       
                                        'tk_rkpd_n_min_1_rp'=>0,                       
                                        'rk_tw1_k'=>0,                       
                                        'rk_tw1_rp'=>0,                       
                                        'rk_tw2_k'=>0,                       
                                        'rk_tw2_rp'=>0,                       
                                        'rk_tw3_k'=>0,                       
                                        'rk_tw3_rp'=>0,                       
                                        'rk_tw4_k'=>0,                       
                                        'rk_tw4_rp'=>0,                       
                                        'rck_rkpd_k'=>0,                       
                                        'rck_rkpd_rp'=>0,                       
                                        'rk_rpjmd_sd_n_k'=>0,                       
                                        'rk_rpjmd_sd_n_rp'=>0,                       
                                        'OrgID'=>null,                       
                                        'OrgNm'=>null];

                                        RekapEvaluasiRKPDMurniModel::create($data_urusan);
                                }
                            }                            
                        });

                                
        return $this->index($request);
    }        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                                   
        $rekap=RekapEvaluasiRKPDMurniModel::where('TA',\HelperKegiatan::getTahunPerencanaan())
                                            ->get();    
        $generated_html = view("pages.evaluasirkpdm.datatable")->with([
                                                                    'data'=>$rekap,
                                                                ])->render();
        return response()->json([
                                'generated_html'=>$generated_html
                                ],200);          

                     
    }     
    
 
}