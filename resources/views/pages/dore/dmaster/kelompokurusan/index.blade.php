@extends('layouts.dore.l_main')
@section('page_title')
    KELOMPOK URUSAN
@endsection
@section('page_header')    
    <h1>KELOMPOK URUSAN</h1>
@endsection
@section('page_header_button')    
<div class="text-zero top-right-button-container">
    <button type="button" class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</button>
    <div class="btn-group">
        <div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
            <label class="custom-control custom-checkbox mb-0 d-inline-block">
                <input type="checkbox" class="custom-control-input" id="checkAll">
                <span class="custom-control-label"></span>
            </label>
        </div>
        <button type="button"
            class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
        </div>
    </div>
</div>
@endsection
@section('page_header_display')    
<a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
    role="button" aria-expanded="true" aria-controls="displayOptions">
    Display Options
    <i class="simple-icon-arrow-down align-middle"></i>
</a>
<div class="collapse dont-collapse-sm" id="displayOptions">                            
    <div class="d-block d-md-inline-block">
        <div class="btn-group float-md-left mr-1 mb-1">
            <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Order By
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
            </div>
        </div>
        <div class="search-sm calendar-sm d-inline-block float-md-left mr-1 mb-1 align-top">
            <input class="form-control datepicker" placeholder="Search by day">
        </div>
    </div>
    <div class="float-md-right">
        <span class="text-muted text-small">Displaying 1-10 of 210 items </span>
        <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            20
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">10</a>
            <a class="dropdown-item active" href="#">20</a>
            <a class="dropdown-item" href="#">30</a>
            <a class="dropdown-item" href="#">50</a>
            <a class="dropdown-item" href="#">100</a>
        </div>
    </div>
</div>
@endsection
@section('page_breadcrumb')
    <li class="breadcrumb-item">DATA MASTER</li>
    <li class="breadcrumb-item">FUNGSIONAL</li>
    <li class="breadcrumb-item active" aria-current="page">RINGKASAN DATA</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/jquery.contextMenu.min.css')!!}" />  
<link rel="stylesheet" href="{!!asset('css/vendor/bootstrap-datepicker3.min.css')!!}" /> 
@endsection
@section('page_content')
<div class="row">    
    <div class="col-12" id="divdatatable">
        @include('pages.dore.dmaster.kelompokurusan.datatable')
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery.contextMenu.min.js')!!}"></script>
<script src="{!!asset('js/vendor/bootstrap-datepicker.js')!!}"></script>
@endsection