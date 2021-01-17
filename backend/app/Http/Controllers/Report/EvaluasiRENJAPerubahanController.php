<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\DMaster\OrganisasiModel;
use App\Models\Belanja\RKAModel;


class EvaluasiRENJAPerubahanController extends Controller 
{
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {             
        $this->hasPermissionTo('EVALUASI-RENJA-PERUBAHAN_BROWSE');

        $this->validate($request, [            
            'tahun'=>'required',                     
            'OrgID'=>'required|exists:tmOrg,OrgID',            
        ]);
        $tahun = $request->input('tahun');        
        $OrgID = $request->input('OrgID');
        
        $opd = OrganisasiModel::find($OrgID);
        
        $totalPaguOPD = (float)\DB::table('trRKA')
                                    ->where('kode_organisasi',$opd->kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',2)
                                    ->sum('PaguDana2');        
        
        $total_kegiatan=0;
        $total_uraian=0;
        $totalPersenTargetFisik=0;
        $totalFisikTW1=0;
        $totalKeuanganTW1=0;
        $totalFisikTW2=0;
        $totalKeuanganTW2=0;
        $totalFisikTW3=0;
        $totalKeuanganTW3=0;
        $totalFisikTW4=0;
        $totalKeuanganTW4=0;

        $daftar_program=\DB::table('simda')
                            ->select(\DB::raw('DISTINCT kode_program,"PrgNm"'))
                            ->orderBy('kode_program','ASC')
                            ->where('kode_organisasi',$opd->kode_organisasi)
                            ->get();
        
        $data=[];        
        foreach ($daftar_program as $data_program)
        {
            $kode_program = $data_program->kode_program;
            $daftar_kegiatan = \DB::table('trRKA')
                                    ->select(\DB::raw('"RKAID","kode_kegiatan","KgtNm",capaian_program2,tk_capaian2,keluaran2,tk_keluaran2,"PaguDana2","lokasi_kegiatan2"'))
                                    ->where('kode_program',$kode_program)                                            
                                    ->where('kode_organisasi',$opd->kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',2)
                                    ->orderBy('kode_kegiatan','ASC')
                                    ->get();

            $jumlahuraian_program = \DB::table('trRKARinc')                                        
                                        ->join('trRKA','trRKA.RKAID','trRKARinc.RKAID')
                                        ->where('kode_program',$kode_program) 
                                        ->where('kode_organisasi',$opd->kode_organisasi)
                                        ->where('trRKA.TA',$tahun)                                            
                                        ->where('trRKA.EntryLvl',2)
                                        ->count();	
                
            $data_target_program=\DB::table('trRKATargetRinc')
                                    ->join('trRKA','trRKA.RKAID','trRKATargetRinc.RKAID')
                                    ->select(\DB::raw('COALESCE(SUM(target2),0) AS totaltarget, COALESCE(SUM(fisik2),0) AS jumlah_fisik'))
                                    ->where('kode_program',$kode_program) 
                                    ->where('kode_organisasi',$opd->kode_organisasi)
                                    ->where('trRKA.TA',$tahun)                                        
                                    ->where('trRKA.EntryLvl',2)
                                    ->get();

            //menghitung persen target fisik program         
            $target_fisik_program=Helper::formatPecahan($data_target_program[0]->jumlah_fisik,$jumlahuraian_program);                            
            $persen_target_fisik_program= $target_fisik_program > 100 ?'100.00':$target_fisik_program;

            if(isset($daftar_kegiatan[0]))
            {
                $totalpagueachprogram=$daftar_kegiatan->sum('PaguDana2');
                  
                $data_realisasi_tw1=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->join('trRKA','trRKARealisasiRinc.RKAID','trRKA.RKAID')
                                            ->where('kode_program',$kode_program) 
                                            ->where('kode_organisasi',$opd->kode_organisasi)
                                            ->where('bulan2','>=',1)                            
                                            ->where('bulan2','<=',3)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();
                
                $fisik_tw_1=Helper::formatPecahan($data_realisasi_tw1[0]->fisik2,$jumlahuraian_program);
                $keuangan_tw_1=$data_realisasi_tw1[0]->realisasi2;
                
                $data_realisasi_tw2=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->join('trRKA','trRKARealisasiRinc.RKAID','trRKA.RKAID')
                                            ->where('kode_program',$kode_program) 
                                            ->where('kode_organisasi',$opd->kode_organisasi)
                                            ->where('bulan2','>=',4)                            
                                            ->where('bulan2','<=',6)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();
                
                $fisik_tw_2=Helper::formatPecahan($data_realisasi_tw2[0]->fisik2,$jumlahuraian_program);
                $keuangan_tw_2=$data_realisasi_tw2[0]->realisasi2;

                $data_realisasi_tw3=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->join('trRKA','trRKARealisasiRinc.RKAID','trRKA.RKAID')
                                            ->where('kode_program',$kode_program) 
                                            ->where('kode_organisasi',$opd->kode_organisasi)
                                            ->where('bulan2','>=',7)                            
                                            ->where('bulan2','<=',9)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();
                
                $fisik_tw_3=Helper::formatPecahan($data_realisasi_tw3[0]->fisik2,$jumlahuraian_program);
                $keuangan_tw_3=$data_realisasi_tw3[0]->realisasi2;

                $data_realisasi_tw4=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->join('trRKA','trRKARealisasiRinc.RKAID','trRKA.RKAID')
                                            ->where('kode_program',$kode_program) 
                                            ->where('kode_organisasi',$opd->kode_organisasi)
                                            ->where('bulan2','>=',10)                            
                                            ->where('bulan2','<=',12)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();
                
                $fisik_tw_4=Helper::formatPecahan($data_realisasi_tw4[0]->fisik2,$jumlahuraian_program);
                $keuangan_tw_4=$data_realisasi_tw4[0]->realisasi2;
                
                $data[]=[
                    'EvaluasiRKPPerubahanID'=>uniqid('uid'),
                    'RKAID'=>null,
                    'kode'=>$kode_program,
                    'nama'=>$data_program->PrgNm,            
                    'indikator_kinerja'=>$daftar_kegiatan[0]->capaian_program2,                                                                                    
                    'target_kinerja'=>$daftar_kegiatan[0]->tk_capaian2, 
                    'fisik_target2'=>$persen_target_fisik_program,
                    'pagu_dana2'=>$totalpagueachprogram,                                                                                   
                    'fisik_tw_1'=>$fisik_tw_1,                                                                                   
                    'keuangan_tw_1'=>$keuangan_tw_1,                                                                                   
                    'fisik_tw_2'=>$fisik_tw_2,                                                                                   
                    'keuangan_tw_2'=>$keuangan_tw_2,                                                                                   
                    'fisik_tw_3'=>$fisik_tw_3,                                                                                   
                    'keuangan_tw_3'=>$keuangan_tw_3,                                                                                   
                    'fisik_tw_4'=>$fisik_tw_4,                                                                                   
                    'keuangan_tw_4'=>$keuangan_tw_4,                                                                                   
                    
                ];           
                foreach ($daftar_kegiatan as $n)
                {
                    $RKAID=$n->RKAID;
                    $nilai_pagu_proyek=$n->PaguDana2;      

                    //jumlah baris uraian
                    $jumlahuraian = \DB::table('trRKARinc')->where('RKAID',$RKAID)->count();	
                    $total_uraian+=$jumlahuraian;

                    $data_target=\DB::table('trRKATargetRinc')
                                        ->select(\DB::raw('COALESCE(SUM(target2),0) AS totaltarget, COALESCE(SUM(fisik2),0) AS jumlah_fisik'))
                                        ->where('RKAID',$RKAID)                                    
                                        ->get();

                    $data_realisasi_tw1=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKAID',$RKAID)    
                                            ->where('bulan2','>=',1)                            
                                            ->where('bulan2','<=',3)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();

                    $fisik_tw_1=Helper::formatPecahan($data_realisasi_tw1[0]->fisik2,$jumlahuraian);
                    $keuangan_tw_1=$data_realisasi_tw1[0]->realisasi2;
                    $totalFisikTW1+=$fisik_tw_1;
                    $totalKeuanganTW1+=$keuangan_tw_1;

                    $data_realisasi_tw2=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKAID',$RKAID)    
                                            ->where('bulan2','>=',4)                            
                                            ->where('bulan2','<=',6)     
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                       
                                            ->get();

                    $fisik_tw_2=Helper::formatPecahan($data_realisasi_tw2[0]->fisik2,$jumlahuraian);
                    $keuangan_tw_2=$data_realisasi_tw2[0]->realisasi2;
                    $totalFisikTW2+=$fisik_tw_2;
                    $totalKeuanganTW2+=$keuangan_tw_2;

                    $data_realisasi_tw3=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKAID',$RKAID)    
                                            ->where('bulan2','>=',7)                            
                                            ->where('bulan2','<=',9)    
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                               
                                            ->get();
                    $fisik_tw_3=Helper::formatPecahan($data_realisasi_tw3[0]->fisik2,$jumlahuraian);
                    $keuangan_tw_3=$data_realisasi_tw3[0]->realisasi2;
                    $totalFisikTW3+=$fisik_tw_3;
                    $totalKeuanganTW3+=$keuangan_tw_3;

                    $data_realisasi_tw4=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKAID',$RKAID)    
                                            ->where('bulan2','>=',10)                            
                                            ->where('bulan2','<=',12)      
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                             
                                            ->get();
                    $fisik_tw_4=Helper::formatPecahan($data_realisasi_tw4[0]->fisik2,$jumlahuraian);
                    $keuangan_tw_4=$data_realisasi_tw4[0]->realisasi2;
                    $totalFisikTW4+=$fisik_tw_4;
                    $totalKeuanganTW4+=$keuangan_tw_4;

                    //menghitung persen target fisik         
                    $target_fisik=Helper::formatPecahan($data_target[0]->jumlah_fisik,$jumlahuraian);                            
                    $persen_target_fisik= $target_fisik > 100 ?'100.00':$target_fisik;
                    $totalPersenTargetFisik+=$persen_target_fisik;               

                    $data[]=[
                        'EvaluasiRKPPerubahanID'=>uniqid('uid'),
                        'RKAID'=>$RKAID,
                        'kode'=>$n->kode_kegiatan,
                        'nama'=>$n->KgtNm,      
                        'indikator_kinerja'=>$n->keluaran2,                               
                        'target_kinerja'=>$n->tk_keluaran2, 
                        'fisik_target2'=>$persen_target_fisik,
                        'pagu_dana2'=>$nilai_pagu_proyek,   
                        
                        'fisik_tw_1'=>$fisik_tw_1,                                                                                   
                        'keuangan_tw_1'=>$keuangan_tw_1,                                                                                   
                        'fisik_tw_2'=>$fisik_tw_2,                                                                                   
                        'keuangan_tw_2'=>$keuangan_tw_2,                                                                                   
                        'fisik_tw_3'=>$fisik_tw_3,                                                                                   
                        'keuangan_tw_3'=>$keuangan_tw_3,                                                                                   
                        'fisik_tw_4'=>$fisik_tw_4,                                                                                   
                        'keuangan_tw_4'=>$keuangan_tw_4,                                                                                   
                    ];

                    $total_kegiatan+=1;
                }
            }
        }
        $totalPersenTargetFisik = Helper::formatPecahan($totalPersenTargetFisik,$total_kegiatan); 
        $totalFisikTW1 = Helper::formatPecahan($totalFisikTW1,$total_kegiatan);         
        $totalFisikTW2 = Helper::formatPecahan($totalFisikTW2,$total_kegiatan);         
        $totalFisikTW3 = Helper::formatPecahan($totalFisikTW3,$total_kegiatan);         
        $totalFisikTW4 = Helper::formatPecahan($totalFisikTW4,$total_kegiatan); 
        


        $total_data=[
            'totalPaguOPD'=>$totalPaguOPD,
            'totalPersenTargetFisik'=>$totalPersenTargetFisik,            
            'totalFisikTW1'=>$totalFisikTW1,
            'totalKeuanganTW1'=>$totalKeuanganTW1,
            'totalFisikTW2'=>$totalFisikTW2,
            'totalKeuanganTW2'=>$totalKeuanganTW2,
            'totalFisikTW3'=>$totalFisikTW3,
            'totalKeuanganTW3'=>$totalKeuanganTW3,
            'totalFisikTW4'=>$totalFisikTW4,
            'totalKeuanganTW4'=>$totalKeuanganTW4,
        ];
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'opd'=>$opd,
                                    'rka'=>$data,
                                    'total_data'=>$total_data,
                                    'message'=>'Fetch data evaluasi rkpd perubahan berhasil diperoleh'
                                ],200);    
        
    }
    public function printtoexcel (Request $request)
    {
        $this->hasPermissionTo('EVALUASI-RENJA-PERUBAHAN_BROWSE');

        $this->validate($request, [            
            'tahun'=>'required',                     
            'OrgID'=>'required|exists:tmOrg,OrgID',            
        ]);
        $tahun = $request->input('tahun');        
        $OrgID = $request->input('OrgID');
        
        $opd = OrganisasiModel::find($OrgID);

        $data_report=[
                        'kode_organisasi'=>$opd->kode_organisasi,
                        'OrgNm'=>$opd->OrgNm,
                        'tahun'=>$tahun,                        
                        'nama_pengguna_anggaran'=>$opd->NamaKepalaUnitKerja,
                        'nip_pengguna_anggaran'=>$opd->NIPKepalaUnitKerja
                    ];
        $report= new \App\Models\Report\EvaluasiRENJAPerubahanModel ($data_report);
        $generate_date=date('Y-m-d_H_m_s');
        return $report->download("form_evaluasi_renja_perubahan_$generate_date.xlsx");
    }

}