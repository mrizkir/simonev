@extends('layouts.dore.l_login')
@section('page_title')
    LOGIN
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/bootstrap-float-label.min.css')!!}" />  
@endsection
@section('page_content')
<div class="fixed-background"></div>
<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>

                        <p class="white mb-0">
                            Please use your credentials to login.
                            <br>If you are not a member, please
                            <a href="#" class="white">register</a>.
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Login</h6>
                        {!! Form::open(['url'=>route('login'),'method'=>'post','id'=>'frmlogin','name'=>'frmlogin'])!!}
                            <label class="form-group has-float-label mb-4">
                                {{Form::text('username',old('username'),['class'=>'form-control'])}}
                                <span>Username</span>
                            </label>
                            <label class="form-group has-float-label mb-4">
                                {{Form::password('password',['class'=>'form-control'])}}
                                <span>Password</span>
                            </label>
                            
                            <div class="form-group has-float-label mb-4">
                                {{Form::select('TACd', \App\Models\DMaster\TAModel::pluck('TACd','TACd'), config('simonev.tahun_penyerapan'), ['placeholder' => 'PILIH TAHUN PENYERAPAN','class'=>'form-control'])}}
                                <span>TAHUN PENYERAPAN</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#">&nbsp;</a>
                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                            </div>
                            @if ($errors->has('username'))                            
                                {{ $errors->first('username') }}                                                    
                            @endif    
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>    
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery-validation/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery-validation/additional-methods.min.js')!!}"></script>
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