// const DashboardFront = () => import ('./pages/DashboardFront.vue');
// const FormValidation = () => import ('./pages/FormValidation.vue');

// DATA MASTER
// const KelompokUrusan = () => import ('./pages/dmaster/KelompokUrusan.vue');
// const Urusan = () => import ('./pages/dmaster/Urusan.vue');
// const Organisasi = () => import ('./pages/dmaster/Organisasi.vue');
// const UnitKerja = () => import ('./pages/dmaster/UnitKerja.vue');
// const PaguAnggaranOPD = () => import ('./pages/dmaster/PaguAnggaranOPD.vue');

import DashboardFront from './pages/DashboardFront.vue';
import FormValidation from './pages/FormValidation.vue';

// DATA MASTER
import KelompokUrusan from './pages/dmaster/KelompokUrusan.vue';
import Urusan from './pages/dmaster/Urusan.vue';
import Organisasi from './pages/dmaster/Organisasi.vue';
import UnitKerja from './pages/dmaster/UnitKerja.vue';
import PaguAnggaranOPD from './pages/dmaster/PaguAnggaranOPD.vue';

export const routes =  [
    {
        path: '/',
        meta:{
            title: "DASHBOARD"
        },
        component: DashboardFront
    },
    {
        path: '/formvalidation',
        meta:{
            title: "LATIHAN FORM VALIDATION"
        },
        component: FormValidation
    },
    // DATA MASTER
    {
        path: '/dmaster/kelompokurusan',
        meta:{
            title: "KELOMPOK URUSAN"
        },
        component: KelompokUrusan
    },
    {
        path: '/dmaster/urusan',
        meta:{
            title: "URUSAN"
        },
        component: Urusan
    },    
    {
        path: '/dmaster/organisasi',
        meta:{
            title: "OPD / SKPD"
        },
        component: Organisasi
    }, 
    {
        path: '/dmaster/unitkerja',
        meta:{
            title: "UNIT KERJA"
        },
        component: UnitKerja
    }, 
    {
        path: '/dmaster/paguanggaranopd',
        meta:{
            title: "PAGU ANGGARAN OPD / SKPD"
        },
        component: PaguAnggaranOPD
    },    
];