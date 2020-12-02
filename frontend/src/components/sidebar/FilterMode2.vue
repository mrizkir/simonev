<template>
    <v-list-item>
        <v-list-item-content>                                 
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
    name:'FilterMode2',
    created()
    {
        this.daftar_bulan=this.$store.getters['uifront/getDaftarBulan'];  
        this.bulan_realisasi=this.$store.getters['uifront/getBulanRealisasi'];                                            
    },
    data:()=>({
        firstloading:true,
        
        daftar_bulan:[],
        bulan_realisasi:null,
    }),
    methods:{
        setFirstTimeLoading (bool)
        {            
            this.firstloading=bool;            
        }
    },
    watch:{        
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