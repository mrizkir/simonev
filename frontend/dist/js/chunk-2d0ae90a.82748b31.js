(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0ae90a"],{"0b35":function(a,t,s){"use strict";s.r(t);var i=function(){var a=this,t=a.$createElement,s=a._self._c||t;return s("FrontLayout",{scopedSlots:a._u([{key:"system-bar",fn:function(){return[a._v(" Tahun Anggaran: "+a._s(a.tahun_anggaran)+" | Bulan Realisasi:"+a._s(a.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0},{key:"filtersidebar",fn:function(){return[s("Filter1",{ref:"filter1",on:{changeTahunAnggaran:a.changeTahunAnggaran,changeBulanRealisasi:a.changeBulanRealisasi}})]},proxy:!0}])},[s("v-container",{attrs:{fluid:""}},[s("v-row",{attrs:{dense:""}},[s("v-col",{attrs:{cols:"12"}},[s("v-alert",{attrs:{type:"info"}},[a._v(" Nilai persen realisasi keuangan tetap muncul 0% bila kurang dari 0.01% ")])],1)],1),s("v-row",{attrs:{dense:""}},[s("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[s("v-card",{attrs:{color:"#385F73",dark:""}},[s("v-card-title",{staticClass:"headline"},[a._v(" APBD MURNI ")]),s("v-card-subtitle",[a._v(" Total Pagu APBD ")]),s("v-card-text",[a._v(" "+a._s(a._f("formatUang")(a.statistik1_murni.PaguDana1))+" ")]),s("v-card-actions",[s("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:a.statistik1_murni.PersenRealisasiKeuangan1,callback:function(t){a.$set(a.statistik1_murni,"PersenRealisasiKeuangan1",t)},expression:"statistik1_murni.PersenRealisasiKeuangan1"}})],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e(),s("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[s("v-card",{attrs:{color:"#385F73",dark:""}},[s("v-card-title",{staticClass:"headline"},[a._v(" PROG. DAN KEG. ")]),s("v-card-subtitle",[a._v(" Jumlah Program dan Keg. ")]),s("v-card-text",[a._v(" Prog.: "+a._s(a.statistik1_murni.JumlahProgram1)+" / Keg.: "+a._s(a.statistik1_murni.JumlahKegiatan1)+" ")]),s("v-card-actions",[s("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:a.statistik1_murni.PersenRealisasiKeuangan1,callback:function(t){a.$set(a.statistik1_murni,"PersenRealisasiKeuangan1",t)},expression:"statistik1_murni.PersenRealisasiKeuangan1"}})],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e(),s("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[s("v-card",{attrs:{color:"#385F73",dark:""}},[s("v-card-title",{staticClass:"headline"},[a._v(" KEUANGAN ")]),s("v-card-subtitle",[a._v(" Realisasi Keuangan ")]),s("v-card-text",[a._v(" "+a._s(a._f("formatUang")(a.statistik1_murni.RealisasiKeuangan1))+" ("+a._s(a.statistik1_murni.PersenRealisasiKeuangan1)+"%) ")]),s("v-card-actions",[s("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:a.statistik1_murni.PersenRealisasiKeuangan1,callback:function(t){a.$set(a.statistik1_murni,"PersenRealisasiKeuangan1",t)},expression:"statistik1_murni.PersenRealisasiKeuangan1"}})],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e(),s("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[s("v-card",{attrs:{color:"#385F73",dark:""}},[s("v-card-title",{staticClass:"headline"},[a._v(" FISIK ")]),s("v-card-subtitle",[a._v(" Realisasi Fisik ")]),s("v-card-text",[a._v(" "+a._s(a.statistik1_murni.RealisasiFisik1)+"% ")]),s("v-card-actions",[s("v-progress-linear",{attrs:{value:a.statistik1_murni.RealisasiFisik1,color:"success","background-color":"error"}})],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e()],1),s("v-row",{attrs:{dense:""}},[s("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[s("v-card",{attrs:{color:"#952175",dark:""}},[s("v-card-title",{staticClass:"headline"},[a._v(" APBD PERUBAHAN ")]),s("v-card-subtitle",[a._v(" Total Pagu APBD ")]),s("v-card-text",[a._v(" "+a._s(a._f("formatUang")(a.statistik1_perubahan.PaguDana2))+" ")]),s("v-card-actions",[s("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:a.statistik1_perubahan.PersenRealisasiKeuangan2,callback:function(t){a.$set(a.statistik1_perubahan,"PersenRealisasiKeuangan2",t)},expression:"statistik1_perubahan.PersenRealisasiKeuangan2"}})],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e(),s("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[s("v-card",{attrs:{color:"#952175",dark:""}},[s("v-card-title",{staticClass:"headline"},[a._v(" PROG. DAN KEG. ")]),s("v-card-subtitle",[a._v(" Jumlah Program dan Keg. ")]),s("v-card-text",[a._v(" Prog.: "+a._s(a.statistik1_perubahan.JumlahProgram2)+" / Keg.: "+a._s(a.statistik1_perubahan.JumlahKegiatan2)+" ")]),s("v-card-actions",[s("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:a.statistik1_perubahan.PersenRealisasiKeuangan2,callback:function(t){a.$set(a.statistik1_perubahan,"PersenRealisasiKeuangan2",t)},expression:"statistik1_perubahan.PersenRealisasiKeuangan2"}})],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e(),s("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[s("v-card",{attrs:{color:"#952175",dark:""}},[s("v-card-title",{staticClass:"headline"},[a._v(" KEUANGAN ")]),s("v-card-subtitle",[a._v(" Realisasi Keuangan ")]),s("v-card-text",[a._v(" "+a._s(a._f("formatUang")(a.statistik1_perubahan.RealisasiKeuangan2))+" ("+a._s(a.statistik1_perubahan.PersenRealisasiKeuangan2)+"%) ")]),s("v-card-actions",[s("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:a.statistik1_perubahan.PersenRealisasiKeuangan2,callback:function(t){a.$set(a.statistik1_perubahan,"PersenRealisasiKeuangan2",t)},expression:"statistik1_perubahan.PersenRealisasiKeuangan2"}})],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e(),s("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[s("v-card",{attrs:{color:"#952175",dark:""}},[s("v-card-title",{staticClass:"headline"},[a._v(" FISIK ")]),s("v-card-subtitle",[a._v(" Realisasi Fisik ")]),s("v-card-text",[a._v(" "+a._s(a.statistik1_perubahan.RealisasiFisik2)+"% ")]),s("v-card-actions",[s("v-progress-linear",{attrs:{value:a.statistik1_perubahan.RealisasiFisik2,color:"success","background-color":"error"}})],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e()],1),s("v-row",{attrs:{dense:""}},[s("v-col",{attrs:{xs:"12",sm:"12",md:"6"}},[s("v-card",{staticClass:"mb-2"},[s("v-card-title",{staticClass:"headline"},[a._v(" Progres Realisasi Keuangan Murni ")]),s("v-card-text",[a.chartLoaded?s("chart-realisasi-keuangan",{attrs:{datagrafik:a.chartrealisasikeuangan_murni}}):a._e()],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e(),s("v-col",{attrs:{xs:"12",sm:"12",md:"6"}},[s("v-card",{staticClass:"mb-2"},[s("v-card-title",{staticClass:"headline"},[a._v(" Progres Realisasi Keuangan Perubahan ")]),s("v-card-text",[a.chartLoaded?s("chart-realisasi-fisik",{attrs:{datagrafik:a.chartrealisasikeuangan_perubahan}}):a._e()],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e()],1),s("v-row",{attrs:{dense:""}},[s("v-col",{attrs:{xs:"12",sm:"12",md:"6"}},[s("v-card",{staticClass:"mb-2"},[s("v-card-title",{staticClass:"headline"},[a._v(" Progres Realisasi Fisik Murni ")]),s("v-card-text",[a.chartLoaded?s("chart-realisasi-keuangan",{attrs:{datagrafik:a.chartrealisasifisik_murni}}):a._e()],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e(),s("v-col",{attrs:{xs:"12",sm:"12",md:"6"}},[s("v-card",{staticClass:"mb-2"},[s("v-card-title",{staticClass:"headline"},[a._v(" Progres Realisasi Fisik Perubahan ")]),s("v-card-text",[a.chartLoaded?s("chart-realisasi-fisik",{attrs:{datagrafik:a.chartrealisasifisik_perubahan}}):a._e()],1)],1)],1),a.$vuetify.breakpoint.xsOnly?s("v-responsive",{attrs:{width:"100%"}}):a._e()],1)],1)],1)},e=[],r=(s("96cf"),s("1da1")),n=function(){var a=this,t=a.$createElement,s=a._self._c||t;return s("div",[s("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[s("v-spacer"),s("strong",[a._t("system-bar")],2)],1),s("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[s("v-app-bar-nav-icon",{class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(t){t.stopPropagation(),a.drawer=!a.drawer}}}),s("v-toolbar-title",[s("span",{staticClass:"hidden-sm-and-down"},[a._v(" "+a._s(a.NamaAPPAlias)+" ")])]),s("v-spacer"),s("v-toolbar-items",{staticClass:"hidden-sm-and-down"},[s("v-btn",{attrs:{to:"/login",color:"white",text:"",large:""}},[a._v(" LOGIN ")])],1),a.$vuetify.breakpoint.xsOnly?s("v-menu",{staticClass:"hidden-md-and-up",scopedSlots:a._u([{key:"activator",fn:function(t){var i=t.on;return[s("v-btn",a._g({attrs:{icon:""}},i),[s("v-icon",[a._v("mdi-dots-vertical")])],1)]}}],null,!1,2097855828)},[s("v-list",[s("v-list-item",{attrs:{to:"/login"}},[s("v-list-item-title",[a._v("LOGIN")])],1)],1)],1):a._e(),s("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),s("v-app-bar-nav-icon",{on:{click:function(t){t.stopPropagation(),a.drawerRight=!a.drawerRight}}},[s("v-icon",[a._v("mdi-menu-open")])],1)],1),s("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",temporary:a.temporaryleftsidebar,app:""},model:{value:a.drawer,callback:function(t){a.drawer=t},expression:"drawer"}},[s("v-list-item",[s("v-list-item-avatar",[s("v-img",{attrs:{src:a.photoUser}})],1),s("v-list-item-content",[s("v-list-item-title",{staticClass:"title"},[a._v(" GUEST ")]),s("v-list-item-subtitle",[a._v(" GUEST ")])],1)],1),s("v-divider")],1),a.showrightsidebar?s("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:a.drawerRight,callback:function(t){a.drawerRight=t},expression:"drawerRight"}},[s("v-list",{attrs:{dense:""}},[s("v-list-item",[s("v-list-item-icon",{staticClass:"mr-2"},[s("v-icon",[a._v("mdi-menu-open")])],1),s("v-list-item-content",[s("v-list-item-title",{staticClass:"title"},[a._v(" OPTIONS ")])],1)],1),s("v-divider"),s("v-list-item",{staticClass:"primary",attrs:{dark:""}},[s("v-list-item-icon",{staticClass:"mr-2"},[s("v-icon",[a._v("mdi-filter")])],1),s("v-list-item-content",[s("v-list-item-title",[a._v("FILTER")])],1)],1),a._t("filtersidebar"),s("v-list-item",{staticClass:"primary",attrs:{dark:""}},[s("v-list-item-icon",{staticClass:"mr-2"},[s("v-icon",[a._v("mdi-filter")])],1),s("v-list-item-content",[s("v-list-item-title",[a._v("OTHER")])],1)],1),s("v-list-item",[s("v-list-item-content",[s("v-btn",{attrs:{color:"danger"},on:{click:function(t){return t.stopPropagation(),a.resetCache(t)}}},[a._v(" RESET CACHE ")])],1)],1)],2)],1):a._e(),s("v-main",{staticClass:"mx-4 mb-4"},[a._t("default")],2),s("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[s("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[s("v-divider"),s("v-card-text",{staticClass:"py-2 white--text text-center"},[s("strong",[a._v(a._s(a.NamaAPP)+" (2019-2020)")]),a._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),s("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev-vuetify"}},[s("v-icon",[a._v("mdi-github")])],1)],1)],1)],1)],1)},l=[],o=s("5530"),c=s("2f62"),u={name:"FrontLayout",props:{showrightsidebar:{type:Boolean,default:!0},temporaryleftsidebar:{type:Boolean,default:!0}},data:function(){return{drawer:null,drawerRight:null}},methods:{resetCache:function(){this.$store.dispatch("uifront/reinit"),this.$router.go()}},computed:Object(o["a"])(Object(o["a"])({},Object(c["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var a=this.$api.url+"/storage/images/users/no_photo.png";return a}})},d=u,v=s("2877"),h=s("6544"),g=s.n(h),_=s("40dc"),m=s("5bc1"),p=s("8336"),f=s("b0af"),k=s("99d9"),b=s("ce7e"),R=s("553a"),x=s("132d"),P=s("adda"),A=s("8860"),w=s("da13"),C=s("8270"),y=s("5d23"),K=s("34c3"),$=s("f6c4"),V=s("e449"),T=s("f774"),I=s("2fa4"),L=s("afd9"),N=s("2a7f"),O=Object(v["a"])(d,n,l,!1,null,null,null),S=O.exports;g()(O,{VAppBar:_["a"],VAppBarNavIcon:m["a"],VBtn:p["a"],VCard:f["a"],VCardText:k["c"],VDivider:b["a"],VFooter:R["a"],VIcon:x["a"],VImg:P["a"],VList:A["a"],VListItem:w["a"],VListItemAvatar:C["a"],VListItemContent:y["a"],VListItemIcon:K["a"],VListItemSubtitle:y["b"],VListItemTitle:y["c"],VMain:$["a"],VMenu:V["a"],VNavigationDrawer:T["a"],VSpacer:I["a"],VSystemBar:L["a"],VToolbarItems:N["a"],VToolbarTitle:N["b"]});var B=function(){var a=this,t=a.$createElement,s=a._self._c||t;return s("v-list-item",[s("v-list-item-content",[s("v-select",{attrs:{items:a.daftar_ta,label:"TAHUN ANGGARAN",outlined:""},model:{value:a.tahun_anggaran,callback:function(t){a.tahun_anggaran=t},expression:"tahun_anggaran"}}),s("v-select",{attrs:{items:a.daftar_bulan,label:"BULAN REALISASI",outlined:""},model:{value:a.bulan_realisasi,callback:function(t){a.bulan_realisasi=t},expression:"bulan_realisasi"}})],1)],1)},F=[],E={name:"FilterMode1",created:function(){this.daftar_ta=this.$store.getters["uifront/getDaftarTA"],this.tahun_anggaran=this.$store.getters["uifront/getTahunAnggaran"],this.daftar_bulan=this.$store.getters["uifront/getDaftarBulan"],this.bulan_realisasi=this.$store.getters["uifront/getBulanRealisasi"]},data:function(){return{firstloading:!0,daftar_bulan:[],bulan_realisasi:null,daftar_ta:[],tahun_anggaran:null}},methods:{setFirstTimeLoading:function(a){this.firstloading=a}},watch:{tahun_anggaran:function(a){this.firstloading||(this.$store.dispatch("uifront/updateTahunAnggaran",a),this.$emit("changeTahunAnggaran",a))},bulan_realisasi:function(a){this.firstloading||(this.$store.dispatch("uifront/updateBulanRealisasi",a),this.$emit("changeBulanRealisasi",a))}}},D=E,G=s("b974"),U=Object(v["a"])(D,B,F,!1,null,null,null),J=U.exports;g()(U,{VListItem:w["a"],VListItemContent:y["a"],VSelect:G["a"]});var j=s("ace6"),M={name:"DashboardFront",created:function(){this.$store.dispatch("uifront/init",this.$ajax),this.tahun_anggaran=this.$store.getters["uifront/getTahunAnggaran"],this.bulan_realisasi=this.$store.getters["uifront/getBulanRealisasi"]},mounted:function(){this.initialize(),this.firstloading=!1,this.$refs.filter1.setFirstTimeLoading(this.firstloading)},data:function(){return{firstloading:!0,tahun_anggaran:null,bulan_realisasi:null,statistik1_murni:{PaguDana1:0,JumlahProgram1:0,JumlahKegiatan1:0,RealisasiKeuangan1:0,RealisasiFisik1:0},statistik1_perubahan:{PaguDana2:0,JumlahProgram2:0,JumlahKegiatan2:0,RealisasiKeuangan2:0,RealisasiFisik2:0},chartLoaded:!1,chartrealisasikeuangan_murni:[[],[]],chartrealisasikeuangan_perubahan:[[],[]],chartrealisasifisik_murni:[[],[]],chartrealisasifisik_perubahan:[[],[]]}},methods:{changeTahunAnggaran:function(a){this.tahun_anggaran=a},changeBulanRealisasi:function(a){this.bulan_realisasi=a},initialize:function(){var a=this;return Object(r["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,a.$ajax.post("/dashboard/front",{ta:a.tahun_anggaran,bulan_realisasi:a.bulan_realisasi}).then((function(t){var s=t.data;a.statistik1_murni=s.statistik1_murni,a.statistik1_perubahan=s.statistik1_perubahan,a.chartrealisasikeuangan_murni[0]=s.chart_keuangan_murni[0],a.chartrealisasikeuangan_murni[1]=s.chart_keuangan_murni[1],a.chartrealisasikeuangan_perubahan[0]=s.chart_keuangan_perubahan[0],a.chartrealisasikeuangan_perubahan[1]=s.chart_keuangan_perubahan[1],a.chartrealisasifisik_murni[0]=s.chart_fisik_murni[0],a.chartrealisasifisik_murni[1]=s.chart_fisik_murni[1],a.chartrealisasifisik_perubahan[0]=s.chart_fisik_perubahan[0],a.chartrealisasifisik_perubahan[1]=s.chart_fisik_perubahan[1],a.chartLoaded=!0}));case 2:case"end":return t.stop()}}),t)})))()}},components:{FrontLayout:S,Filter1:J,"chart-realisasi-keuangan":j["a"],"chart-realisasi-fisik":j["a"]},watch:{tahun_anggaran:function(){this.firstloading||this.initialize()},bulan_realisasi:function(){this.firstloading||this.initialize()}}},z=M,H=s("0798"),W=s("62ad"),Y=s("a523"),q=s("8e36"),Q=s("6b53"),X=s("0fd9"),Z=Object(v["a"])(z,i,e,!1,null,null,null);t["default"]=Z.exports;g()(Z,{VAlert:H["a"],VCard:f["a"],VCardActions:k["a"],VCardSubtitle:k["b"],VCardText:k["c"],VCardTitle:k["d"],VCol:W["a"],VContainer:Y["a"],VProgressLinear:q["a"],VResponsive:Q["a"],VRow:X["a"]})}}]);
//# sourceMappingURL=chunk-2d0ae90a.82748b31.js.map