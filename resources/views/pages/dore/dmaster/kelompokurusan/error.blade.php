@extends('layouts.dore.l_main')
@section('page_title')
    KELOMPOK URUSAN
@endsection
@section('page_header')
    <i class="icon-chess-queen position-left"></i>
    <span class="text-semibold">
        KELOMPOK URUSAN TAHUN PERENCANAAN {{HelperKegiatan::getRPJMDTahunMulai()}} - {{HelperKegiatan::getRPJMDTahunAkhir()}}
    </span>
@endsection
@section('page_info')
    @include('pages.dore.dmaster.kelompokurusan.info')
@endsection
@section('page_breadcrumb')
    <li><a href="#">MASTERS</a></li>
    <li><a href="#">DATA</a></li>
    <li><a href="{!!route('kelompokurusan.index')!!}">KELOMPOK URUSAN</a></li>
    <li class="active">ERROR</li>
@endsection
@section('page_content')
<div class="alert alert-danger alert-styled-left alert-bordered">
    <button type="button" class="close" onclick="location.href='{{route('kelompokurusan.index')}}'">×</button>
    {{$errormessage}}
</div>
@endsection