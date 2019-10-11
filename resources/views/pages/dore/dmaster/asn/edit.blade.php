@extends('layouts.dore.l_main')
@section('page_title')
    ASN
@endsection
@section('page_header')
    <h1>
        <i class="simple-icon-bag"></i>
        ASN 
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
            <a class="dropdown-item" href="{!!route('asn.index')!!}" title="Tutup Halaman ini">
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
<li class="breadcrumb-item">RKA</li>
<li class="breadcrumb-item" aria-current="page">
    <a href="{!!route('asn.index')!!}"> KEGIATAN MURNI</a>
</li>
<li class="breadcrumb-item active" aria-current="page">TAMBAH DATA</li>
@endsection
@section('page_content')
<div class="content">
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="simple-icon-note"></i>
                UBAH DATA
            </h4>
            <div class="separator mb-5"></div>
            {!! Form::open(['action'=>['DMaster\ASNController@update',$data->ASNID],'method'=>'put','class'=>'form-horizontal tooltip-label-bottom','id'=>'frmdata','name'=>'frmdata','novalidate'=>true])!!}                                                              
                <div class="form-group row has-float-label">
                    {{Form::label('NIP_ASN','NIP ASN:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('NIP_ASN',$data['NIP_ASN'],['class'=>'form-control','placeholder'=>'NIP ASN'])}}
                    </div>
                </div>
                <div class="form-group row has-float-label">
                    {{Form::label('Nm_ASN','Nama ASN:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('Nm_ASN',$data['Nm_ASN'],['class'=>'form-control','placeholder'=>'Nama ASN'])}}
                    </div>
                </div>
                <div class="form-group row has-float-label">
                    {{Form::label('Descr','Keterangan:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('Descr',$data['Descr'],['class'=>'form-control','placeholder'=>'Keterangan','rows'=>3])}}
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
<script src="{!!asset('js/vendor/autoNumeric.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {   
    AutoNumeric.multiple(['#NIP_ASN'], {
                                            allowDecimalPadding: false,
                                            minimumValue:0,
                                            maximumValue:99999999999999999999, 
                                            numericPos:true,
                                            decimalPlaces : 0,
                                            digitGroupSeparator : '',
                                            showWarnings:false,
                                            unformatOnSubmit: true,
                                            modifyValueOnWheel:false
                                        });
    $('#frmdata').validate({
        rules: {
            NIP_ASN : {
                required: true,
                minlength: 2
            },
            Nm_ASN : {
                required: true,
                minlength: 2
            },
        },
        messages : {
            NIP_ASN : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 2 karakter atau lebih."
            },
            Nm_ASN : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 2 karakter atau lebih."
            }
        }      
    });   
});
</script>
@endsection