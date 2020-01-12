@if (count($data) > 0)
<table class="table table-bordered mb-2 table-condensed">
    <thead class="text-center">
        <tr>
            <th rowspan="2" width="50">No</th>
            <th rowspan="2" width="100">Kode</th>
            <th rowspan="2" width="350">Urusan/Bidang Urusan Dan Program/Kegiatan</th>
            <th rowspan="2">Indikator Kinerja Program (Outcome)/ Kegiatan (output)</th>
            <th rowspan="2" colspan="2">Target RPJMD pada Tahun {{HelperKegiatan::getRPJMDTahunAkhir()}}</th>
            <th rowspan="2" colspan="2">Realisasi Capaian Kinerja RPJMD s/d RKPD Tahun {{HelperKegiatan::getTahunPerencanaan()-1}} (n-2)</th>
            <th rowspan="2" colspan="2">Target Kinerja dan Anggaran RKPD Tahun {{HelperKegiatan::getTahunPerencanaan()}} (n-1)</th>
            <th colspan="8">Realisasi Kinerja Pada Triwulan</th>
            <th rowspan="2" colspan="2">Realisasi Capaian Kinerja dan Anggaran RKPD </th>
            <th rowspan="2" colspan="2">Realisasi Kinerja dan Anggaran RPJMD s/d Tahun {{HelperKegiatan::getTahunPerencanaan()}} </th>
            <th rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD s/d Tahun {{HelperKegiatan::getTahunPerencanaan()}} (%)</th>
            <th rowspan="2">Perangkat Daerah Penanggung Jawab</th>
        </tr>
        <tr>
            <th colspan="2">I</th>
            <th colspan="2">II</th>
            <th colspan="2">III</th>
            <th colspan="2">IV</th>
        </tr>
        <tr>
            <th rowspan="2">1</th>
            <th rowspan="2">2</th>
            <th rowspan="2">3</th>
            <th rowspan="2">4</th>
            <th colspan="2">5</th>
            <th colspan="2">6</th>
            <th colspan="2">7</th>
            <th colspan="2">8</th>
            <th colspan="2">9</th>
            <th colspan="2">10</th>
            <th colspan="2">11</th>
            <th colspan="2">12</th>
            <th colspan="2">13</th>
            <th colspan="2">14</th>
            <th rowspan="2">15</th>
        </tr>
        <tr>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>
            <th>K</th>
            <th>Rp</th>            
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key=>$item)
        @if ($item->level==0)
        <tr>
            <td colspan="25"><strong>Sasaran RPJMD</strong>: {{$item->Nm_Sasaran}}</td>
        </tr>        
        @elseif($item->level==1)
        <tr>            
            <tr>
                <td></td>
                <td>{{$item->kode}}</td>
                <td>{{$item->Nm_Bidang}}</td>
            </tr>
        </tr>
        @elseif($item->level==2)
        <tr>            
            <tr>
                <td></td>
                <td>{{$item->kode}}</td>
                <td>{{$item->PrgNm}}</td>
            </tr>
        </tr>
        @elseif($item->level==3)
        <tr>            
            <tr>
                <td></td>
                <td>{{$item->kode}}</td>
                <td>{{$item->KgtNm}}</td>
                <td>{{$item->ik_kegiatan}}</td>
                <td>5K</td>
                <td>5RP</td>
                <td>6K</td>
                <td>6RP</td>
                <td>7K</td>
                <td>{{Helper::formatUang($item->tk_rkpd_n_min_1_rp)}}</td>
            </tr>
        </tr>
        @endif
        @endforeach 
    </tbody>
</table>
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif