@extends('layouts.dore.l_main')
@section('page_title')
    JENIS PELAKSANAAN
@endsection
@section('page_header')
<h1>
    <i class="simple-icon-bag"></i>
    JENIS PELAKSANAAN
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
            <a class="dropdown-item" href="{!!route('jenispelaksanaan.index')!!}" title="Tutup Halaman ini">
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
<li class="breadcrumb-item">DATA MASTER</li>
<li class="breadcrumb-item" aria-current="page">
    <a href="{!!route('jenispelaksanaan.index')!!}"> JENIS PELAKSANAAN</a>
</li>
<li class="breadcrumb-item active" aria-current="page">TAMBAH DATA</li>
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
            {!! Form::open(['action'=>'DMaster\JenisPelaksanaanController@store','method'=>'post','class'=>'form-horizontal tooltip-label-bottom','id'=>'frmdata','name'=>'frmdata','novalidate'=>true])!!}            
                <div class="form-group row has-float-label">
                    {{Form::label('NamaJenis','Nama Jenis:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('NamaJenis','',['class'=>'form-control','placeholder'=>'Nama Jenis'])}}
                    </div>
                </div>
                <div class="form-group row has-float-label">
                    {{Form::label('Descr','Keterangan:',['class'=>'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('Descr','',['class'=>'form-control','placeholder'=>'Keterangan','rows'=>3])}}
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
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {       
    $('#frmdata').validate({
        rules: {            
            NamaJenis : {
                required: true,
                minlength: 2
            },
        },
        messages : {            
            NamaJenis : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 2 karakter atau lebih."
            }
        }      
    });   
});
</script>
@endsection