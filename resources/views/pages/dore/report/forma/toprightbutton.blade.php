<div class="text-zero top-right-button-container">    
    <div class="btn-group">
        <button type="button"
            class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single default"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="simple-icon-menu"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('rkakegiatanmurni.create1',['uuid'=>$rka->RKAID])}}" title="Tambah Uraian">
                <i class="simple-icon-plus"></i> TAMBAH URAIAN
            </a> 
            <a class="dropdown-item" href="{{route('rkakegiatanmurni.create3',['uuid'=>$rka->RKAID])}}" title="Tambah Realisasi">
                <i class="simple-icon-plus"></i> TAMBAH REALISASI
            </a> 
            <a class="dropdown-item" href="{!!route('rkakegiatanmurni.index')!!}" title="Tutup Halaman ini">
                <i class="simple-icon-close"></i> CLOSE
            </a>
        </div>
    </div>
</div>