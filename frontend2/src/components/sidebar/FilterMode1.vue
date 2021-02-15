<template>
    <v-list-item>
        <v-list-item-content>                     
            <v-select
                v-model="tahun_anggaran"
                :items="daftar_ta"                
                label="TAHUN ANGGARAN"
                outlined/>   
            <v-select
                v-model="bulan_realisasi"
                :items="daftar_bulan"                                
                label="BULAN REALISASI"
                outlined/>   
        </v-list-item-content>
    </v-list-item>	
</template>
<script>
export default {
    name:'FilterMode1',
    created()
    {
        this.daftar_ta=this.$store.getters['uifront/getDaftarTA'];  
        this.tahun_anggaran=this.$store.getters['uifront/getTahunAnggaran'];  

        this.daftar_bulan=this.$store.getters['uifront/getDaftarBulan'];  
        this.bulan_realisasi=this.$store.getters['uifront/getBulanRealisasi'];                                            
    },
    data:()=>({
        firstloading:true,
        
        daftar_bulan:[],
        bulan_realisasi:null,

        daftar_ta:[],
        tahun_anggaran:null
    }),
    methods:{
        setFirstTimeLoading (bool)
        {            
            this.firstloading=bool;            
        }
    },
    watch:{
        tahun_anggaran(val)
        {
            if (!this.firstloading)
            {
                this.$store.dispatch('uifront/updateTahunAnggaran',val);  
                this.$emit('changeTahunAnggaran',val);          
            }            
        },
        bulan_realisasi(val)
        {
            if (!this.firstloading)
            {                
                this.$store.dispatch('uifront/updateBulanRealisasi',val);  
                this.$emit('changeBulanRealisasi',val);          
            }
        },
    }
}
</script>