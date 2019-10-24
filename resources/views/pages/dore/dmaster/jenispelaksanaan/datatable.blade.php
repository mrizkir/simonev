@if (count($data) > 0)    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" width="55">NO</th>                            
                            <th scope="col">
                                <a class="column-sort" id="col-Nm_Urusan" data-order="{{$direction}}" href="#">
                                    NAMA JENIS 
                                </a>
                            </th>
                            <th scope="col" width="70">KET.</th>
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
                            <td>{{$item->NamaJenis}}</td>
                            <td>{{$item->Descr}}</td>
                            <td>{{$item->TA}}</td>
                            <td>
                                <div class="input-group-append">
                                    <a href="{{route('jenispelaksanaan.show',['uuid'=>$item->JenisPelaksanaanID])}}" class="btn btn-primary btn-xs mr-sm-2 default"  title="Detail Data Jenis Pelaksanaan">
                                        <i class="simple-icon-eye"></i>
                                    </a>
                                    <a href="{{route('jenispelaksanaan.edit',['uuid'=>$item->JenisPelaksanaanID])}}" title="Ubah Data Jenis Pelaksanaan" class="btn btn-primary btn-xs mr-sm-2 default">
                                        <i class="simple-icon-pencil"></i>
                                    </a>
                                    <a href="javascript:;" title="Hapus Data Jenis Pelaksanaan" data-id="{{$item->JenisPelaksanaanID}}" class="btn btn-danger btn-xs default btnDelete" data-url="{{route('jenispelaksanaan.index')}}">
                                        <i class="simple-icon-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="6">                                
                                <p class="mb-3">
                                    <span class="badge badge-pill badge-outline-theme-2 mb-1">
                                        <strong>JenisPelaksanaanID:</strong>{{$item->JenisPelaksanaanID}}
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
</div>
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif