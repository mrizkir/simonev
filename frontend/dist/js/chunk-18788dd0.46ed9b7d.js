(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-18788dd0"],{"94df":function(t,i,e){"use strict";var s=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",[e("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[e("v-spacer"),e("strong",[t._t("system-bar")],2)],1),e("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[e("v-app-bar-nav-icon",{staticClass:"grey--text",class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(i){i.stopPropagation(),t.drawer=!t.drawer}}}),e("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(i){i.stopPropagation(),t.$router.push("/dashboard/"+t.$store.getters["auth/AccessToken"]).catch((function(t){}))}}},[e("span",{staticClass:"hidden-sm-and-down"},[t._v(" "+t._s(t.NamaAPPAlias)+" ")])]),e("v-spacer"),e("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:t._u([{key:"activator",fn:function(i){var s=i.on;return[e("v-avatar",{attrs:{size:"30"}},[e("v-img",t._g({attrs:{src:t.photoUser}},s))],1)]}}])},[e("v-list",[e("v-list-item",[e("v-list-item-avatar",[e("v-img",{attrs:{src:t.photoUser}})],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),e("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),e("v-divider"),e("v-list-item",{attrs:{to:"/system-users/profil"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-title",[t._v("Profil")])],1),e("v-divider"),e("v-list-item",{on:{click:function(i){return i.preventDefault(),t.logout(i)}}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-power")])],1),e("v-list-item-title",[t._v("Logout")])],1)],1)],1),e("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),e("v-app-bar-nav-icon",{on:{click:function(i){i.stopPropagation(),t.drawerRight=!t.drawerRight}}},[e("v-icon",[t._v("mdi-menu-open")])],1)],1),e("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",app:""},model:{value:t.drawer,callback:function(i){t.drawer=i},expression:"drawer"}},[e("v-list-item",[e("v-list-item-avatar",[e("v-img",{attrs:{src:t.photoUser},on:{click:function(i){return i.stopPropagation(),t.toProfile(i)}}})],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),e("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),e("v-divider"),e("v-list",{attrs:{expand:""}},[t.CAN_ACCESS("DMASTER-GROUP")?e("v-list-item",{staticClass:"yellow",attrs:{to:{path:"/dmaster"},link:"",color:"green"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-home-floor-b")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v("BOARD DATA MASTER")])],1)],1):t._e(),e("v-subheader",[t._v("REKENING")]),t.CAN_ACCESS("OPD_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/transaksi"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-decimal")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" TRANSAKSI ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/kelompok"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-decimal")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" KELOMPOK ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/jenis"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-decimal")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" JENIS ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/rincian"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-decimal")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" RINCIAN ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/objek"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-decimal")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" OBJEK ")])],1)],1):t._e(),e("v-subheader",[t._v("ORGANISASI")]),t.CAN_ACCESS("OPD_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/opd"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-office-building")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" OPD ")])],1)],1):t._e(),t.CAN_ACCESS("UNIT KERJA_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/unitkerja"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-domain")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" UNIT KERJA ")])],1)],1):t._e(),e("v-subheader",[t._v("KEGIATAN")]),t.CAN_ACCESS("JENIS PELAKSANAAN_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/jenispelaksanaan"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-road")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" JENIS PELAKSANAAN ")])],1)],1):t._e(),t.CAN_ACCESS("JENIS PEMBANGUNAN_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/jenispembangunan"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-shovel")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" JENIS PEMBANGUNAN ")])],1)],1):t._e(),e("v-subheader",[t._v("PEGAWAI")]),t.CAN_ACCESS("ASN_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/asn"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account-circle-outline")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" ASN ")])],1)],1):t._e(),t.CAN_ACCESS("PEJABAT_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/pejabat"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account-circle")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" PEJABAT ")])],1)],1):t._e(),e("v-subheader",[t._v("LAIN-LAIN")]),t.CAN_ACCESS("SUMBER DANA_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/sumberdana"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-cash-100")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" SUMBER DANA ")])],1)],1):t._e(),t.CAN_ACCESS("TA_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/dmaster/ta"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-calendar-month")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" TAHUN ANGGARAN ")])],1)],1):t._e()],1)],1),t.showrightsidebar?e("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:t.drawerRight,callback:function(i){t.drawerRight=i},expression:"drawerRight"}},[e("v-list",{attrs:{dense:""}},[e("v-list-item",[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-menu-open")])],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" OPTIONS ")])],1)],1),e("v-divider"),e("v-list-item",{staticClass:"teal lighten-5 mb-5"},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-filter")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v("FILTER")])],1)],1),t._t("filtersidebar")],2)],1):t._e(),e("v-main",{staticClass:"mx-4 mb-4"},[t._t("default")],2),e("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[e("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[e("v-divider"),e("v-card-text",{staticClass:"py-2 white--text text-center"},[e("strong",[t._v(t._s(t.NamaAPP)+" (2019-2020)")]),t._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),e("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev-vuetify"}},[e("v-icon",[t._v("mdi-github")])],1)],1)],1)],1)],1)},a=[],n=(e("ac1f"),e("5319"),e("5530")),r=e("2f62"),o={name:"DataMasterLayout",props:{showrightsidebar:{type:Boolean,default:!0}},data:function(){return{loginTime:0,drawer:null,drawerRight:null}},methods:{logout:function(){var t=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")})).catch((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")}))}},computed:Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(r["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"})),Object(r["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var t,i=this.ATTRIBUTE_USER("foto");return t=""==i?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+i,t}}),watch:{loginTime:{handler:function(t){var i=this;t>=0?setTimeout((function(){i.loginTime=1==i.AUTHENTICATED?i.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,c=e("2877"),v=e("6544"),m=e.n(v),d=e("40dc"),u=e("5bc1"),_=e("8212"),A=e("8336"),C=e("b0af"),h=e("99d9"),S=e("ce7e"),p=e("553a"),E=e("132d"),g=e("adda"),N=e("8860"),f=e("da13"),b=e("8270"),T=e("5d23"),k=e("34c3"),R=e("f6c4"),O=e("e449"),I=e("f774"),B=e("2fa4"),P=e("e0c7"),w=e("afd9"),V=e("2a7f"),L=Object(c["a"])(l,s,a,!1,null,null,null);i["a"]=L.exports;m()(L,{VAppBar:d["a"],VAppBarNavIcon:u["a"],VAvatar:_["a"],VBtn:A["a"],VCard:C["a"],VCardText:h["c"],VDivider:S["a"],VFooter:p["a"],VIcon:E["a"],VImg:g["a"],VList:N["a"],VListItem:f["a"],VListItemAvatar:b["a"],VListItemContent:T["a"],VListItemIcon:k["a"],VListItemSubtitle:T["b"],VListItemTitle:T["c"],VMain:R["a"],VMenu:O["a"],VNavigationDrawer:I["a"],VSpacer:B["a"],VSubheader:P["a"],VSystemBar:w["a"],VToolbarTitle:V["b"]})},bb59:function(t,i,e){"use strict";e.r(i);var s=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("DataMasterLayout",{attrs:{showrightsidebar:!1},scopedSlots:t._u([{key:"system-bar",fn:function(){return[t._v(" Tahun Anggaran: "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" | Bulan Realisasi:"+t._s(t.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0}])})},a=[],n=e("94df"),r={name:"DMaster",components:{DataMasterLayout:n["a"]}},o=r,l=e("2877"),c=Object(l["a"])(o,s,a,!1,null,null,null);i["default"]=c.exports}}]);
//# sourceMappingURL=chunk-18788dd0.46ed9b7d.js.map