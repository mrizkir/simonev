// const DashboardFront = () => import ('./pages/DashboardFront.vue');
// const FormValidation = () => import ('./pages/FormValidation.vue');
// const MasterPaguAnggaranOPD = () => import ('./pages/dmaster/MasterPaguAnggaranOPD.vue');

import DashboardFront from './pages/DashboardFront.vue';
import FormValidation from './pages/FormValidation.vue';
import MasterPaguAnggaranOPD from './pages/dmaster/MasterPaguAnggaranOPD.vue';

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
    {
        path: '/dmaster/paguanggaranopd',
        meta:{
            title: "PAGU ANGGARAN OPD / SKPD"
        },
        component: MasterPaguAnggaranOPD
    },    
];