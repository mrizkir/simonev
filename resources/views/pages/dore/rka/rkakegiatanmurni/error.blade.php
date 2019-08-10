@extends('layouts.limitless.l_main')
@section('page_title')
    RKAKEGIATANMURNI
@endsection
@section('page_header')
    <i class="icon-database-refresh position-left"></i>
    <span class="text-semibold">
        RKAKEGIATANMURNI TAHUN PENYERAPAN {{config('simonev.tahun_penyerapan')}}
    </span>
@endsection
@section('page_info')
    @include('pages.dore.rka.rkakegiatanmurni.info')
@endsection
@section('page_breadcrumb')
    <li><a href="{!!route('rkakegiatanmurni.index')!!}">RKAKEGIATANMURNI</a></li>
    <li class="active">ERROR</li>
@endsection
@section('page_content')
<div class="alert alert-danger alert-styled-left alert-bordered">
    <button type="button" class="close" onclick="location.href='{{route('rkakegiatanmurni.index')}}'">×</button>
    {{$errormessage}}
</div>
@endsection