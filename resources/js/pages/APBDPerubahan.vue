<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        APBD PERUBAHAN
                    </h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item active">APBD PERUBAHAN</li>
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
            <div class="row" v-if="pid=='edit'">
				<div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i> UBAH KEGIATAN
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('default',null)">
                                    <i class="fas fa-times"></i>
                                </button>                                                
                            </div>       
                        </div>
                        <form class="form-horizontal" @submit.prevent="updateData">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PROGRAM</label>
                                    <div class="col-sm-10">
                                        [{{form.kode_program}}] {{form.PrgNm}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">RKPDID</label>
                                    <div class="col-sm-10">
                                        {{form.RKPDID}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KEGIATAN</label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static">
                                            [{{form.kode_kegiatan}}] {{form.KgtNm}}
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PAGU DANA</label>
                                    <div class="col-sm-10">
										<vue-autonumeric 
											v-model.trim="form.PaguDana2" 
											v-on:input="$v.form.$touch"
											:options="{
												minimumValue: '0',
												decimalCharacter: ',',
												digitGroupSeparator: '.',
												emptyInputBehavior:0,
												unformatOnSubmit: true 
											}" 
											class="form-control" 
											v-bind:class="{'is-invalid': $v.form.PaguDana2.$error, 'is-valid': $v.form.PaguDana2.$dirty && !$v.form.PaguDana2.$invalid}">
										</vue-autonumeric>
										<div class="text-danger" v-if="$v.form.PaguDana2.$error">* wajib isi</div>
                                    </div>
                                </div>		
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PA</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.nip_pa" 
                                            :reduce="daftar_pa => daftar_pa.code" 
                                            placeholder="SILAHKAN PILIH KPA (PENGGUNA ANGGARAN)" 
                                            :options="daftar_pa">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KPA</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.nip_kpa" 
                                            :reduce="daftar_kpa => daftar_kpa.code" 
                                            placeholder="SILAHKAN PILIH KPA (KUASA PENGGUNA ANGGARAN)" 
                                            :options="daftar_kpa">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PPK</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            placeholder="SILAHKAN PILIH PPK (PEJABAT PEMBUAT KOMITMEN)" 
                                            v-model="form.nip_ppk" 
                                            :reduce="daftar_ppk => daftar_ppk.code" 
                                            :options="daftar_ppk">
                                        </v-select>
                                    </div>
                                </div>                               
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">PPTK</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="form.nip_pptk" 
                                            :reduce="daftar_pptk => daftar_pptk.code"
                                            placeholder="SILAHKAN PILIH PPTK (PEJABAT PELAKSANA TEKNIS KEGIATAN)" 
                                            :options="daftar_pptk">
                                        </v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info" :disabled="$v.form.$error">Simpan</button>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </form>
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
                                        <v-select 
                                            v-model="OrgID" 
                                            placeholder="PILIH OPD / SKPD" 
                                            :options="daftar_opd"
                                            @input="fetchUnitKerja">
                                        </v-select>
                                    </div>
                                </div>                               
                                <div class="form-group row" id="divSOrgID">
                                    <label class="col-sm-2 col-form-label">UNIT KERJA</label>
                                    <div class="col-sm-10">
                                        <v-select 
                                            v-model="SOrgID" 
                                            placeholder="PILIH UNIT KERJA" 
                                            :options="daftar_unitkerja"
                                            @input="filter">
                                        </v-select>
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
                                <button type="button" class="btn btn-tool" v-on:click.prevent="proc('create')" title="Tambah Kegiatan Baru">
                                    <i class="fas fa-plus"></i>
                                </button>                                
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_apbdperubahan.data.length">
                            <table class="table table-striped table-hover mb-2 table-condensed">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>                                      
                                        <th width="120">
                                            KODE KEGIATAN
                                        </th> 
                                        <th>
                                            NAMA KEGIATAN  
                                        </th>                                       
                                        <th width="80">
                                            PAGU KEGIATAN  
                                        </th>                                       
                                        <th width="80">
                                            PAGU URAIAN  
                                        </th>                                       
                                        <th width="80">
                                            REALISASI  
                                        </th>                                       
                                        <th width="70">
                                            FISIK(%)  
                                        </th>                                       
                                        <th width="70">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_apbdperubahan.data" v-bind:key="item.RKAID">
                                        <td>{{daftar_apbdperubahan.from+index}}</td>
                                        <td>{{item.kode_kegiatan}}</td>    
                                        <td>{{item.KgtNm}}</td>
                                        <td>{{item.PaguDana2|formatUang}}</td>
                                        <td>{{item.TotalPaguUraian2|formatUang}}</td>
                                        <td>{{item.TotalRealisasi2|formatUang}}</td>
                                        <td>{{item.TotalFisik2}}</td>                                            
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" v-on:click.prevent="proc('show',item)">
                                                        <i class="fas fa-eye"></i> URAIAN
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
                        <div class="card-footer" v-if="daftar_apbdperubahan.data.length">                            
                            <pagination :data="daftar_apbdperubahan" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
import { required} from 'vuelidate/lib/validators';
import VueAutonumeric from 'vue-autonumeric';
import Pagination from 'laravel-vue-pagination';
import vSelect from 'vue-select';

export default {
    mounted()
	{       
        //inisialisasi data halaman
        this.$store.commit('addToPages',{
                name:'apbdperubahan',
                OrgID:'',
                OrgNm:'',
                SOrgID:'',
                SOrgNm:'',
                RKAID:'',
                datarekening:{},
                datauraian:{},
                detailkegiatan:{}
        });
		this.proc ('default');   
	},
	data: function() 
	{
		return {
            pid:'default',
            api_message:'',

            apbdperubahan:{
                kriteria:'',
                isikriteria:'',
            },
            daftar_apbdperubahan:{
                data:{}
            },

            //field form search & filter
            OrgID:'',
            OrgNm:'',
            SOrgID:'',
            SOrgNm:'',
            daftar_opd: [],
            daftar_unitkerja: [],

            //form			
            daftar_pa: [],
            daftar_kpa: [],
            daftar_ppk: [],
            daftar_pptk: [],
			form: {		
                RKAID:'',
                RKPDID:'',
                kode_program:'',		                                
                PrgNm:'',		                                
                kode_kegiatan:'',		                                
                KgtNm: '',
                PaguDana2: '',	
                nip_kpa:'',			
                nip_pa:'',			
                nip_ppk:'',			
                nip_pptk:'',			
				Descr:'',
			},      
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
                        code:key,
                        label:value
                    });
                });                
                this.daftar_opd=daftar_opd;   
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        fetchUnitKerja()
        {           
            var page = this.$store.getters.getPage('apbdperubahan');
            page.OrgID=this.OrgID;
            page.OrgNm=this.OrgID.label;
            page.SOrgID='';
            page.SOrgNm='';
            this.$store.commit('replacePage',page);

            axios.get('/api/v1/master/suborganisasi/daftarunitkerja/'+this.OrgID.code,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                var daftar_unitkerja = [];
                $.each(response.data,function(key,value){
                    daftar_unitkerja.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_unitkerja=daftar_unitkerja;                            
            })
            .catch(response => {
                this.api_message = response;
            });
            this.populateData();
        },
        filter ()
        {           
            var page = this.$store.getters.getPage('apbdperubahan');
            page.SOrgID=this.SOrgID;
            page.SOrgNm=this.SOrgNm.label;
            this.$store.commit('replacePage',page);

            this.populateData();
        },
        fetchPejabat ()
        {  
            axios.get('/api/v1/apbdperubahan/create',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {             
                var daftar_program = [];
                $.each(response.data.daftar_program,function(key,value){
                    daftar_program.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_program=daftar_program;                 
                
                var daftar_pa = [];
                $.each(response.data.daftar_pa,function(key,value){
                    daftar_pa.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_pa=daftar_pa;                 
                
                var daftar_kpa = [];
                $.each(response.data.daftar_kpa,function(key,value){
                    daftar_kpa.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_kpa=daftar_kpa;                 
                
                var daftar_ppk = [];
                $.each(response.data.daftar_ppk,function(key,value){
                    daftar_ppk.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_ppk=daftar_ppk;                 
                
                var daftar_pptk = [];
                $.each(response.data.daftar_pptk,function(key,value){
                    daftar_pptk.push({
                        code:key,
                        label:value
                    });
                });                
                this.daftar_pptk=daftar_pptk;                 
            })
            .catch(response => {
                this.api_message = response;
            });
        },
        populateData(page=1)
        {           
            axios.get('/api/v1/apbdperubahan?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                    'OrgID':this.OrgID.code,
                    'SOrgID':this.SOrgID.code,
                }
            })
            .then(response => {        
                this.apbdperubahan=response.data; 
                this.daftar_apbdperubahan = this.apbdperubahan.daftar_apbdperubahan;                                      
            })
            .catch(response => {
                this.api_message = response;
            });             
        },
        updateData() 
        {	
            this.$v.form.$touch();    
            if(this.$v.$invalid == false)
            { 
                axios.post('/api/v1/apbdperubahan/update/'+this.form.RKAID,{                   
                    '_method':'PUT',                   
                    'PaguDana2':this.form.PaguDana2,                   
                    'nip_pa':this.form.nip_pa,
                    'nip_kpa':this.form.nip_kpa,
                    'nip_ppk':this.form.nip_ppk,
                    'nip_pptk':this.form.nip_pptk,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Mengubah Data Kegiatan berhasil dilakukan",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });              
                    setTimeout(() => {
                        this.clearform();                             
                        this.$swal.close();   
                        this.proc('default');       
                    }, 1500);             
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			
                
            }
        },   
        proc (pid,item=null) 
        {           
            this.$v.$reset();
            switch (pid)
            {
                case 'show':     
                    var page = this.$store.getters.getPage('apbdperubahan');
                    page.detailkegiatan = {};                        
                    page.RKAID = item.RKAID;                        
                    this.$store.commit('replacePage',page);      
                    this.$router.push('/apbdperubahan/uraian');
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
                        this.$router.push('/apbdperubahan/create');                        
                    }                    
                break;
                case 'edit':
                    this.pid=pid;                    
                    this.form.RKAID = item.RKAID;
                    this.form.RKPDID = item.RKPDID;
                    this.form.kode_program = item.kode_program;
                    this.form.PrgNm = item.PrgNm;
                    this.form.kode_kegiatan = item.kode_kegiatan;
                    this.form.KgtNm = item.KgtNm;
                    this.form.PaguDana2 = item.PaguDana2;

                    this.fetchPejabat();                                    
                    this.form.nip_pa=item.nip_pa2;			
                    this.form.nip_kpa=item.nip_kpa2;	
                    this.form.nip_ppk=item.nip_ppk2;			
                    this.form.nip_pptk=item.nip_pptk2;	                   
                    
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
                            console.log(self.$store);
                            // axios.post('/api/v1/apbdperubahan/'+item.RKAID,{
                            //     '_method':'DELETE',
                            //     'pid':'datakegiatan'
                            // },{
                            //     headers:{
                            //         'Authorization': window.laravel.api_token,
                            //     },
                            // })
                            // .then(response => {                                                          
                            //     self.proc('default');                                                                    
                            // })
                            // .catch(response => {
                            //     self.api_message = response;                               
                            // });                                  
                        }
                    });                                      
                break;
                default :
                    this.pid = pid;                    
                    this.fetchOPD();                               
                    this.OrgID=this.$store.getters.getAtributeValueOfPage('apbdperubahan','OrgID');      
                    this.OrgNm=this.$store.getters.getAtributeValueOfPage('apbdperubahan','OrgNm');      
                    if (this.OrgID!='')
                    {                                
                        axios.get('/api/v1/master/suborganisasi/daftarunitkerja/'+this.OrgID.code,{
                            headers:{
                                'Authorization': window.laravel.api_token,
                            }
                        })
                        .then(response => {     
                            var daftar_unitkerja = [];
                            $.each(response.data,function(key,value){
                                daftar_unitkerja.push({
                                    code:key,
                                    label:value
                                });
                            });                
                            this.daftar_unitkerja=daftar_unitkerja;                            
                        })
                        .catch(response => {
                            this.api_message = response;
                        });                
                        this.SOrgID=this.$store.getters.getAtributeValueOfPage('apbdperubahan','SOrgID');      
                        this.SOrgNm=this.$store.getters.getAtributeValueOfPage('apbdperubahan','SOrgNm');    
                    }               
                    this.populateData();                    
            }
        },
        clearform ()
        {   
            this.form.RKAID='';
            this.form.RKPDID='';
            this.form.kode_program='';
            this.form.KgtNm='';
            this.form.kode_kegiatan='';
            this.form.KgtNm='';
            this.form.PaguDana2=0;
            this.form.nip_pa='';
            this.form.nip_kpa='';
            this.form.nip_ppk='';
            this.form.nip_pptk='';
            this.form.Descr='';          
        },
    },         
    validations: {
		form: {
			PaguDana2: {
				required
			},
		}
    },
    
    components: 
	{
        'vue-autonumeric':VueAutonumeric,
        'pagination': Pagination,
        'v-select': vSelect,
    }
}
</script>