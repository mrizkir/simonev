<div class="row">
    @if (count($data) > 0)
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="55">NO</th>
                                <th scope="col" width="190">KODE KELOMPOK URUSAN</th>
                                <th scope="col">NAMA KELOMPOK URUSAN </th>
                                <th scope="col">KET.</th>
                                <th scope="col" width="70">TA</th>
                                <th scope="col" width="70">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$item)
                            <tr>
                                <th scope="row">
                                    {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                                    </td>
                                <td>{{$item->Kd_Urusan}}</td>
                                <td>{{$item->Nm_Urusan}}</td>
                                <td>{{$item->Descr}}</td>
                                <td>{{$item->TA}}</td>
                                <td>
                                    <div class="input-group-append">
                                        <a href="#" class="btn btn-primary btn-xs mr-sm-2 default">
                                            <i class="simple-icon-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-primary btn-xs mr-sm-2 default">
                                            <i class="simple-icon-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-xs default">
                                            <i class="simple-icon-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="6">
                                    <div class="card d-flex flex-row mb-0">
                                        <div class="d-flex flex-grow-2 min-width-zero">
                                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center"
                                                style="padding:10px">
                                                <div class="w-15 w-xs-100">
                                                    <span class="badge badge-pill badge-secondary">
                                                        <strong>KURSID:</strong>{{$item->KUrsID}}
                                                    </span>
                                                </div>
                                                <div class="w-15 w-xs-100">
                                                    <span class="badge badge-pill badge-secondary">
                                                        <strong>CREATED:</strong>{{Helper::tanggal('d/m/Y H:m',$item->created_at)}}
                                                    </span>
                                                </div>
                                                <div class="w-15 w-xs-100">
                                                    <span class="badge badge-pill badge-secondary">
                                                        <strong>UPDATED:</strong>{{Helper::tanggal('d/m/Y H:m',$item->updated_at)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links('layouts.dore.l_pagination')}}
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-12">
        <div class="card">
            <div class="alert alert-info">
                Belum ada data yang bisa ditampilkan.
            </div>
        </div>
    </div>
    @endif
</div>