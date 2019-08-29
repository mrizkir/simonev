@extends('layouts.limitless.l_main')
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('themes/limitless/assets/js/sweetalert2/sweetalert2.min.css')!!}">
@endsection
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
    <li><a href="#">SETTING</a></li>
    <li class="active">USERS OPD</li>
@endsection
@section('page_breadcrumbelement')
<ul class="breadcrumb-elements">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-cog5 position-left"></i>
            AKSI
            <span class="caret"></span>
        </a>        
        <ul class="dropdown-menu dropdown-menu-right" id="breadcrumb-action">
            <li>
                <a href="#" id="lockall">
                    <i class="icon-lock2 pull-right"></i> LOCK ALL
                </a>
            </li>
            <li>
                <a href="#" id="unlockall">
                    <i class="icon-unlocked2 pull-right"></i> UNLOCK ALL
                </a>
            </li>
        </ul>
    </li>
</ul>
@endsection
@section('page_content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat border-top-lg border-top-info border-bottom-info">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <i class="icon-search4 position-left"></i>
                    Pencarian Data
                </h5>
            </div>
            <div class="panel-body">
                {!! Form::open(['action'=>'Setting\UsersOPDController@search','method'=>'post','class'=>'form-horizontal','id'=>'frmsearch','name'=>'frmsearch'])!!}                                
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kriteria :</label> 
                        <div class="col-md-10">
                            {{Form::select('cmbKriteria', ['id'=>'USERID','username'=>'USERNAME','nama'=>'NAMA','email'=>'EMAIL'], isset($search['kriteria'])?$search['kriteria']:'username',['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group" id="divKriteria">
                        <label class="col-md-2 control-label">Isi Kriteria :</label>                                                    
                        <div class="col-md-10">                            
                            {{Form::text('txtKriteria',isset($search['isikriteria'])?$search['isikriteria']:'',['class'=>'form-control','placeholder'=>'Isi Kriteria Pencarian','id'=>'txtKriteria'])}}                                                                  
                        </div>
                    </div>                                                     
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            {{ Form::button('<b><i class="icon-search4"></i></b> Cari', ['type' => 'submit', 'class' => 'btn btn-info btn-labeled btn-xs', 'id'=>'btnSearch'] )  }}                            
                            <a id="btnReset" href="javascript:;" title="Reset Pencarian" class="btn btn-default btn-labeled btn-xs">
                                <b><i class="icon-reset"></i></b> Reset
                            </a>                           
                        </div>
                    </div>  
                {!! Form::close()!!}
            </div>
        </div>
    </div>       
    <div class="col-md-12" id="divdatatable">
        @include('pages.limitless.setting.usersopd.datatable')
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('themes/limitless/assets/js/sweetalert2/sweetalert2.all.min.js')!!}"></script>
<script src="{!!asset('themes/limitless/assets/js/promise-polyfill.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {
    $('#breadcrumb-action').on('click','#lockall',function(ev)
    {
        ev.preventDefault();
        $.ajax({
            type:'post',
            url: url_current_page +'/changelocked/0',
            dataType: 'json',
            data: {                
                "_token": token,
                "_method": 'PUT',
                "lockall":true
            },
            success:function(result)
            { 
                Swal.fire({
                    title: 'Seluruh user berhasil dikunci semuanya',
                    type: 'success',                    
                });
            },
            error:function(xhr, status, error){
                console.log('ERROR');
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });
    });
    $('#breadcrumb-action').on('click','#unlockall',function(ev)
    {
        ev.preventDefault();
        $.ajax({
            type:'post',
            url: url_current_page +'/changelocked/0',
            dataType: 'json',
            data: {                
                "_token": token,
                "_method": 'PUT',
                "unlockall":true
            },
            success:function(result)
            { 
                Swal.fire({
                    title: 'Seluruh user berhasil dilepas kuncinya',
                    type: 'success',                    
                });
            },
            error:function(xhr, status, error){
                console.log('ERROR');
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });
    });
    $("#divdatatable").on("click",".btnDelete", function(){
        if (confirm('Apakah Anda ingin menghapus Data User OPD ini ?')) {
            let url_ = $(this).attr("data-url");
            let id = $(this).attr("data-id");
            $.ajax({            
                type:'post',
                url:url_+'/'+id,
                dataType: 'json',
                data: {
                    "_method": 'DELETE',
                    "_token": token,
                    "id": id,
                },
                success:function(result){ 
                    if (result.success==1){
                        $('#divdatatable').html(result.datatable);                        
                    }else{
                        console.log("Gagal menghapus data User OPD dengan id "+id);
                    }                    
                },
                error:function(xhr, status, error){
                    console.log('ERROR');
                    console.log(parseMessageAjaxEror(xhr, status, error));                           
                },
            });
        }        
    });
});
</script>
@endsection