(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-12f41134"],{1681:function(t,e,a){},"4bd4":function(t,e,a){"use strict";a("4de4"),a("7db0"),a("4160"),a("caad"),a("07ac"),a("2532"),a("159b");var i=a("5530"),s=a("58df"),r=a("7e2b"),n=a("3206");e["a"]=Object(s["a"])(r["a"],Object(n["b"])("form")).extend({name:"v-form",provide:function(){return{form:this}},inheritAttrs:!1,props:{disabled:Boolean,lazyValidation:Boolean,readonly:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(t){var e=Object.values(t).includes(!0);this.$emit("input",!e)},deep:!0,immediate:!0}},methods:{watchInput:function(t){var e=this,a=function(t){return t.$watch("hasError",(function(a){e.$set(e.errorBag,t._uid,a)}),{immediate:!0})},i={_uid:t._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?i.shouldValidate=t.$watch("shouldValidate",(function(s){s&&(e.errorBag.hasOwnProperty(t._uid)||(i.valid=a(t)))})):i.valid=a(t),i},validate:function(){return 0===this.inputs.filter((function(t){return!t.validate(!0)})).length},reset:function(){this.inputs.forEach((function(t){return t.reset()})),this.resetErrorBag()},resetErrorBag:function(){var t=this;this.lazyValidation&&setTimeout((function(){t.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(t){return t.resetValidation()})),this.resetErrorBag()},register:function(t){this.inputs.push(t),this.watchers.push(this.watchInput(t))},unregister:function(t){var e=this.inputs.find((function(e){return e._uid===t._uid}));if(e){var a=this.watchers.find((function(t){return t._uid===e._uid}));a&&(a.valid(),a.shouldValidate()),this.watchers=this.watchers.filter((function(t){return t._uid!==e._uid})),this.inputs=this.inputs.filter((function(t){return t._uid!==e._uid})),this.$delete(this.errorBag,e._uid)}}},render:function(t){var e=this;return t("form",{staticClass:"v-form",attrs:Object(i["a"])({novalidate:!0},this.attrs$),on:{submit:function(t){return e.$emit("submit",t)}}},this.$slots.default)}})},"94df":function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[a("v-spacer"),a("strong",[t._t("system-bar")],2)],1),a("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[a("v-app-bar-nav-icon",{staticClass:"grey--text",class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(e){e.stopPropagation(),t.drawer=!t.drawer}}}),a("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(e){e.stopPropagation(),t.$router.push("/dashboard/"+t.$store.getters["auth/AccessToken"]).catch((function(t){}))}}},[a("span",{staticClass:"hidden-sm-and-down"},[t._v(" "+t._s(t.NamaAPPAlias)+" ")])]),a("v-spacer"),a("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:t._u([{key:"activator",fn:function(e){var i=e.on;return[a("v-avatar",{attrs:{size:"30"}},[a("v-img",t._g({attrs:{src:t.photoUser}},i))],1)]}}])},[a("v-list",[a("v-list-item",[a("v-list-item-avatar",[a("v-img",{attrs:{src:t.photoUser}})],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),a("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),a("v-divider"),a("v-list-item",{attrs:{to:"/system-users/profil"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account")])],1),a("v-list-item-title",[t._v("Profil")])],1),a("v-divider"),a("v-list-item",{on:{click:function(e){return e.preventDefault(),t.logout(e)}}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-power")])],1),a("v-list-item-title",[t._v("Logout")])],1)],1)],1),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-app-bar-nav-icon",{on:{click:function(e){e.stopPropagation(),t.drawerRight=!t.drawerRight}}},[a("v-icon",[t._v("mdi-menu-open")])],1)],1),a("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",app:""},model:{value:t.drawer,callback:function(e){t.drawer=e},expression:"drawer"}},[a("v-list-item",[a("v-list-item-avatar",[a("v-img",{attrs:{src:t.photoUser},on:{click:function(e){return e.stopPropagation(),t.toProfile(e)}}})],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),a("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),a("v-divider"),a("v-list",{attrs:{expand:""}},[t.CAN_ACCESS("DMASTER-GROUP")?a("v-list-item",{staticClass:"yellow",attrs:{to:{path:"/dmaster"},link:"",color:"green"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-home-floor-b")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("BOARD DATA MASTER")])],1)],1):t._e(),a("v-subheader",[t._v("KEGIATAN")]),t.CAN_ACCESS("KELOMPOK URUSAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/kelompokurusan"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-group")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" KELOMPOK URUSAN ")])],1)],1):t._e(),t.CAN_ACCESS("JENIS PELAKSANAAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/jenispelaksanaan"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-road")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" JENIS PELAKSANAAN ")])],1)],1):t._e(),t.CAN_ACCESS("JENIS PEMBANGUNAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/jenispembangunan"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-shovel")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" JENIS PEMBANGUNAN ")])],1)],1):t._e(),a("v-subheader",[t._v("REKENING")]),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/transaksi"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" TRANSAKSI ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/kelompok"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" KELOMPOK ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/jenis"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" JENIS ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/rincian"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" RINCIAN ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/objek"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" OBJEK ")])],1)],1):t._e(),a("v-subheader",[t._v("ORGANISASI")]),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/opd"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-office-building")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" OPD ")])],1)],1):t._e(),t.CAN_ACCESS("UNIT KERJA_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/unitkerja"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-domain")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" UNIT KERJA ")])],1)],1):t._e(),a("v-subheader",[t._v("PEGAWAI")]),t.CAN_ACCESS("ASN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/asn"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account-circle-outline")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" ASN ")])],1)],1):t._e(),t.CAN_ACCESS("PEJABAT_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/pejabat"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account-circle")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" PEJABAT ")])],1)],1):t._e(),a("v-subheader",[t._v("LAIN-LAIN")]),t.CAN_ACCESS("SUMBER DANA_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/sumberdana"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-cash-100")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" SUMBER DANA ")])],1)],1):t._e(),t.CAN_ACCESS("TA_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/ta"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-calendar-month")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" TAHUN ANGGARAN ")])],1)],1):t._e()],1)],1),t.showrightsidebar?a("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:t.drawerRight,callback:function(e){t.drawerRight=e},expression:"drawerRight"}},[a("v-list",{attrs:{dense:""}},[a("v-list-item",[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-menu-open")])],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" OPTIONS ")])],1)],1),a("v-divider"),a("v-list-item",{staticClass:"teal lighten-5 mb-5"},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-filter")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("FILTER")])],1)],1),t._t("filtersidebar")],2)],1):t._e(),a("v-main",{staticClass:"mx-4 mb-4"},[t._t("default")],2),a("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[a("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[a("v-divider"),a("v-card-text",{staticClass:"py-2 white--text text-center"},[a("strong",[t._v(t._s(t.NamaAPP)+" (2019-2020)")]),t._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),a("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev"}},[a("v-icon",[t._v("mdi-github")])],1)],1)],1)],1)],1)},s=[],r=(a("ac1f"),a("5319"),a("5530")),n=a("2f62"),o={name:"DataMasterLayout",props:{showrightsidebar:{type:Boolean,default:!0}},data:function(){return{loginTime:0,drawer:null,drawerRight:null}},methods:{logout:function(){var t=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")})).catch((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")}))}},computed:Object(r["a"])(Object(r["a"])(Object(r["a"])({},Object(n["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"})),Object(n["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var t,e=this.ATTRIBUTE_USER("foto");return t=""==e?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+e,t}}),watch:{loginTime:{handler:function(t){var e=this;t>=0?setTimeout((function(){e.loginTime=1==e.AUTHENTICATED?e.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,d=a("2877"),c=a("6544"),u=a.n(c),v=a("40dc"),m=a("5bc1"),h=a("8212"),f=a("8336"),p=a("b0af"),_=a("99d9"),g=a("ce7e"),A=a("553a"),b=a("132d"),k=a("adda"),E=a("8860"),S=a("da13"),C=a("8270"),N=a("5d23"),x=a("34c3"),T=a("f6c4"),O=a("e449"),U=a("f774"),w=a("2fa4"),I=a("e0c7"),R=a("afd9"),K=a("2a7f"),D=Object(d["a"])(l,i,s,!1,null,null,null);e["a"]=D.exports;u()(D,{VAppBar:v["a"],VAppBarNavIcon:m["a"],VAvatar:h["a"],VBtn:f["a"],VCard:p["a"],VCardText:_["c"],VDivider:g["a"],VFooter:A["a"],VIcon:b["a"],VImg:k["a"],VList:E["a"],VListItem:S["a"],VListItemAvatar:C["a"],VListItemContent:N["a"],VListItemIcon:x["a"],VListItemSubtitle:N["b"],VListItemTitle:N["c"],VMain:T["a"],VMenu:O["a"],VNavigationDrawer:U["a"],VSpacer:w["a"],VSubheader:I["a"],VSystemBar:R["a"],VToolbarTitle:K["b"]})},a844:function(t,e,a){"use strict";a("a9e3");var i=a("5530"),s=(a("1681"),a("8654")),r=a("58df"),n=Object(r["a"])(s["a"]);e["a"]=n.extend({name:"v-textarea",props:{autoGrow:Boolean,noResize:Boolean,rowHeight:{type:[Number,String],default:24,validator:function(t){return!isNaN(parseFloat(t))}},rows:{type:[Number,String],default:5,validator:function(t){return!isNaN(parseInt(t,10))}}},computed:{classes:function(){return Object(i["a"])({"v-textarea":!0,"v-textarea--auto-grow":this.autoGrow,"v-textarea--no-resize":this.noResizeHandle},s["a"].options.computed.classes.call(this))},noResizeHandle:function(){return this.noResize||this.autoGrow}},watch:{lazyValue:function(){this.autoGrow&&this.$nextTick(this.calculateInputHeight)},rowHeight:function(){this.autoGrow&&this.$nextTick(this.calculateInputHeight)}},mounted:function(){var t=this;setTimeout((function(){t.autoGrow&&t.calculateInputHeight()}),0)},methods:{calculateInputHeight:function(){var t=this.$refs.input;if(t){t.style.height="0";var e=t.scrollHeight,a=parseInt(this.rows,10)*parseFloat(this.rowHeight);t.style.height=Math.max(a,e)+"px"}},genInput:function(){var t=s["a"].options.methods.genInput.call(this);return t.tag="textarea",delete t.data.attrs.type,t.data.attrs.rows=this.rows,t},onInput:function(t){s["a"].options.methods.onInput.call(this,t),this.autoGrow&&this.calculateInputHeight()},onKeyDown:function(t){this.isFocused&&13===t.keyCode&&t.stopPropagation(),this.$emit("keydown",t)}}})},aafa:function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("DataMasterLayout",{attrs:{showrightsidebar:!1},scopedSlots:t._u([{key:"system-bar",fn:function(){return[t._v(" Tahun Anggaran: "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" | Bulan Realisasi:"+t._s(t.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0}])},[a("ModuleHeader",{scopedSlots:t._u([{key:"icon",fn:function(){return[t._v(" mdi-group ")]},proxy:!0},{key:"name",fn:function(){return[t._v(" KELOMPOK URUSAN ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[a("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:t.breadcrumbs},scopedSlots:t._u([{key:"divider",fn:function(){return[a("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[a("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[t._v(' Daftar "kelompok urusan" uraian digunakan sebagai referensi di uraian kegiatan saat proses integrasi. ')])]},proxy:!0}])}),a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-card",[a("v-card-text",[a("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"",filled:"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1)],1)],1),a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.datatable,search:t.search,"item-key":"KUrsID","show-expand":"",expanded:t.expanded,"single-expand":!0,loading:t.datatableLoading,"loading-text":"Loading... Please wait"},on:{"update:expanded":function(e){t.expanded=e},"click:row":t.dataTableRowClicked},scopedSlots:t._u([{key:"top",fn:function(){return[a("v-toolbar",{attrs:{flat:"",color:"white"}},[a("v-toolbar-title",[t._v("DAFTAR KELOMPOK URUSAN")]),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-spacer"),a("v-dialog",{attrs:{"max-width":"800px",persistent:""},scopedSlots:t._u([{key:"activator",fn:function(e){var i=e.on;return[a("v-btn",t._g({staticClass:"mb-2",attrs:{color:"primary",dark:"",disabled:!t.$store.getters["auth/can"]("KELOMPOK URUSAN_STORE")}},i),[t._v("TAMBAH")])]}}]),model:{value:t.dialogfrm,callback:function(e){t.dialogfrm=e},expression:"dialogfrm"}},[a("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:t.form_valid,callback:function(e){t.form_valid=e},expression:"form_valid"}},[a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[t._v(t._s(t.formtitle))])]),a("v-card-text",[a("v-container",{attrs:{fluid:""}},[a("v-row",[a("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[a("v-text-field",{attrs:{label:"KODE KELOMPOK URUSAN",filled:"",rules:t.rule_kode},model:{value:t.formdata.Kd_Urusan,callback:function(e){t.$set(t.formdata,"Kd_Urusan",e)},expression:"formdata.Kd_Urusan"}})],1),a("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[a("v-text-field",{attrs:{label:"NAMA KELOMPOK URUSAN",filled:"",rules:t.rule_name},model:{value:t.formdata.Nm_Urusan,callback:function(e){t.$set(t.formdata,"Nm_Urusan",e)},expression:"formdata.Nm_Urusan"}})],1),a("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[a("v-textarea",{attrs:{label:"KETERANGAN",filled:""},model:{value:t.formdata.Descr,callback:function(e){t.$set(t.formdata,"Descr",e)},expression:"formdata.Descr"}})],1)],1)],1)],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.closedialogfrm(e)}}},[t._v("BATAL")]),a("v-btn",{attrs:{color:"blue darken-1",text:"",loading:t.btnLoading,disabled:!t.form_valid||t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.save(e)}}},[t._v(" SIMPAN ")])],1)],1)],1)],1),a("v-dialog",{attrs:{"max-width":"800px",persistent:""},model:{value:t.dialogdetailitem,callback:function(e){t.dialogdetailitem=e},expression:"dialogdetailitem"}},[a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[t._v("DETAIL DATA")])]),a("v-card-text",[a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" KUrsID ")]),a("v-card-subtitle",[t._v(" "+t._s(t.formdata.KUrsID)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" KETERANGAN ")]),a("v-card-subtitle",[t._v(" "+t._s(t.formdata.Descr)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1),a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" KODE KELOMPOK URUSAN ")]),a("v-card-subtitle",[t._v(" "+t._s(t.formdata.Kd_Urusan)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" CREATED ")]),a("v-card-subtitle",[t._v(" "+t._s(t.$date(t.formdata.created_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1),a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" NAMA KELOMPOK URUSAN ")]),a("v-card-subtitle",[t._v(" "+t._s(t.formdata.Nm_Urusan)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" UPDATED ")]),a("v-card-subtitle",[t._v(" "+t._s(t.$date(t.formdata.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1)],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.closedialogdetailitem(e)}}},[t._v("KELUAR")])],1)],1)],1)],1)]},proxy:!0},{key:"item.actions",fn:function(e){var i=e.item;return[a("v-icon",{staticClass:"mr-2",attrs:{small:""},on:{click:function(e){return e.stopPropagation(),t.viewItem(i)}}},[t._v(" mdi-eye ")]),a("v-icon",{staticClass:"mr-2",attrs:{small:"",disabled:!t.$store.getters["auth/can"]("KELOMPOK URUSAN_UPDATE")},on:{click:function(e){return e.stopPropagation(),t.editItem(i)}}},[t._v(" mdi-pencil ")]),a("v-icon",{attrs:{small:"",loading:t.btnLoading,disabled:t.btnLoading||!t.$store.getters["auth/can"]("KELOMPOK URUSAN_STORE")},on:{click:function(e){return e.stopPropagation(),t.deleteItem(i)}}},[t._v(" mdi-delete ")])]}},{key:"expanded-item",fn:function(e){var i=e.headers,s=e.item;return[a("td",{staticClass:"text-center",attrs:{colspan:i.length}},[a("strong",[t._v("ID:")]),t._v(t._s(s.KUrsID)+" "),a("strong",[t._v("created_at:")]),t._v(t._s(t.$date(s.created_at).format("DD/MM/YYYY HH:mm"))+" "),a("strong",[t._v("updated_at:")]),t._v(t._s(t.$date(s.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])]}},{key:"no-data",fn:function(){return[t._v(" Data belum tersedia ")]},proxy:!0}])})],1)],1)],1)],1)},s=[],r=(a("c975"),a("a434"),a("96cf"),a("1da1")),n=a("94df"),o=a("e477"),l={name:"KelompokUrusan",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.$store.getters["auth/AccessToken"]},{text:"DATA MASTER",disabled:!1,href:"#"},{text:"KEGIATAN",disabled:!0,href:"#"},{text:"KELOMPOK URUSAN",disabled:!0,href:"#"}],this.initialize()},data:function(){return{btnLoading:!1,datatableLoading:!1,expanded:[],datatable:[],headers:[{text:"KODE KELOMPOK URUSAN",value:"Kd_Urusan",width:150},{text:"NAMA KELOMPOK URUSAN",value:"Nm_Urusan"},{text:"KET",value:"Descr"},{text:"TA",value:"TA"},{text:"AKSI",value:"actions",sortable:!1,width:100}],search:"",dialogfrm:!1,dialogdetailitem:!1,form_valid:!0,formdata:{KUrsID:"",RpjmdVisiID:"",Kd_Urusan:"",Nm_Urusan:"",Descr:"",TA:"",created_at:"",updated_at:""},formdefault:{KUrsID:"",Kd_Urusan:"",Nm_Urusan:"",Descr:"",TA:"",created_at:"",updated_at:""},editedIndex:-1,rule_kode:[function(t){return!!t||"Mohon untuk di isi Kode Kelompok Urusan!!!"},function(t){return/^[0-9]+$/.test(t)||"Kode Kelompok Urusan hanya boleh angka"}],rule_name:[function(t){return!!t||"Mohon untuk di isi Nama Kelompok Urusan !!!"},function(t){return/^[A-Za-z\s\\,\\.]*$/.test(t)||"Nama Kelompok Urusan hanya boleh string dan spasi"}]}},methods:{initialize:function(){var t=Object(r["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.datatableLoading=!0,t.next=3,this.$ajax.post("/dmaster/rekening/kelompokurusan",{TA:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(t){var a=t.data;e.datatable=a.kelompokurusan,e.datatableLoading=!1}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),dataTableRowClicked:function(t){t===this.expanded[0]?this.expanded=[]:this.expanded=[t]},editItem:function(t){this.editedIndex=this.datatable.indexOf(t),this.formdata=Object.assign({},t),this.dialogfrm=!0},viewItem:function(t){this.formdata=t,this.dialogdetailitem=!0},save:function(){var t=this;this.$refs.frmdata.validate()&&(this.btnLoading=!0,this.editedIndex>-1?this.$ajax.post("/dmaster/rekening/kelompokurusan/"+this.formdata.KUrsID,{_method:"PUT",Kd_Urusan:this.formdata.Kd_Urusan,Nm_Urusan:this.formdata.Nm_Urusan,Descr:this.formdata.Descr},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(e){var a=e.data;Object.assign(t.datatable[t.editedIndex],a.kelompokurusan),t.closedialogfrm()})).catch((function(){t.btnLoading=!1})):this.$ajax.post("/dmaster/rekening/kelompokurusan/store",{Kd_Urusan:this.formdata.Kd_Urusan,Nm_Urusan:this.formdata.Nm_Urusan,Descr:this.formdata.Descr,TA:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(e){var a=e.data;t.datatable.push(a.kelompokurusan),t.closedialogfrm()})).catch((function(){t.btnLoading=!1})))},deleteItem:function(t){var e=this;this.$root.$confirm.open("Delete","Apakah Anda ingin menghapus data dengan ID "+t.KUrsID+" ?",{color:"red"}).then((function(a){a&&(e.btnLoading=!0,e.$ajax.post("/dmaster/rekening/kelompokurusan/"+t.KUrsID,{_method:"DELETE"},{headers:{Authorization:e.$store.getters["auth/Token"]}}).then((function(){var a=e.datatable.indexOf(t);e.datatable.splice(a,1),e.btnLoading=!1})).catch((function(){e.btnLoading=!1})))}))},closedialogfrm:function(){var t=this;this.btnLoading=!1,this.dialogfrm=!1,setTimeout((function(){t.formdata=Object.assign({},t.formdefault),t.editedIndex=-1,t.$refs.frmdata.reset()}),300)},closedialogdetailitem:function(){var t=this;this.dialogdetailitem=!1,setTimeout((function(){t.formdata=Object.assign({},t.formdefault),t.editedIndex=-1}),300)}},computed:{formtitle:function(){return-1===this.editedIndex?"TAMBAH DATA":"UBAH DATA"}},components:{DataMasterLayout:n["a"],ModuleHeader:o["a"]}},d=l,c=a("2877"),u=a("6544"),v=a.n(u),m=a("0798"),h=a("2bc5"),f=a("8336"),p=a("b0af"),_=a("99d9"),g=a("62ad"),A=a("a523"),b=a("8fea"),k=a("169a"),E=a("ce7e"),S=a("4bd4"),C=a("132d"),N=a("6b53"),x=a("0fd9"),T=a("2fa4"),O=a("8654"),U=a("a844"),w=a("71d9"),I=a("2a7f"),R=Object(c["a"])(d,i,s,!1,null,null,null);e["default"]=R.exports;v()(R,{VAlert:m["a"],VBreadcrumbs:h["a"],VBtn:f["a"],VCard:p["a"],VCardActions:_["a"],VCardSubtitle:_["b"],VCardText:_["c"],VCardTitle:_["d"],VCol:g["a"],VContainer:A["a"],VDataTable:b["a"],VDialog:k["a"],VDivider:E["a"],VForm:S["a"],VIcon:C["a"],VResponsive:N["a"],VRow:x["a"],VSpacer:T["a"],VTextField:O["a"],VTextarea:U["a"],VToolbar:w["a"],VToolbarTitle:I["b"]})}}]);
//# sourceMappingURL=chunk-12f41134.70b7ac1b.js.map