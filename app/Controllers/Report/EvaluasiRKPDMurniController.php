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
                                        'ik_program'=>'',                       
                                        'ik_kegiatan'=>'',                       
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
                                        'level'=>0,                       
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
                                    $UrsID=$item->UrsID;
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
                                        'ik_program'=>'',                       
                                        'ik_kegiatan'=>'',                       
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
                                        'level'=>1,                       
                                        'OrgID'=>null,                       
                                        'OrgNm'=>null];

                                        RekapEvaluasiRKPDMurniModel::create($data_urusan);

                                        \DB::table('v_rka')
                                                    ->select(\DB::raw('"PrgID",kode_program,"PrgNm"'))
                                                    ->where('UrsID',$UrsID)
                                                    ->where('TA',\HelperKegiatan::getTahunPerencanaan())
                                                    ->where('EntryLvl',1)
                                                    ->groupBy('PrgID')
                                                    ->groupBy('kode_program')
                                                    ->groupBy('PrgNm')
                                                    ->orderBy('kode_program')
                                                    ->chunk(5, function ($program) use ($PrioritasSasaranKabID,$Nm_Sasaran,$nama_urusan,$nama_bidang) {
                                                        foreach ($program as $item)
                                                        {
                                                            $PrgID=$item->PrgID;
                                                            $kode_program=$item->kode_program;
                                                            $PrgNm=$item->PrgNm;
                                                            $data_program=['TA'=>\HelperKegiatan::getTahunPerencanaan(),
                                                                        'kode'=>$kode_program,
                                                                        'PrioritasSasaranKabID'=>$PrioritasSasaranKabID,                  
                                                                        'Nm_Sasaran'=>$Nm_Sasaran,                       
                                                                        'Nm_Urusan'=>$nama_urusan,  
                                                                        'Nm_Bidang'=>$nama_bidang,                     
                                                                        'PrgNm'=>$PrgNm,                       
                                                                        'KgtNm'=>'',                       
                                                                        'ik_program'=>'',                       
                                                                        'ik_kegiatan'=>'',                       
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
                                                                        'level'=>2,                       
                                                                        'OrgID'=>null,                       
                                                                        'OrgNm'=>null];

                                                            RekapEvaluasiRKPDMurniModel::create($data_program);

                                                            \DB::table('v_rka')
                                                                        ->select(\DB::raw('"RKAID","KgtID","Nm_Urusan","Nm_Bidang","PrgNm",kode_kegiatan,"KgtNm",hasil1,"PaguDana1","OrgID","OrgNm"'))
                                                                        ->where('PrgID',$PrgID)
                                                                        ->where('TA',\HelperKegiatan::getTahunPerencanaan())
                                                                        ->where('EntryLvl',1)
                                                                        ->orderBy('kode_kegiatan')
                                                                        ->chunk(10, function ($kegiatan) use ($PrioritasSasaranKabID,$Nm_Sasaran) {
                                                                            foreach ($kegiatan as $item)
                                                                            {
                                                                                $data_kegiatan=['TA'=>\HelperKegiatan::getTahunPerencanaan(),
                                                                                            'kode'=>$item->kode_kegiatan,
                                                                                            'PrioritasSasaranKabID'=>$PrioritasSasaranKabID,                       
                                                                                            'Nm_Sasaran'=>$Nm_Sasaran,                       
                                                                                            'Nm_Urusan'=>$item->Nm_Urusan,  
                                                                                            'Nm_Bidang'=>$item->Nm_Bidang,                     
                                                                                            'PrgNm'=>$item->PrgNm,                       
                                                                                            'KgtNm'=>$item->KgtNm,                       
                                                                                            'ik_program'=>'',                       
                                                                                            'ik_kegiatan'=>$item->hasil1,                       
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
                                                                                            'level'=>3,                       
                                                                                            'OrgID'=>$item->OrgID,                       
                                                                                            'OrgNm'=>$item->OrgNm];

                                                                                RekapEvaluasiRKPDMurniModel::create($data_kegiatan);
                                                                            }
                                                                        });
                                                        }
                                                    });
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
                                'data'=>$rekap,
                                'generated_html'=>$generated_html
                                ],200);          

                     
    }     
    
 
}