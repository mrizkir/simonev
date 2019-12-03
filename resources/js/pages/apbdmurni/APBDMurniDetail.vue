<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        APBD MURNI
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/apbdmurni">APBD MURNI</router-link></li>
                        <li class="breadcrumb-item active">DETAIL</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content" v-if="detailkegiatan.hasOwnProperty('RKAID')">
        <div class="container-fluid">
            <div class="row" v-if="api_message">
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        {{api_message}} 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> DETAIL KEGIATAN</h3>
                            <div class="card-tools">                                 
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create',null)" title="Tambah Kegiatan Baru">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('edit',jenis.detail)" title="Ubah Kegiatan">
                                    <i class="fas fa-edit"></i>
                                </button>                                
                                <button type="button" class="btn btn-tool text-danger" v-on:click.prevent="proc('destroy',jenis.detail)" title="Hapus Kegiatan">
                                    <i class="fas fa-trash-alt"></i>
                                </button>                                                 
                                <router-link to="/apbdmurni" class="btn btn-tool" title="Keluar">
                                    <i class="fas fa-times"></i>
                                </router-link>                                
                            </div>                            
                        </div>
                        <div class="card-body">
                            <div class="row">                                      
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>RKAID: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.RKAID}}</p>
                                        </div>                            
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>OPD / SKPD: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">[{{detailkegiatan.kode_organisasi}}] {{detailkegiatan.OrgNm}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>UNIT KERJA: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">[{{detailkegiatan.kode_suborganisasi}}] {{detailkegiatan.SOrgNm}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>URUSAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">[{{detailkegiatan.kode_urusan}}] {{detailkegiatan.Nm_Bidang}}</p>
                                        </div>                            
                                    </div>                             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>PROGRAM: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">[{{detailkegiatan.kode_program}}] {{detailkegiatan.PrgNm}}</p>
                                        </div>                            
                                    </div>       
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>KEGIATAN: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">
                                                [{{detailkegiatan.kode_kegiatan}}] {{detailkegiatan.KgtNm}} 
                                                <span class="badge badge-pill badge-primary mb-1">[{{detailkegiatan.sifat_kegiatan1}}]</span>
                                            </p>
                                        </div>                            
                                    </div>             
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>PAGU DANA: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.PaguDana1|formatUang}}</p>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>SUMBER DANA: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.Nm_SumberDana}}</p>
                                        </div>                            
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>CAPAIAN PROGRAM: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.tk_capaian1}} {{detailkegiatan.capaian_program1}}</p>
                                        </div>                            
                                    </div>                        
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>OUTPUT (KELUARAN): </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.tk_keluaran1}} {{detailkegiatan.keluaran1}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>OUTCOME (HASIL): </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.tk_hasil1}} {{detailkegiatan.hasil1}}</p>
                                        </div>                            
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>LOKASI: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.lokasi_kegiatan1}} {{detailkegiatan.hasil1}}</p>
                                        </div>                            
                                    </div>                                    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>TGL. BUAT: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.created_at|formatTanggal}}</p>
                                        </div>                            
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>TGL. UBAH: </strong></label>
                                        <div class="col-md-8">
                                            <p class="form-control-static">{{detailkegiatan.updated_at|formatTanggal}}</p>
                                        </div>                            
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> RINCIAN KEGIATAN</h3>
                            <div class="card-tools"> 
                                <router-link to="/apbdmurni/uraian/create" class="btn btn-tool" title="Tambah Rincian Kegiatan Baru">
                                    <i class="fas fa-plus"></i>
                                </router-link> 
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_rincian.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>                        
                                        <th scope="col">
                                            NAMA PAKET PEKERJAAN
                                        </th>
                                        <th class="text-right">                            
                                            HARGA SAT.
                                        </th>
                                        <th class="text-right">
                                            PAGU URAIAN
                                        </th>
                                        <th width="110" class="text-right">REALISASI</th>
                                        <th width="110" class="text-right">SISA</th>
                                        <th width="80">FISIK (%)</th>
                                        <th width="120">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_rincian.data" v-bind:key="item.RKARincID">
                                        <td>{{daftar_rincian.from+index}}</td>
                                        <td>{{item.nama_uraian}}</td>
                                        <td class="text-right">{{item.harga_satuan1|formatUang}}</td>    
                                        <td class="text-right">{{item.pagu_uraian1|formatUang}}</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body table-responsive" v-else>                            
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Info!</h5>
                                Belum ada data yang bisa ditampilkan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content" v-else>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <div class="alert alert-danger alert-dismissible">
                        <router-link to="/apbdmurni" class="close">
                            <i class="fas fa-times"></i>
                        </router-link>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        Mohon di pilih terlebih dahulu kegiatan !!!                         
                    </div>
                </div>
            </div>
        </div>
    </section>    
</div>
</template>
<script>
export default {
    created ()
    {
        var page = this.$store.getters.getPage('apbdmurni');
        this.detailkegiatan = page.detailkegiatan;                
    },
    data: function() 
	{
		return {
            pid:'default',
            api_message:'',

            detailkegiatan:'',
            daftar_rincian:{
                data:{}
            },
        }
    },
}
</script>