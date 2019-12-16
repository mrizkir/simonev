<template>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        DASHBOARD
                    </h1>
                </div>
                <div class="col-sm-12">
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
                            <span class="info-box-number" id="spanPagudana">{{datadashboard.pagudana | formatUang}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Grafik Progres Realisasi Target dan Kinerja APBD {{datadashboard.nama_apbd}} TA {{datadashboard.ta}}</h5>
                            <div class="card-tools">
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <v-chart :options="line"/>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">                                        
                                        <h5 class="description-header">
                                            <span class="description-percentage text-success">
                                                {{datadashboard.persen_target_keuangan | formatAngka}}%
                                            </span>
                                        </h5>
                                        <span class="description-text">TARGET KEUANGAN</span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">                                        
                                        <h5 class="description-header">
                                            <span class="description-percentage text-success">
                                                {{datadashboard.persen_realisasi_keuangan | formatAngka}}%
                                            </span>
                                        </h5>
                                        <span class="description-text">REALISASI KEUANGAN</span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">                                        
                                        <h5 class="description-header">
                                            <span class="description-percentage text-success">
                                                {{datadashboard.target_fisik | formatAngka}}%
                                            </span>
                                        </h5>
                                        <span class="description-text">TARGET FISIK</span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">                                        
                                        <h5 class="description-header">
                                            <span class="description-percentage text-success">
                                                {{datadashboard.realisasi_fisik | formatAngka}}%
                                            </span>                                            
                                        </h5>
                                        <span class="description-text">REALISASI FISIK</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</div>
</template>
<script>
import ECharts from 'vue-echarts'; // refers to components/ECharts.vue in webpack

// import ECharts modules manually to reduce bundle size
import 'echarts/lib/component/polar';
import 'echarts/lib/chart/line';
import 'echarts/lib/component/tooltip';

export default {        
    mounted ()
    {         
        this.populateData();        
    },
    data: function()
    {
        let chart = [
            [1,2,3,4,5,6,7,8,9,10,11,12],
            [1,2,3,4,5,6,7,8,9,10,11,12],
            [1,2,3,4,5,6,7,8,9,10,11,12],
            [1,2,3,4,5,6,7,8,9,10,11,100]
        ];        
        return {
           
            datadashboard:{
                'ta':'',
                'nama_apbd':'',
                'jumlah_opd':0,
                'jumlah_kegiatan':0,
                'jumlah_program':0,
                'pagudana':0,
                'persen_target_keuangan':0,
            },
            line: {
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data:['Target Keuangan','Realisasi Keuangan','Target Fisik','Realisasi Fisik']
                },
                grid: {
                    left: '0%',
                    right: '3%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
                },
                yAxis: {
                    type: 'value',
                    max: 100
                },
                series: [
                    {
                        color:'#c23531',
                        name:'Target Keuangan',
                        type:'line',
                        stack: '100',
                        smooth: true,
                        data:chart[0]
                    },
                    {
                        color:'#c23531',
                        name:'Realisasi Keuangan',
                        type:'line',
                        stack: '100',
                        smooth: true,
                        data:chart[1]
                    },
                    {
                        color:'#2f4554',
                        name:'Target Fisik',
                        type:'line',
                        stack: '100',
                        smooth: true,
                        data:chart[2]
                    },
                    {
                        color:'#2f4554',
                        name:'Realisasi Fisik',
                        type:'line',
                        stack: '100',
                        smooth: true,
                        data:chart[3]
                    }
                ]
            }
        }
    },
    methods:
    {
        populateData ()
        {
            axios.get('/api/datadashboard')
                .then(response => {                    
                    this.datadashboard=response.data;                    
                })
                .catch(function (error){
                    console.log(error);
                });             
        },       
    },
    components:
    {
        'v-chart': ECharts
    }
}
</script>
<style scoped>
.echarts
{
    width:100%;
}
</style>