const DashboardFront = () => import ('./pages/DashboardFront.vue');
const MasterPaguAnggaranOPD = () => import ('./pages/dmaster/MasterPaguAnggaranOPD.vue');

export const routes =  [
    {
        path: '/',
        meta:{
            title: "DASHBOARD"
        },
        component: DashboardFront
    },
    {
        path: '/dmaster/paguanggaranopd',
        meta:{
            title: "PAGU ANGGARAN OPD / SKPD"
        },
        component: MasterPaguAnggaranOPD
    },
];