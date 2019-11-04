<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        PAGU ANGGARAN OPD / SKPD
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item active">PAGU ANGGARAN OPD / SKPD</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" v-if="pid=='create'">
                <div class="col-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Pagu Anggaran OPD / SKPD</h3>
                        </div>
                        <form class="form-horizontal" @submit.prevent="saveData">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">OPD / SKPD</label>
                                    <div class="col-sm-9">
                                        <select2 id="OrgID" name="OrgID" v-model="OrgID" :options="daftar_opd" :settings="{placeholder:'PILIH OPD / SKPD',allowClear: true,theme: 'bootstrap'}" :class="{ 'is-invalid': $v.Jumlah2.$error }"></select2>
                                        <div class="form-error-message" v-if="!$v.OrgID.required">* wajib isi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PAGU ANGGARAN APBD</label>
                                    <div class="col-sm-9">
                                        <vue-autonumeric v-model="Jumlah1" :options="{minimumValue: '0',decimalCharacter: ',',digitGroupSeparator: '.',unformatOnSubmit: true }" class="form-control" :class="{ 'is-invalid': $v.Jumlah1.$error }"></vue-autonumeric>
                                        <div class="form-error-message" v-if="!$v.Jumlah1.required">* wajib isi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PAGU ANGGARAN APBDP</label>
                                    <div class="col-sm-9">
                                        <vue-autonumeric v-model="Jumlah2" :options="{minimumValue: '0',decimalCharacter: ',',digitGroupSeparator: '.',unformatOnSubmit: true }" class="form-control" :class="{ 'is-invalid': $v.Jumlah2.$error }"></vue-autonumeric>
                                        <div class="form-error-message" v-if="!$v.Jumlah2.required">* wajib isi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">KETERANGAN</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" name="Descr" id="Descr" v-model="Descr" class="form-control" row="4">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-info" :disabled="submitStatus === 'PENDING'">Simpan</button>
                                        <p class="typo__p" v-if="submitStatus === 'OK'">Data telah sukses disimpan!</p>
                                        <p class="form-error-message" v-if="submitStatus === 'ERROR'">Form ini mohon untuk di isi dengan benar.</p>
                                        <p class="typo__p" v-if="submitStatus === 'PENDING'">Menyimpan...</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-default float-right" v-on:click.prevent="setProcess('default')">Batal</button>
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
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a href="#" class="dropdown-item" v-on:click.prevent="setProcess('create')">
                                            Tambah
                                        </a>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="daftar_paguanggaran.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th width="55">NO</th>
                                        <th width="120">
                                            KODE OPD  
                                        </th> 
                                        <th>
                                            NAMA OPD  
                                        </th> 
                                        <th width="100">
                                            APBD  
                                        </th> 
                                        <th width="100">
                                            APBDP  
                                        </th> 
                                        <th width="100">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_paguanggaran.data" v-bind:key="item.PaguAnggaranOPDID">
                                        <td>{{index+1}}</td>
                                        <td>{{item.kode_organisasi}}</td>
                                        <td>{{item.OrgNm}}</td>    
                                        <td>{{item.Jumlah1|formatUang}}</td>
                                        <td>{{item.Jumlah2|formatUang}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
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
                        <div class="card-footer" v-if="daftar_paguanggaran.data.length">                            
                            <pagination :data="daftar_paguanggaran" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
                                <span slot="prev-nav">&lt; Prev</span>
	                            <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>            
        </div>        
        <span v-if="api_message" class="text-danger">
            {{api_message}} 
        </span>
    </section>
    
</div>
</template>
<script>
import Pagination from 'laravel-vue-pagination';
import Select2 from 'v-select2-component';
import { required} from 'vuelidate/lib/validators';
import VueAutonumeric from 'vue-autonumeric';

export default {
    mounted()
    {
        this.setProcess ('default');
    },
    data: function ()
    {
        return {
            pid:'default',
            paguanggaranopd:{},
            daftar_paguanggaran:{
                data:{}
            },            
            daftar_opd: [{}],
            api_message:'',

            //field form
            OrgID:'',
            Jumlah1:'',
            Jumlah2:'',
            Descr:'',      
            submitStatus: null  
        }
    },
    validations: {
        OrgID: {
			required,
		},
		Jumlah1: {
			required,
		},
		Jumlah2: {
			required,
		},
	},
    methods: 
    {
        loadDataOPD ()
        {            
            axios.get('/api/v1/master/paguanggaranopd/create',{
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
        populateData(page=1)
        {           
            axios.get('/api/v1/master/paguanggaranopd?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.paguanggaranopd=response.data; 
                this.daftar_paguanggaran = this.paguanggaranopd.daftar_paguanggaran;
            })
            .catch(response => {
                this.api_message = response;
            }); 
        },
        setProcess (pid) 
        {
            this.pid = pid;
            switch (this.pid)
            {
                case 'create' :
                    this.loadDataOPD();
                break;
                default :
                    this.populateData();

            }
        },
        saveData() 
		{
			this.$v.$touch();
			if (this.$v.$invalid) {
				this.submitStatus = 'ERROR';
			} else {
				axios.post('/api/v1/master/paguanggaranopd',{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                    '_token':window.laravel.csrfToken
                })
                .then(response => {                          
                   console.log(response.data);          
                })
                .catch(response => {
                    this.api_message = response;
                });

				this.submitStatus = 'PENDING';
				setTimeout(() => {
                    this.submitStatus = 'OK';
                    // this.clearform();
                    // this.setProcess('default');
                }, 500);                
			}
        },
        clearform ()
        {
            this.OrgID='';
            this.Jumlah1='';
            this.Jumlah2='';
            this.Descr='';
            this.submitStatus=null;
        }
    },
    components: {
        'pagination': Pagination,
        'select2':Select2,
        'vue-autonumeric':VueAutonumeric,

    }
}
</script>