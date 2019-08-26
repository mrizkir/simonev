@extends('layouts.dore.l_main')
@section('page_title')
    URUSAN
@endsection
@section('page_header')
    <h1>
        <i class="simple-icon-bag"></i>
        URUSAN
    </h1>
@endsection
@section('page_header_display')
<div class="mb-2">
    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button"
        aria-expanded="true" aria-controls="displayOptions">
        Display Options
        <i class="simple-icon-arrow-down align-middle"></i>
    </a>
    <div class="collapse dont-collapse-sm" id="displayOptions">
        <div class="d-block d-md-inline-block">
            {!!
            Form::open(['url'=>'#','method'=>'post','class'=>'form-inline','id'=>'frmheading','name'=>'frmheading'])!!}
            <div class="form-group">
                {!!Form::select('numberRecordPerPage',['1'=>1,'5'=>5,'10'=>10,'15'=>15,'30'=>30,'50'=>50],$numberRecordPerPage,['id'=>'numberRecordPerPage','class'=>'form-control','style'=>'width:70px'])!!}
            </div>
            {!! Form::close()!!}
        </div>
        <div class="float-md-right">
            
        </div>
    </div>
</div>
<div class="separator mb-5"></div>
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">DATA MASTER</li>
<li class="breadcrumb-item">FUNGSIONAL</li>
<li class="breadcrumb-item active" aria-current="page">URUSAN</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/jquery.contextMenu.min.css')!!}" />
@endsection
@section('page_content')
<div class="row">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">
                    <i class="simple-icon-magnifier"></i>
                    PENCARIAN
                </h4>
                {!! Form::open(['action'=>'DMaster\UrusanController@search','method'=>'post','id'=>'frmsearch','name'=>'frmsearch'])!!}                                
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kriteria :</label> 
                        <div class="col-md-10">
                            {{Form::select('cmbKriteria', ['Kode_Bidang'=>'KODE URUSAN','Nm_Bidang'=>'NAMA URUSAN'], isset($search['kriteria'])?$search['kriteria']:'Kode_Bidang',['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row" id="divKriteria">
                        <label class="col-md-2 col-form-label">Isi Kriteria :</label>                                                    
                        <div class="col-md-10">                            
                            {{Form::text('txtKriteria',isset($search['isikriteria'])?$search['isikriteria']:'',['class'=>'form-control','placeholder'=>'Isi Kriteria Pencarian','id'=>'txtKriteria'])}}                                                                  
                        </div>
                    </div>                                                     
                    <div class="form-group row">
                        <div class="offset-md-2 col-md-10">
                            {{ Form::button('<b><i class="icon-search4"></i></b> Cari', ['type' => 'submit', 'class' => 'btn btn-primary default', 'id'=>'btnSearch'] )  }}                            
                            <a id="btnReset" href="javascript:;" title="Reset Pencarian" class="btn btn-dark default">
                                <b><i class="icon-reset"></i></b> Reset
                            </a>                           
                        </div>
                    </div>  
                {!! Form::close()!!}
            </div>
        </div>
    </div>
    <div class="col-12" id="divdatatable">
        @include('pages.dore.dmaster.urusan.datatable')
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery.contextMenu.min.js')!!}"></script>
@endsection