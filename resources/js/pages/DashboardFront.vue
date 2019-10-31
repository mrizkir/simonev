<template>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">DASHBOARD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item active">DASHBOARD</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">JUMLAH OPD</span>
                            <span class="info-box-number">
                                {{datadashboard.jumlah_opd}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">JUMLAH KEGIATAN</span>
                            <span class="info-box-number">
                                {{datadashboard.jumlah_kegiatan}}
                            </span>
                        </div>
                    </div>
                </div>          
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>      
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">JUMLAH PROGRAM</span>
                            <span class="info-box-number">{{datadashboard.jumlah_program}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">PAGU DANA</span>
                            <span class="info-box-number">{{datadashboard.pagudana}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</div>
</template>
<script>
export default {
    mounted ()
    {        
        this.populateData();
    },
    data: function()
    {
        return {
            datadashboard:{
                'jumlah_opd':0,
                'jumlah_kegiatan':0,
                'jumlah_program':0
            }
        }
    },
    methods:{
        populateData ()
        {
            axios.get('/api/datadashboard')
                    .then(response => (this.datadashboard=response.data));
        }
    }
}
</script>