@extends('layouts.dore.l_main')
@section('page_title')
PROGRAM
@endsection
@section('page_header')
<h1>
    <i class="simple-icon-bag"></i>
    PROGRAM
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
<li class="breadcrumb-item active" aria-current="page">PROGRAM</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/jquery.contextMenu.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/bootstrap-datepicker3.min.css')!!}" />
@endsection
@section('page_content')
<div class="row">
    <div class="col-12" id="divdatatable">
        @include('pages.dore.dmaster.program.datatable')
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery.contextMenu.min.js')!!}"></script>
<script src="{!!asset('js/vendor/bootstrap-datepicker.js')!!}"></script>
@endsection