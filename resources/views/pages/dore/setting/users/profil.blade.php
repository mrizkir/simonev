@extends('layouts.dore.l_main')
@section('page_title')
PROFIL PENGGUNA
@endsection
@section('page_header')
<h1>
    <i class="simple-icon-bag"></i>
    PROFIL PENGGUNA
</h1>
@endsection
@section('page_info')
@include('pages.dore.setting.usersbapelitbang.info')
@endsection
@section('page_header_button')
<div class="text-zero top-right-button-container">
    <button type="button"
        class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single default"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="simple-icon-menu"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{!!route('usersbapelitbang.index')!!}">
            <i class="simple-icon-close"></i> CLOSE
        </a>
    </div>
</div>
@endsection
@section('page_header_display')
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first"
            aria-selected="true">DETAILS
        </a>
    </li>
</ul>
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">SETTING</li>
<li class="breadcrumb-item">PROFIL</li>
<li class="breadcrumb-item">
    <a href="{!!route('kelompokurusan.index')!!}">PROFIL PENGGUNA</a>
</li>
<li class="breadcrumb-item active" aria-current="page">DETAIL</li>
@endsection
@section('page_content')
<div class="tab-content">
    <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2">
                            <i class="simple-icon-screen-tablet"></i>
                            PROFIL
                        </h2>
                        <div class="separator mb-3"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label"><strong>ID: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{$data->id}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label"><strong>USERNAME: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{$data->username}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label"><strong>NAMA: </strong></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{$data->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><strong>EMAIL: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->email}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><strong>TGL. BUAT: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">
                                                {{Helper::tanggal('d/m/Y H:m',$data->created_at)}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><strong>TGL. UBAH: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">
                                                {{Helper::tanggal('d/m/Y H:m',$data->updated_at)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator mb-5"></div>
                        {!!Form::open(['action'=>['Setting\UsersController@updateprofil',$data->id],'method'=>'put','id'=>'frmdata','name'=>'frmdata'])!!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{Form::label('username','USERNAME',['class'=>'col-sm-3 col-form-label'])}}
                                    <div class="col-sm-9">
                                        {{Form::text('username',$data->username,['class'=>'form-control','placeholder'=>'USERNAME','readonly'=>'readonly'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('email','EMAIL',['class'=>'col-sm-3 col-form-label'])}}
                                    <div class="col-sm-9">
                                        {{Form::text('email',$data->email,['class'=>'form-control','placeholder'=>'EMAIL'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{Form::label('password','NEW PASSWORD',['class'=>'col-sm-3 col-form-label'])}}
                                    <div class="col-sm-9">
                                        {{Form::password('password1',['class'=>'form-control','placeholder'=>'PASSWORD'])}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{Form::label('password','ULANGI PASSWORD',['class'=>'col-sm-3 col-form-label'])}}
                                    <div class="col-sm-9">
                                        {{Form::password('password2',['class'=>'form-control','placeholder'=>'ULANGI PASSWORD'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{Form::label('','',['class'=>'col-sm-3 col-form-label'])}}
                                    <div class="col-sm-9">
                                        {{ Form::button('SIMPAN', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm default'] ) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('themes/dore/assets/js/jquery-validation/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('themes/dore/assets/js/jquery-validation/additional-methods.min.js')!!}"></script>
<script src="{!!asset('themes/dore/assets/js/filepond.min.js')!!}"></script>
@endsection
@section('page_custom_js')

@endsection