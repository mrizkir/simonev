@extends('layouts.dore.l_login')
@section('page_title')
    LOGIN
@endsection
@section('page_content')
<!-- BEGIN MAIN CONTENT-->
<div class="offcanvas-wrapper">
    <!-- PAGE CONTENT BEGINS -->
    <div class="row no-gutters">
        <div class="col-md-6 fh-section" style="background-image: url('http://via.placeholder.com/683x1024');">
            <span class="overlay" style="background-color: #374250; opacity: .45;"></span>
            <div class="d-flex flex-column fh-section py-5 px-3 justify-content-between">
                <div class="w-in-100 text-center">
                    <div class="d-inline-block mb-5">
                        <img class="d-block" src="http://via.placeholder.com/261x88" alt="pvr_tech_studio">
                    </div>
                    <div class="pt-3 hidden-md-up">
                        <a class="btn btn-primary scroll-to" href="#notify">
                            <i class="icon-bell"></i>&nbsp;Notify Me!
                        </a>
                    </div>
                </div>
                <div class="w-in-100 text-center">
                    <p class="text-white mb-2">+91 9159547048</p>
                    <a class="navi-link-light" href="http://www.pvrtechstudio.com/" target="_blank">pvrtechstudio.com</a>
                    <div class="pt-3">
                        <a class="social-button shape-circle fa fa-facebook sb-light-skin" href="javascript:void(0)">
                            <i class="socicon-facebook"></i>
                        </a>
                        <a class="social-button shape-circle fa fa-twitter sb-light-skin" href="javascript:void(0)">
                            <i class="socicon-twitter"></i>
                        </a>
                        <a class="social-button shape-circle fa fa-instagram sb-light-skin" href="javascript:void(0)">
                            <i class="socicon-instagram"></i>
                        </a>
                        <a class="social-button shape-circle fa fa-google-plus sb-light-skin" href="javascript:void(0)">
                            <i class="socicon-googleplus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 fh-section" id="notify" data-offset-top="-1">
            <div class="d-flex flex-column fh-section py-5 px-3 justify-content-center align-items-center">
                <div class="text-center" style="max-width: 500px;">
                    <div class="h1 text-normal mb-2">Login <i class="fa fa-sign-in f-s-28"></i></div>
                    <h5 class="text-normal text-muted mb-4">
                        Masukan username dan password untuk masuk ke dalam {{config('app.name')}}
                    </h5>
                    {!! Form::open(['url'=>route('login'),'method'=>'post','class'=>'login-box','id'=>'frmlogin','name'=>'frmlogin'])!!}                        
                        <div class="form-group input-group">                            
                            {{Form::text('username',old('username'),['class'=>'form-control form-control-rounded','placeholder'=>'Username'])}}
                            <span class="input-group-addon"><i class="icon-mail"></i></span>
                        </div>
                        <div class="form-group input-group">
                            {{Form::password('password',['class'=>'form-control form-control-rounded','placeholder'=>'Password'])}}
                            <span class="input-group-addon"><i class="icon-lock"></i></span>
                        </div>
                        <div class="form-group input-group">
                            {{Form::select('TACd', \App\Models\DMaster\TAModel::pluck('TACd','TACd'), config('eplanning.tahun_perencanaan'), ['placeholder' => 'PILIH TAHUN PENYERAPAN','class'=>'form-control form-control-rounded'])}}
                        </div>
                        <div class="text-center text-sm-right">
                            <button class="btn btn-primary margin-bottom-none" type="submit">Login</button>
                        </div>
                    {!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('page_asset_js')
<script src="{!!asset('assets/plugins/jquery-validation/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('assets/plugins/jquery-validation/additional-methods.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {
    $('#frmlogin').validate({
        rules: {
            username : {
                required: true
            },
            password : {
                required: true
            },
            TACd : {
                required: true
            },
        },
        messages : {
            username : {
                required: "Mohon untuk di isi username karena diperlukan."
            },
            password : {
                required: "Mohon untuk di isi password karena diperlukan."
            },
            TACd : {
                required: "Mohon pilih tahun perencanaan."
            }
        }        
    });   
});
</script>
@endsection