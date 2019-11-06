<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-bars"></i>
                        URUSAN
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item active">URUSAN</li>
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
                        <div class="card-body table-responsive p-0" v-if="daftar_urusan.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th scope="col" width="55">NO</th>
                                        <th scope="col" width="190">
                                            KODE URUSAN
                                        </th>
                                        <th scope="col">
                                            NAMA URUSAN 
                                        </th>
                                        <th scope="col" width="200">
                                            KELOMPOK URUSAN
                                        </th>
                                        <th scope="col" width="70">KET.</th>
                                        <th scope="col" width="70">TA</th>
                                    </tr>
                                </thead> 
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_urusan.data" v-bind:key="item.UrsID">
                                        <td>{{daftar_urusan.from+index}}</td>
                                        <td>{{item.Kode_Bidang}}</td>
                                        <td>{{item.Nm_Bidang}}</td>
                                        <td>{{item.Nm_Urusan}}</td>
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
                        <div class="card-footer" v-if="daftar_urusan.data.length">                            
                            <pagination :data="daftar_urusan" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
            api_message:'',
            urusan:{
                kriteria:'',
                isikriteria:''
            },
            daftar_urusan:{
                data:{}
            },
         }
    },
    methods: 
    {        
        populateData(page=1)
        {           
            axios.get('/api/v1/master/urusan?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.urusan=response.data; 
                this.daftar_urusan = this.urusan.daftar_urusan;
                if(typeof(this.urusan.search) !== 'undefined' && this.urusan.search !== null)
                {
                    this.cmbKriteria = this.urusan.search.kriteria;
                    this.txtKriteria = this.urusan.search.isikriteria;
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