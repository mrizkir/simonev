@if (count($data) > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" width="55">NO</th>
                        <th scope="col" width="150">
                            <a class="column-sort" id="col-NIP_TRANSAKSI" data-order="{{$direction}}" href="#">
                                KODE TRANSAKSI
                            </a>
                        </th>
                        <th scope="col">
                            <a class="column-sort" id="col-Nm_Urusan" data-order="{{$direction}}" href="#">
                                NAMA TRANSAKSI
                            </a>
                        </th>
                        <th scope="col" width="70">DESKRIPSI</th>
                        <th scope="col" width="70">TA</th>
                        <th scope="col" width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                    <tr>
                        <th scope="row">

                            {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                            </td>
                        <td>{{$item->Kd_Rek_1}}</td>
                        <td>{{$item->StrNm}}</td>
                        <td>{{$item->Descr}}</td>
                        <td>{{$item->TA}}</td>
                        <td>
                            <div class="input-group-append">
                                <a href="{{route('transaksi.show',['uuid'=>$item->StrID])}}"
                                    class="btn btn-primary btn-xs mr-sm-2 default" title="Detail Data Transaksi">
                                    <i class="simple-icon-eye"></i>
                                </a>
                                <a href="{{route('transaksi.edit',['uuid'=>$item->StrID])}}" title="Ubah Data Transaksi"
                                    class="btn btn-primary btn-xs mr-sm-2 default">
                                    <i class="simple-icon-pencil"></i>
                                </a>
                                <a href="javascript:;" title="Hapus Data Transaksi" data-id="{{$item->StrID}}"
                                    class="btn btn-danger btn-xs default btnDelete"
                                    data-url="{{route('transaksi.index')}}">
                                    <i class="simple-icon-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="6">
                            <p class="mb-3">
                                <span class="badge badge-pill badge-outline-theme-2 mb-1">
                                    <strong>TRANSAKSIID:</strong>{{$item->StrID}}
                                </span>
                                <span class="badge badge-pill badge-outline-theme-2 mb-1">
                                    <strong>CREATED:</strong>{{Helper::tanggal('d/m/Y H:m',$item->created_at)}}
                                </span>
                                <span class="badge badge-pill badge-outline-theme-2 mb-1">
                                    <strong>UPDATED:</strong>{{Helper::tanggal('d/m/Y H:m',$item->updated_at)}}
                                </span>
                            </p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <nav class="mt-4 mb-3" id="paginations">
                {{$data->links('layouts.dore.l_pagination')}}
            </nav>
        </div>
    </div>
</div>
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif