const getDefaultState = () => 
{
    return {      
        loaded:false,   
        daftar_ta:[{
            text:new Date().getFullYear(),
            value:new Date().getFullYear()
        }],
        daftar_bulan:[
            {
                value:1,
                text:'JANUARI'
            },
            {
                value:2,
                text:'FEBRUARI'
            },
            {
                value:3,
                text:'MARET'
            },
            {
                value:4,
                text:'APRIL'
            },
            {
                value:5,
                text:'MEI'
            },
            {
                value:6,
                text:'JUNI'
            },
            {
                value:7,
                text:'JULI'
            },
            {
                value:8,
                text:'AGUSTUS'
            },
            {
                value:9,
                text:'SEPTEMBER'
            },
            {
                value:10,
                text:'OKTOBER'
            },
            {
                value:11,
                text:'NOVEMBER'
            },
            {
                value:12,
                text:'DESEMBER'
            },            
        ],    
        tahun_anggaran:new Date().getFullYear(),
        bulan_realisasi:1,      

        identitas:{
            nama_app:'',
            nama_app_alias:'',
            nama_opd:'',
            nama_opd_alias:''
        }, 

        theme:null
    }
}
const state = getDefaultState();
//mutations
const mutations = {
    setLoaded(state,loaded)
    {
        state.loaded=loaded;
    },
    setDaftarTA(state,daftar)
    {
        state.daftar_ta=daftar;
    },
    setTahunAnggaran(state,tahun)
    {
        state.tahun_anggaran = tahun;
    },    
    setBulanRealisasi(state,bulan)
    {
        state.bulan_realisasi = bulan;
    },
    setIdentitas(state,identitas)
    {
        state.identitas = identitas;
    },    
    setTheme(state,theme)
    {
        state.theme=theme;
    },
    resetState (state) {
        Object.assign(state, getDefaultState())
    }    
}
const getters= {
    isLoaded : state => {
        return state.loaded;
    },
    getDaftarTA: state => 
    {   
        return state.daftar_ta;
    },
    getTahunAnggaran: state => 
    {             
        return state.tahun_anggaran;
    },
    getBulanRealisasi: state => 
    {             
        return parseInt(state.bulan_realisasi);
    },
    getDaftarBulan:state =>
    {
        return state.daftar_bulan;
    },
    getNamaBulan: state => 
    {        
        var no_bulan=parseInt(state.bulan_realisasi);
        var nama_bulan='';
        switch(no_bulan)
        {
            case 1:
                nama_bulan='JANUARI';
            break;
            case 2:
                nama_bulan='FEBRUARI';
            break;
            case 3:
                nama_bulan='MARET';
            break;
            case 4:
                nama_bulan='APRIL';
            break;
            case 5:
                nama_bulan='MEI';
            break;
            case 6:
                nama_bulan='JUNI';
            break;
            case 7:
                nama_bulan='JULI';
            break;
            case 8:
                nama_bulan='AGUSTUS';
            break;
            case 9:
                nama_bulan='SEPTEMBER';
            break;
            case 10:
                nama_bulan='OKTOBER';
            break;
            case 11:
                nama_bulan='NOVEMBER';
            break;            
            case 12:
                nama_bulan='DESEMBER';
            break;
        }
        return nama_bulan;
    },
    getNamaAPP: state => 
    {             
        return state.identitas.nama_app;
    },    
    getNamaAPPAlias: state => 
    {
        return state.identitas.nama_app_alias;
    },
    getNamaOPD: state => 
    {             
        return state.identitas.nama_opd;
    },    
    getNamaOPDAlias: state => 
    {
        return state.identitas.nama_opd_alias;
    },
    getTheme : (state) => (key) =>
    {           
        return state.theme == null?'':state.theme[key];
    },
}
const actions = {
    init: async function ({commit,state},ajax)
    {            
        if (!state.loaded)
        {            
            await ajax.get('/setting/uifront').then(({data})=>{
                commit('setDaftarTA',data.daftar_ta);                                                                        
                commit('setTahunAnggaran',data.tahun_anggaran);                                         
                commit('setBulanRealisasi',data.bulan_realisasi);                                         
                
                commit('setIdentitas',data.identitas); 

                commit('setTheme',data.theme);   

                commit('setLoaded',true);
            })
        }
    },
    updateTahunAnggaran({commit},tahun)
    {
        commit('setTahunAnggaran',tahun);
    },
    updateBulanRealisasi({commit},bulan)
    {
        commit('setBulanRealisasi',bulan);
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