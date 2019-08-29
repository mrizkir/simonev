@extends('layouts.dore.l_main')
@section('page_title')
    USERS SUPER ADMIN
@endsection
@section('page_header')
    <h1>
        <i class="simple-icon-people"></i>
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
            <a class="dropdown-item" href="{{route('users.create')}}" title="Tambah Users">
                <i class="simple-icon-plus"></i> TAMBAH
            </a>            
        </div>
    </div>
</div>
@endsection
@section('page_header_display')
<div class="mb-2">
    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button"
        aria-expanded="true" aria-controls="displayOptions">
        Display Options
        <i class="simple-icon-arrow-down align-middle"></i>
    </a>
    <div class="collapse dont-collapse-sm" id="displayOptions">
        <div class="d-block d-md-inline-block">
            {!!Form::open(['url'=>'#','method'=>'post','class'=>'form-inline','id'=>'frmheading','name'=>'frmheading'])!!}
            <div class="form-group">
                {!!Form::select('numberRecordPerPage',['1'=>1,'5'=>5,'10'=>10,'15'=>15,'30'=>30,'50'=>50],$numberRecordPerPage,['id'=>'numberRecordPerPage','class'=>'form-control','style'=>'width:70px'])!!}
            </div>
            {!! Form::close()!!}
        </div>
        <div class="float-md-right">            
        </div>
    </div>
</div>
<div class="separator mb-5"></div>
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">SETTING</li>
<li class="breadcrumb-item">USERS</li>
<li class="breadcrumb-item active" aria-current="page">USERS SUPER ADMIN</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/jquery.contextMenu.min.css')!!}" />
@endsection
@section('page_content')
<div class="row">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">
                    <i class="simple-icon-magnifier"></i>
                    PENCARIAN
                </h4>
                {!! Form::open(['action'=>'Setting\UsersController@search','method'=>'post','id'=>'frmsearch','name'=>'frmsearch'])!!}                                
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kriteria :</label> 
                        <div class="col-md-10">
                            {{Form::select('cmbKriteria', ['id'=>'USERID','username'=>'USERNAME','nama'=>'NAMA','email'=>'EMAIL'], isset($search['kriteria'])?$search['kriteria']:'Kode_Bidang',['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row" id="divKriteria">
                        <label class="col-md-2 col-form-label">Isi Kriteria :</label>                                                    
                        <div class="col-md-10">                            
                            {{Form::text('txtKriteria',isset($search['isikriteria'])?$search['isikriteria']:'',['class'=>'form-control','placeholder'=>'Isi Kriteria Pencarian','id'=>'txtKriteria'])}}                                                                  
                        </div>
                    </div>                                                     
                    <div class="form-group row">
                        <div class="offset-md-2 col-md-10">
                            {{ Form::button('<b><i class="icon-search4"></i></b> Cari', ['type' => 'submit', 'class' => 'btn btn-primary default', 'id'=>'btnSearch'] )  }}                            
                            <a id="btnReset" href="javascript:;" title="Reset Pencarian" class="btn btn-dark default">
                                <b><i class="icon-reset"></i></b> Reset
                            </a>                           
                        </div>
                    </div>  
                {!! Form::close()!!}
            </div>
        </div>
    </div>  
    <div class="col-12" id="divdatatable">
        @include('pages.dore.setting.users.datatable')
    </div>
</div>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {  
    $("#divdatatable").on("click",".btnDelete", function(){
        if (confirm('Apakah Anda ingin menghapus Data User ini ?')) {
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
                        console.log("Gagal menghapus data Users dengan id "+id);
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