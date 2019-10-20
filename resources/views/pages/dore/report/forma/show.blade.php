@extends('layouts.dore.l_main')
@section('page_title')
    {{HelperKegiatan::getPageTitle()}}
@endsection
@section('page_header')
    <h1>
        <i class="iconsminds-file"></i>
        {{HelperKegiatan::getPageTitle()}} 
    </h1>    
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">LAPORAN</li>
<li class="breadcrumb-item">{{HelperKegiatan::getPageTitle()}} </li>
<li class="breadcrumb-item active" aria-current="page">DETAIL</li>
@endsection
@section('page_header_button')
@include('pages.dore.report.forma.toprightbutton')
@endsection
@section('page_header_display')   
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
    <li class="nav-item">
        <a class="nav-link{!!($filters['changetab']=='data-uraian-tab')?' active':''!!}" id="data-uraian-tab" data-toggle="tab" href="#data-uraian" role="tab" aria-controls="data-uraian" aria-selected="false">
            URAIAN KEGIATAN
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{!!($filters['changetab']=='data-statistik-tab')?' active':''!!}" id="data-statistik-tab" data-toggle="tab" href="#data-statistik" role="tab" aria-controls="data-statistik" aria-selected="true">
            STATISTIK
        </a>
    </li>    
    <li class="nav-item">
        <a class="nav-link{!!($filters['changetab']=='data-foto-tab')?' active':''!!}" id="data-foto-tab" data-toggle="tab" href="#data-foto" role="tab" aria-controls="data-foto" aria-selected="false">
            FOTO
        </a>
    </li>
</ul>
@endsection
@section('page_asset_css')

@endsection
@section('page_content')
<div class="tab-content">    
    <div class="tab-pane fade{!!($filters['changetab']=='data-uraian-tab')?' show active':''!!}" id="data-uraian" role="tabpanel" aria-labelledby="data-uraian">
        <div class="row">
            <div class="col-12 mb-3" id="divfilter">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <i class="iconsminds-filter-2"></i>
                            FILTER
                        </h4>
                        {!! Form::open(['action'=>'Report\FormAController@filter','method'=>'post','id'=>'frmfilter','name'=>'frmfilter'])!!}                                
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">BULAN REALISASI :</label> 
                                <div class="col-md-10">
                                    {{Form::select('bulan', Helper::getBulanM(),$filters['bulan_realisasi'],['class'=>'form-control select'])}}
                                </div>
                            </div>                           
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
        <div id="datatableuraian" class="table-responsive">
            @include('pages.dore.report.forma.datatableuraian')
        </div>
    </div>
    <div class="tab-pane fade{!!($filters['changetab']=='data-statistik-tab')?' show active':''!!}" id="data-statistik" role="tabpanel" aria-labelledby="data-statistik">
        
    </div>
    <div class="tab-pane fade{!!($filters['changetab']=='data-foto-tab')?' show active':''!!}" id="data-foto" role="tabpanel" aria-labelledby="data-foto">
       
    </div>
</div>    
@endsection
@section('page_asset_js')

@endsection
@section('page_custom_js')
<script src="{!!asset('rkakegiatan.js')!!}"></script>
@endsection