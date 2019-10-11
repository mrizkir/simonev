@if (count($data) > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" width="55">NO</th>
                        <th scope="col" width="120">
                            <a class="column-sort" id="col-Kd_Urusan" data-order="{{$direction}}" href="#">
                                KODE KEGIATAN
                            </a>
                        </th>
                        <th scope="col">
                            <a class="column-sort" id="col-Nm_Bidang" data-order="{{$direction}}" href="#">
                                NAMA KEGIATAN
                            </a>
                        </th>
                        <th scope="col" width="120">
                            <a class="column-sort" id="col-Nm_Urusan" data-order="{{$direction}}" href="#">
                                PAGU KEGIATAN
                            </a>
                        </th>
                        <th scope="col" width="120">TOTAL PAGU URAIAN</th>
                        <th scope="col" width="70">REALISASI</th>
                        <th scope="col" width="70">FISIK(%)</th>
                        <th scope="col" width="120">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                    <tr>
                        <th scope="row">
                            {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                            </td>
                        <td>{{$item->kode_kegiatan}}</td>
                        <td>{{$item->KgtNm}}</td>
                        <td>{{Helper::formatUang($item->PaguDana1)}}</td>
                        <td>{{Helper::formatUang(DB::table('trRKARinc')->where('RKAID',$item->RKAID)->sum('pagu_uraian1'))}}</td>
                        <td>{{Helper::formatUang(DB::table('trRKARealisasiRinc')->where('RKAID',$item->RKAID)->sum('realisasi1'))}}</td>                        
                        <td>
                            @php
                                $jumlah_uraian=DB::table('trRKARinc')->where('RKAID',$item->RKAID)->count('RKARincID');
                                $total_fisik=Helper::formatUang(DB::table('trRKARealisasiRinc')->where('RKAID',$item->RKAID)->sum('fisik1'));
                            @endphp
                            {{Helper::formatPecahan($total_fisik,$jumlah_uraian)}}
                        </td>
                        <td>
                            <div class="input-group-append">
                                <a href="{{route('rkakegiatanmurni.show',['uuid'=>$item->RKAID])}}" class="btn btn-primary btn-xs mr-sm-2 default"  title="Detail Data Kegiatan">
                                    <i class="simple-icon-eye"></i>
                                </a>
                                <a href="{{route('rkakegiatanmurni.edit',['uuid'=>$item->RKAID])}}" title="Ubah Data Kegiatan" class="btn btn-primary btn-xs mr-sm-2 default">
                                    <i class="simple-icon-pencil"></i>
                                </a>
                                <a href="javascript:;" title="Hapus Data Kegiatan" data-id="{{$item->RKAID}}" class="btn btn-danger btn-xs default btnDelete" data-url="{{route('rkakegiatanmurni.index')}}">
                                    <i class="simple-icon-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="8">
                            <span class="badge badge-pill badge-outline-primary mb-1">
                                <strong>RKAID:</strong>{{$item->RKAID}}
                            </span>
                            <span class="badge badge-pill badge-outline-primary mb-1">
                                <strong>KGTID:</strong>{{$item->KgtID}}
                            </span>
                            <span class="badge badge-pill badge-outline-primary mb-1">
                                <strong>PRGID:</strong>{{$item->PrgID}}
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
                        <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                        <td class="text-right" id="tdTotalPaguUraian"><strong>{{Helper::formatUang($datatotalkegiatan['pagu_kegiatan'])}}</strong></td>
                        <td class="text-right" id="tdTotalPaguUraian"><strong>{{Helper::formatUang($datatotalkegiatan['pagu_uraian'])}}</strong></td>
                        <td class="text-right" id="tdTotalRealisasi"><strong>{{Helper::formatUang($datatotalkegiatan['total_realisasi'])}}</strong></td>
                        <td class="text-center"><strong>{{Helper::formatAngka($datatotalkegiatan['total_fisik'])}}</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><strong>PAGU OPD/SKPD</strong></td>
                        <td class="text-right"><strong>{{$datatotalkegiatan['pagu_opd']}}</strong></td>                
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><strong>SISA PAGU OPD/SKPD</strong></td>
                        <td class="text-right"><strong>{{Helper::formatUang($datatotalkegiatan['pagu_opd']-$datatotalkegiatan['pagu_kegiatan'])}}</strong></td>                
                        <td colspan="4"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert alert-info">
    Belum ada data yang bisa ditampilkan.
</div>
@endif
