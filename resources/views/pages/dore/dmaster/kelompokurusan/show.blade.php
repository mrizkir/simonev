@extends('layouts.dore.l_main')
@section('page_title')
    KELOMPOK URUSAN
@endsection
@section('page_header')    
    <h1>KELOMPOK URUSAN</h1>
@endsection
@section('page_info')
    @include('pages.dore.dmaster.kelompokurusan.info')
@endsection
@section('page_breadcrumb')
    <li class="breadcrumb-item">DATA MASTER</li>
    <li class="breadcrumb-item">FUNGSIONAL</li>
    <li class="breadcrumb-item">
        <a href="{!!route('kelompokurusan.index')!!}">KELOMPOK URUSAN</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">DETAIL</li>
@endsection
@section('page_content')
<div class="row">    
    <div class="col-12 list">
        
    </div>
    <div class="col-md-12">
        <div class="panel panel-flat border-top-info border-bottom-info">
            <div class="panel-heading">
                <h5 class="panel-title"> 
                    <i class="icon-eye"></i> DATA KELOMPOK URUSAN
                </h5>
                <div class="heading-elements">                      
                    <a href="javascript:;" title="Hapus Data Kelompok Urusan" data-id="{{$data->KUrsID}}" data-url="{{route('kelompokurusan.index')}}" class="btn btn-danger btn-icon heading-btn btnDelete">
                        <i class='icon-trash'></i>
                    </a>
                    <a href="{!!route('kelompokurusan.index')!!}" class="btn btn-default btn-icon heading-btn" title="keluar">
                        <i class="icon-close2"></i>
                    </a>            
                </div>
            </div>
            <div class="panel-body">
                <div class="row">                                      
                    <div class="col-md-6">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>KODE KELOMPOK URUSAN: </strong></label>
                                <div class="col-md-8">
                                    <p class="form-control-static">{{$data->Kd_Urusan}}</p>
                                </div>                            
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>NAMA KELOMPOK URUSAN: </strong></label>
                                <div class="col-md-8">
                                    <p class="form-control-static">{{$data->Nm_Urusan}}</p>
                                </div>                            
                            </div>                              
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>TGL. BUAT: </strong></label>
                                <div class="col-md-8">
                                    <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$data->created_at)}}</p>
                                </div>                            
                            </div>                    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>KETERANGAN: </strong></label>
                                <div class="col-md-8">
                                    <p class="form-control-static">{{$data->Descr}}</p>
                                </div>                            
                            </div>        
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>TAHUN PERENCANAAN: </strong></label>
                                <div class="col-md-8">
                                    <p class="form-control-static">{{$data->TA}}</p>
                                </div>                            
                            </div>         
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>TGL. UBAH: </strong></label>
                                <div class="col-md-8">
                                    <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$data->updated_at)}}</p>
                                </div>                            
                            </div>            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection