@extends('layouts.dore.l_main')
@section('page_title')
    PROFIL PENGGUNA
@endsection 
@section('page_header')
    <i class="icon-users position-left"></i>
    <span class="text-semibold"> 
        PROFIL PENGGUNA
    </span>     
@endsection
@section('page_breadcrumb')    
    <li class="active">PROFIL PENGGUNA</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('themes/dore/assets/css/filepond.min.css')!!}">
@endsection
@section('page_sidebar')
<div class="sidebar sidebar-main sidebar-default sidebar-separate">
    <div class="sidebar-content" style="margin-right:2px">
        <!-- User details -->
        <div class="content-group">
            <div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url({!!asset('/storage/images/panel_bg.png')!!}); background-size: contain;">
                <div class="content-group-sm">
                    <h6 class="text-semibold no-margin-bottom">
                        {{Auth::user()->username}}
                    </h6>
                    <span class="display-block">&nbsp;</span>
                </div>
                <a href="#" class="display-inline-block content-group-sm">
                    <img src="{!!asset(Auth::user()->foto)!!}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                </a>
                <ul class="list-inline list-inline-condensed no-margin-bottom">                    
                    <li>
                        <span class="display-block">
                            &nbsp;
                        </span>
                    </li>
                </ul>
            </div>
            <input type="file" class="filepond" name="photoprofile" id="photoprofile" data-max-file-size="3MB" data-max-files="3">    
        </div>
    </div>    
</div>    
@endsection
@section('page_content')
<div class="row">    
    <div class="col-md-12">
        <div class="panel panel-flat border-top-info border-bottom-info">
            <div class="panel-heading">
                <h5 class="panel-title"> 
                    <i class="icon-eye"></i>  PROFIL PENGGUNA
                </h5>
            </div>
            <div class="panel-body">
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
                                    <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$data->created_at)}}</p>
                                </div>                            
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>TGL. UBAH: </strong></label>
                                <div class="col-md-8">
                                    <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$data->updated_at)}}</p>
                                </div>                            
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <i class="icon-users position-left"></i>
                    Informasi Profil
                </h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                {!! Form::open(['action'=>['Setting\UsersController@updateprofil',$data->id],'method'=>'put','id'=>'frmdata','name'=>'frmdata'])!!}
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Username :</label>
                                    {{Form::text('username',$data->username,['class'=>'form-control','placeholder'=>'username','readonly'=>'readonly'])}}
                                </div>
                                <div class="col-md-6">
                                    <label>Email :</label>
                                    {{Form::text('email',$data->email,['class'=>'form-control','placeholder'=>'email'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>New password</label>
                                {{Form::password('password1', ['class' => 'form-control','placeholder'=>'Password Baru','id'=>'password1'])}}
                            </div>

                            <div class="col-md-6">
                                <label>Ulangi password</label>
                                {{Form::password('password2', ['class' => 'form-control','placeholder'=>'Ulangi Password','id'=>'password2'])}}
                            </div>
                        </div>
                    </div>                    
                    <div class="text-right">
                        {{ Form::button('<b><i class="icon-floppy-disk "></i></b> SIMPAN', ['type' => 'submit', 'class' => 'btn btn-info btn-labeled btn-xs'] ) }}
                    </div>
                {!! Form::close()!!}
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
<script type="text/javascript">
$(document).ready(function () {
    FilePond.setOptions({
        name: 'file',
        server: '{{route("filepond.upload")}}',
    })
    const photoprofile =  document.querySelector('#photoprofile');
    const uploader = FilePond.create(photoprofile);
    $('#frmdata').validate({
        rules: {
            email : {
                required: true
            },
            password2 : {
                equalTo: "#password1"
            }
        },
        messages : {
            email : {
                required: "Mohon untuk di isi karena ini diperlukan.",                
            },
            password2 : {
                equalTo : "Password yang di inputkan tidak sama, mohon untuk disesuaikan"
            }
        }      
    });   
});
</script>
@endsection