<template>
    <DataMasterLayout :showrightsidebar="false">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
    </DataMasterLayout>
</template>
<script>
import DataMasterLayout from '@/views/layouts/DataMasterLayout';
export default {
    name:'DMaster',
    components:{
        DataMasterLayout,      
    },
}
</script>