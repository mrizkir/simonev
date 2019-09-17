@extends('layouts.dore.l_main')
@section('page_title')
    USER ROLES
@endsection
@section('page_header')    
    <h1>
        <i class="simple-icon-bag"></i> 
        USER ROLES
    </h1>
@endsection
@section('page_info')
    @include('pages.dore.setting.users.info')
@endsection
@section('page_header_button')
    <div class="text-zero top-right-button-container">
        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="simple-icon-menu"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{!!route('roles.index')!!}">
                <i class="simple-icon-close"></i> CLOSE
            </a>            
        </div>
    </div>
@endsection
@section('page_header_display')   
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
            aria-controls="first" aria-selected="true">DETAILS
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="permission-tab" data-toggle="tab" href="#permission-tab" role="tab"
            aria-controls="permission-tab" aria-selected="true">PERMISSION
        </a>
    </li>
</ul>
@endsection
@section('page_breadcrumb')
    <li class="breadcrumb-item">SETTING</li>
    <li class="breadcrumb-item">USERS</li>
    <li class="breadcrumb-item">
        <a href="{!!route('roles.index')!!}">DETAIL USER ROLES</a>
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
                            USER ROLES
                        </h2>
                        <div class="separator mb-3"></div>
                        <div class="row">                                      
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>ID: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->id}}</p>
                                        </div>                            
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>GUARD: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->guard_name}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>JUMLAH USERS: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->jumlah}}</p>
                                        </div>                            
                                    </div>                       
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-4 control-label"><strong>TGL. BUAT: </strong></label>
                                        <div class="col-8">
                                            <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$data->created_at)}}</p>
                                        </div>                            
                                    </div>       
                                    <div class="form-group row">
                                        <label class="col-4 control-label"><strong>TGL. UBAH: </strong></label>
                                        <div class="col-8">
                                            <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$data->updated_at)}}</p>
                                        </div>                            
                                    </div>            
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="tab-permission" role="tabpanel" aria-labelledby="permission-tab">
    </div>
</div>
@endsection
