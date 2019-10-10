@if (count($datauraian) > 0)
<div class="table-responsive">
    <table class="table" style="background:white">
        <thead class="thead-light">
            <tr>
                <th scope="col" width="55">NO</th>                        
                <th scope="col">
                    NAMA PAKET PEKERJAAN
                </th>
                <th scope="col" class="text-right">                            
                    HARGA SAT.
                </th>
                <th scope="col" class="text-right">
                    PAGU URAIAN
                </th>
                <th scope="col" width="110" class="text-right">REALISASI</th>
                <th scope="col" width="110" class="text-right">SISA</th>
                <th scope="col" width="80">FISIK (%)</th>
                <th scope="col" width="120">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_realisasi=0;
                $total_fisik=0;
                $total_pagu_uraian=0;            
            @endphp
            @foreach ($datauraian as $key=>$item)
            <tr>
                <th scope="row">{{ $key + 1 }}</td>
                <td>{{$item->nama_uraian}}</td>
                <td class="text-right">{{Helper::formatUang($item->harga_satuan)}}</td>
                <td class="text-right">{{Helper::formatUang($item->pagu_uraian1)}}</td>
                <td class="text-right">
                    @php
                        $total_pagu_uraian+=$item->pagu_uraian1;
                        $realisasi=0;
                        $fisik=0;
                        $total_fisik+=$fisik;
                        $total_realisasi+=$realisasi;
                    @endphp
                    {{Helper::formatUang($realisasi)}}
                </td>
                <td class="text-right">{{Helper::formatUang($item->pagu_uraian1-$realisasi)}}</td>
                <td class="text-center">{{Helper::formatAngka($fisik)}}</td>                
                <td>
                    <div class="input-group-append">
                        <a href="{{route('rkakegiatanmurni.edit2',['uuid'=>$item->RKARincID])}}" title="Ubah Data Uraian" class="btn btn-primary btn-xs mr-sm-2 default">
                            <i class="simple-icon-pencil"></i>
                        </a>
                        <a href="javascript:;" title="Hapus Data Uraian" data-id="{{$item->RKARincID}}" class="btn btn-danger btn-xs default btnDeleteUraian" data-url="{{route('rkakegiatanmurni.index')}}">
                            <i class="simple-icon-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <tr class="text-center">
                <td colspan="8">
                    <span class="badge badge-pill badge-outline-primary mb-1">
                        <strong>RKARincID:</strong>{{$item->RKARincID}}
                    </span>
                    <span class="badge badge-pill badge-outline-primary mb-1">
                        <strong>RKAID:</strong>{{$item->RKAID}}
                    </span>                           
                    <span class="badge badge-pill badge-outline-primary mb-1">
                        <strong>Rekening:</strong>[{{$item->Kd_Rek_5}}] {{$item->RObyNm}}
                    </span>                           
                    <span class="badge badge-pill badge-outline-primary mb-1">
                        <strong>Volume:</strong>{{$item->volume}} {{$item->satuan}}
                    </span>                          
                    <span class="badge badge-pill badge-outline-primary mb-1">
                        <strong>TA:</strong>{{$item->TA}}
                    </span>
                    <span class="badge badge-pill badge-outline-primary mb-1">
                        <strong>KET:</strong>{{$item->Descr}}
                    </span>
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
                <td class="text-right"><strong>{{Helper::formatUang($total_pagu_uraian)}}</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang($total_realisasi)}}</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang($total_pagu_uraian-$total_realisasi)}}</strong></td>
                <td class="text-center"><strong>{{Helper::formatAngka($total_fisik)}}</strong></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>PAGU KEGIATAN</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang($rka->PaguDana1)}}</strong></td>                
                <td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>SISA PAGU KEGIATAN</strong></td>
                <td class="text-right"><strong>{{Helper::formatUang($rka->PaguDana1-$total_pagu_uraian)}}</strong></td>                
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
