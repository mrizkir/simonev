@if (count($datarealisasi) > 0)
<div class="table-responsive">
    <table class="table" style="background:white">
        <thead class="thead-light">
            <tr>
                <th scope="col" width="55">NO</th>                        
                <th scope="col" width="120">
                    BULAN
                </th>
                <th scope="col" class="text-right">
                    RENCANA ANGGARAN KAS
                </th>
                <th scope="col" class="text-right">REALISASI/SP2D</th>
                <th scope="col" class="text-right">RENCANA TARGET FISIK (%)</th>
                <th scope="col" width="80">FISIK</th>
                <th scope="col" width="80">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datarealisasi as $key=>$item)
            <tr>
                <th scope="row">{{ $key + 1 }}</td>
                <td>{{helper::getBulan($item->bulan)}} {{$item->TA}}</td>
                <td class="text-right">{{Helper::formatUang(0)}}</td>
                <td class="text-right">{{Helper::formatUang($item->realisasi1)}}</td>
                <td class="text-right">                    
                    {{Helper::formatAngka($item->target1)}}
                </td>
                <td class="text-center">{{Helper::formatAngka($item->fisik1)}}</td>                
                <td>
                    <div class="input-group-append">
                        <a href="javascript:;" title="Hapus Data Realisasi" data-id="{{$item->RKARealisasiRincID}}" class="btn btn-danger btn-xs default btnDeleteRealisasi" data-url="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <tr class="text-center">
                <td colspan="7">                    
                    <span class="badge badge-pill badge-outline-primary mb-1">
                        <strong>CREATED:</strong>{{Helper::tanggal('d/m/Y H:m',$item->created_at)}}
                    </span>
                    <span class="badge badge-pill badge-outline-primary mb-1">
                        <strong>UPDATED:</strong>{{Helper::tanggal('d/m/Y H:m',$item->updated_at)}}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot style="background-color:orange">           
            <tr>
                <td colspan="3" class="text-right"><strong>TOTAL URAIAN</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang(0)}}</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang(0)}}</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang(0)}}</strong></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>PAGU KEGIATAN</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang(0)}}</strong></td>                
                <td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>SISA PAGU KEGIATAN</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang(0)}}</strong></td>                
                <td colspan="4"></td>
            </tr>
        </tfoot>
    </table>
</div>    
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif
