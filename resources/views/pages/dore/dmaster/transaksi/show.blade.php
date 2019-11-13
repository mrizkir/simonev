@extends('layouts.dore.l_main')
@section('page_title')
    TRANSAKSI
@endsection
@section('page_header')
<h1>
    <i class="simple-icon-people"></i>
    TRANSAKSI
</h1>
@endsection
@section('page_info')
@include('pages.dore.dmaster.transaksi.info')
@endsection
@section('page_header_button')
<div class="text-zero top-right-button-container">
    <button type="button"
        class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single default"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="simple-icon-menu"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{!!route('transaksi.index')!!}">
            <i class="simple-icon-close"></i> CLOSE
        </a>
    </div>
</div>
@endsection
@section('page_header_display')
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first"
            aria-selected="true">DETAILS
        </a>
    </li>
</ul>
@endsection
@section('page_breadcrumb')
<li class="breadcrumb-item">DATA MASTER</li>
<li class="breadcrumb-item">REKENING</li>
<li class="breadcrumb-item">
    <a href="{!!route('transaksi.index')!!}">TRANSAKSI</a>
</li>
<li class="breadcrumb-item active" aria-current="page">DETAIL</li>
@endsection
@section('page_content')
<div class="tab-content">
    <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-2">
                            <i class="simple-icon-screen-tablet"></i>
                            DATA TRANSAKSI
                        </h2>
                        <div class="separator mb-3"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>KODE TRANSAKSI: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->Kd_Rek_1}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>NAMA TRANSAKSI: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->StrNm}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>TGL. BUAT: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">
                                                {{Helper::tanggal('d/m/Y H:m',$data->created_at)}}</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>KETERANGAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->Descr}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 control-label"><strong>TAHUN PERENCANAAN: </strong></label>
                                        <div class="col-8">
                                            <p class="form-control-static">{{$data->TA}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 control-label"><strong>TGL. UBAH: </strong></label>
                                        <div class="col-8">
                                            <p class="form-control-static">
                                                {{Helper::tanggal('d/m/Y H:m',$data->updated_at)}}</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection