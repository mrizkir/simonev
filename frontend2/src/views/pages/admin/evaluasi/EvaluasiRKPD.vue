<template>
    <EvaluasiRKPDLayout :temporaryleftsidebar="true">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <v-container fluid>
            
        </v-container>
    </EvaluasiRKPDLayout>
</template>
<script>
import EvaluasiRKPDLayout from '@/views/layouts/EvaluasiRKPDLayout';

export default {
    name: 'EvaluasiRKPD',
    created()
    {
        this.tahun_anggaran=this.$store.getters['uifront/getTahunAnggaran'];
        this.bulan_realisasi=this.$store.getters['uifront/getBulanRealisasi'];      
        this.initialize();
    },    
    data: () => ({
        tahun_anggaran:null,                
        bulan_realisasi:null,        
    }),
    methods: {
        async initialize()
        {

        },
    },
    components: {
        EvaluasiRKPDLayout,        
    },
};
</script>