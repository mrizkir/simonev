@extends('layouts.dore.l_main')
@section('page_title')
    ASN OPD
@endsection
@section('page_header')
<h1>
    <i class="iconsminds-user"></i>
    ASN OPD
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
            <a class="dropdown-item" href="{{route('asnopd.create')}}" title="Tambah ASN OPD">
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
<li class="breadcrumb-item">PEGAWAI</li>
<li class="breadcrumb-item active" aria-current="page">ASN OPD</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/select2.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/select2-bootstrap.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('js/vendor/sweetalert2/sweetalert2.min.css')!!}" />
@endsection
@section('page_content')
<div class="row">
    <div class="col-12 mb-3" id="divfilter">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">
                    <i class="iconsminds-filter-2"></i>
                    FILTER
                </h4>
                {!! Form::open(['action'=>'RKA\RKAKegiatanMurniController@filter','method'=>'post','id'=>'frmfilter','name'=>'frmfilter'])!!}                                
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">OPD / SKPD :</label> 
                        <div class="col-md-10">
                            {{Form::select('OrgID', $daftar_opd,$filters['OrgID'],['class'=>'form-control select','id'=>'OrgID'])}}
                        </div>
                    </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
    <div class="col-12" id="divdatatable">
        @include('pages.dore.dmaster.asnopd.datatable')
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/select2.full.js')!!}"></script>
<script src="{!!asset('js/vendor/sweetalert2/sweetalert2.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {  
    $("#OrgID.select").select2({
        theme: "bootstrap",
        placeholder: "PILIH OPD / SKPD",
        allowClear:true        
    });
    $(document).on('change','#OrgID',function(ev) {
        ev.preventDefault();   
        $.ajax({
            type:'post',
            url: url_current_page +'/filter',
            dataType: 'json',
            data: {                
                "_token": token,
                "OrgID": $('#OrgID').val(),
            },
            success:function(result)
            { 
                $('#divdatatable').html(result.datatable);
            },
            error:function(xhr, status, error){
                console.log('ERROR');
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });     
    });      
    $("#divdatatable").on("click",".btnDelete", function(){
        swal.fire ({
            title:'Hapus Data',
            text:'Apakah ingin menghapus data ASN OPD ini ?',
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
                            console.log("Gagal menghapus data ASN OPD dengan id "+id);
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