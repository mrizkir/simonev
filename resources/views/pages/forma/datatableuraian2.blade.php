@if (count($rka) > 0)
<table class="table table-striped table-bordered mb-2 table-condensed">
    <thead> 
        <tr>
            <th rowspan="3" colspan="5" class="text-center" width="150">KODE <br>REKENING</th>
            <th rowspan="3" width="400" class="text-center">URAIAN</th>
            <th rowspan="2" width="100" class="text-center">JUMLAH</th>
            <th rowspan="2" width="40" class="text-center">BOBOT</th>
            <th colspan="2" class="text-center">REALISASI FISIK</th>
            <th colspan="5" class="text-center">KEUANGAN</th>
            <th rowspan="3" class="text-center">SISA ANGGARAN</th>
        </tr>
        <tr>
            <td rowspan="2" class="text-center">%</td>
            <td rowspan="2" class="text-center">% TTB</td>
            <td colspan="2" class="text-center">RENCANA TARGET</td>
            <td colspan="3" class="text-center">REALISASI</td>
        </tr>
        <tr>
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">% TTB</td>
        </tr>
        <tr>
            <td colspan="5" class="text-center">1</td>
            <td class="text-center">2</td>
            <td class="text-center">3</td>
            <td class="text-center">4</td>
            <td class="text-center">5</td>
            <td class="text-center">6a</td>
            <td class="text-center">6b</td>
            <td class="text-center">6c</td>
            <td class="text-center">6d</td>
            <td class="text-center">6e</td>
            <td class="text-center">7</td>
            <td class="text-center">8</td>
        </tr>
    </thead>
    <tbody>
        @if (isset($tingkat[1]))
            @php
                $tingkat_1=$tingkat[1];            
                $tingkat_2=$tingkat[2];
                $tingkat_3=$tingkat[3];
                $tingkat_4=$tingkat[4];
                $tingkat_5=$tingkat[5]; 
                $totalUraian=0;
                $totalTargetSatuKegiatan=0;
                $totalRealisasiSatuKegiatan=0;
                $totalPersenBobotSatuKegiatan=0;
                $totalPersenTargetSatuKegiatan=0;
                $totalPersenRealisasiSatuKegiatan=0;
                $totalPersenFisikSatuKegiatan=0;
                $totalPersenTertimbangFisikSatuKegiatan=0;
                
                foreach ($tingkat_1 as $k1=>$v1)
                {
                    foreach ($tingkat_5 as $k5=>$v5)
                    {
                        $rek1=substr($k5,0,1);
                        if ($rek1 == $k1) 
                        {
                            //tingkat i
                            $totalPaguDana_Rek1=\App\Controllers\Report\FormAController::calculateEachLevel($rka,$k1,'Kd_Rek_1');
                            $totalPaguDana=$totalPaguDana_Rek1['totalpagu'];
                            $rp_total_pagu_dana_rek1=Helper::formatUang($totalPaguDana);
                            echo '<tr>';
                            echo '<td width="10" class="text-center">'.$k1.'.</td>';
                            echo '<td width="10" class="text-center">&nbsp;</td>';
                            echo '<td width="10" class="text-center">&nbsp;</td>';
                            echo '<td width="10" class="text-center">&nbsp;</td>';
                            echo '<td width="10" class="text-center">&nbsp;</td>';
                            echo '<td class="left">'.$v1.'</td>';
                            echo '<td class="text-right">'.$rp_total_pagu_dana_rek1.'</td>';										
                            echo '<td class="text-center">&nbsp;</td>';
                            echo '<td class="text-center">&nbsp;</td>';                        
                            echo '<td class="text-center">&nbsp;</td>';
                            echo '<td class="text-center">&nbsp;</td>';
                            echo '<td class="text-center">&nbsp;</td>';
                            echo '<td class="text-center">&nbsp;</td>';
                            echo '<td class="text-center">&nbsp;</td>';
                            echo '<td class="text-center">&nbsp;</td>';
                            echo '<td class="text-center">&nbsp;</td>';                        
                            echo '</tr>';

                            //tingkat ii
                            foreach ($tingkat_2 as $k2=>$v2) 
                            {
                                $rek2_tampil=[];
                                foreach ($tingkat_5 as $k5_level2=>$v5_level2) {
                                    $rek2=substr($k5_level2,0,3);								
                                    if ($rek2 == $k2) {
                                        if (!array_key_exists($k2,$rek2_tampil)){															
                                            $rek2_tampil[$rek2]=$v2;
                                        }							
                                    }
                                }
                                foreach ($rek2_tampil as $a=>$b) 
                                {
                                    $totalPaguDana_Rek2=\App\Controllers\Report\FormAController::calculateEachLevel($rka,$a,'kode_rek_2');                                
                                    $no_=explode ('.',$a);
                                    $rp_total_pagu_dana_rek2=Helper::formatUang($totalPaguDana_Rek2['totalpagu']);
                                    echo '<tr>';
                                    echo '<td class="text-center">'.$no_[0].'.</td>';
                                    echo '<td class="text-center">'.$no_[1].'.</td>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="left">'.$b.'</td>';
                                    echo '<td class="text-right">'.$rp_total_pagu_dana_rek2.'</td>';														
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';                                
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';
                                    echo '<td class="text-center">&nbsp;</td>';                                
                                    echo '</tr>';
                                    
                                    //tingkat iii
                                    foreach ($tingkat_3 as $k3=>$v3) 
                                    {
                                        $rek3=substr($k3,0,3);
                                        if ($a==$rek3) 
                                        {
                                            $totalPaguDana_Rek3=\App\Controllers\Report\FormAController::calculateEachLevel($rka,$k3,'kode_rek_3');                                        
                                            $no_=explode (".",$k3);
                                            $rp_total_pagu_dana_rek3=Helper::formatUang($totalPaguDana_Rek3['totalpagu']);
                                            $persen_bobot_rek3=$totalPaguDana_Rek3['totalpersenbobot'];
                                            $rp_total_target_rek3=Helper::formatUang($totalPaguDana_Rek3['totaltarget']);
                                            $persen_target_rek3=$totalPaguDana_Rek3['totalpersentarget'];
                                            $rp_total_realisasi_rek3=Helper::formatUang($totalPaguDana_Rek3['totalrealisasi']);
                                            $persen_realisasi_rek3=$totalPaguDana_Rek3['totalpersenrealisasi'];
                                            $persen_tertimbang_realisasi_rek3=$totalPaguDana_Rek3['totalpersentertimbangrealisasi'];                                        
                                            $persen_rata2_fisik_rek3=Helper::formatPecahan($totalPaguDana_Rek3['totalfisik'],$totalPaguDana_Rek3['totalbaris']);                                        
                                            $persen_tertimbang_fisik_rek3=$totalPaguDana_Rek3['totalpersentertimbangfisik'];
                                            $dalamDpa_rek3=Helper::formatUang($totalPaguDana_Rek3['totalpagu']-$totalPaguDana_Rek3['totalrealisasi']);

                                            echo '<tr>';
                                            echo '<td class="text-center">'.$no_[0].'.</td>';
                                            echo '<td class="text-center">'.$no_[1].'.</td>';
                                            echo '<td class="text-center">'.$no_[2].'.</td>';
                                            echo '<td class="text-center">&nbsp;</td>';
                                            echo '<td class="text-center">&nbsp;</td>';											
                                            echo '<td class="left">'.$v3.'</td>';									
                                            echo '<td class="text-right">'.$rp_total_pagu_dana_rek3.'</td>';																		                                        
                                            echo '<td class="text-center">'.$persen_bobot_rek3.'</td>';
                                            echo '<td class="text-center">'.$persen_rata2_fisik_rek3.'</td>';
                                            echo '<td class="text-center">'.$persen_tertimbang_fisik_rek3.'</td>';
                                            echo '<td class="text-right">'.$rp_total_target_rek3.'</td>';
                                            echo '<td class="text-center">'.$persen_target_rek3.'</td>';
                                            echo '<td class="text-right">'.$rp_total_realisasi_rek3.'</td>';
                                            echo '<td class="text-center">'.$persen_realisasi_rek3.'</td>';
                                            echo '<td class="text-center">'.$persen_tertimbang_realisasi_rek3.'</td>';                                        
                                            echo '<td class="text-right">'.$dalamDpa_rek3.'</td>';                                        
                                            echo '</tr>';

                                            foreach ($tingkat_4 as $k4=>$v4) 
                                            {
                                                if (preg_match("/^$k3/", $k4)) 
                                                {
                                                    $totalPaguDana_Rek4=\App\Controllers\Report\FormAController::calculateEachLevel($rka,$k4,'kode_rek_4');
                                                    $rp_total_pagu_dana_rek4=Helper::formatUang($totalPaguDana_Rek4['totalpagu']);
                                                    $no_=explode (".",$k4);
                                                    $persen_bobot_rek4=$totalPaguDana_Rek4['totalpersenbobot'];
                                                    $rp_total_target_rek4=Helper::formatUang($totalPaguDana_Rek4['totaltarget']);
                                                    $persen_target_rek4=$totalPaguDana_Rek4['totalpersentarget'];
                                                    $rp_total_realisasi_rek4=Helper::formatUang($totalPaguDana_Rek4['totalrealisasi']);
                                                    $persen_realisasi_rek4=$totalPaguDana_Rek4['totalpersenrealisasi'];
                                                    $persen_tertimbang_realisasi_rek4=$totalPaguDana_Rek4['totalpersentertimbangrealisasi'];                                                
                                                    $persen_rata2_fisik_rek4=Helper::formatPecahan($totalPaguDana_Rek4['totalfisik'],$totalPaguDana_Rek4['totalbaris']);
                                                    $persen_tertimbang_fisik_rek4=$totalPaguDana_Rek4['totalpersentertimbangfisik'];                                                
                                                    $dalamDpa_rek4=Helper::formatUang($totalPaguDana_Rek4['totalpagu']-$totalPaguDana_Rek4['totalrealisasi']);  
                                                    
                                                    echo '<tr>';
                                                    echo '<td class="text-center">'.$no_[0].'.</td>';
                                                    echo '<td class="text-center">'.$no_[1].'.</td>';
                                                    echo '<td class="text-center">'.$no_[2].'.</td>';
                                                    echo '<td class="text-center">'.$no_[3].'.</td>';											
                                                    echo '<td class="text-center">&nbsp;</td>';		
                                                    echo '<td class="left">'.$v4.'</td>';																					
                                                    echo '<td class="text-right">'.$rp_total_pagu_dana_rek4.'</td>';														                                                
                                                    echo '<td class="text-center">'.$persen_bobot_rek4.'</td>';
                                                    echo '<td class="text-center">'.$persen_rata2_fisik_rek4.'</td>';
                                                    echo '<td class="text-center">'.$persen_tertimbang_fisik_rek4.'</td>';
                                                    echo '<td class="text-right">'.$rp_total_target_rek4.'</td>';
                                                    echo '<td class="text-center">'.$persen_target_rek4.'</td>';
                                                    echo '<td class="text-right">'.$rp_total_realisasi_rek4.'</td>';
                                                    echo '<td class="text-center">'.$persen_realisasi_rek4.'</td>';
                                                    echo '<td class="text-center">'.$persen_tertimbang_realisasi_rek4.'</td>';                                                
                                                    echo '<td class="text-right">'.$dalamDpa_rek4.'</td>';                                                                                              
                                                    echo '</tr>';

                                                    foreach ($tingkat_5 as $k5=>$v5) {
                                                        if (preg_match("/^$k4/", $k5)) {      
                                                            $totalUraian+=1;
                                                            $totalPaguDana_Rek5=\App\Controllers\Report\FormAController::calculateEachLevel($rka,$k5,'kode_rek_5');													
                                                            $rp_total_pagu_dana_rek5=Helper::formatUang($totalPaguDana_Rek5['totalpagu']); 
                                                            $RKARincID=$rka[$k5]['RKARincID'];
                                                            $nama_uraian=$rka[$k5]['nama_uraian']; 
                                                            $no_=explode (".",$k5);    
                                                            $persen_bobot_rek5=$totalPaguDana_Rek5['totalpersenbobot'];
                                                            $rp_total_target_rek5=Helper::formatUang($totalPaguDana_Rek5['totaltarget']);
                                                            $persen_target_rek5=$totalPaguDana_Rek5['totalpersentarget'];
                                                            $rp_total_realisasi_rek5=Helper::formatUang($totalPaguDana_Rek5['totalrealisasi']);
                                                            $persen_realisasi_rek5=$totalPaguDana_Rek5['totalpersenrealisasi'];
                                                            $persen_tertimbang__realisasi_rek5=$totalPaguDana_Rek5['totalpersentertimbangrealisasi'];                                                        
                                                            $persen_rata2_fisik_rek5=Helper::formatPecahan($totalPaguDana_Rek5['totalfisik'],$totalPaguDana_Rek5['totalbaris']);
                                                            $persen_tertimbang_fisik_rek5=$totalPaguDana_Rek5['totalpersentertimbangfisik'];
                                                            $dalamDpa_rek5=Helper::formatUang($totalPaguDana_Rek5['totalpagu']-$totalPaguDana_Rek5['totalrealisasi']);                                                                                                        
                                                            echo '<tr>';
                                                            echo '<td class="text-center">'.$no_[0].'.</td>';
                                                            echo '<td class="text-center">'.$no_[1].'.</td>';
                                                            echo '<td class="text-center">'.$no_[2].'.</td>';
                                                            echo '<td class="text-center">'.$no_[3].'.</td>';															
                                                            echo '<td class="text-center">'.$no_[4].'.</td>';
                                                            echo '<td class="left">'.$v5.'</td>';
                                                            echo '<td class="text-right">'.$rp_total_pagu_dana_rek5.'</td>';                                                        
                                                            echo '<td class="text-center">'.$persen_bobot_rek5.'</td>';
                                                            echo '<td class="text-center">'.$persen_rata2_fisik_rek5.'</td>';
                                                            echo '<td class="text-center">'.$persen_tertimbang_fisik_rek5.'</td>';
                                                            echo '<td class="text-right">'.$rp_total_target_rek5.'</td>';
                                                            echo '<td class="text-center">'.$persen_target_rek5.'</td>';
                                                            echo '<td class="text-right">'.$rp_total_realisasi_rek5.'</td>';
                                                            echo '<td class="text-center">'.$persen_realisasi_rek5.'</td>';
                                                            echo '<td class="text-center">'.$persen_tertimbang__realisasi_rek5.'</td>';                                                        
                                                            echo '<td class="text-right">'.$dalamDpa_rek5.'</td>';                                                        
                                                            echo '</tr>';	
                                                            
                                                            $nilaiuraian=$rka[$k5]['pagu_uraian']; 
                                                            $target=$rka[$k5]['target'];                                                         
                                                            $totalTargetSatuKegiatan+=$target;
                                                            $realisasi=$rka[$k5]['realisasi'];                                                  
                                                            $totalRealisasiSatuKegiatan+=$realisasi;
                                                            $fisik=$rka[$k5]['fisik'];                                                        
                                                            $volume=$rka[$k5]['volume'];                                                        
                                                            $persen_bobot=$rka[$k5]['persen_bobot'];
                                                            $totalPersenBobotSatuKegiatan+=$persen_bobot;
                                                            $persen_target=$rka[$k5]['persen_target'];   
                                                            $totalPersenTargetSatuKegiatan+=$persen_target;   
                                                            $persen_realisasi=$rka[$k5]['persen_realisasi'];
                                                            $totalPersenRealisasiSatuKegiatan+=$persen_realisasi;
                                                            $persen_tertimbang_realisasi=$rka[$k5]['persen_tertimbang_realisasi'];                                                        
                                                            $persen_fisik=$rka[$k5]['persen_fisik'];
                                                            $totalPersenFisikSatuKegiatan+=$persen_fisik;
                                                            $persen_tertimbang_fisik=$rka[$k5]['persen_tertimbang_fisik'];
                                                            $totalPersenTertimbangFisikSatuKegiatan+=$persen_tertimbang_fisik;
                                                            $dalamDpa=$nilaiuraian-$realisasi;                                                                                                                                                                   
                                                            
                                                            $rp_nilai_uraian=Helper::formatUang($nilaiuraian); 
                                                            $rp_target=Helper::formatUang($target);
                                                            $rp_realisasi=Helper::formatUang($realisasi);
                                                            $rp_dalam_dpa=Helper::formatUang($dalamDpa);                                                        
                                                            
                                                            echo '<tr>';
                                                            echo '<td colspan="5"></td>';                    
                                                            //$url=$this->Service->constructUrl('d.report.FormADetails',array('id'=>$iduraian));
                                                            $url='#';
                                                            $tetaut = "<a href=\"$url\">$nama_uraian</a>";                                                            
                                                            echo '<td>'.$tetaut.'</td>';                                                            
                                                            echo '<td class="text-right">'.$rp_nilai_uraian.'</td>';                                                        
                                                            echo "<td class=\"text-center\">$persen_bobot</td>";
                                                            echo "<td class=\"text-center\">$persen_fisik</td>";
                                                            echo "<td class=\"text-center\">$persen_tertimbang_fisik</td>";
                                                            echo "<td class=\"text-right\">$rp_target</td>";
                                                            echo "<td class=\"text-center\">$persen_target</td>";
                                                            echo "<td class=\"text-right\">$rp_realisasi</td>";
                                                            echo "<td class=\"text-center\">$persen_realisasi</td>";
                                                            echo "<td class=\"text-center\">$persen_tertimbang_realisasi</td>";                                                        
                                                            echo "<td class=\"text-right\">$rp_dalam_dpa</td>";                                                                                                             
                                                            echo '</tr>';
                                                            
                                                            if (isset($rka[$k5]['child'][0])) 
                                                            {
                                                                $child=$rka[$k5]['child'];    
                                                                foreach ($child as $n) 
                                                                {
                                                                    $totalUraian+=1;
                                                                    $RKARincID=$n['RKARincID'];                                                                
                                                                    $nama_uraian=$n['nama_uraian'];
                                                                    $nilaiuraian=$n['pagu_uraian']; 
                                                                    $target=$n['target'];                                                                 
                                                                    $totalTargetSatuKegiatan+=$target;
                                                                    $realisasi=$n['realisasi'];    
                                                                    $totalRealisasiSatuKegiatan+=$realisasi;
                                                                    $fisik=$n['fisik'];                                                                
                                                                    $volume=$n['volume'];
                                                                    $persen_bobot=$n['persen_bobot'];
                                                                    $totalPersenBobotSatuKegiatan+=$persen_bobot;   
                                                                    $persen_target=$n['persen_target'];   
                                                                    $totalPersenTargetSatuKegiatan+=$persen_target;   
                                                                    $persen_realisasi=$n['persen_realisasi'];
                                                                    $totalPersenRealisasiSatuKegiatan+=$persen_realisasi;
                                                                    $persen_tertimbang_realisasi=$n['persen_tertimbang_realisasi'];                                                                
                                                                    $persen_fisik=$n['persen_fisik'];
                                                                    $totalPersenFisikSatuKegiatan+=$persen_fisik;
                                                                    $persen_tertimbang_fisik=$n['persen_tertimbang_fisik'];
                                                                    $totalPersenTertimbangFisikSatuKegiatan+=$persen_tertimbang_fisik;
                                                                    $dalamDpa=$nilaiuraian-$realisasi;                                                                                                                                
                                                                            
                                                                    $rp_nilai_uraian=Helper::formatUang($nilaiuraian); 
                                                                    $rp_target=Helper::formatUang($target);
                                                                    $rp_realisasi=Helper::formatUang($realisasi);
                                                                    $rp_dalam_dpa=Helper::formatUang($dalamDpa);

                                                                    echo '<tr>';
                                                                    echo '<td colspan="5"></td>';            
                                                                    // $url=$this->Service->constructUrl('d.report.FormADetails',array('id'=>$iduraian));
                                                                    $url='#';
                                                                    $tetaut = "<a href=\"$url\">$nama_uraian</a>";
                                                                    echo '<td>';
                                                                    echo '<table width="100%">';
                                                                    echo '<tr>';
                                                                    echo '<td width="5%">&nbsp;</td>';
                                                                    echo '<td>'.$tetaut.'</td>';
                                                                    echo '</tr>';
                                                                    echo '</table>';
                                                                    echo '</td>';
                                                                    echo '<td class="text-right">'.$rp_nilai_uraian.'</td>';                                                                
                                                                    echo "<td class=\"text-center\">$persen_bobot</td>";
                                                                    echo "<td class=\"text-center\">$persen_fisik</td>";
                                                                    echo "<td class=\"text-center\">$persen_tertimbang_fisik</td>";
                                                                    echo "<td class=\"text-right\">$rp_target</td>";
                                                                    echo "<td class=\"text-center\">$persen_target</td>";
                                                                    echo "<td class=\"text-right\">$rp_realisasi</td>";
                                                                    echo "<td class=\"text-center\">$persen_realisasi</td>";
                                                                    echo "<td class=\"text-center\">$persen_tertimbang_realisasi</td>";                                                                
                                                                    echo "<td class=\"text-right\">$rp_dalam_dpa</td>";                                                                                                                       
                                                                    echo '</tr>';	             
                                                                } 
                                                            }     
                                                        }
                                                    }	                                                                                                                                                                        
                                                }
                                            }  
                                        }
                                    }
                                }
                            }
                            break;
                        }
                        continue;
                    }
                }
                $rp_total_pagu_dana=Helper::formatUang($totalPaguDana);	
                $rp_total_target=Helper::formatUang ($totalTargetSatuKegiatan);			
                $rp_total_realisasi=Helper::formatUang ($totalRealisasiSatuKegiatan);            
                $rp_total_dalam_dpa=Helper::formatUang($totalPaguDana-$totalRealisasiSatuKegiatan);            
                echo '<tr style="background-color:orange;font-weight:bolder">';
                echo '<td colspan="6" class="text-right"><strong>Jumlah</strong></td>';
                echo '<td class="text-right">'.$rp_total_pagu_dana.'</td>';			            
                $totalPersenBobotSatuKegiatan = $totalPersenBobotSatuKegiatan > 100 ?100:$totalPersenBobotSatuKegiatan;
                echo '<td class="text-center">'.number_format($totalPersenBobotSatuKegiatan,2).'&nbsp;</td>';
                echo '<td class="text-center">'.Helper::formatPecahan($totalPersenFisikSatuKegiatan,$totalUraian).'</td>';                        
                echo '<td class="text-center">'.$totalPersenTertimbangFisikSatuKegiatan.'</td>';            
                echo '<td class="text-right">'.$rp_total_target.'</td>';	
                $total_persen_target=Helper::formatPersen($totalTargetSatuKegiatan,$totalPaguDana);
                echo '<td class="text-center">'.$total_persen_target.'</td>';
                echo '<td class="text-right">'.$rp_total_realisasi.'</td>';		
                $total_persen_rata2_realisasi=Helper::formatPersen($totalRealisasiSatuKegiatan,$totalPaguDana);
                echo '<td class="text-center">'.$total_persen_rata2_realisasi.'</td>';	
                $totalPersenTertimbangRealisasiSatuKegiatan=number_format(($total_persen_rata2_realisasi*$totalPersenBobotSatuKegiatan)/100,2);
                echo '<td class="text-center">'.$totalPersenTertimbangRealisasiSatuKegiatan.'</td>';                        
                echo '<td class="text-right">'.$rp_total_dalam_dpa.'</td>';	            
                echo '</tr></table>';		
            @endphp            
        @endif
    </tbody>
</table>
@else
<table border="1" width="100%" style="font-size:10px">
    <thead> 
        <tr>
            <th rowspan="3" colspan="5" class="text-center" width="150">KODE <br>REKENING</th>
            <th rowspan="3" width="400" class="text-center">URAIAN</th>
            <th rowspan="2" width="100" class="text-center">JUMLAH</th>
            <th rowspan="2" width="40" class="text-center">BOBOT</th>
            <th colspan="2" class="text-center">REALISASI FISIK</th>
            <th colspan="5" class="text-center">KEUANGAN</th>
            <th rowspan="3" class="text-center">SISA ANGGARAN</th>
        </tr>
        <tr>
            <td rowspan="2" class="text-center">%</td>
            <td rowspan="2" class="text-center">% TTB</td>
            <td colspan="2" class="text-center">RENCANA TARGET</td>
            <td colspan="3" class="text-center">REALISASI</td>
        </tr>
        <tr>
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">% TTB</td>
        </tr>
        <tr>
            <td colspan="5" class="text-center">1</td>
            <td class="text-center">2</td>
            <td class="text-center">3</td>
            <td class="text-center">4</td>
            <td class="text-center">5</td>
            <td class="text-center">6a</td>
            <td class="text-center">6b</td>
            <td class="text-center">6c</td>
            <td class="text-center">6d</td>
            <td class="text-center">6e</td>
            <td class="text-center">7</td>
            <td class="text-center">8</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="16">
                <div class="alert alert-info">
                    Belum ada data yang bisa ditampilkan.
                </div>
            </td>
        </tr>        
    </tbody>
</table>
@endif
