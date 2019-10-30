@extends('layouts.dore.l_main')
@section('page_title')
    ASN OPD / SKPD
@endsection
@section('page_header')
<h1>
    <i class="iconsminds-user"></i>
    ASN OPD / SKPD
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
            <a class="dropdown-item" href="{!!route('asnopd.index')!!}" title="Tutup Halaman ini">
                <i class="simple-icon-close"></i> CLOSE
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
            &nbsp;
        </div>
        <div class="float-md-right">

        </div>
    </div>
</div>
<div class="separator mb-5"></div>
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">MASTER</li>
<li class="breadcrumb-item">PEGAWAI</li>
<li class="breadcrumb-item" aria-current="page">
    <a href="{!!route('asnopd.index')!!}"> ASN OPD / SKPD</a>
</li>
<li class="breadcrumb-item active" aria-current="page">TAMBAH DATA</li>
@endsection
@section('page_asset_css')
<link rel="stylesheet" href="{!!asset('css/vendor/select2.min.css')!!}" />
<link rel="stylesheet" href="{!!asset('css/vendor/select2-bootstrap.min.css')!!}" />
@endsection
@section('page_content')
<div class="content">
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="simple-icon-plus"></i>
                TAMBAH DATA
            </h4>
            <div class="separator mb-5"></div>
            {!! Form::open(['action'=>'DMaster\ASNOPDController@store','method'=>'post','class'=>'form-horizontal tooltip-label-bottom','id'=>'frmdata','name'=>'frmdata','novalidate'=>true])!!}
                <div class="form-group row">
                    <label class="col-md-2 col-form-label"><strong>OPD / SKPD: </strong></label>
                    <div class="col-md-10">
                        {{Form::hidden('OrgID',$organisasi->OrgID)}}
                        <p class="form-control-static">
                            <strong>{{$organisasi->OrgNm}}</strong>
                        </p>
                    </div>                            
                </div> 
                <div class="form-group row has-float-label">
                    {{Form::label('ASNID','Nama ASN:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('ASNID', $daftar_asn,'',['class'=>'form-control select','id'=>'ASNID'])}}
                    </div>
                </div>
                <div class="form-group row has-float-label">
                    {{Form::label('Jenis_Jabatan','Jenis Jabatan:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('Jenis_Jabatan', [''=>'DAFTAR JENIS JABATAN','pa'=>'PENGGUNA ANGGARAN','kpa'=>'KUASA PENGGUNA ANGGARAN','ppk'=>'PEJABAT PEMBUAT KOMITMEN','pptk'=>'PPTK'],'',['class'=>'form-control select','id'=>'Jenis_Jabatan'])}}
                    </div>
                </div>   
                <div class="form-group row has-float-label">
                    {{Form::label('','',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{ Form::button('SIMPAN', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm default'] ) }}
                    </div>
                </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>
@endsection
@section('page_asset_js')
<script src="{!!asset('js/vendor/jquery.validate/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('js/vendor/jquery.validate/additional-methods.min.js')!!}"></script>
<script src="{!!asset('js/vendor/select2.full.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {      
    $("#ASNID.select").select2({
        theme: "bootstrap",
        placeholder: "PILIH ASN",
        allowClear:true        
    }); 
    $('#frmdata').validate({
        rules: {
            ASNID : {
                required: true,
            },
            Jenis_Jabatan : {
                required: true,
            },
        },
        messages : {
            ASNID : {
                required: "Mohon untuk di pilih karena ini diperlukan.",
            },
            Jenis_Jabatan : {
                required: "Mohon untuk di pilih karena ini diperlukan.",
            }
        }      
    });   
});
</script>
@endsection