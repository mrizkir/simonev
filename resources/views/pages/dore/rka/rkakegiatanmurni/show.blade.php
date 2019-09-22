@extends('layouts.dore.l_main')
@section('page_title')
    RKA KEGIATAN MURNI
@endsection
@section('page_header')
    <h1>
        <i class="simple-icon-bag"></i>
        RKA KEGIATAN MURNI 
    </h1>    
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">RKA</li>
<li class="breadcrumb-item">KEGIATAN MURNI</li>
<li class="breadcrumb-item active" aria-current="page">DETAIL</li>
@endsection
@section('page_header_display')   
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">
            Details
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">
            Comments(19)
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">
            Questions(5)
        </a>
    </li>
</ul>
@endsection
@section('page_content')
<div class="tab-content">
    <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
        1
    </div>
    <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
        2
    </div>
    <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
        3
    </div>
</div>
@endsection