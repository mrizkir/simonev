@extends('layouts.dore.l_main')
@section('page_title')
    USER PERMISSIONS
@endsection
@section('page_header')
    <i class="icon-lock4 position-left"></i>
    <span class="text-semibold">
        USER PERMISSIONS
    </span>
@endsection
@section('page_info')
    @include('pages.dore.setting.permissions.info')
@endsection
@section('page_breadcrumb')
    <li><a href="#">SETTING</a></li>
    <li><a href="{!!route('permissions.index')!!}">PERMISSIONS</a></li>
    <li class="active">ERROR</li>
@endsection
@section('page_content')
<div class="alert alert-danger alert-styled-left alert-bordered">
    <button type="button" class="close" onclick="location.href='{{route('kelompokurusan.index')}}'">×</button>
    {{$errormessage}}
</div>
@endsection