require('./bootstrap');
window.Vue = require('vue');

//vue route
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const DashboardFront = () => import ('./pages/DashboardFront.vue');
const MasterPaguAnggaranOPD = () => import ('./pages/dmaster/MasterPaguAnggaranOPD.vue');

let routes = [
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
]

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next();
});
// vue state management
import 'es6-promise/auto';
import Vuex from 'vuex';
Vue.use(Vuex);

const cache = new Vuex.Store({
    
});

import AutoNumeric from 'autonumeric';
//format uang
Vue.filter("formatUang",function (value){
    var options = {
                    allowDecimalPadding: false,
                    emptyInputBehavior:'zero',
                    decimalCharacter: ",",
                    digitGroupSeparator: ".",
                    showWarnings:false
    };
    return AutoNumeric.format(value,options);
});
Vue.filter("formatAngka",function (value){
    var options = {
                    allowDecimalPadding: false,
                    emptyInputBehavior:'zero',
                    decimalCharacter: ",",
                    digitGroupSeparator: ".",
                    showWarnings:false
    };
    return AutoNumeric.format(value,options);
});

const app = new Vue({
    el: '#app',
    cache,
    router,
});
