<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\DMaster\OrganisasiModel;
use App\Models\Belanja\RKAModel;

class FormBOPDMurniController extends Controller 
{
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {             
        $this->hasPermissionTo('FORM B MURNI_BROWSE');

        $this->validate($request, [            
            'tahun'=>'required',         
            'no_bulan'=>'required',   
            'OrgID'=>'required|exists:tmOrg,OrgID',            
        ]);
        $tahun = $request->input('tahun');
        $no_bulan = $request->input('no_bulan');
        $OrgID = $request->input('OrgID');
        
        $opd = OrganisasiModel::find($OrgID);
        
        $totalPaguOPD = (float)\DB::table('trRKA')
                                    ->where('kode_organisasi',$opd->kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',1)
                                    ->sum('PaguDana1');        
        
        $total_kegiatan=0;
        $total_uraian=0;
        $totalPersenBobot=0;
        $totalPersenTargetFisik=0;
        $totalPersenRealisasiFisik=0;
        $total_ttb_fisik=0;
        $totalTargetKeuanganKeseluruhan=0;
        $totalRealisasiKeuanganKeseluruhan=0;
        $total_ttb_keuangan=0;
        $totalSisaAnggaran=0;

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
                                    ->select(\DB::raw('"RKAID","kode_kegiatan","KgtNm","PaguDana1","lokasi_kegiatan1"'))
                                    ->where('kode_program',$kode_program)                                            
                                    ->where('kode_organisasi',$opd->kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',1)
                                    ->orderBy('kode_kegiatan','ASC')
                                    ->get();

            if(isset($daftar_kegiatan[0]))
            {
                $totalpagueachprogram=$daftar_kegiatan->sum('PaguDana1');
                $persen_bobot_program=Helper::formatPersen($totalpagueachprogram,$totalPaguOPD);
                
                $jumlahuraian_program = \DB::table('trRKARinc')                                        
                                        ->join('trRKA','trRKA.RKAID','trRKARinc.RKAID')
                                        ->where('kode_program',$kode_program) 
                                        ->where('kode_organisasi',$opd->kode_organisasi)
                                        ->where('trRKA.TA',$tahun)                                            
                                        ->where('trRKA.EntryLvl',1)
                                        ->count();	
                
                $data_target_program=\DB::table('trRKATargetRinc')
                                    ->join('trRKA','trRKA.RKAID','trRKATargetRinc.RKAID')
                                    ->select(\DB::raw('COALESCE(SUM(target1),0) AS totaltarget, COALESCE(SUM(fisik1),0) AS jumlah_fisik'))
                                    ->where('kode_program',$kode_program) 
                                    ->where('kode_organisasi',$opd->kode_organisasi)
                                    ->where('trRKA.TA',$tahun)    
                                    ->where('bulan1','<=',$no_bulan)
                                    ->where('trRKA.EntryLvl',1)
                                    ->get();

                $data_realisasi_program=\DB::table('trRKARealisasiRinc')
                                ->join('trRKA','trRKA.RKAID','trRKARealisasiRinc.RKAID')
                                ->select(\DB::raw('COALESCE(SUM(realisasi1),0) AS realisasi1, COALESCE(SUM(fisik1),0) AS fisik1'))
                                ->where('kode_program',$kode_program) 
                                ->where('kode_organisasi',$opd->kode_organisasi)
                                ->where('trRKA.TA',$tahun)    
                                ->where('bulan1','<=',$no_bulan)
                                ->where('trRKA.EntryLvl',1)
                                ->get();

                //menghitung persen target fisik program         
                $target_fisik_program=Helper::formatPecahan($data_target_program[0]->jumlah_fisik,$jumlahuraian_program);                            
                $persen_target_fisik_program= $target_fisik_program > 100 ?'100.00':$target_fisik_program;                             
                
                //menghitung persen realisasi fisik                
                $persen_realisasi_fisik_program=Helper::formatPecahan($data_realisasi_program[0]->fisik1,$jumlahuraian_program);
                
                $persen_tertimbang_fisik_program=0.00;
                if ($persen_realisasi_fisik_program > 0 && $persen_bobot_program > 0)
                {
                    $persen_tertimbang_fisik_program=number_format(($persen_realisasi_fisik_program*$persen_bobot_program)/100,2);                            
                }							

                // menghitung total target dan realisasi keuangan                 
                $persen_target_keuangan_program=Helper::formatPersen($data_target_program[0]->totaltarget,$totalpagueachprogram); 
                $persen_realisasi_keuangan_program=Helper::formatPersen($data_realisasi_program[0]->realisasi1,$totalpagueachprogram);  

                $persen_tertimbang_keuangan_program=0.00;
                if ($persen_realisasi_keuangan_program > 0 && $persen_bobot_program > 0)
                {
                    $persen_tertimbang_keuangan_program=number_format(($persen_realisasi_keuangan_program*$persen_bobot_program)/100,2);                            
                }	

                $sisa_anggaran_program=$totalpagueachprogram-$data_realisasi_program[0]->realisasi1;
                $persen_sisa_anggaran_program=Helper::formatPersen($sisa_anggaran_program,$totalpagueachprogram);  

                $data[]=[
                    'FormBMurniID'=>uniqid('uid'),
                    'RKAID'=>null,
                    'kode'=>$kode_program,
                    'nama'=>$data_program->PrgNm,
                    'pagu_dana1'=>$totalpagueachprogram,
                    'bobot1'=>$persen_bobot_program,
                    'fisik_target1'=>$persen_target_fisik_program,
                    'fisik_realisasi1'=>$persen_realisasi_fisik_program,
                    'fisik_ttb1'=>$persen_tertimbang_fisik_program,
                    'keuangan_target1'=>$data_target_program[0]->totaltarget,
                    'keuangan_target_persen_1'=>$persen_target_keuangan_program,
                    'keuangan_realisasi1'=>$data_realisasi_program[0]->realisasi1,
                    'keuangan_realisasi_persen_1'=>$persen_realisasi_keuangan_program,
                    'keuangan_ttb1'=>$persen_tertimbang_keuangan_program,
                    'lokasi'=>'-',
                    'sisa_anggaran'=>$sisa_anggaran_program,
                    'sisa_anggaran_persen'=>$persen_sisa_anggaran_program,
                ];

                foreach ($daftar_kegiatan as $n)
                {
                    $RKAID=$n->RKAID;
                    $nilai_pagu_proyek=$n->PaguDana1;
                    $persen_bobot=Helper::formatPersen($nilai_pagu_proyek,$totalPaguOPD);
                    $totalPersenBobot+=$persen_bobot;

                    //jumlah baris uraian
                    $jumlahuraian = \DB::table('trRKARinc')->where('RKAID',$RKAID)->count();	
                    $total_uraian+=$jumlahuraian;

                    $data_target=\DB::table('trRKATargetRinc')
                                        ->select(\DB::raw('COALESCE(SUM(target1),0) AS totaltarget, COALESCE(SUM(fisik1),0) AS jumlah_fisik'))
                                        ->where('RKAID',$RKAID)
                                        ->where('bulan1','<=',$no_bulan)
                                        ->get();

                    $data_realisasi=\DB::table('trRKARealisasiRinc')
                                    ->select(\DB::raw('COALESCE(SUM(realisasi1),0) AS realisasi1, COALESCE(SUM(fisik1),0) AS fisik1'))
                                    ->where('RKAID',$RKAID)
                                    ->where('bulan1','<=',$no_bulan)
                                    ->get();

                    //menghitung persen target fisik         
                    $target_fisik=Helper::formatPecahan($data_target[0]->jumlah_fisik,$jumlahuraian);                            
                    $persen_target_fisik= $target_fisik > 100 ?'100.00':$target_fisik;
                    $totalPersenTargetFisik+=$persen_target_fisik;               

                    //menghitung persen realisasi fisik                
                    $persen_realisasi_fisik=Helper::formatPecahan($data_realisasi[0]->fisik1,$jumlahuraian);
                    $totalPersenRealisasiFisik+=$persen_realisasi_fisik; 
                    
                    $persen_tertimbang_fisik=0.00;
                    if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                    {
                        $persen_tertimbang_fisik=number_format(($persen_realisasi_fisik*$persen_bobot)/100,2);                            
                    }							
                    $total_ttb_fisik+=$persen_tertimbang_fisik;

                    //menghitung total target dan realisasi keuangan 
                    $totalTargetKeuangan=$data_target[0]->totaltarget;
                    $totalTargetKeuanganKeseluruhan+=$totalTargetKeuangan;
                    $persen_target_keuangan=Helper::formatPersen($totalTargetKeuangan,$nilai_pagu_proyek);                            							                                 
                
                    $totalRealisasiKeuangan=$data_realisasi[0]->realisasi1;
                    $totalRealisasiKeuanganKeseluruhan+=$totalRealisasiKeuangan;
                    $persen_realisasi_keuangan=Helper::formatPersen($totalRealisasiKeuangan,$nilai_pagu_proyek);  
                    
                    $persen_tertimbang_keuangan=0.00;
                    if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                    {
                        $persen_tertimbang_keuangan=number_format(($persen_realisasi_keuangan*$persen_bobot)/100,2);                            
                    }	
                    $total_ttb_keuangan += $persen_tertimbang_keuangan;

                    $sisa_anggaran=$nilai_pagu_proyek-$totalRealisasiKeuangan;
                    $totalSisaAnggaran+=$sisa_anggaran; 
                    
                    $persen_sisa_anggaran=Helper::formatPersen($sisa_anggaran,$nilai_pagu_proyek);                            

                    
                    $data[]=[
                        'FormBMurniID'=>uniqid('uid'),
                        'RKAID'=>$RKAID,
                        'kode'=>$n->kode_kegiatan,
                        'nama'=>$n->KgtNm,
                        'pagu_dana1'=>$nilai_pagu_proyek,
                        'bobot1'=>$persen_bobot,
                        'fisik_target1'=>$persen_target_fisik,
                        'fisik_realisasi1'=>$persen_realisasi_fisik,
                        'fisik_ttb1'=>$persen_tertimbang_fisik,
                        'keuangan_target1'=>$totalTargetKeuangan,
                        'keuangan_target_persen_1'=>$persen_target_keuangan,
                        'keuangan_realisasi1'=>$totalRealisasiKeuangan,
                        'keuangan_realisasi_persen_1'=>$persen_realisasi_keuangan,
                        'keuangan_ttb1'=>$persen_tertimbang_keuangan,
                        'lokasi'=>$n->lokasi_kegiatan1,
                        'sisa_anggaran'=>$sisa_anggaran,
                        'sisa_anggaran_persen'=>$persen_sisa_anggaran,
                    ];

                    $total_kegiatan+=1;
                }
            }
        }
        
        if ($totalPersenBobot > 100) {
            $totalPersenBobot = 100.000;
        }
        $totalPersenTargetFisik = Helper::formatPecahan($totalPersenTargetFisik,$total_kegiatan);        
        $totalPersenRealisasiFisik=Helper::formatPecahan($totalPersenRealisasiFisik,$total_kegiatan); 
        $totalPersenTargetKeuangan=Helper::formatPersen($totalTargetKeuanganKeseluruhan,$totalPaguOPD);                
        $totalPersenRealisasiKeuangan=Helper::formatPersen($totalRealisasiKeuanganKeseluruhan,$totalPaguOPD);
        $totalPersenSisaAnggaran=Helper::formatPersen($totalSisaAnggaran,$totalPaguOPD);
        $totalPersenBobot=round($totalPersenBobot,2);
        $total_ttb_fisik=round($total_ttb_fisik,2);
        $total_ttb_keuangan=round($total_ttb_keuangan,2);
        $total_data=[
            'totalPaguOPD'=>$totalPaguOPD,
            'totalPersenBobot'=>$totalPersenBobot,
            'totalPersenTargetFisik'=>$totalPersenTargetFisik,
            'totalPersenRealisasiFisik'=>$totalPersenRealisasiFisik,
            'total_ttb_fisik'=>$total_ttb_fisik,
            'totalTargetKeuanganKeseluruhan'=>$totalTargetKeuanganKeseluruhan,
            'totalRealisasiKeuanganKeseluruhan'=>$totalRealisasiKeuanganKeseluruhan,
            'totalPersenTargetKeuangan'=>$totalPersenTargetKeuangan,
            'totalPersenRealisasiKeuangan'=>$totalPersenRealisasiKeuangan,
            'total_ttb_keuangan'=>$total_ttb_keuangan,
            'totalSisaAnggaran'=>$totalSisaAnggaran,
            'totalPersenSisaAnggaran'=>$totalPersenSisaAnggaran,
        ];       
        
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'opd'=>$opd,
                                    'rka'=>$data,
                                    'total_data'=>$total_data,                                    
                                    'message'=>'Fetch data form b murni berhasil diperoleh'
                                ],200);    
        
    }
    public function printtoexcel (Request $request)
    {
        $this->hasPermissionTo('FORM B MURNI_BROWSE');

        $this->validate($request, [            
            'tahun'=>'required',         
            'no_bulan'=>'required',   
            'OrgID'=>'required|exists:tmOrg,OrgID',            
        ]);
        $tahun = $request->input('tahun');
        $no_bulan = $request->input('no_bulan');
        $OrgID = $request->input('OrgID');
        
        $opd = OrganisasiModel::find($OrgID);
        if (\DB::table('trRKA')->where('kode_organisasi',$opd->kode_organisasi)->where('EntryLvl',1)->where('TA',$tahun)->count()>0)
        {
            $data_report=[
                            'kode_organisasi'=>$opd->kode_organisasi,
                            'OrgNm'=>$opd->OrgNm,
                            'tahun'=>$tahun,
                            'no_bulan'=>$no_bulan,
                            'nama_pengguna_anggaran'=>$opd->NamaKepalaOPD,
                            'nip_pengguna_anggaran'=>$opd->NIPKepalaOPD
                        ];
            $report= new \App\Models\Report\FormBOPDMurniModel ($data_report);
            $generate_date=date('Y-m-d_H_m_s');
            return $report->download("form_b_$generate_date.xlsx");
        }
        else
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'fetchdata',                                                                            
                                    'message'=>['Print excel gagal dilakukan karena tidak ada belum ada Uraian pada kegiatan ini']
                                ],422); 
        }
    }

}