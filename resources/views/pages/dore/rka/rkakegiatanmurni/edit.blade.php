@extends('layouts.dore.l_main')
@section('page_title')
    RKA KEGIATAN MURNI
@endsection
@section('page_header')
    <i class="icon-database-refresh position-left"></i>
    <span class="text-semibold"> 
        RKA KEGIATAN MURNI TAHUN PENYERAPAN {{config('simonev.tahun_penyerapan')}}
    </span>     
@endsection
@section('page_info')
    @include('pages.dore.rka.rkakegiatanmurni.info')
@endsection
@section('page_breadcrumb')
    <li><a href="{!!route('rkakegiatanmurni.index')!!}">RKA KEGIATAN MURNI</a></li>
    <li class="active">UBAH DATA</li>
@endsection
@section('page_content')
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="icon-pencil7 position-left"></i> 
                UBAH DATA
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">                    
                    <li>
                        <a href="{!!route('rkakegiatanmurni.index')!!}" data-action="closeredirect" title="keluar"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            {!! Form::open(['action'=>['RKA\RKAKegiatanMurniController@update',$data->rkakegiatanmurni_id],'method'=>'put','class'=>'form-horizontal','id'=>'frmdata','name'=>'frmdata'])!!}                        
                <div class="form-group">
                    {{Form::label('replaceit','replaceit',['class'=>'control-label col-md-2'])}}
                    <div class="col-md-10">
                        {{Form::text('replaceit',$data[''],['class'=>'form-control','placeholder'=>'replaceit'])}}
                    </div>                
                </div>
                <div class="form-group">            
                    <div class="col-md-10 col-md-offset-2">                        
                        {{ Form::button('<b><i class="icon-floppy-disk "></i></b> SIMPAN', ['type' => 'submit', 'class' => 'btn btn-info btn-labeled btn-xs'] )  }}                        
                    </div>
                </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>  
@endsection
@section('page_asset_js')
<script src="{!!asset('themes/limitless/assets/js/jquery-validation/jquery.validate.min.js')!!}"></script>
<script src="{!!asset('themes/limitless/assets/js/jquery-validation/additional-methods.min.js')!!}"></script>
@endsection
@section('page_custom_js')
<script type="text/javascript">
$(document).ready(function () {
    $('#frmdata').validate({
        rules: {
            replaceit : {
                required: true,
                minlength: 2
            }
        },
        messages : {
            replaceit : {
                required: "Mohon untuk di isi karena ini diperlukan.",
                minlength: "Mohon di isi minimal 2 karakter atau lebih."
            }
        }     
    });   
});
</script>
@endsection