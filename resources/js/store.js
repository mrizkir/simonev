import VuexPersistence from 'vuex-persist'

const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

export default {
    state: {
        config:[],
        pages:[]
    },
    getters:{
        getConfig: (state) => (name) =>
        {
            
        },
        getPage: (state) => (name) => 
        {
            let page = state.pages.find(halaman => halaman.name==name);
            return page;
        },
        getAtributeValueOfPage : (state) => (name,key) =>
        {
            let page = state.pages.find(halaman => halaman.name==name);            
            return page[key];
        }
    },
    mutations:{
        init (state) {       
            
        },
        addToPages(state, page)
        {
            let found = state.pages.find(halaman => halaman.name==page.name);
            if (!found)
            {
                state.pages.push(page);
            }            
        },
        replacePage (state,page)
        {
            var i;
            var index=0;
            for (i = 0;i < state.pages.length;i++)
            {                
                if(state.pages[i].name==page.name)
                {
                    break;
                }
            }
            state.pages[i]=page;            
        }        
    },
    actions:{

    },
    plugins: [vuexLocal.plugin]
}