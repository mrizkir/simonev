@extends('layouts.dore.l_main')
@section('page_title')
OBJEK
@endsection
@section('page_header')
<h1>
    <i class="simple-icon-people"></i>
    OBJEK
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
            <a class="dropdown-item" href="{{route('objek.create')}}" title="Tambah Jenis">
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
            {!!
            Form::open(['url'=>'#','method'=>'post','class'=>'form-inline','id'=>'frmheading','name'=>'frmheading'])!!}
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
<li class="breadcrumb-item">DATA MASTER</li>
<li class="breadcrumb-item">REKENING</li>
<li class="breadcrumb-item active" aria-current="page">OBJEK</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('js/vendor/sweetalert2/sweetalert2.min.css')!!}" />
@endsection
@section('page_content')
<div class="row">
    <div class="col-12" id="divdatatable">
        @include('pages.dore.dmaster.objek.datatable')
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/sweetalert2/sweetalert2.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
    $(document).ready(function () {  
    $("#divdatatable").on("click",".btnDelete", function(){
        swal.fire ({
            title:'Hapus Data',
            text:'Apakah ingin menghapus data Objek ini ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'YA, Hapus!',
            cancelButtonText: 'TIDAK!',
        }).then((result)=>{
            if (result.value)
            {
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
                            console.log("Gagal menghapus data objek dengan id "+id);
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
});
</script>
@endsection