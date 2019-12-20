require('./bootstrap');
window.Vue = require('vue');
//component


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
    var tanggal = moment(String(value)).format('DD/MM/YYYY hh:mm');
    return tanggal;
});

const app = new Vue({
    el: '#app',
    store,
    router,
    mounted()
    {
        this.$store.commit('init');
        this.changeMenuItem();        
    },        
    methods: 
    {    
        toggleDMaster(state=0)
        {
            if (state == 0)
            {
                window.$('#liDMaster').removeClass('menu-open');
                window.$('#ulDMaster').css('display','none');                
                window.$('#linkDMaster').removeClass('active');
            }
            else
            {
                window.$('#liDMaster').addClass('menu-open');
                window.$('#linkDMaster').addClass('active');
            }
        }, 
        toggleAPBDMurni(state=0)
        {
            if (state == 0)
            {                
                window.$('#liAPBDMurni').removeClass('menu-open');
                window.$('#ulAPBDMurni').css('display','none');                
                window.$('#linkAPBDMurni').removeClass('active');
            }
            else
            {
                window.$('#liAPBDMurni').addClass('menu-open');
                window.$('#linkAPBDMurni').addClass('active');
            }
        },
        toggleAPBDPerubahan(state=0)
        {
            if (state == 0)
            {                
                window.$('#liAPBDPerubahan').removeClass('menu-open');
                window.$('#ulAPBDPerubahan').css('display','none');                
                window.$('#linkAPBDPerubahan').removeClass('active');
            }
            else
            {
                window.$('#liAPBDPerubahan').addClass('menu-open');
                window.$('#linkAPBDPerubahan').addClass('active');
            }
        },
        changeMenuItem()
        {
            var name = this.$router.currentRoute.name;
            switch (name)
            {
                case 'dashboard':            
                    this.toggleDMaster();
                    this.toggleAPBDMurni();
                    this.toggleAPBDPerubahan();
                break;
                //dmaster
                case 'dmaster_kelompokurusan':
                case 'dmaster_urusan':
                case 'dmaster_organisasi':
                case 'dmaster_unitkerja':
                case 'dmaster_program':
                case 'dmaster_programkegiatan':
                case 'dmaster_transaksi':
                case 'dmaster_kelompok':
                case 'dmaster_jenis':
                case 'dmaster_rincian':
                case 'dmaster_objek':
                case 'dmaster_asn':
                case 'dmaster_asnopd':
                case 'dmaster_paguanggaranopd':
                case 'dmaster_jenispelaksanaan':
                    this.toggleDMaster(1);
                    this.toggleAPBDMurni();
                    this.toggleAPBDPerubahan();
                break;

                //apbd murni
                case 'apbdmurni' :                                   
                case 'apbdmurnicreate' :                        
                case 'apbdmurniuraian' :                        
                case 'apbdmurniuraianpilihrekening' :                        
                case 'apbdmurniuraiancreate' :                        
                case 'apbdmurniuraianrealisasi' :  
                    this.toggleDMaster();
                    this.toggleAPBDMurni(1);
                    this.toggleAPBDPerubahan(0);
                break;
                //apbd perubahan
                case 'apbdperubahan' :                                   
                case 'apbdperubahancreate' :                        
                case 'apbdperubahanuraian' :                        
                case 'apbdperubahanuraianpilihrekening' :                        
                case 'apbdperubahanuraiancreate' :                        
                case 'apbdperubahanuraianrealisasi' : 
                    this.toggleDMaster();
                    this.toggleAPBDMurni();
                    this.toggleAPBDPerubahan(1);
                break;
            }
        }
    }
});
