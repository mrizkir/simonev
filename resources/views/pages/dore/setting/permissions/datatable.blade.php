@if (count($data) > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" width="55">NO</th>
                        <th scope="col" width="150">
                            <a class="column-sort" id="col-image" data-order="{{$direction}}" href="#">
                               ID
                            </a>
                        </th>
                        <th scope="col" width="150">
                            <a class="column-sort" id="col-kd_user" data-order="{{$direction}}" href="#">
                                NAME
                            </a>
                        </th>
                        <th scope="col" width="150">
                            <a class="column-sort" id="col-username" data-order="{{$direction}}" href="#">
                                GUARD  
                            </a>
                        </th>
                        <th scope="col" width="100">AKSI</th>
            
                    </tr>
                </thead>
                <tbody>                    
                @foreach ($data as $key=>$item)
                    <tr>
                        <td>
                            {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}    
                        </td>     
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->guard_name}}</td>
                        <td>
                            <div class="input-group-append">
                                <a href="{{route('users.show',['id'=>$item->id])}}" title="Show Data Permissions" class="btn btn-primary btn-xs mr-sm-2 default">
                                    <i class="simple-icon-eye"></i>
                                </a>
                                @if ($item->isdeleted)  
                                <a class="btn btn-primary btn-xs mr-sm-2 default btnDelete" href="javascript:;" title="Hapus Data Permissions" data-id="{{$item->id}}" class="btn btn-danger btn-xs default" data-url="{{route('permissions.index')}}">
                                    <i class="simple-icon-trash"></i>
                                </a>
                                @endif   
                            </div>
                        </td> 
                    </tr>
                @endforeach                    
                </tbody>
            </table>               
        </div>
    </div>
</div>
<div class="panel-body border-top-info text-center" id="paginations">
    {{$data->links('layouts.dore.l_pagination')}}               
</div>
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div> 
@endif            

