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
                'jumlah_kegiatan':0
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