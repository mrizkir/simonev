<div class="text-zero top-right-button-container">    
    <div class="btn-group">
        <button type="button"
            class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single default"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="simple-icon-menu"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route(Helper::getNameOfPage('printtoexcel'))}}" title="Tambah Kegiatan">
                <i class="simple-icon-printer"></i> CETAK KE EXCEL
            </a>            
            <a class="dropdown-item" href="{!!route(Helper::getNameOfPage('index'))!!}" title="Tutup Halaman ini">
                <i class="simple-icon-close"></i> CLOSE
            </a>
        </div>
    </div>
</div>