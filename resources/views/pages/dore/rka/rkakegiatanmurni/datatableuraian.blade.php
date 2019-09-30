@if (count($datauraian) > 0)
<div class="table-responsive">
    <table class="table" style="background:white">
        <thead class="thead-light">
            <tr>
                <th scope="col" width="55">NO</th>                        
                <th scope="col">
                    NAMA PAKET PEKERJAAN
                </th>
                <th scope="col">                            
                    HARGA SAT.
                </th>
                <th scope="col">
                    PAGU URAIAN
                </th>
                <th scope="col" width="110">REALISASI</th>
                <th scope="col" width="110">SISA</th>
                <th scope="col" width="80">FISIK (%)</th>
                <th scope="col" width="120">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datauraian as $key=>$item)
            <tr>
                <th scope="row">{{ $key + 1 }}</td>
                <td>{{$item->nama_uraian}}</td>
                <td>{{Helper::formatUang($item->harga_satuan)}}</td>
                <td>{{Helper::formatUang($item->pagu_uraian)}}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>
                    <div class="input-group-append">
                        <a href="{{route('rkakegiatanmurni.edit',['uuid'=>$item->RKARincID])}}" title="Ubah Data Uraian" class="btn btn-primary btn-xs mr-sm-2 default">
                            <i class="simple-icon-pencil"></i>
                        </a>
                        <a href="javascript:;" title="Hapus Data Uraian" data-id="{{$item->RKARincID}}" class="btn btn-danger btn-xs default btnDelete" data-url="{{route('rkakegiatanmurni.index')}}">
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
    </table>
</div>    
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif
