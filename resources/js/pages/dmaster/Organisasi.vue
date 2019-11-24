<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-bars"></i>
                        OPD / SKPD
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item">DATA DASAR</li>
                        <li class="breadcrumb-item active">OPD / SKPD</li>
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
                            <h3 class="card-title"><i class="fas fa-search"></i> PENCARIAN</h3>                            
                        </div>
                        <form class="form-horizontal" @submit.prevent="search">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">KRITERIA</label>
                                    <div class="col-sm-10">
                                        <select name="cmbKriteria" id="cmbKriteria" class="form-control" v-model="cmbKriteria">
                                            <option value="kode_organisasi" :selected="cmbKriteria=='kode_organisasi'">KODE OPD / SKPD</option>
                                            <option value="OrgNm" :selected="cmbKriteria=='OrgNm'">NAMA OPD / SKPD</option>
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
                        <div class="card-body table-responsive p-0" v-if="daftar_organisasi.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th scope="col" width="55">NO</th>
                                        <th scope="col" width="190">
                                            KODE OPD / SKPD
                                        </th>
                                        <th scope="col">
                                            NAMA OPD / SKPD
                                        </th>
                                        <th scope="col">
                                            URUSAN
                                        </th>
                                        <th scope="col" width="70">TA</th>
                                    </tr>
                                </thead> 
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_organisasi.data" v-bind:key="item.OrgID">
                                        <td>{{daftar_organisasi.from+index}}</td>
                                        <td>{{item.kode_organisasi}}</td>
                                        <td>{{item.OrgNm}}</td>
                                        <td>{{item.Nm_Urusan}}</td>
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
                        <div class="card-footer" v-if="daftar_organisasi.data.length">                            
                            <pagination :data="daftar_organisasi" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
export default {
    mounted()
    {
        this.setProcess ('default');   
    },  
    data:function()
    {
         return {
            pid:'default',
            organisasi:{
                kriteria:'',
                isikriteria:''
            },
            daftar_organisasi:{
                data:{}
            },
            api_message:'',   
             //field form search
            cmbKriteria:'OrgNm',
            txtKriteria:'',         
         }
    },
    methods: 
    { 
        search()
        {
            axios.post('/api/v1/master/organisasi/search',{
                    'cmbKriteria':this.cmbKriteria,
                    'txtKriteria':this.txtKriteria,
                    'action':'search',
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.organisasi=response.data; 
                    this.daftar_organisasi = this.organisasi.daftar_organisasi;
                    if(typeof(this.organisasi.search) !== 'undefined' && this.organisasi.search !== null)
                    {
                        this.cmbKriteria = this.organisasi.search.kriteria;
                        this.txtKriteria = this.organisasi.search.isikriteria;
                    }   
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			   
        },   
        resetpencarian()
        {
            axios.post('/api/v1/master/organisasi/search',{
                    'action':'reset',
                },{
                    headers:{
                        'Authorization': window.laravel.api_token,
                    },
                })
                .then(response => {                          
                    this.organisasi=response.data; 
                    this.daftar_organisasi = this.organisasi.daftar_organisasi;                
                    this.cmbKriteria = 'OrgNm';
                    this.txtKriteria = '';                       
                })
                .catch(error => {
                    this.api_message = error.response.data.message;
                });			   
        },   
        populateData(page=1)
        {           
            axios.get('/api/v1/master/organisasi?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.organisasi=response.data; 
                this.daftar_organisasi = this.organisasi.daftar_organisasi;
                if(typeof(this.organisasi.search) !== 'undefined' && this.organisasi.search !== null)
                {
                    this.cmbKriteria = this.organisasi.search.kriteria;
                    this.txtKriteria = this.organisasi.search.isikriteria;
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
                    this.populateData();
            }
        },
    },
    components: {
        'pagination': Pagination,
    }
}
</script>