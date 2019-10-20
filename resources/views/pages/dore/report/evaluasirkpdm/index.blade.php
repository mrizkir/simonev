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
<li class="breadcrumb-item">LAPORAN</li>
<li class="breadcrumb-item active" aria-current="page">{{HelperKegiatan::getPageTitle()}}</li>
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
                {!! Form::open(['action'=>'Report\EvaluasiRKPDMurniController@filter','method'=>'post','id'=>'frmfilter','name'=>'frmfilter'])!!}                                
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">OPD / SKPD :</label> 
                        <div class="col-md-10">
                            {{Form::select('OrgIDRPJMD', $daftar_opd,$filters['OrgIDRPJMD'],['class'=>'form-control select','id'=>'OrgIDRPJMD'])}}
                        </div>
                    </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">
                    <i class="simple-icon-magnifier"></i>
                    PENCARIAN
                </h4>
                {!! Form::open(['action'=>'Report\EvaluasiRKPDMurniController@search','method'=>'post','id'=>'frmsearch','name'=>'frmsearch'])!!}                                
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kriteria :</label> 
                        <div class="col-md-10">
                            {{Form::select('cmbKriteria', ['Nm_Sasaran'=>'NAMA SASARAN'], isset($search['kriteria'])?$search['kriteria']:'Nm_Sasaran',['class'=>'form-control'])}}
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
        @include('pages.dore.report.evaluasirkpdm.datatable')
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
    $("#OrgIDRPJMD.select").select2({
        theme: "bootstrap",
        placeholder: "PILIH OPD / SKPD",
        allowClear:true        
    });   
    $(document).on('change','#OrgIDRPJMD',function(ev) {
        ev.preventDefault();   
        $.ajax({
            type:'post',
            url: url_current_page +'/filter',
            dataType: 'json',
            data: {                
                "_token": token,
                "OrgIDRPJMD": $('#OrgIDRPJMD').val(),
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