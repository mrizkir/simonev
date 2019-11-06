<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-bars"></i>
                        KELOMPOK URUSAN
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item active">KELOMPOK URUSAN</li>
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
                        <div class="card-body table-responsive p-0" v-if="daftar_kelompokurusan.data.length">
                            <table class="table table-striped table-hover mb-2">
                                <thead>
                                    <tr>
                                        <th scope="col" width="55">NO</th>
                                        <th scope="col" width="150">
                                            KODE KELOMPOK URUSAN
                                        </th>
                                        <th scope="col" width="150">
                                            NAMA KELOMPOK URUSAN 
                                        </th>
                                        <th scope="col" width="70">KET.</th>
                                        <th scope="col" width="70">TA</th>
                                    </tr>
                                </thead> 
                                <tbody>  
                                    <tr v-for="(item,index) in daftar_kelompokurusan.data" v-bind:key="item.KUrsID">
                                        <td>{{daftar_kelompokurusan.from+index}}</td>
                                         <td>{{item.Kd_Urusan}}</td>
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
                        <div class="card-footer" v-if="daftar_kelompokurusan.data.length">                            
                            <pagination :data="daftar_kelompokurusan" @pagination-change-page="populateData" align="center" :show-disabled="true" :limit="8">
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
            kelompokurusan:{
                kriteria:'',
                isikriteria:''
            },
            daftar_kelompokurusan:{
                data:{}
            },
         }
    },
    methods: 
    {        
        populateData(page=1)
        {           
            axios.get('/api/v1/master/kelompokurusan?page='+page,{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {                                        
                this.kelompokurusan=response.data; 
                this.daftar_kelompokurusan = this.kelompokurusan.daftar_kelompokurusan;
                if(typeof(this.kelompokurusan.search) !== 'undefined' && this.kelompokurusan.search !== null)
                {
                    this.cmbKriteria = this.kelompokurusan.search.kriteria;
                    this.txtKriteria = this.kelompokurusan.search.isikriteria;
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