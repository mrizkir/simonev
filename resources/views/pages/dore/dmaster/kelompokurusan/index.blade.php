@extends('layouts.dore.l_main')
@section('page_title')
    KELOMPOK URUSAN
@endsection
@section('page_header')
    KELOMPOK URUSAN
@endsection
@section('page_breadcrumb')
    <li class="breadcrumb-item">DATA MASTER</li>
    <li class="breadcrumb-item">FUNGSIONAL</li>
    <li class="breadcrumb-item active" aria-current="page">RINGKASAN DATA</li>
@endsection
@section('page_content')
<div class="row">    
    <div class="col-md-12" id="divdatatable">
        @include('pages.dore.dmaster.kelompokurusan.datatable')
    </div>
</div>
@endsection