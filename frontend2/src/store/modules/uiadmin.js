//state
const getDefaultState = () => 
{
    return {      
        loaded:false, 
        //page
        default_dashboard:null,
        pages:[],
    }
}
const state = getDefaultState();

//mutations
const mutations = {   
    setNewPage(state, page)
    {
        state.pages.push(page);                
    },
    replacePage (state,page,index)
    {
        state.pages[index]=page;            
    },
    removePage(state,name)
    {
        var i;
        for (i = 0;i < state.pages.length;i++)
        {                
            if(state.pages[i].name==name)
            {
                state.pages.splice(i,1);
                break;
            }
        }
    },  
    setLoaded(state,loaded)
    {
        state.loaded=loaded;
    },
    setDashboard(state,name)
    {
        state.default_dashboard=name;
    },    
    resetState (state) {
        Object.assign(state, getDefaultState())
    }
}
const getters= {
    Page: (state) => (name) => 
    {
        let page = state.pages.find(halaman => halaman.name==name);
        return page;
    },
    AtributeValueOfPage : (state) => (name,key) =>
    {
        let page = state.pages.find(halaman => halaman.name==name);            
        return page[key];
    },  
    getDefaultDashboard: state => 
    {   
        return state.default_dashboard;
    },
}
const actions = {    
    init: async function ({commit,state,rootGetters},ajax)
    {   
        //dipindahkan kesini karena ada beberapa kasus yang melaporkan ini membuat bermasalah.               
        if (!state.loaded && rootGetters['auth/Authenticated'])
        {   
            let token=rootGetters['auth/Token'];                                                     
            await ajax.get('/setting/uiadmin',               
                {
                    headers:{
                        Authorization:token
                    }
                }
            ).then(()=>{                                   
                commit('setLoaded',true);              
            });      
        }
    },
    
    addToPages ({commit,state},page)
    {
        let found = state.pages.find(halaman => halaman.name==page.name);
        if (!found)
        {
            commit('setNewPage',page);
        }
    },    
    updatePage ({commit,state},page)
    {
        var i;
        for (i = 0;i < state.pages.length;i++)
        {                
            if(state.pages[i].name==page.name)
            {
                break;
            }
        }
        commit('replacePage',page,i)
    }, 
    deletePage({commit},name)
    {
        commit('removePage',name);
    },
    changeDashboard({commit},name)
    {        
        commit('setDashboard',name);
    },    
    reinit ({ commit }) 
    {
        commit('resetState');
    },
}
export default {
    namespaced: true,
    state,        
    mutations,
    getters,
    actions
}