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
    <li class="active">TAMBAH DATA</li>
@endsection
@section('page_content')
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="icon-pencil7 position-left"></i> 
                TAMBAH DATA
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">                    
                    <li>               
                        <a href="{!!route('permissions.index')!!}" data-action="closeredirect" title="keluar"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            {!! Form::open(['action'=>'Setting\PermissionsController@store','method'=>'post','class'=>'form-horizontal','id'=>'frmdata','name'=>'frmdata'])!!}                              
                <div class="form-group">
                    {{Form::label('name','NAMA PERMISSION',['class'=>'control-label col-md-2'])}}
                    <div class="col-md-10">
                        {{Form::text('name','',['class'=>'form-control','placeholder'=>'NAMA PERMISSION'])}}
                    </div>
                </div> 
                <div class="form-group">
                    {{Form::label('aksi','AKSI',['class'=>'control-label col-md-2'])}}
                    <div class="col-md-10">
                        <div class="checkbox checkbox-switch">
                            {{ Form::checkbox('aksi[]', 'browse',true,['class'=>'switch']) }}    
                            BROWSE
                        </div>
                        <div class="checkbox checkbox-switch">
                            {{ Form::checkbox('aksi[]', 'show',true,['class'=>'switch']) }}    
                            SHOW
                        </div>
                        <div class="checkbox checkbox-switch">
                            {{ Form::checkbox('aksi[]', 'add',true,['class'=>'switch']) }}
                            ADD
                        </div>
                        <div class="checkbox checkbox-switch">
                            {{ Form::checkbox('aksi[]', 'edit',true,['class'=>'switch']) }}
                            EDIT
                        </div>
                        <div class="checkbox checkbox-switch">
                            {{ Form::checkbox('aksi[]', 'delete',true,['class'=>'switch']) }}
                            DELETE
                        </div>
                    </div>
                </div>     
                <div class="form-group">            
                    <div class="col-md-10 col-md-offset-2">                        
                        {{ Form::button('<b><i class="icon-floppy-disk "></i></b> SIMPAN', ['type' => 'submit', 'class' => 'btn btn-info btn-labeled btn-xs'] ) }}
                    </div>
                </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>   
@endsection
@section('page_asset_js')
<script src="{!!asset('themes/dore/assets/js/jquery-validation/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('themes/dore/assets/js/jquery-validation/additional-methods.min.js')!!}"></script>
<script src="{!!asset('themes/dore/assets/js/switch.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {
    $(".switch").bootstrapSwitch();
    $('#frmdata').validate({
        rules: {
            name : {
                required: true,
                minlength: 2
            }
        },
        messages : {
            name : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 2 karakter atau lebih."
            }
        }     
    });   
});
</script>
@endsection