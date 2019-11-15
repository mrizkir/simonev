require('./bootstrap');
window.Vue = require('vue');

//vue route
import VueRouter from 'vue-router';
import {routes} from './routes';
Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    linkExactActiveClass: "active",
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next();
});

// vue state management
import 'es6-promise/auto';
import Vuex from 'vuex';
import StoreData from './store';
 
Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

//validate
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

//sweat alert
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

//format uang
import AutoNumeric from 'autonumeric';
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

// format tanggal
import moment from 'moment';

Vue.filter('formatTanggal', function(value) {
    return moment(String(value)).format('DD/MM/YYYY hh:mm')
});

const app = new Vue({
    el: '#app',
    store,
    router,
});
