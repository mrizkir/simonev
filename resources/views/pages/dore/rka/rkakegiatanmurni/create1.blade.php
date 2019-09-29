@extends('layouts.dore.l_main')
@section('page_title')
    RKA KEGIATAN MURNI
@endsection
@section('page_header')
    <h1>
        <i class="simple-icon-bag"></i>
        RKA KEGIATAN MURNI 
    </h1>    
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">RKA</li>
<li class="breadcrumb-item">
    <a href="{{route('rkakegiatanmurni.show',['uuid'=>$rka->RKAID])}}" title="Detail Kegiatan">
        DETAIL KEGIATAN MURNI
    </a>    
</li>
<li class="breadcrumb-item" aria-current="page">TAMBAH URAIAN</li>
<li class="breadcrumb-item active" aria-current="page">PILIH REKENING</li>
@endsection
@section('page_header_button')
<div class="text-zero top-right-button-container">    
    <div class="btn-group">
        <button type="button"
            class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single default"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="simple-icon-menu"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('rkakegiatanmurni.create1',['uuid'=>$rka->RKAID])}}" title="Tambah Uraian">
                <i class="simple-icon-plus"></i> TAMBAH URAIAN
            </a> 
            <a class="dropdown-item" href="{!!route('rkakegiatanmurni.index')!!}" title="Tutup Halaman ini">
                <i class="simple-icon-close"></i> CLOSE
            </a>
        </div>
    </div>
</div>
@endsection
@section('page_header_display')   
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="rincian-ringkasan-tab" href="{!!route('rkakegiatanmurni.show',['uuid'=>$rka->RKAID])!!}" role="tab" aria-controls="ringkasan" aria-selected="false">
            RINGKASAN
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="data-rinciankegiatan-tab" href="{!!route('rkakegiatanmurni.show',['uuid'=>$rka->RKAID])!!}" role="tab" aria-controls="data-kegiatan" aria-selected="false">
            DATA KEGIATAN
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="data-uraian-tab" data-toggle="tab" href="#data-uraian" role="tab" aria-controls="data-uraian" aria-selected="true">
            URAIAN
        </a>
    </li>
</ul>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/select2.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/select2-bootstrap.min.css')!!}" />
@endsection
@section('page_content')
<div class="tab-content">
    <div class="tab-pane fade{!!($filters['changetab']=='data-uraian-tab')?' show active':''!!}" id="data-uraian" role="tabpanel" aria-labelledby="data-uraian-tab">        
        <div class="row">            
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="mb-2">
                            <i class="simple-icon-screen-tablet"></i>
                            DATA KEGIATAN
                        </h2>
                        <div class="separator mb-3"></div>
                        <div class="row">                     
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>RKAID: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$rka->RKAID}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>KEGIATAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$rka->KgtNm}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>PAGU DANA: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{Helper::formatUang($rka->PaguDana1)}}</p>
                                        </div>                            
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2">
                            <i class="simple-icon-plus"></i>
                            TAMBAH URAIAN
                        </h2>
                        <div class="separator mb-3"></div>
                        {!! Form::open(['action'=>['RKA\RKAKegiatanMurniController@store1',$rka->RKAID],'method'=>'post','class'=>'form-horizontal','id'=>'frminformasitambahan','name'=>'frminformasitambahan'])!!}                              
                            <div class="form-group row">
                                {{Form::label('StrID','Transaksi',['class'=>'col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::select('StrID', $daftar_transaksi, 'none', ['class'=>'form-control select'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('KlpID','Kelompok',['class'=>'col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::select('KlpID', [], null, ['class'=>'form-control select'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('JnsID','Jenis',['class'=>'col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::select('JnsID', [], null, ['class'=>'form-control select'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('ObyID','Rincian',['class'=>'col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::select('ObyID', [], null, ['class'=>'form-control select'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('RObyID','Objek',['class'=>'col-sm-2 col-form-label'])}}
                                <div class="col-sm-10">
                                    {{Form::select('RObyID', [], null, ['class'=>'form-control select'])}}
                                </div>
                            </div>                            
                        {!! Form::close()!!} 
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>    
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/select2.full.js')!!}"></script>
@endsection
@section('page_custom_js')
<script src="{!!asset('rkakegiatan.js')!!}"></script>
<script type="text/javascript">
$(document).ready(function () {
    
});
</script>
@endsection