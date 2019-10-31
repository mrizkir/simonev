require('./bootstrap');
window.Vue = require('vue');

//vue route
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const DashboardFront = () => import ('./pages/DashboardFront.vue');

let routes = [
    {
        path: '/',
        meta:{
            title: "DASHBOARD"
        },
        component: DashboardFront
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

const app = new Vue({
    el: '#app',
    cache,
    router,
});
