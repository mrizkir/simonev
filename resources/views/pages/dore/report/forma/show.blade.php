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
        <a class="nav-link{!!($filters['changetab']=='data-kegiatan-tab')?' active':''!!}" id="data-kegiatan-tab" data-toggle="tab" href="#data-kegiatan" role="tab" aria-controls="data-kegiatan" aria-selected="false">
            DATA KEGIATAN
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{!!($filters['changetab']=='ringkasan-tab')?' active':''!!}" id="ringkasan-tab" data-toggle="tab" href="#ringkasan" role="tab" aria-controls="ringkasan" aria-selected="true">
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
    <div class="tab-pane fade{!!($filters['changetab']=='ringkasan-tab')?' show active':''!!}" id="ringkasan" role="tabpanel" aria-labelledby="ringkasan-tab">
        
    </div>
    <div class="tab-pane fade{!!($filters['changetab']=='data-kegiatan-tab')?' show active':''!!}" id="data-kegiatan" role="tabpanel" aria-labelledby="data-kegiatan-tab">
        
    </div>
    <div class="tab-pane fade{!!($filters['changetab']=='data-foto-tab')?' show active':''!!}" id="data-foto" role="tabpanel" aria-labelledby="data-foto-tab">
       
    </div>
</div>    
@endsection
@section('page_asset_js')

@endsection
@section('page_custom_js')
<script src="{!!asset('rkakegiatan.js')!!}"></script>
@endsection