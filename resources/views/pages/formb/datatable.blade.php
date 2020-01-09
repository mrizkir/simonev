@if (count($daftar_program) > 0)
<div class="table-responsive">
@php
    $totalPaguUnit = (float)\DB::table('trRKA')->where('OrgID',$filters['OrgID'])->sum('PaguDana1');
    $no_huruf=ord('a');                                       
    $jumlah_kegiatan=0;
    $jumlah_uraian=0;
    $totalPersenBobot=0;
    $totalPersenTargetFisik=0;
    $totalPersenRealisasiFisik=0;
    $total_ttb_fisik=0;
    $totalTargetKeuanganKeseluruhan=0;
    $totalRealisasiKeuanganKeseluruhan=0;
    $total_ttb_keuangan=0;
    $totalSisaAnggaran=0;
    $no_bulan = $filters['bulan_realisasi'];
@endphp
@if ($totalPaguUnit > 0)
<table class="table table-striped table-bordered mb-2 table-condensed">
    <thead>       
        <tr>
            <th rowspan="2" class="text-center">NOMOR</th>
            <th rowspan="2" class="text-center">KODE</th>
            <th rowspan="2" width="350" class="text-center">PROGRAM/KEGIATAN</th>                            
            <th rowspan="2" class="text-center">PAGU DANA<br />(RP)</th>
            <th rowspan="2" class="text-center">BOBOT<br />(%)</th>
            <th colspan="3" class="text-center">FISIK</th>										
            <th colspan="5" class="text-center">KEUANGAN</th>							
            <th rowspan="2" width="100" class="text-center">LOKASI</th>										
            <th colspan="2" class="text-center">SISA ANGGARAN</th>		                                                        
        </tr>	                       
        <tr>																	
            <th class="text-center">TARGET (%)</th>		
            <th class="text-center">REALISASI (%)</th>
            <th class="text-center">TTB (%)</th>
            <th class="text-center">TARGET <br />(RP)</th>
            <th class="text-center">TARGET <br />(%)</th>
            <th class="text-center">REALISASI (Rp)</th>
            <th class="text-center">REALISASI (%)</th>	
            <th class="text-center">TTB (%)</th>
            <th class="text-center">(Rp)</th>
            <th class="text-center">(%)</th>
        </tr>				                        			
        <tr>				
            <th class="text-center">1</th>
            <th class="text-center">2</th>
            <th class="text-center">3</th>					
            <th class="text-center">4</th>
            <th class="text-center">5</th>
            <th class="text-center">6</th>					
            <th class="text-center">7</th>					
            <th class="text-center">8</th>
            <th class="text-center">9</th>
            <th class="text-center">10</th>
            <th class="text-center">11</th>
            <th class="text-center">12</th>					
            <th class="text-center">13</th>
            <th class="text-center">14</th>          
            <th class="text-center">15</th>
            <th class="text-center">16</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($daftar_program as $PrgID=>$data_program)
            @php
                $daftar_kegiatan = \DB::table(HelperKegiatan::getViewName(Helper::getNameOfPage()))
                                    ->where('PrgID',$PrgID)                                            
                                    ->where($col_name,$col_value)                                            
                                    ->where('TA', HelperKegiatan::getTahunAnggaran())  
                                    ->where('EntryLvl',HelperKegiatan::getLevelEntriByName(Helper::getNameOfPage()))
                                    ->get();
                
            @endphp            
            @if(isset($daftar_kegiatan[0]))
            @php
                // dd($daftar_kegiatan);
                $totalpagueachprogram=0;
                foreach ($daftar_kegiatan as $eachprogram) {
                    $totalpagueachprogram+=$eachprogram->PaguDana1;
                }        
                $no=0;        
            @endphp
            <tr>				
                <td class="text-center"><strong>{{chr($no_huruf)}}</strong></td>
                <td class="text-left"><strong>{{$data_program['kode_program']}}</strong></td>
                <td class="text-left"><strong>{{$data_program['PrgNm']}}</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang($totalpagueachprogram)}}</strong></td>
                <td class="text-left">&nbsp;</td>					                                
                <td class="text-left">&nbsp;</td>
                <td class="text-left">&nbsp;</td>
                <td class="text-left">&nbsp;</td>
                <td class="text-left">&nbsp;</td>
                <td class="text-left">&nbsp;</td>						
                <td class="text-left">&nbsp;</td>
                <td class="text-left">&nbsp;</td>
                <td class="text-left">&nbsp;</td>					
                <td class="text-left">&nbsp;</td>
                <td class="text-left">&nbsp;</td>					
                <td class="text-left">&nbsp;</td>
            </tr>
            @foreach ($daftar_kegiatan as $n)
            @php
                $RKAID=$n->RKAID;
                $nilai_pagu_proyek=$n->PaguDana1;
                $persen_bobot=Helper::formatPersen($nilai_pagu_proyek,$totalPaguUnit);
                $totalPersenBobot+=$persen_bobot;

                //jumlah baris uraian
                $jumlahuraian = \DB::table('trRKARinc')->where('RKAID',$RKAID)->count();	
                $jumlah_uraian+=$jumlahuraian;

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
                    $persen_tertimbang_fisik=number_format(($persen_realisasi_fisik*$persen_bobot)/100,3);                            
                }							
                $total_ttb_fisik+=$persen_tertimbang_fisik;

                //menghitung total target dan realisasi keuangan 
                $totalTargetKeuangan=$data_target[0]->totaltarget;
                $totalTargetKeuanganKeseluruhan+=$totalTargetKeuangan;
                $persen_target_keuangan=Helper::formatPersen($totalTargetKeuangan,$nilai_pagu_proyek);                            							                                 
              
                $totalRealisasiKeuangan=$data_realisasi[0]->realisasi1;
                $totalRealisasiKeuanganKeseluruhan+=$totalRealisasiKeuangan;
                $persen_realisasi_keuangan=Helper::formatPersen($totalRealisasiKeuangan,$nilai_pagu_proyek);  

                if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                {
                    $persen_tertimbang_keuangan=number_format(($persen_realisasi_keuangan*$persen_bobot)/100,3);                            
                }	
                $total_ttb_keuangan += $persen_tertimbang_keuangan;

                $sisa_anggaran=$nilai_pagu_proyek-$totalRealisasiKeuangan;
                $totalSisaAnggaran+=$sisa_anggaran; 
                
                $persen_sisa_anggaran=Helper::formatPersen($sisa_anggaran,$nilai_pagu_proyek);                            

                $no+=1;
                $jumlah_kegiatan+=1;
            @endphp            
            <tr>
                <td class="text-center">{{$no}}</td>
                <td class="text-center">{{$n->kode_organisasi.'.'.$n->kode_kegiatan}}</td>
                <td class="text-left">{{$n->KgtNm}}</td>
                <td class="text-right">{{Helper::formatUang($nilai_pagu_proyek)}}</td>            
                <td class="text-center">{{$persen_bobot}}</td>       
                <td class="text-center">{{$persen_target_fisik}}</td>                                                                                             
                <td class="text-center">{{$persen_realisasi_fisik}}</td>  
                <td class="text-center">{{$persen_tertimbang_fisik}}</td>
                <td class="text-center">{{Helper::formatUang($totalTargetKeuangan)}}</td>         
                <td class="text-center">{{$persen_target_keuangan}}</td>                                                   
                <td class="text-right">{{Helper::formatUang($totalRealisasiKeuangan)}}</td>					
                <td class="text-center">{{$persen_realisasi_keuangan}}</td>             
                <td class="text-center">{{$persen_tertimbang_keuangan}}</td> 
                <td class=text-right>{{$n->lokasi_kegiatan1}}</td>
                <td class="text-right">{{Helper::formatUang($sisa_anggaran)}}</td>										
                <td class="text-center">{{$persen_sisa_anggaran}}</td>
            </tr>
            @endforeach
            @php
                $no_huruf+=1; 
            @endphp
            @endif
        @endforeach
    </tbody>
    <tfoot>
        @php
        $rp_total_pagu_unit=Helper::formatUang($totalPaguUnit);
        $rp_total_target_keuangan_keseluruhan=Helper::formatUang($totalTargetKeuanganKeseluruhan);
        $rp_total_realisasi_keuangan_keseluruhan=Helper::formatUang($totalRealisasiKeuanganKeseluruhan);                                                  
        
        if ($totalPersenTargetFisik > 0) {            
            $totalPersenTargetFisik = Helper::formatPecahan($totalPersenTargetFisik,$jumlah_kegiatan);
        }
        
        if ($totalPersenRealisasiFisik > 0)  {
            $totalPersenRealisasiFisik=Helper::formatPecahan($totalPersenRealisasiFisik,$jumlah_kegiatan); 
        }
        
        $totalPersenTargetKeuangan=Helper::formatPersen($totalTargetKeuanganKeseluruhan,$totalPaguUnit);                
        $totalPersenRealisasiKeuangan=Helper::formatPersen($totalRealisasiKeuanganKeseluruhan,$totalPaguUnit);

        $rp_total_sisa_anggaran=Helper::formatUang($totalSisaAnggaran);
        
        $totalPersenSisaAnggaran=Helper::formatPersen($totalSisaAnggaran,$totalPaguUnit);

        \DB::table('s_targetkinerja_opd')
            ->where('OrgID',$filters['OrgID'])
            ->where('TA',HelperKegiatan::getTahunAnggaran())
            ->where('bulan',$no_bulan)
            ->where('EntryLvl',1)
            ->delete();

        $pagupembanding=0;

        \App\Models\Report\StatistikTargetKinerjaModel::create([
            'TargetKinerjaID'=> uniqid ('uid'),
            'OrgID'=>$filters['OrgID'],
            'OrgNm'=>$organisasi->OrgNm,
            'jumlah_kegiatan1'=>$jumlah_kegiatan,
            'jumlah_kegiatan2'=>0,
            'jumlah_uraian1'=>$jumlah_uraian,
            'jumlah_uraian2'=>0,
            'pagudinas1'=>$totalPaguUnit,
            'pagudinas2'=>0,
            'pagupembanding1'=>$pagupembanding,
            'pagupembanding2'=>0,
            'target_fisik1'=>$totalPersenTargetFisik,
            'target_fisik2'=>0,
            'realisasi_fisik1'=>$totalPersenRealisasiFisik,
            'realisasi_fisik2'=>0,
            'persen_target_keuangan1'=>$totalPersenTargetKeuangan,
            'persen_target_keuangan2'=>0,
            'persen_realisasi_keuangan1'=>$totalPersenRealisasiKeuangan,
            'persen_realisasi_keuangan2'=>0,
            'target_keuangan1'=>$totalTargetKeuanganKeseluruhan,
            'target_keuangan2'=>0,
            'realisasi_keuangan1'=>$totalRealisasiKeuanganKeseluruhan,
            'realisasi_keuangan2'=>0,
            'sisa_pagu1'=>$totalSisaAnggaran,
            'sisa_pagu2'=>0,
            'persen_sisa_pagu1'=>$totalPersenSisaAnggaran,
            'persen_sisa_pagu2'=>0,
            'bobot1'=>$totalPersenBobot,
            'bobot2'=>0,
            'bulan'=>$no_bulan,
            'TA'=>HelperKegiatan::getTahunAnggaran(),
            'EntryLvl'=>1,
        ]);

        @endphp
        <tr>
            <td colspan="3" class="text-right"><strong>Jumlah</strong></td>
            <td class="text-right">{{$rp_total_pagu_unit}}</td>                           
            <td class="text-center">{{$totalPersenBobot}}</td>							
            <td class="text-center">{{$totalPersenTargetFisik}}</td>
            <td class="text-center">{{$totalPersenRealisasiFisik}}</td>	
            <td class="text-center">{{$total_ttb_fisik}}</td>
            <td class="text-right">{{$rp_total_target_keuangan_keseluruhan}}</td>
            <td class="text-center">{{$totalPersenTargetKeuangan}}</td>                                                
            <td class="text-right">{{$rp_total_realisasi_keuangan_keseluruhan}}</td>
            <td class="text-center">{{$totalPersenRealisasiKeuangan}}</td>
            <td class="text-center">{{$total_ttb_keuangan}}</td>
            <td class="text-left"></td>
            <td class="text-right">{{$rp_total_sisa_anggaran}}</td>
            <td class="text-center">{{$totalPersenSisaAnggaran}}</td>                        
        </tr>
    </tfoot>
</table>
@endif
</div>    
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif
