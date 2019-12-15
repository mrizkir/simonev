<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        APBD MURNI | URAIAN
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/apbdmurni">APBD MURNI</router-link></li>
                        <li class="breadcrumb-item active">URAIAN</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content" v-if="RKAIDIsExist">
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
                            <h3 class="card-title"><i class="fas fa-eye"></i> DATA KEGIATAN</h3>
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
                            <h3 class="card-title"><i class="fas fa-list-ol"></i> RINCIAN KEGIATAN</h3>
                            <div class="card-tools"> 
                                <router-link to="/apbdmurni/uraian/pilihrekening" class="btn btn-tool" title="Tambah Rincian Kegiatan Baru">
                                    <i class="fas fa-plus"></i>
                                </router-link> 
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_uraian.length > 0">
                            <table class="table table-striped table-hover mb-2 table-condensed">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>                        
                                        <th scope="col">
                                            NAMA PAKET PEKERJAAN
                                        </th>
                                        <th width="100" class="text-center">VOL.</th>
                                        <th class="text-right" width="100">                            
                                            HARGA SAT.
                                        </th>
                                        <th class="text-right">
                                            PAGU URAIAN
                                        </th>                                        
                                        <th width="100" class="text-right">REALISASI</th>
                                        <th width="100" class="text-right">SISA</th>
                                        <th width="100" class="text-center">FISIK (%)</th>
                                        <th width="100">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>                                      
                                    <tr v-for="(item,index) in daftar_uraian" v-bind:key="item.RKARincID">
                                        <td>{{index+1}}</td>
                                        <td>{{item.nama_uraian}}</td>
                                        <td class="text-center">{{item.volume1}} {{item.satuan1}}</td>
                                        <td class="text-right">{{item.harga_satuan1|formatUang}}</td>    
                                        <td class="text-right">{{item.pagu_uraian1|formatUang}}</td>
                                        <td class="text-right">{{item.realisasi1|formatUang}}</td>
                                        <td class="text-right">{{item.pagu_uraian1-item.realisasi1|formatUang}}</td>
                                        <td class="text-center">{{item.fisik1}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('realisasi',item)">
                                                        <i class="fas fa-directions"></i> REALISASI
                                                    </a>
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('edit',item)">
                                                        <i class="fas fa-edit"></i> UBAH
                                                    </a>
                                                    <a class="dropdown-item" v-on:click.prevent="proc('destroy',item)" href="#">
                                                        <i class="fas fa-trash-alt"></i> HAPUS
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="table-info font-weight-bold">
                                        <td colspan="4" class="text-right">TOTAL</td>
                                        <td class="text-right">
                                            {{totalpaguuraian|formatUang}}
                                        </td>
                                        <td class="text-right">
                                            {{totalrealisasi|formatUang}}
                                        </td>
                                        <td class="text-right">
                                            {{totalpaguuraian-totalrealisasi|formatUang}}
                                        </td>
                                        <td class="text-center">
                                            {{totalfisik}}
                                        </td>
                                        <td class="center">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </tfoot>
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
    mounted()
    {
        this.proc ('default');          
    },
    data: function() 
	{
		return {
            pid:'default',
            api_message:'',

            RKAIDIsExist:false,
            detailkegiatan:{},
            daftar_uraian:{
                data:{}
            },
            totalpaguuraian:0,
            totalrealisasi:0,
            totalfisik:0,
        }
    },
    methods: 
    {
        fetchUraianKegiatan()
        {           
            var page = this.$store.getters.getPage('apbdmurni');            
            this.$swal({
                title: '<i class="fas fa-spin fa-spinner"></i>',
                text: "Mendapatkan informasi Uraian Data Kegiatan dengan ID "+page.RKAID,
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });              
            setTimeout(() => {
                axios.get('/api/v1/apbdmurni/'+page.RKAID,{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    }
                })
                .then(response => {   
                    this.RKAIDIsExist = true;
                    this.detailkegiatan = response.data.rka;
                    page.detailkegiatan = this.detailkegiatan;                        
                    this.$store.commit('replacePage',page);                    
                    this.daftar_uraian = response.data.daftar_uraian;
                    this.totalpaguuraian = response.data.totalpaguuraian;
                    this.totalrealisasi = response.data.totalrealisasi;
                    this.totalfisik = response.data.totalfisik;
                })
                .catch(response => {
                    this.api_message = response;
                });       
                this.$swal.close();  
            }, 1500);               
        },
        proc (pid,item=null) 
        {           
            switch (pid)
            {
                case 'realisasi':
                    
                    axios.get('/api/v1/apbdmurni/uraian/info/'+item.RKARincID,{
                        headers:{
                            'Authorization': window.laravel.api_token,
                        }
                    })
                    .then(response => {                                     
                        var page = this.$store.getters.getPage('apbdmurni');
                        page.datauraian=response.data;                                  
                        this.$store.commit('replacePage',page);                                            
                        this.$router.push('/apbdmurni/uraian/realisasi'); 
                    })
                    .catch(response => {
                        this.api_message = response;
                    });       
                break;
                case 'edit':

                break;
                case 'destroy':
                    var self = this;
                    this.$swal({
                        title: 'Yakin mau menghapus rincian kegiatan?',
                        text: "Anda tidak bisa mengembalikan data ini",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus ini!',
                        cancelButtonText: 'Tidak, Batalkan!',
                        buttonsStyling: true
                    }).then(function (isConfirm){
                        if(isConfirm.value === true) 
                        {
                            axios.post('/api/v1/apbdmurni/'+item.RKARincID,{
                                '_method':'DELETE',
                                'pid':'datauraian'
                            },{
                                headers:{
                                    'Authorization': window.laravel.api_token,
                                },
                            })
                            .then(response => {                                                          
                                self.fetchUraianKegiatan();                                                           
                            })
                            .catch(response => {
                                self.api_message = response;                               
                            });                                  
                        }
                    });                          
                break;
                case 'default' :
                    this.pid = pid;
                    this.fetchUraianKegiatan();
            }
        },
    }
}
</script>