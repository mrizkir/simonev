<template>
    <FrontLayout>        
        <template v-slot:system-bar>
            Tahun Anggaran: {{tahun_anggaran}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <v-container fluid>
            <v-row dense>
                <v-col cols="12">
                    <v-alert type="info">
                        Nilai persen realisasi keuangan tetap muncul 0% bila kurang dari 0.01%
                    </v-alert>
                </v-col>
            </v-row>
            <v-row dense>
                <v-col xs="12" sm="6" md="3">
                    <v-card color="#385F73" dark>
                        <v-card-title class="headline">
                            APBD MURNI
                        </v-card-title>
                        <v-card-subtitle>
                            Total Pagu APBD
                        </v-card-subtitle>
                        <v-card-text>
                            {{statistik1_murni.PaguDana1|formatUang}}
                        </v-card-text>
                        <v-card-actions>
                            <v-progress-linear v-model="statistik1_murni.PersenRealisasiKeuangan1" color="success" background-color="error"></v-progress-linear>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="3">
                    <v-card color="#385F73" dark>
                        <v-card-title class="headline">
                            PROG. DAN KEG.
                        </v-card-title>
                        <v-card-subtitle>
                            Jumlah Program dan Keg.
                        </v-card-subtitle>
                        <v-card-text>
                            Prog.: {{statistik1_murni.JumlahProgram1}} / Keg.: {{statistik1_murni.JumlahKegiatan1}} 
                        </v-card-text>
                        <v-card-actions>
                            <v-progress-linear v-model="statistik1_murni.PersenRealisasiKeuangan1" color="success" background-color="error"></v-progress-linear>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="3">
                    <v-card color="#385F73" dark>
                        <v-card-title class="headline">
                            KEUANGAN
                        </v-card-title>
                        <v-card-subtitle>
                            Realisasi Keuangan
                        </v-card-subtitle>
                        <v-card-text>
                            {{statistik1_murni.RealisasiKeuangan1|formatUang}} ({{statistik1_murni.PersenRealisasiKeuangan1}}%)
                        </v-card-text>
                        <v-card-actions>
                            <v-progress-linear v-model="statistik1_murni.PersenRealisasiKeuangan1" color="success" background-color="error"></v-progress-linear>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="3">
                    <v-card color="#385F73" dark>
                        <v-card-title class="headline">
                            FISIK
                        </v-card-title>
                        <v-card-subtitle>
                            Realisasi Fisik 
                        </v-card-subtitle>
                        <v-card-text>
                            {{statistik1_murni.RealisasiFisik1}}%
                        </v-card-text>
                        <v-card-actions>
                            <v-progress-linear :value="statistik1_murni.RealisasiFisik1" color="success" background-color="error"></v-progress-linear>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
            </v-row>
            <v-row dense>
                <v-col xs="12" sm="6" md="3">
                    <v-card color="#952175" dark>
                        <v-card-title class="headline">
                            APBD PERUBAHAN
                        </v-card-title>
                        <v-card-subtitle>
                            Total Pagu APBD
                        </v-card-subtitle>
                        <v-card-text>
                            {{statistik1_perubahan.PaguDana2|formatUang}}
                        </v-card-text>
                        <v-card-actions>
                            <v-progress-linear v-model="statistik1_perubahan.PersenRealisasiKeuangan2" color="success" background-color="error"></v-progress-linear>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="3">
                    <v-card color="#952175" dark>
                        <v-card-title class="headline">
                            PROG. DAN KEG.
                        </v-card-title>
                        <v-card-subtitle>
                            Jumlah Program dan Keg.
                        </v-card-subtitle>
                        <v-card-text>
                            Prog.: {{statistik1_perubahan.JumlahProgram2}} / Keg.: {{statistik1_perubahan.JumlahKegiatan2}} 
                        </v-card-text>
                        <v-card-actions>
                            <v-progress-linear v-model="statistik1_perubahan.PersenRealisasiKeuangan2" color="success" background-color="error"></v-progress-linear>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="3">
                    <v-card color="#952175" dark>
                        <v-card-title class="headline">
                            KEUANGAN
                        </v-card-title>
                        <v-card-subtitle>
                            Realisasi Keuangan
                        </v-card-subtitle>
                        <v-card-text>
                            {{statistik1_perubahan.RealisasiKeuangan2|formatUang}} ({{statistik1_perubahan.PersenRealisasiKeuangan2}}%)
                        </v-card-text>
                        <v-card-actions>
                            <v-progress-linear v-model="statistik1_perubahan.PersenRealisasiKeuangan2" color="success" background-color="error"></v-progress-linear>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="3">
                    <v-card color="#952175" dark>
                        <v-card-title class="headline">
                            FISIK
                        </v-card-title>
                        <v-card-subtitle>
                            Realisasi Fisik 
                        </v-card-subtitle>
                        <v-card-text>
                            {{statistik1_perubahan.RealisasiFisik2}}%
                        </v-card-text>
                        <v-card-actions>
                            <v-progress-linear :value="statistik1_perubahan.RealisasiFisik2" color="success" background-color="error"></v-progress-linear>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
            </v-row>
            <v-row dense>
                <v-col xs="12" sm="12" md="6">
                    <v-card class="mb-2">
                        <v-card-title class="headline">
                            Progres Realisasi Keuangan Murni                         
                        </v-card-title>
                        <v-card-text>
                            <chart-realisasi-keuangan :datagrafik="chartrealisasikeuangan_murni" v-if="chartLoaded" />
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="12" md="6">
                    <v-card class="mb-2">
                        <v-card-title class="headline">
                            Progres Realisasi Keuangan Perubahan
                        </v-card-title>
                        <v-card-text>
                            <chart-realisasi-fisik :datagrafik="chartrealisasikeuangan_perubahan" v-if="chartLoaded" />
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
            </v-row>
            <v-row dense>
                <v-col xs="12" sm="12" md="6">
                    <v-card class="mb-2">
                        <v-card-title class="headline">
                            Progres Realisasi Fisik Murni                         
                        </v-card-title>
                        <v-card-text>
                            <chart-realisasi-keuangan :datagrafik="chartrealisasifisik_murni" v-if="chartLoaded" />
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="12" md="6">
                    <v-card class="mb-2">
                        <v-card-title class="headline">
                            Progres Realisasi Fisik Perubahan
                        </v-card-title>
                        <v-card-text>
                            <chart-realisasi-fisik :datagrafik="chartrealisasifisik_perubahan" v-if="chartLoaded" />
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
            </v-row>
        </v-container>
        <template v-slot:filtersidebar>
            <Filter1 v-on:changeTahunAnggaran="changeTahunAnggaran" v-on:changeBulanRealisasi="changeBulanRealisasi" ref="filter1" />	
        </template>
    </FrontLayout>
</template>
<script>
import FrontLayout from '@/views/layouts/FrontLayout';
import Filter1 from '@/components/sidebar/FilterMode1';

//chart
import ChartTargetRealisasi from '@/components/chart/ChartTargetRealisasi';

export default {
    name: 'DashboardFront',
    created () 
    {
        this.$store.dispatch('uifront/init',this.$ajax);           
        this.tahun_anggaran=this.$store.getters['uifront/getTahunAnggaran'];
        this.bulan_realisasi=this.$store.getters['uifront/getBulanRealisasi'];          
    },
    mounted()
    {
        this.initialize();
        this.firstloading=false;            
        this.$refs.filter1.setFirstTimeLoading(this.firstloading);
    },
    data: () => ({ 
        firstloading:true,
        tahun_anggaran:null,                
        bulan_realisasi:null,

        statistik1_murni:{
            'PaguDana1':0,             
            'JumlahProgram1':0,             
            'JumlahKegiatan1':0,             
            'RealisasiKeuangan1':0,             
            'RealisasiFisik1':0,            
        },		
        statistik1_perubahan:{
            'PaguDana2':0,             
            'JumlahProgram2':0,             
            'JumlahKegiatan2':0,             
            'RealisasiKeuangan2':0,             
            'RealisasiFisik2':0,            
        },		
        //chart
        chartLoaded:false,
        chartrealisasikeuangan_murni:[
            [],
            []
        ],
        chartrealisasikeuangan_perubahan:[
            [],
            []
        ],
        chartrealisasifisik_murni:[
            [],
            []
        ],
        chartrealisasifisik_perubahan:[
            [],
            []
        ]
    }),
    methods:{
        changeTahunAnggaran (ta)
        {
            this.tahun_anggaran=ta;
        },
        changeBulanRealisasi (bulan)
        {
            this.bulan_realisasi=bulan;
        },
        async initialize()
        {
            await this.$ajax.post('/dashboard/front',
            {
                ta:this.tahun_anggaran,                
                bulan_realisasi:this.bulan_realisasi,                
            }).then(({data})=>{ 
                this.statistik1_murni=data.statistik1_murni;
                this.statistik1_perubahan=data.statistik1_perubahan;

                //chart realisasi-keuangan               

                this.chartrealisasikeuangan_murni[0]=data.chart_keuangan_murni[0];
                this.chartrealisasikeuangan_murni[1]=data.chart_keuangan_murni[1];

                this.chartrealisasikeuangan_perubahan[0]=data.chart_keuangan_perubahan[0];
                this.chartrealisasikeuangan_perubahan[1]=data.chart_keuangan_perubahan[1];
                
                this.chartrealisasifisik_murni[0]=data.chart_fisik_murni[0];
                this.chartrealisasifisik_murni[1]=data.chart_fisik_murni[1];

                this.chartrealisasifisik_perubahan[0]=data.chart_fisik_perubahan[0];
                this.chartrealisasifisik_perubahan[1]=data.chart_fisik_perubahan[1];

                this.chartLoaded=true;

            });                         
        }
    },
    components: {
        FrontLayout,
        Filter1,
        'chart-realisasi-keuangan':ChartTargetRealisasi,        
        'chart-realisasi-fisik':ChartTargetRealisasi,      
    },    
    watch:{
        tahun_anggaran()
        {
            if (!this.firstloading)
            {
                this.initialize();
            }            
        },
        bulan_realisasi()
        {
            if (!this.firstloading)
            {
                this.initialize();
            }            
        },  
    },
}
</script>