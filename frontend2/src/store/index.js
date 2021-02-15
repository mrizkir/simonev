import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'
import Uifront from './modules/uifront'
import Uiadmin from './modules/uiadmin'
import Auth from './modules/auth'

const vuexPersistent = new VuexPersistence({
	key:'simonev3',
	storage: window.localStorage,	
});
Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		uifront:Uifront,
		auth:Auth,
		uiadmin:Uiadmin,
	},
	plugins: [vuexPersistent.plugin]
});
