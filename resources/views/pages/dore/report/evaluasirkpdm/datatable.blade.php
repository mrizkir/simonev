@if (count($data) > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" width="55">NO</th>
                        <th scope="col" width="300">
                            <a class="column-sort" id="col-Nm_Sasaran" data-order="{{$direction}}" href="#">
                                SASARAN
                            </a>
                        </th>
                        <th scope="col">                            
                            I
                        </th>
                        <th scope="col">
                            II
                        </th>
                        <th scope="col">
                            III
                        </th>
                        <th scope="col">
                            IV
                        </th>
                        <th scope="col" width="8">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                    <tr>
                        <th scope="row">
                            {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                            </td>
                        <td>{{$item->Nm_Sasaran}}</td>
                        <td>{{Helper::formatUang(0)}}</td>
                        <td>{{Helper::formatUang(0)}}</td>
                        <td>{{Helper::formatUang(0)}}</td>                        
                        <td>{{Helper::formatUang(0)}}</td>  
                        <td>
                            <div class="input-group-append">
                                <a href="{{route(Helper::getNameOfPage('show'),['uuid'=>$item->PrioritasSasaranKabID])}}" class="btn btn-primary btn-xs mr-sm-2 default"  title="Detail Data Kegiatan">
                                    <i class="simple-icon-eye"></i>
                                </a>                               
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="8">
                            <span class="badge badge-pill badge-outline-primary mb-1">
                                <strong>ORGIDRPJDM:</strong>{{$item->OrgIDRPJMD}}
                            </span>
                            <span class="badge badge-pill badge-outline-primary mb-1">
                                <strong>PRIORITASSASARANKABID:</strong>{{$item->PrioritasSasaranKabID}}
                            </span>                           
                            <span class="badge badge-pill badge-outline-primary mb-1">
                                <strong>TA RPJMD:</strong>{{$item->TA}}
                            </span>   
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif
