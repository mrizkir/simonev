<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-bars"></i>
                        KEGIATAN
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item">DATA DASAR</li>
                        <li class="breadcrumb-item active">KEGIATAN</li>
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
                                <div class="form-group row" id="divPrgID">
                                    <label class="col-sm-2 col-form-label">PROGRAM</label>
                                    <div class="col-sm-10">                                        
                                        <select2 
                                            id="cmbPrgID" 
                                            name="cmbPrgID" 
                                            v-model="PrgID" 
                                            :options="daftar_program" 
                                            :settings="{
                                                theme:'bootstrap',
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
                            <h3 class="card-title"><i class="fas fa-search"></i> PENCARIAN</h3>                            
                        </div>
                        <form class="form-horizontal" @submit.prevent="search">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KRITERIA</label>
                                    <div class="col-sm-10">
                                        <select name="cmbKriteria" id="cmbKriteria" class="form-control" v-model="cmbKriteria">
                                            <option value="KgtID" :selected="cmbKriteria=='KgtID'">KEGIATAN ID</option>
                                            <option value="kode_kegiatan" :selected="cmbKriteria=='kode_kegiatan'">KODE KEGIATAN</option>
                                            <option value="KgtNm" :selected="cmbKriteria=='KgtNm'">NAMA KEGIATAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ISI KRITERIA</label>
                                    <div class="col-sm-10">
                                        <input name="txtKriteria" id="txtKriteria" type="text" class="form-control" v-model="txtKriteria">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-10">
                                        <button type="button" class="btn bg-gradient-info btn-xs" v-on:click.prevent="search">
                                            <i class="fas fa-search"></i> Cari
                                        </button>      
                                        <a id="btnReset" href="#" title="Reset Pencarian" class="btn btn-default btn-xs" v-on:click.prevent="resetpencarian">
                                            <b><i class="icon-reset"></i></b> Reset
                                        </a>                           
                                    </div>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">                        
                        <div class="card-body table-responsive p-0" v-if="daftar_kegiatan.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th scope="col" width="55">NO</th>
                                        <th scope="col" width="100">
                                            KODE KEGIATAN
                                        </th>
                                        <th scope="col">
                                            NAMA KEGIATAN 
                                        </th>
                                        <th scope="col" width="250">
                                            PROGRAM
                                        </th>
                                        <th scope="col" width="70">KET.</th>
                                        <th scope="col" width="70">TA</th>
                                    </tr>
                                </thead> 
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_kegiatan.data" v-bind:key="item.KgtID">
                                        <td>{{daftar_kegiatan.from+index}}</td>
                                        <td>{{item.kode_kegiatan}}</td>
                                        <td>{{item.KgtNm}}</td>
                                        <td>{{item.PrgNm}}</td>
                                        <td>{{item.Descr}}</td>
                                        <td>{{item.TA}}</td>
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
                        <div class="card-footer" v-if="daftar_kegiatan.data.length">                            
                            <pagination :data="daftar_kegiatan" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
        this.setProcess ('default');   
    },  
    data:function()
    {
         return {
            pid:'default',
            kegiatan:{
                kriteria:'',
                isikriteria:''
            },
            daftar_kegiatan:{
                data:{}
            },
            api_message:'',   
            //field form search & filter
            PrgID:'',
            daftar_program: [{}],
            cmbKriteria:'kode_kegiatan',
            txtKriteria:'',         
         }
    },
    methods: 
    { 
        fetchProgram()
        {
            axios.get('/api/v1/master/program?page=all',{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => { 
                var daftar_program = [];
                daftar_program.push({
                    id:'',
                    text:'SELURUH PROGRAM'
                });
                $.each(response.data,function(key,value){
                    daftar_program.push({
                        id:value.PrgID,
                        text:'['+value.kode_program+'] '+value.PrgNm
                    });
                });                                            
                this.daftar_program=daftar_program;
            })
            .catch(response => {
                this.api_message = response;
            }); 
        },
        search()
        {
            axios.post('/api/v1/master/programkegiatan/search',{
                    'cmbKriteria':this.cmbKriteria,
                    'txtKriteria':this.txtKriteria,
                    'action':'search',
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {      
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Melakukan pencarian data Kegiatan",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });   
                    setTimeout(() => {
                        this.kegiatan=response.data; 
                        this.daftar_kegiatan = this.kegiatan.daftar_kegiatan;
                        if(typeof(this.kegiatan.search) !== 'undefined' && this.kegiatan.search !== null)
                        {
                            this.cmbKriteria = this.kegiatan.search.kriteria;
                            this.txtKriteria = this.kegiatan.search.isikriteria;
                        }   
                        this.$swal.close();
                    }, 1500);
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			   
        },       
        resetpencarian()
        {
            axios.post('/api/v1/master/programkegiatan/search',{
                    'action':'reset',
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.kegiatan=response.data; 
                    this.daftar_kegiatan = this.kegiatan.daftar_kegiatan;                
                    this.cmbKriteria = 'kode_kegiatan';
                    this.txtKriteria = '';                       
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			   
        },   
        filter ({id, text})
        {               
            axios.post('/api/v1/master/programkegiatan/filter',{
                    'PrgID':id,
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {            
                    this.$swal({
                        title: '<i class="fas fa-spin fa-spinner"></i>',
                        text: "Melakukan filter data Kegiatan berdasarkan program",
                        showCancelButton: false,
                        showConfirmButton: false,
                        showCloseButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });  
                    setTimeout(() => {
                        this.kegiatan=response.data; 
                        this.daftar_kegiatan = this.kegiatan.daftar_kegiatan;
                        this.$swal.close();
                    },1500);
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });	
            
        }, 
        populateData(page=1)
        {           
            axios.get('/api/v1/master/programkegiatan?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.kegiatan=response.data; 
                this.PrgID=this.kegiatan.filters.PrgID;
                this.daftar_kegiatan = this.kegiatan.daftar_kegiatan;
                if(typeof(this.kegiatan.search) !== 'undefined' && this.kegiatan.search !== null)
                {
                    this.cmbKriteria = this.kegiatan.search.kriteria;
                    this.txtKriteria = this.kegiatan.search.isikriteria;
                }               
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
                default :
                    this.fetchProgram();                                    
                    this.populateData();                                        
            }
        },
    },
    components: {
        'pagination': Pagination,
        'select2':Select2,
    }
}
</script>