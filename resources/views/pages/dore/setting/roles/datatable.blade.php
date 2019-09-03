@if (count($data) > 0)    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" width="55">NO</th>
                            <th scope="col" width="150">
                                <a class="column-sort" id="col-id" data-order="{{$direction}}" href="#">
                                    ID
                                </a>
                            </th>
                            <th scope="col" width="100%">
                                <a class="column-sort" id="col-nama_roles" data-order="{{$direction}}" href="#">
                                    NAMA ROLE
                                </a>
                            </th>
                            <th scope="col" width="100%">GUARD</th>
                            <th scope="col" width="100%">JUMLAH USERS</th>
                            <th scope="col" width="100%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$item)
                        <tr>
                            <th scope="row">
                                {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                                </td>
                            <td>{{$item->id}}</td>   
                            <td>{{$item->name}}</td>
                            <td>{{$item->guard_name}}</td>
                            <td>{{$item->jumlah}}</td>   
                            <td>
                                <div class="input-group-append">
                                    <a href="{{route('roles.show',['id'=>$item->id])}}" class="btn btn-primary btn-xs mr-sm-2 default"  title="Detail Roles">
                                        <i class="simple-icon-eye"></i>
                                    </a>
                                    <a href="{{route('roles.edit',['id'=>$item->id])}}" class="btn btn-primary btn-xs mr-sm-2 default"  title="Detail Roles">
                                        <i class="simple-icon-pencil"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-primary btn-xs mr-sm-2 default btnDelete"  title="Delete Roles" data-id="{{$item->id}}" data-url="{{route('roles.index')}}">
                                        <i class="simple-icon-trash"></i>
                                    </a>
                                </div>
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