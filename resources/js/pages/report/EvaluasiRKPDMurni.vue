<template>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        LAPORAN EVALUASI RKPD MURNI
                    </h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">
                            LAPORAN
                        </li>
                        <li class="breadcrumb-item active">EVALUASI RKPD MURNI</li>
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
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" v-on:click.prevent="populateData">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-html="html_generated"></div>
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
        //inisialisasi data halaman        
		return {
            pid:'default',
            api_message:'',
 
            //show detail
            html_generated:'',
        }
    },
    methods: 
    {        
        generateReport()
        {
            var page = this.$store.getters.getPage('reportevaluasirkpdmurni');
            axios.post('/api/v1/report/reportevaluasirkpdmurni',{
                'OrgID':'all',
            },{
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                this.html_generated=response.data.generated_html;                     
            })
            .catch(response => {
                this.api_message = response;
            });           
        },
        populateData()
        {
            this.$swal({
                title: '<i class="fas fa-spin fa-spinner"></i>',
                text: "Refresh data evaluasi RKPD",
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            }); 
            axios.get('/api/v1/report/reportevaluasirkpdmurni/populatedata',
            {
                headers:{
                    'Authorization': window.laravel.api_token,
                }
            })
            .then(response => {     
                this.html_generated=response.data.generated_html;                     
            })
            .catch(response => {
                this.api_message = response;
            });  
            this.$swal.close();
        },
        proc (pid,item=null) 
        {           
            switch (pid)
            {
                default :
                    this.pid = pid;                                                   
                    this.generateReport(); 
            }
        },
    },
}
</script>