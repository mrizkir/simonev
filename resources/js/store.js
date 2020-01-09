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
            return state.config[name];
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
        init (state) 
        {       
            var config;
            var daftar_bulan=[
                {
                    code:1,
                    label:'Januari'
                },
                {
                    code:2,
                    label:'Februari'
                },
                {
                    code:3,
                    label:'Maret'
                },
                {
                    code:4,
                    label:'April'
                },
                {
                    code:5,
                    label:'Mei'
                },
                {
                    code:6,
                    label:'Juni'
                },
                {
                    code:7,
                    label:'Juli'
                },
                {
                    code:8,
                    label:'Agustus'
                },
                {
                    code:9,
                    label:'September'
                },
                {
                    code:10,
                    label:'Oktober'
                },
                {
                    code:11,
                    label:'September'
                },
                {
                    code:12,
                    label:'Desember'
                }                
            ];
            state.config[0]=daftar_bulan;
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
        },
        removePage(state,page)
        {
            var i;
            var index=0;
            for (i = 0;i < state.pages.length;i++)
            {                
                if(state.pages[i].name==page.name)
                {
                    state.pages.splice(i,1);
                    break;
                }
            }
        }        
    },
    actions:{

    },
    plugins: [vuexLocal.plugin]
}