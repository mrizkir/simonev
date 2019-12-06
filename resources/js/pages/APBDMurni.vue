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
                        <li class="breadcrumb-item active">APBD MURNI</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content">
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
            <div class="row" v-if="pid=='default'">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-bookmark"></i> FILTER</h3>                            
                        </div>
                        <form class="form-horizontal" @submit.prevent="filter">
                            <div class="card-body">
                                <div class="form-group row" id="divOrgID">
                                    <label class="col-sm-2 col-form-label">OPD / SKPD</label>
                                    <div class="col-sm-10">                                        
                                        <select2 
                                            id="OrgID" 
                                            name="OrgID" 
                                            v-model="OrgID" 
                                            :options="daftar_opd" 
                                            :settings="{
                                                theme:'bootstrap',
                                                placeholder:'PILIH OPD / SKPD'
                                            }" 
                                            v-on:select="fetchUnitKerja($event)">
                                        </select2>
                                    </div>
                                </div>                               
                                <div class="form-group row" id="divSOrgID">
                                    <label class="col-sm-2 col-form-label">UNIT KERJA</label>
                                    <div class="col-sm-10">                                        
                                        <select2 
                                            id="SOrgID" 
                                            name="SOrgID" 
                                            v-model="SOrgID" 
                                            :options="daftar_unitkerja" 
                                            :settings="{
                                                theme:'bootstrap',
                                                placeholder:'PILIH UNIT KERJA'
                                            }" 
                                            v-on:select="filter($event)">
                                        </select2>
                                    </div>
                                </div>                               
                            </div>
                        </form>
                    </div>
                </div> 
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')" title="Tambaha Kegiatan Baru">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_apbdmurni.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>                                      
                                        <th width="120">
                                            KODE KEGIATAN
                                        </th> 
                                        <th width="100">
                                            NAMA KEGIATAN  
                                        </th>                                       
                                        <th width="100">
                                            PAGU KEGIATAN  
                                        </th>                                       
                                        <th width="100">
                                            PAGU URAIAN  
                                        </th>                                       
                                        <th width="70">
                                            REALISASI  
                                        </th>                                       
                                        <th width="70">
                                            FISIK(%)  
                                        </th>                                       
                                        <th width="70">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_apbdmurni.data" v-bind:key="item.RKAID">
                                        <td>{{daftar_apbdmurni.from+index}}</td>
                                        <td>{{item.kode_kegiatan}}</td>    
                                        <td>{{item.KgtNm}}</td>
                                        <td>{{item.PaguDana1|formatUang}}</td>
                                        <td>{{item.TotalPaguUraian1|formatUang}}</td>
                                        <td>{{item.TotalRealisasi1|formatUang}}</td>
                                        <td>{{item.TotalFisik1}}</td>                                            
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('show',item)">
                                                        <i class="fas fa-eye"></i> DETAIL
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
                            </table>                            
                        </div>
                        <div class="card-body table-responsive" v-else>                            
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Info!</h5>
                                Belum ada data yang bisa ditampilkan.
                            </div>
                        </div>
                        <div class="card-footer" v-if="daftar_apbdmurni.data.length">                            
                            <pagination :data="daftar_apbdmurni" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
                                <span slot="prev-nav">&lt; Prev</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>
<script>
import Pagination from 'laravel-vue-pagination';
import Select2 from 'v-select2-component';

export default {
    mounted()
	{       
        //inisialisasi data halaman
        this.$store.commit('addToPages',{
                name:'apbdmurni',
                OrgID:'',
                OrgNm:'',
                SOrgID:'',
                SOrgNm:'',
                datarekening:{},
                detailkegiatan:{}
        });
		this.proc ('default');   
	},
	data: function() 
	{
		return {
            pid:'default',
            api_message:'',

            apbdmurni:{
                kriteria:'',
                isikriteria:'',
            },
            daftar_apbdmurni:{
                data:{}
            },

            //field form search & filter
            OrgID:'',
            OrgNm:'',
            SOrgID:'',
            SOrgNm:'',
            daftar_opd: [{}],
            daftar_unitkerja: [{}],
        }
    },
    methods: 
    {
        fetchOPD ()
        {            
            axios.get('/api/v1/master/organisasi/daftaropd',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                var daftar_opd = [];
                $.each(response.data,function(key,value){
                    daftar_opd.push({
                        id:key,
                        text:value
                    });
                });                
                this.daftar_opd=daftar_opd;   
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        fetchUnitKerja({id, text})
        {
            this.OrgID = id;
            this.OrgNm = text;

            var page = this.$store.getters.getPage('apbdmurni');
            page.OrgID=id;
            page.OrgNm=text;
            page.SOrgID='';
            page.SOrgNm='';
            this.$store.commit('replacePage',page);

            axios.get('/api/v1/master/suborganisasi/daftarunitkerja/'+id,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                var daftar_unitkerja = [];
                $.each(response.data,function(key,value){
                    daftar_unitkerja.push({
                        id:key,
                        text:value
                    });
                });                
                this.daftar_unitkerja=daftar_unitkerja;                            
            })
            .catch(response => {
                this.api_message = response;
            });
            this.populateData();
        },
        filter ({id, text})
        {
            this.SOrgID = id;
            this.SOrgNm = text;            
            var page = this.$store.getters.getPage('apbdmurni');
            page.SOrgID=id;
            page.SOrgNm=text;
            this.$store.commit('replacePage',page);

            this.populateData();
        },
        populateData(page=1)
        {           
            axios.get('/api/v1/apbdmurni?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                    'OrgID':this.OrgID,
                    'SOrgID':this.SOrgID,
                }
            })
            .then(response => {        
                this.apbdmurni=response.data; 
                this.daftar_apbdmurni = this.apbdmurni.daftar_apbdmurni;                                      
            })
            .catch(response => {
                this.api_message = response;
            });             
        },
        proc (pid,item=null) 
        {           
            switch (pid)
            {
                case 'show':                                        
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Mendapatkan informasi Detail Data Kegiatan dengan ID "+item.RKAID,
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        axios.get('/api/v1/apbdmurni/'+item.RKAID,{
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        })
                        .then(response => {                                                                
                            var page = this.$store.getters.getPage('apbdmurni');
                            page.detailkegiatan = response.data;                        
                            this.$store.commit('replacePage',page);
                        })
                        .catch(response => {
                            this.api_message = response;
                        });       
                        this.$swal.close();          
                        this.$router.push('apbdmurni/detail');
                    }, 1500);               
                break;
                case 'create':
                    if (this.SOrgID == '')
                    {
                        this.pid = 'default'; 
                        this.$swal({
                            title: 'Pilih Unit Kerja',
                            text: "Mohon dipilih UNIT KERJA di Filter",
                            type: 'warning',
                        }).then(function() {
                            this.$swal.close();
                        });                       
                    }
                    else
                    {                        
                        this.$router.push('apbdmurni/create');                        
                    }                    
                break;
                case 'destroy':
                    var self = this;
                    this.$swal({
                        title: 'Yakin mau menghapus?',
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
                            axios.post('/api/v1/apbdmurni/'+item.RKAID,{
                                '_method':'DELETE',
                                'pid':'datakegiatan'
                            },{
                                headers:{
                                    'Authorization': window.laravel.api_token,
                                },
                            })
                            .then(response => {                                                          
                                self.proc('default');                                                                    
                            })
                            .catch(response => {
                                self.api_message = response;                               
                            });                                  
                        }
                    });                                      
                break;
                default :
                    this.pid = pid;
                    this.fetchOPD();           
                    this.OrgID=this.$store.getters.getAtributeValueOfPage('apbdmurni','OrgID');      
                    this.OrgNm=this.$store.getters.getAtributeValueOfPage('apbdmurni','OrgNm');      
                    if (this.OrgID!='')
                    {                                
                        axios.get('/api/v1/master/suborganisasi/daftarunitkerja/'+this.OrgID,{
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        })
                        .then(response => {     
                            var daftar_unitkerja = [];
                            $.each(response.data,function(key,value){
                                daftar_unitkerja.push({
                                    id:key,
                                    text:value
                                });
                            });                
                            this.daftar_unitkerja=daftar_unitkerja;                            
                        })
                        .catch(response => {
                            this.api_message = response;
                        });                
                        this.SOrgID=this.$store.getters.getAtributeValueOfPage('apbdmurni','SOrgID');      
                        this.SOrgNm=this.$store.getters.getAtributeValueOfPage('apbdmurni','SOrgNm');    
                    }               
                    this.populateData();                    
            }
        }    
    },
    components: 
	{
        'pagination': Pagination,
        'select2':Select2,
    }
}
</script>