(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-4a87b37c"],{9388:function(t,a,e){"use strict";var i=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",[e("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[e("v-spacer"),e("strong",[t._t("system-bar")],2)],1),e("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[e("v-app-bar-nav-icon",{staticClass:"grey--text",class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(a){a.stopPropagation(),t.drawer=!t.drawer}}}),e("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(a){a.stopPropagation(),t.$router.push("/dashboard/"+t.$store.getters["auth/AccessToken"]).catch((function(t){}))}}},[e("span",{staticClass:"hidden-sm-and-down"},[t._v(" "+t._s(t.NamaAPPAlias)+" ")])]),e("v-spacer"),e("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:t._u([{key:"activator",fn:function(a){var i=a.on;return[e("v-avatar",{attrs:{size:"30"}},[e("v-img",t._g({attrs:{src:t.photoUser}},i))],1)]}}])},[e("v-list",[e("v-list-item",[e("v-list-item-avatar",[e("v-img",{attrs:{src:t.photoUser}})],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),e("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),e("v-divider"),e("v-list-item",{attrs:{to:"/system-users/profil"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-title",[t._v("Profil")])],1),e("v-divider"),e("v-list-item",{on:{click:function(a){return a.preventDefault(),t.logout(a)}}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-power")])],1),e("v-list-item-title",[t._v("Logout")])],1)],1)],1),e("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),e("v-app-bar-nav-icon",{on:{click:function(a){a.stopPropagation(),t.drawerRight=!t.drawerRight}}},[e("v-icon",[t._v("mdi-menu-open")])],1)],1),e("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",temporary:t.temporaryleftsidebar,app:""},model:{value:t.drawer,callback:function(a){t.drawer=a},expression:"drawer"}},[e("v-list-item",[e("v-list-item-avatar",[e("v-img",{attrs:{src:t.photoUser},on:{click:function(a){return a.stopPropagation(),t.toProfile(a)}}})],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),e("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),e("v-divider"),e("v-list",{attrs:{expand:""}},[t.CAN_ACCESS("BELANJA-GROUP_BROWSE")?e("v-list-item",{staticClass:"yellow",attrs:{to:{path:"/belanjamurni"},link:"",color:"green"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-home-floor-b")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v("BOARD BELANJA MURNI")])],1)],1):t._e(),e("v-divider"),t.CAN_ACCESS("RKA MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/datamentah"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-database")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" DATA MENTAH ")])],1)],1):t._e(),e("v-subheader",[t._v("TRANSAKSI")]),t.CAN_ACCESS("RKA MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/rka"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-graph")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" RKA MURNI ")])],1)],1):t._e(),e("v-subheader",[t._v("LAPORAN")]),t.CAN_ACCESS("FORM A MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/report/forma"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-graph")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" FORM A ")])],1)],1):t._e(),t.CAN_ACCESS("FORM B MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/report/formbopd"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-graph")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" FORM B OPD ")])],1)],1):t._e(),t.CAN_ACCESS("FORM B MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/report/formbunitkerja"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-graph")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" FORM B UNIT KERJA ")])],1)],1):t._e(),e("v-subheader",[t._v("STATISTIK")]),e("v-list-item",{attrs:{to:"/belanjamurni/statistik/peringkatopd",link:""}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-chart-timeline-variant")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v("PERINGKAT OPD")])],1)],1)],1)],1),t.showrightsidebar?e("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:t.drawerRight,callback:function(a){t.drawerRight=a},expression:"drawerRight"}},[e("v-list",{attrs:{dense:""}},[e("v-list-item",[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-menu-open")])],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" OPTIONS ")])],1)],1),e("v-divider"),e("v-list-item",{staticClass:"teal lighten-5 mb-5"},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-filter")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v("FILTER")])],1)],1),t._t("filtersidebar")],2)],1):t._e(),e("v-main",{staticClass:"mx-4 mb-4"},[t._t("default")],2),e("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[e("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[e("v-divider"),e("v-card-text",{staticClass:"py-2 white--text text-center"},[e("strong",[t._v(t._s(t.NamaAPP)+" (2019-2020)")]),t._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),e("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev"}},[e("v-icon",[t._v("mdi-github")])],1)],1)],1)],1)],1)},s=[],r=(e("ac1f"),e("5319"),e("5530")),n=e("2f62"),o={name:"BelanjaMurniLayout",props:{showrightsidebar:{type:Boolean,default:!0},temporaryleftsidebar:{type:Boolean,default:!1}},data:function(){return{loginTime:0,drawer:null,drawerRight:null}},methods:{logout:function(){var t=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")})).catch((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")}))}},computed:Object(r["a"])(Object(r["a"])(Object(r["a"])({},Object(n["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"})),Object(n["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var t,a=this.ATTRIBUTE_USER("foto");return t=""==a?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+a,t}}),watch:{loginTime:{handler:function(t){var a=this;t>=0?setTimeout((function(){a.loginTime=1==a.AUTHENTICATED?a.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,c=e("2877"),v=e("6544"),u=e.n(v),d=e("40dc"),m=e("5bc1"),g=e("8212"),h=e("8336"),p=e("b0af"),_=e("99d9"),f=e("ce7e"),k=e("553a"),b=e("132d"),A=e("adda"),R=e("8860"),C=e("da13"),T=e("8270"),P=e("5d23"),S=e("34c3"),w=e("f6c4"),x=e("e449"),E=e("f774"),N=e("2fa4"),$=e("e0c7"),O=e("afd9"),V=e("2a7f"),I=Object(c["a"])(l,i,s,!1,null,null,null);a["a"]=I.exports;u()(I,{VAppBar:d["a"],VAppBarNavIcon:m["a"],VAvatar:g["a"],VBtn:h["a"],VCard:p["a"],VCardText:_["c"],VDivider:f["a"],VFooter:k["a"],VIcon:b["a"],VImg:A["a"],VList:R["a"],VListItem:C["a"],VListItemAvatar:T["a"],VListItemContent:P["a"],VListItemIcon:S["a"],VListItemSubtitle:P["b"],VListItemTitle:P["c"],VMain:w["a"],VMenu:x["a"],VNavigationDrawer:E["a"],VSpacer:N["a"],VSubheader:$["a"],VSystemBar:O["a"],VToolbarTitle:V["b"]})},eef3:function(t,a,e){"use strict";e.r(a);var i=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("BelanjaMurniLayout",{attrs:{temporaryleftsidebar:!0},scopedSlots:t._u([{key:"system-bar",fn:function(){return[t._v(" Tahun Anggaran: "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" | Bulan Realisasi:"+t._s(t.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0}])},[e("v-container",{attrs:{fluid:""}},[e("v-row",{attrs:{dense:""}},[e("v-col",{attrs:{cols:"12"}},[e("v-alert",{attrs:{type:"info"}},[t._v(" Nilai persen realisasi keuangan tetap muncul 0% bila kurang dari 0.01% ")])],1)],1),e("v-row",{attrs:{dense:""}},[e("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[e("v-card",{attrs:{color:"#385F73",dark:""}},[e("v-card-title",{staticClass:"headline"},[t._v(" APBD "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" "),e("v-spacer"),e("v-icon",{attrs:{large:""},on:{click:function(a){return a.stopPropagation(),t.loadstatistik1(a)}}},[t._v(" mdi-database-refresh ")])],1),e("v-card-subtitle",[t._v(" Total Pagu APBD Murni TA "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" ")]),e("v-card-text",[t._v(" "+t._s(t._f("formatUang")(t.statistik1.PaguDana1))+" ")]),e("v-card-actions",[e("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:t.statistik1.PersenRealisasiKeuangan1,callback:function(a){t.$set(t.statistik1,"PersenRealisasiKeuangan1",a)},expression:"statistik1.PersenRealisasiKeuangan1"}})],1)],1)],1),t.$vuetify.breakpoint.xsOnly?e("v-responsive",{attrs:{width:"100%"}}):t._e(),e("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[e("v-card",{attrs:{color:"#385F73",dark:""}},[e("v-card-title",{staticClass:"headline"},[t._v(" PROG. DAN KEG. "),e("v-spacer"),e("v-icon",{attrs:{large:""},on:{click:function(a){return a.stopPropagation(),t.loadstatistik1(a)}}},[t._v(" mdi-database-refresh ")])],1),e("v-card-subtitle",[t._v(" Jumlah Program dan Kegiatan TA "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" ")]),e("v-card-text",[t._v(" Prog.: "+t._s(t.statistik1.JumlahProgram1)+" / Keg.: "+t._s(t.statistik1.JumlahKegiatan1)+" ")]),e("v-card-actions",[e("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:t.statistik1.PersenRealisasiKeuangan1,callback:function(a){t.$set(t.statistik1,"PersenRealisasiKeuangan1",a)},expression:"statistik1.PersenRealisasiKeuangan1"}})],1)],1)],1),t.$vuetify.breakpoint.xsOnly?e("v-responsive",{attrs:{width:"100%"}}):t._e(),e("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[e("v-card",{attrs:{color:"#385F73",dark:""}},[e("v-card-title",{staticClass:"headline"},[t._v(" KEUANGAN "),e("v-spacer"),e("v-icon",{attrs:{large:""},on:{click:function(a){return a.stopPropagation(),t.loadstatistik1(a)}}},[t._v(" mdi-database-refresh ")])],1),e("v-card-subtitle",[t._v(" Realisasi Keuangan TA "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" ")]),e("v-card-text",[t._v(" "+t._s(t._f("formatUang")(t.statistik1.RealisasiKeuangan1))+" ("+t._s(t.statistik1.PersenRealisasiKeuangan1)+"%) ")]),e("v-card-actions",[e("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:t.statistik1.PersenRealisasiKeuangan1,callback:function(a){t.$set(t.statistik1,"PersenRealisasiKeuangan1",a)},expression:"statistik1.PersenRealisasiKeuangan1"}})],1)],1)],1),t.$vuetify.breakpoint.xsOnly?e("v-responsive",{attrs:{width:"100%"}}):t._e(),e("v-col",{attrs:{xs:"12",sm:"6",md:"3"}},[e("v-card",{attrs:{color:"#385F73",dark:""}},[e("v-card-title",{staticClass:"headline"},[t._v(" FISIK "),e("v-spacer"),e("v-icon",{attrs:{large:""},on:{click:function(a){return a.stopPropagation(),t.loadstatistik1(a)}}},[t._v(" mdi-database-refresh ")])],1),e("v-card-subtitle",[t._v(" Realisasi Fisik TA "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" ")]),e("v-card-text",[t._v(" "+t._s(t.statistik1.RealisasiFisik1)+" % ")]),e("v-card-actions",[e("v-progress-linear",{attrs:{color:"success","background-color":"error"},model:{value:t.statistik1.RealisasiFisik1,callback:function(a){t.$set(t.statistik1,"RealisasiFisik1",a)},expression:"statistik1.RealisasiFisik1"}})],1)],1)],1),t.$vuetify.breakpoint.xsOnly?e("v-responsive",{attrs:{width:"100%"}}):t._e()],1),e("v-row",{attrs:{dense:""}},[e("v-col",{attrs:{cols:"12"}},[e("v-card",{staticClass:"mb-2"},[e("v-card-title",{staticClass:"headline"},[t._v(" Progres Realisasi Keuangan "),e("v-spacer"),e("v-icon",{attrs:{large:""},on:{click:function(a){return a.stopPropagation(),t.loadstatistik2(a)}}},[t._v(" mdi-database-refresh ")])],1),e("v-card-text",[t.chartLoaded?e("chart-realisasi-keuangan",{attrs:{datagrafik:t.chartrealisasikeuangan}}):t._e()],1)],1)],1)],1),e("v-row",{attrs:{dense:""}},[e("v-col",{attrs:{cols:"12"}},[e("v-card",{staticClass:"mb-2"},[e("v-card-title",{staticClass:"headline"},[t._v(" Progres Realisasi Fisik "),e("v-spacer"),e("v-icon",{attrs:{large:""},on:{click:function(a){return a.stopPropagation(),t.loadstatistik2(a)}}},[t._v(" mdi-database-refresh ")])],1),e("v-card-text",[t.chartLoaded?e("chart-realisasi-fisik",{attrs:{datagrafik:t.chartrealisasifisik}}):t._e()],1)],1)],1)],1)],1)],1)},s=[],r=(e("96cf"),e("1da1")),n=e("9388"),o=e("ace6"),l={name:"BelanjaMurni",created:function(){this.tahun_anggaran=this.$store.getters["uifront/getTahunAnggaran"],this.bulan_realisasi=this.$store.getters["uifront/getBulanRealisasi"],this.initialize()},methods:{initialize:function(){var t=this;return Object(r["a"])(regeneratorRuntime.mark((function a(){return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return a.next=2,t.$ajax.post("/belanjamurni",{ta:t.tahun_anggaran,bulan_realisasi:t.bulan_realisasi},{headers:{Authorization:t.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.statistik1=e.statistik1;var i=e.chart_keuangan,s=e.chart_fisik;t.chartrealisasikeuangan[0]=i[0],t.chartrealisasikeuangan[1]=i[1],t.chartrealisasifisik[0]=s[0],t.chartrealisasifisik[1]=s[1],t.chartLoaded=!0}));case 2:case"end":return a.stop()}}),a)})))()},loadstatistik1:function(){var t=this;return Object(r["a"])(regeneratorRuntime.mark((function a(){return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return a.next=2,t.$ajax.post("/belanjamurni/reloadstatistik1",{ta:t.tahun_anggaran},{headers:{Authorization:t.$store.getters["auth/Token"]}}).then((function(){t.$router.go()}));case 2:case"end":return a.stop()}}),a)})))()},loadstatistik2:function(){var t=this;return Object(r["a"])(regeneratorRuntime.mark((function a(){return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return a.next=2,t.$ajax.post("/belanjamurni/reloadstatistik2",{ta:t.tahun_anggaran},{headers:{Authorization:t.$store.getters["auth/Token"]}}).then((function(){t.$router.go()}));case 2:case"end":return a.stop()}}),a)})))()}},data:function(){return{tahun_anggaran:null,bulan_realisasi:null,statistik1:{PaguDana1:0,JumlahProgram1:0,JumlahKegiatan1:0,RealisasiKeuangan1:0,RealisasiFisik1:0},chartLoaded:!1,chartrealisasikeuangan:[[],[]],chartrealisasifisik:[[],[]]}},components:{BelanjaMurniLayout:n["a"],"chart-realisasi-keuangan":o["a"],"chart-realisasi-fisik":o["a"]}},c=l,v=e("2877"),u=e("6544"),d=e.n(u),m=e("0798"),g=e("b0af"),h=e("99d9"),p=e("62ad"),_=e("a523"),f=e("132d"),k=e("8e36"),b=e("6b53"),A=e("0fd9"),R=e("2fa4"),C=Object(v["a"])(c,i,s,!1,null,null,null);a["default"]=C.exports;d()(C,{VAlert:m["a"],VCard:g["a"],VCardActions:h["a"],VCardSubtitle:h["b"],VCardText:h["c"],VCardTitle:h["d"],VCol:p["a"],VContainer:_["a"],VIcon:f["a"],VProgressLinear:k["a"],VResponsive:b["a"],VRow:A["a"],VSpacer:R["a"]})}}]);