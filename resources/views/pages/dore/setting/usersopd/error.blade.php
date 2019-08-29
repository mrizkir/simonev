@extends('layouts.limitless.l_main')
@section('page_title')
    USERS OPD
@endsection
@section('page_header')
    <i class="icon-users position-left"></i>
    <span class="text-semibold">
        USERS OPD
    </span>
@endsection
@section('page_info')
    @include('pages.limitless.setting.usersopd.info')
@endsection
@section('page_breadcrumb')
    <li><a href="{!!route('usersopd.index')!!}">USERS OPD</a></li>
    <li class="active">ERROR</li>
@endsection
@section('page_content')
<div class="alert alert-danger alert-styled-left alert-bordered">
    <button type="button" class="close" onclick="location.href='{{route('usersopd.index')}}'">×</button>
    {{$errormessage}}
</div>
@endsection