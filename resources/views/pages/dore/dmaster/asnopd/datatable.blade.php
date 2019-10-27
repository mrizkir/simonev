@if (count($data) > 0)    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" width="55">NO</th>
                            <th scope="col" width="150">
                                <a class="column-sort" id="col-NIP_ASN" data-order="{{$direction}}" href="#">
                                    NIP ASN
                                </a>
                            </th>
                            <th scope="col">
                                <a class="column-sort" id="col-Nm_Urusan" data-order="{{$direction}}" href="#">
                                    NAMA ASN 
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
                            <td>{{$item->NIP_ASN}}</td>
                            <td>{{$item->Nm_ASN}}</td>
                            <td>{{$item->Descr}}</td>
                            <td>{{$item->TA}}</td>
                            <td>
                                <div class="input-group-append">
                                    <a href="{{route('asnopd.show',['uuid'=>$item->ASNID])}}" class="btn btn-primary btn-xs mr-sm-2 default"  title="Detail Data ASN">
                                        <i class="simple-icon-eye"></i>
                                    </a>                                    
                                    @hasrole('superadmin|bapelitbang')
                                    <a href="{{route('asnopd.edit',['uuid'=>$item->ASNID])}}" title="Ubah Data ASN" class="btn btn-primary btn-xs mr-sm-2 default">
                                        <i class="simple-icon-pencil"></i>
                                    </a>
                                    <a href="javascript:;" title="Hapus Data ASN" data-id="{{$item->ASNID}}" class="btn btn-danger btn-xs default btnDelete" data-url="{{route('asnopd.index')}}">
                                        <i class="simple-icon-trash"></i>
                                    </a>
                                    @endhasrole
                                </div>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="6">                                
                                <p class="mb-3">
                                    <span class="badge badge-pill badge-outline-theme-2 mb-1">
                                        <strong>ASNID:</strong>{{$item->ASNID}}
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