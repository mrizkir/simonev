@extends('layouts.dore.l_main')
@section('page_title')
    USERS SUPER ADMIN
@endsection
@section('page_header')
    <h1>
        <i class="simple-icon-bag"></i>
        USERS SUPER ADMIN
    </h1> 
@endsection
@section('page_header_button')
<div class="text-zero top-right-button-container">    
    <div class="btn-group">
        <button type="button"
            class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single default"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="simple-icon-menu"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{!!route('users.index')!!}" title="Tutup Halaman ini">
                <i class="simple-icon-close"></i> CLOSE
            </a>
        </div>
    </div>
</div>
@endsection
@section('page_info')
    @include('pages.dore.setting.users.info')
@endsection
@section('page_breadcrumb')
    <li class="breadcrumb-item">SETTING</li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="{!!route('rkakegiatanmurni.index')!!}"> USERS SUPER ADMIN</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">UBAH DATA</li>
@endsection
@section('page_content')
<div class="content">
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="simple-icon-note"></i>
                UBAH DATA
            </h4>
            <div class="separator mb-5"></div>
            {!! Form::open(['action'=>['Setting\UsersController@update',$data->id],'method'=>'post','class'=>'form-horizontal','id'=>'frmdata','name'=>'frmdata'])!!}                              
                {{Form::hidden('_method','PUT')}}
                <div class="form-group row">
                    {{Form::label('name','NAMA',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('name',$data['name'],['class'=>'form-control','placeholder'=>'NAMA USER'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('email','EMAIL',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-md-10">
                        {{Form::text('email',$data['email'],['class'=>'form-control','placeholder'=>'EMAIL USER'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('username','USERNAME',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-md-10">
                        {{Form::text('username',$data['username'],['class'=>'form-control','placeholder'=>'USERNAME'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('password','PASSWORD',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-md-10">
                        {{Form::password('password',['class'=>'form-control','placeholder'=>'PASSWORD'])}}
                    </div>
                </div>  
               <div class="form-group row">
                    {{Form::label('','',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{ Form::button('SIMPAN', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm default'] ) }}
                    </div>
                </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>

@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery-validation/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery-validation/additional-methods.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {
    $('#frmdata').validate({
        ignore:[],
        rules: {
            name : {
                required: true,
                minlength: 2
            },
            email : {
                required: true,
                email: true,
            },
            username : {
                required: true,
                minlength: 5,
            },
            password : {
                required: true,
                minlength: 5,
            }
        },
        messages : {
            name : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 2 karakter atau lebih."
            },
            email : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                email: "Format email tidak benar."
            },
            username : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 5 karakter atau lebih."
            },
            password : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 5 karakter atau lebih."
            }
        },        
    });    
});
</script>
@endsection