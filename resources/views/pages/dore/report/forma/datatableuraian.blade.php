@php
$datauraian=[''=>''];
@endphp
@if (count($datauraian) > 0)
<table border="1" width="100%" style="font-size:10px">
    <thead> 
        <tr class="bg-teal-700">
            <th rowspan="3" colspan="5" class="text-center" width="150">KODE <br>REKENING</th>
            <th rowspan="3" width="400" class="text-center">URAIAN</th>
            <th rowspan="2" width="100" class="text-center">JUMLAH</th>
            <th rowspan="2" width="40" class="text-center">BOBOT</th>
            <th colspan="2" class="text-center">REALISASI FISIK</th>
            <th colspan="5" class="text-center">KEUANGAN</th>
            <th rowspan="3" class="text-center">SISA ANGGARAN</th>
        </tr>
        <tr class="bg-teal-700">
            <td rowspan="2" class="text-center">%</td>
            <td rowspan="2" class="text-center">% TTB</td>
            <td colspan="2" class="text-center">RENCANA TARGET</td>
            <td colspan="3" class="text-center">REALISASI</td>
        </tr>
        <tr class="bg-teal-700">
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">Rp.</td>
            <td class="text-center">%</td>
            <td class="text-center">% TTB</td>
        </tr>
        <tr class="bg-teal-700">
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

    </tbody>
</table>
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif
