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
@section('page_breadcrumb')
<li class="breadcrumb-item">LAPORAN</li>
<li class="breadcrumb-item">{{HelperKegiatan::getPageTitle()}} </li>
<li class="breadcrumb-item active" aria-current="page">DETAIL</li>
@endsection
@section('page_header_display')   
<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
            aria-controls="first" aria-selected="true">DETAILS
        </a>
    </li>
</ul>
@endsection
@section('page_header_button')
@include('pages.dore.report.evaluasirkpdm.toprightbutton')
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
                            DATA SASARAN RPJMD {{HelperKegiatan::getRPJMDTahunMulai()}}-{{HelperKegiatan::getRPJMDTahunAkhir()+1}}
                        </h2>
                        <div class="separator mb-3"></div>
                        <div class="row">                                      
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>PrioritasSasaranKabID: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->PrioritasSasaranKabID}}</p>
                                        </div>                            
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>KODE SASARAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->Kd_Sasaran}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>NAMA SASARAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->Nm_Sasaran}}</p>
                                        </div>                            
                                    </div>                       
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>KODE TUJUAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{$data->Kd_Tujuan}}</p>
                                        </div>                            
                                    </div>        
                                    <div class="form-group row">
                                        <label class="col-4 control-label"><strong>NAMA TUJUAN: </strong></label>
                                        <div class="col-8">
                                            <p class="form-control-static">{{$data->Nm_Tujuan}}</p>
                                        </div>                            
                                    </div>         
                                    <div class="form-group row">
                                        <label class="col-4 control-label"><strong>TGL. BUAT / TGL. UBAH: </strong></label>
                                        <div class="col-8">
                                            <p class="form-control-static">{{Helper::tanggal('d/m/Y H:m',$data->created_at)}} / {{Helper::tanggal('d/m/Y H:m',$data->updated_at)}}</p>
                                        </div>                            
                                    </div>            
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table border="1" width="100%" style="font-size:10px">
                
            </table>
        </div>
    </div>
</div>
@endsection
@section('page_asset_js')

@endsection
@section('page_custom_js')
<script src="{!!asset('rkakegiatan.js')!!}"></script>
@endsection