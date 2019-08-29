@extends('layouts.dore.l_main')
@section('page_title')
    USERS SUPER ADMIN
@endsection
@section('page_header')
    <i class="icon-users position-left"></i>
    <span class="text-semibold">
        USERS SUPER ADMIN
    </span>
@endsection
@section('page_info')
    @include('pages.dore.setting.users.info')
@endsection
@section('page_breadcrumb')
    <li><a href="{!!route('users.index')!!}">USERS SUPER ADMIN</a></li>
    <li class="active">ERROR</li>
@endsection
@section('page_content')
<div class="alert alert-danger alert-styled-left alert-bordered">
    <button type="button" class="close" onclick="location.href='{{route('users.index')}}'">×</button>
    {{$errormessage}}
</div>
@endsection