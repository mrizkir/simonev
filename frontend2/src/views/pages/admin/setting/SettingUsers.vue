<template>
    <SettingUserLayout :showrightsidebar="false">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
    </SettingUserLayout>
</template>
<script>
import SettingUserLayout from '@/views/layouts/SettingUserLayout';
export default {
    name:'DMaster',
    components:{
        SettingUserLayout,      
    },
}
</script>