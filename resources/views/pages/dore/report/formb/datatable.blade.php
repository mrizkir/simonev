@if (count($daftar_program) > 0)
<div class="table-responsive">
@php
    $totalPaguUnit = (float)\DB::table('trRKA')->where('SOrgID',$filters['SOrgID'])->sum('PaguDana1');
    $no_huruf=ord('a');                                       
    $jumlah_kegiatan=0;
    $jumlah_uraian=0;
@endphp
@if ($totalPaguUnit > 0)
<table border="1" width="100%" style="font-size:10px">
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
                $totalpagueachprogram=0;
                foreach ($daftar_kegiatan as $eachprogram) {
                    $totalpagueachprogram+=$eachprogram->PaguDana1;
                }                
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
            </tr>'
            @endif
        @endforeach
    </tbody>
</table>
@endif
</div>    
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif
