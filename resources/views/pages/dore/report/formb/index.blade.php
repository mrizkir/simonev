@extends('layouts.dore.l_main')
@section('page_title')
    {{HelperKegiatan::getPageTitle()}}
@endsection
@section('page_header')
    <h1>
        <i class="iconsminds-file"></i>
        {{HelperKegiatan::getPageTitle()}} 
    </h1>    
@endsection
@section('page_header_display')
<div class="separator mb-5"></div>
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">LAPORAN</li>
<li class="breadcrumb-item active" aria-current="page">{{HelperKegiatan::getPageTitle()}}</li>
@endsection
@section('page_header_button')
@include('pages.dore.report.formb.toprightbutton')
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
                {!! Form::open(['action'=>'Report\FormAController@filter','method'=>'post','id'=>'frmfilter','name'=>'frmfilter'])!!}                                
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">OPD / SKPD :</label> 
                        <div class="col-md-10">
                            {{Form::select('OrgID', $daftar_opd,$filters['OrgID'],['class'=>'form-control select','id'=>'OrgID'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">BULAN REALISASI:</label> 
                        <div class="col-md-10">
                            {{Form::select('bulan', Helper::getBulanM(),$filters['bulan_realisasi'],['class'=>'form-control select'])}}
                        </div>
                    </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>    
    <div class="col-12" id="divdatatable">
        @include('pages.dore.report.formb.datatable')
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
});
</script>
@endsection