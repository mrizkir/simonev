(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-22901f81"],{1681:function(t,e,a){},"2bfd":function(t,e,a){},"4bd4":function(t,e,a){"use strict";a("4de4"),a("7db0"),a("4160"),a("caad"),a("07ac"),a("2532"),a("159b");var i=a("5530"),n=a("58df"),s=a("7e2b"),r=a("3206");e["a"]=Object(n["a"])(s["a"],Object(r["b"])("form")).extend({name:"v-form",provide:function(){return{form:this}},inheritAttrs:!1,props:{disabled:Boolean,lazyValidation:Boolean,readonly:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(t){var e=Object.values(t).includes(!0);this.$emit("input",!e)},deep:!0,immediate:!0}},methods:{watchInput:function(t){var e=this,a=function(t){return t.$watch("hasError",(function(a){e.$set(e.errorBag,t._uid,a)}),{immediate:!0})},i={_uid:t._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?i.shouldValidate=t.$watch("shouldValidate",(function(n){n&&(e.errorBag.hasOwnProperty(t._uid)||(i.valid=a(t)))})):i.valid=a(t),i},validate:function(){return 0===this.inputs.filter((function(t){return!t.validate(!0)})).length},reset:function(){this.inputs.forEach((function(t){return t.reset()})),this.resetErrorBag()},resetErrorBag:function(){var t=this;this.lazyValidation&&setTimeout((function(){t.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(t){return t.resetValidation()})),this.resetErrorBag()},register:function(t){this.inputs.push(t),this.watchers.push(this.watchInput(t))},unregister:function(t){var e=this.inputs.find((function(e){return e._uid===t._uid}));if(e){var a=this.watchers.find((function(t){return t._uid===e._uid}));a&&(a.valid(),a.shouldValidate()),this.watchers=this.watchers.filter((function(t){return t._uid!==e._uid})),this.inputs=this.inputs.filter((function(t){return t._uid!==e._uid})),this.$delete(this.errorBag,e._uid)}}},render:function(t){var e=this;return t("form",{staticClass:"v-form",attrs:Object(i["a"])({novalidate:!0},this.attrs$),on:{submit:function(t){return e.$emit("submit",t)}}},this.$slots.default)}})},"94df":function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[a("v-spacer"),a("strong",[t._t("system-bar")],2)],1),a("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[a("v-app-bar-nav-icon",{staticClass:"grey--text",class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(e){e.stopPropagation(),t.drawer=!t.drawer}}}),a("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(e){e.stopPropagation(),t.$router.push("/dashboard/"+t.$store.getters["auth/AccessToken"]).catch((function(t){}))}}},[a("span",{staticClass:"hidden-sm-and-down"},[t._v(" "+t._s(t.NamaAPPAlias)+" ")])]),a("v-spacer"),a("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:t._u([{key:"activator",fn:function(e){var i=e.on;return[a("v-avatar",{attrs:{size:"30"}},[a("v-img",t._g({attrs:{src:t.photoUser}},i))],1)]}}])},[a("v-list",[a("v-list-item",[a("v-list-item-avatar",[a("v-img",{attrs:{src:t.photoUser}})],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),a("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),a("v-divider"),a("v-list-item",{attrs:{to:"/system-users/profil"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account")])],1),a("v-list-item-title",[t._v("Profil")])],1),a("v-divider"),a("v-list-item",{on:{click:function(e){return e.preventDefault(),t.logout(e)}}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-power")])],1),a("v-list-item-title",[t._v("Logout")])],1)],1)],1),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-app-bar-nav-icon",{on:{click:function(e){e.stopPropagation(),t.drawerRight=!t.drawerRight}}},[a("v-icon",[t._v("mdi-menu-open")])],1)],1),a("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",app:""},model:{value:t.drawer,callback:function(e){t.drawer=e},expression:"drawer"}},[a("v-list-item",[a("v-list-item-avatar",[a("v-img",{attrs:{src:t.photoUser},on:{click:function(e){return e.stopPropagation(),t.toProfile(e)}}})],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),a("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),a("v-divider"),a("v-list",{attrs:{expand:""}},[t.CAN_ACCESS("DMASTER-GROUP")?a("v-list-item",{staticClass:"yellow",attrs:{to:{path:"/dmaster"},link:"",color:"green"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-home-floor-b")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("BOARD DATA MASTER")])],1)],1):t._e(),a("v-subheader",[t._v("KEGIATAN")]),t.CAN_ACCESS("KELOMPOK URUSAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/kelompokurusan"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-group")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" KELOMPOK URUSAN ")])],1)],1):t._e(),t.CAN_ACCESS("JENIS PELAKSANAAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/jenispelaksanaan"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-road")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" JENIS PELAKSANAAN ")])],1)],1):t._e(),t.CAN_ACCESS("JENIS PEMBANGUNAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/jenispembangunan"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-shovel")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" JENIS PEMBANGUNAN ")])],1)],1):t._e(),a("v-subheader",[t._v("REKENING")]),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/transaksi"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" TRANSAKSI ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/kelompok"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" KELOMPOK ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/jenis"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" JENIS ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/rincian"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" RINCIAN ")])],1)],1):t._e(),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/rekening/objek"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-decimal")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" OBJEK ")])],1)],1):t._e(),a("v-subheader",[t._v("ORGANISASI")]),t.CAN_ACCESS("OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/opd"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-office-building")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" OPD ")])],1)],1):t._e(),t.CAN_ACCESS("UNIT KERJA_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/unitkerja"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-domain")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" UNIT KERJA ")])],1)],1):t._e(),a("v-subheader",[t._v("PEGAWAI")]),t.CAN_ACCESS("ASN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/asn"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account-circle-outline")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" ASN ")])],1)],1):t._e(),t.CAN_ACCESS("PEJABAT_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/pejabat"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account-circle")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" PEJABAT ")])],1)],1):t._e(),a("v-subheader",[t._v("LAIN-LAIN")]),t.CAN_ACCESS("SUMBER DANA_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/sumberdana"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-cash-100")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" SUMBER DANA ")])],1)],1):t._e(),t.CAN_ACCESS("TA_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/dmaster/ta"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-calendar-month")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" TAHUN ANGGARAN ")])],1)],1):t._e()],1)],1),t.showrightsidebar?a("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:t.drawerRight,callback:function(e){t.drawerRight=e},expression:"drawerRight"}},[a("v-list",{attrs:{dense:""}},[a("v-list-item",[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-menu-open")])],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" OPTIONS ")])],1)],1),a("v-divider"),a("v-list-item",{staticClass:"teal lighten-5 mb-5"},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-filter")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("FILTER")])],1)],1),t._t("filtersidebar")],2)],1):t._e(),a("v-main",{staticClass:"mx-4 mb-4"},[t._t("default")],2),a("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[a("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[a("v-divider"),a("v-card-text",{staticClass:"py-2 white--text text-center"},[a("strong",[t._v(t._s(t.NamaAPP)+" (2019-2020)")]),t._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),a("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev"}},[a("v-icon",[t._v("mdi-github")])],1)],1)],1)],1)],1)},n=[],s=(a("ac1f"),a("5319"),a("5530")),r=a("2f62"),o={name:"DataMasterLayout",props:{showrightsidebar:{type:Boolean,default:!0}},data:function(){return{loginTime:0,drawer:null,drawerRight:null}},methods:{logout:function(){var t=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")})).catch((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")}))}},computed:Object(s["a"])(Object(s["a"])(Object(s["a"])({},Object(r["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"})),Object(r["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var t,e=this.ATTRIBUTE_USER("foto");return t=""==e?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+e,t}}),watch:{loginTime:{handler:function(t){var e=this;t>=0?setTimeout((function(){e.loginTime=1==e.AUTHENTICATED?e.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,c=a("2877"),d=a("6544"),u=a.n(d),m=a("40dc"),h=a("5bc1"),v=a("8212"),f=a("8336"),p=a("b0af"),g=a("99d9"),_=a("ce7e"),b=a("553a"),A=a("132d"),I=a("adda"),S=a("8860"),k=a("da13"),x=a("8270"),C=a("5d23"),E=a("34c3"),T=a("f6c4"),N=a("e449"),w=a("f774"),D=a("2fa4"),y=a("e0c7"),O=a("afd9"),R=a("2a7f"),$=Object(c["a"])(l,i,n,!1,null,null,null);e["a"]=$.exports;u()($,{VAppBar:m["a"],VAppBarNavIcon:h["a"],VAvatar:v["a"],VBtn:f["a"],VCard:p["a"],VCardText:g["c"],VDivider:_["a"],VFooter:b["a"],VIcon:A["a"],VImg:I["a"],VList:S["a"],VListItem:k["a"],VListItemAvatar:x["a"],VListItemContent:C["a"],VListItemIcon:E["a"],VListItemSubtitle:C["b"],VListItemTitle:C["c"],VMain:T["a"],VMenu:N["a"],VNavigationDrawer:w["a"],VSpacer:D["a"],VSubheader:y["a"],VSystemBar:O["a"],VToolbarTitle:R["b"]})},a844:function(t,e,a){"use strict";a("a9e3");var i=a("5530"),n=(a("1681"),a("8654")),s=a("58df"),r=Object(s["a"])(n["a"]);e["a"]=r.extend({name:"v-textarea",props:{autoGrow:Boolean,noResize:Boolean,rowHeight:{type:[Number,String],default:24,validator:function(t){return!isNaN(parseFloat(t))}},rows:{type:[Number,String],default:5,validator:function(t){return!isNaN(parseInt(t,10))}}},computed:{classes:function(){return Object(i["a"])({"v-textarea":!0,"v-textarea--auto-grow":this.autoGrow,"v-textarea--no-resize":this.noResizeHandle},n["a"].options.computed.classes.call(this))},noResizeHandle:function(){return this.noResize||this.autoGrow}},watch:{lazyValue:function(){this.autoGrow&&this.$nextTick(this.calculateInputHeight)},rowHeight:function(){this.autoGrow&&this.$nextTick(this.calculateInputHeight)}},mounted:function(){var t=this;setTimeout((function(){t.autoGrow&&t.calculateInputHeight()}),0)},methods:{calculateInputHeight:function(){var t=this.$refs.input;if(t){t.style.height="0";var e=t.scrollHeight,a=parseInt(this.rows,10)*parseFloat(this.rowHeight);t.style.height=Math.max(a,e)+"px"}},genInput:function(){var t=n["a"].options.methods.genInput.call(this);return t.tag="textarea",delete t.data.attrs.type,t.data.attrs.rows=this.rows,t},onInput:function(t){n["a"].options.methods.onInput.call(this,t),this.autoGrow&&this.calculateInputHeight()},onKeyDown:function(t){this.isFocused&&13===t.keyCode&&t.stopPropagation(),this.$emit("keydown",t)}}})},bf2e:function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("DataMasterLayout",{attrs:{showrightsidebar:!1},scopedSlots:t._u([{key:"system-bar",fn:function(){return[t._v(" Tahun Anggaran: "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" | Bulan Realisasi:"+t._s(t.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0}])},[a("ModuleHeader",{scopedSlots:t._u([{key:"icon",fn:function(){return[t._v(" mdi-decimal ")]},proxy:!0},{key:"name",fn:function(){return[t._v(" JENIS ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[a("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:t.breadcrumbs},scopedSlots:t._u([{key:"divider",fn:function(){return[a("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[a("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[t._v(' Daftar rekening "jenis" uraian digunakan sebagai referensi di uraian kegiatan saat proses integrasi. ')])]},proxy:!0}])}),a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-card",[a("v-card-text",[a("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"",filled:"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1)],1)],1),a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.datatable,search:t.search,"item-key":"JnsID","show-expand":"",expanded:t.expanded,"single-expand":!0,loading:t.datatableLoading,"loading-text":"Loading... Please wait"},on:{"update:expanded":function(e){t.expanded=e},"click:row":t.dataTableRowClicked},scopedSlots:t._u([{key:"top",fn:function(){return[a("v-toolbar",{attrs:{flat:"",color:"white"}},[a("v-toolbar-title",[t._v("DAFTAR JENIS")]),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-spacer"),a("v-btn",{staticClass:"mb-2",attrs:{color:"primary",disabled:!t.$store.getters["auth/can"]("REKENING-JENIS_STORE")||t.btnLoading,loading:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.addItem(e)}}},[t._v("TAMBAH")]),a("v-dialog",{attrs:{"max-width":"800px",persistent:""},model:{value:t.dialogfrm,callback:function(e){t.dialogfrm=e},expression:"dialogfrm"}},[a("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:t.form_valid,callback:function(e){t.form_valid=e},expression:"form_valid"}},[a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[t._v(t._s(t.formtitle))])]),a("v-card-text",[a("v-container",{attrs:{fluid:""}},[a("v-row",[a("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[a("v-autocomplete",{attrs:{items:t.daftar_kelompok,label:"KELOMPOK","item-text":"nama_rek2","item-value":"KlpID",filled:"",rules:t.rule_kelompok},model:{value:t.formdata.KlpID,callback:function(e){t.$set(t.formdata,"KlpID",e)},expression:"formdata.KlpID"}})],1),a("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[a("v-text-field",{attrs:{label:"KODE JENIS",filled:"",rules:t.rule_kode_rek},model:{value:t.formdata.Kd_Rek_3,callback:function(e){t.$set(t.formdata,"Kd_Rek_3",e)},expression:"formdata.Kd_Rek_3"}})],1),a("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[a("v-text-field",{attrs:{label:"NAMA JENIS",filled:"",rules:t.rule_name},model:{value:t.formdata.JnsNm,callback:function(e){t.$set(t.formdata,"JnsNm",e)},expression:"formdata.JnsNm"}})],1),a("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[a("v-textarea",{attrs:{label:"KETERANGAN",filled:""},model:{value:t.formdata.Descr,callback:function(e){t.$set(t.formdata,"Descr",e)},expression:"formdata.Descr"}})],1)],1)],1)],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.closedialogfrm(e)}}},[t._v("BATAL")]),a("v-btn",{attrs:{color:"blue darken-1",text:"",loading:t.btnLoading,disabled:!t.form_valid||t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.save(e)}}},[t._v(" SIMPAN ")])],1)],1)],1)],1),a("v-dialog",{attrs:{"max-width":"800px",persistent:""},model:{value:t.dialogdetailitem,callback:function(e){t.dialogdetailitem=e},expression:"dialogdetailitem"}},[a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[t._v("DETAIL DATA")])]),a("v-card-text",[a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" JnsID ")]),a("v-card-subtitle",[t._v(" "+t._s(t.formdata.JnsID)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" KETERANGAN ")]),a("v-card-subtitle",[t._v(" "+t._s(t.formdata.Descr)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1),a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" KODE JENIS ")]),a("v-card-subtitle",[t._v(" "+t._s(t.formdata.Kd_Rek_3)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" CREATED ")]),a("v-card-subtitle",[t._v(" "+t._s(t.$date(t.formdata.created_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1),a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" NAMA JENIS ")]),a("v-card-subtitle",[t._v(" "+t._s(t.formdata.JnsNm)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v(" UPDATED ")]),a("v-card-subtitle",[t._v(" "+t._s(t.$date(t.formdata.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1)],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.closedialogdetailitem(e)}}},[t._v("KELUAR")])],1)],1)],1)],1)]},proxy:!0},{key:"item.actions",fn:function(e){var i=e.item;return[a("v-icon",{staticClass:"mr-2",attrs:{small:""},on:{click:function(e){return e.stopPropagation(),t.viewItem(i)}}},[t._v(" mdi-eye ")]),a("v-icon",{staticClass:"mr-2",attrs:{small:"",loading:t.btnLoading,disabled:!t.$store.getters["auth/can"]("REKENING-JENIS_UPDATE")},on:{click:function(e){return e.stopPropagation(),t.editItem(i)}}},[t._v(" mdi-pencil ")]),a("v-icon",{attrs:{small:"",loading:t.btnLoading,disabled:t.btnLoading||!t.$store.getters["auth/can"]("REKENING-JENIS_STORE")},on:{click:function(e){return e.stopPropagation(),t.deleteItem(i)}}},[t._v(" mdi-delete ")])]}},{key:"expanded-item",fn:function(e){var i=e.headers,n=e.item;return[a("td",{staticClass:"text-center",attrs:{colspan:i.length}},[a("strong",[t._v("ID:")]),t._v(t._s(n.JnsID)+" "),a("strong",[t._v("created_at:")]),t._v(t._s(t.$date(n.created_at).format("DD/MM/YYYY HH:mm"))+" "),a("strong",[t._v("updated_at:")]),t._v(t._s(t.$date(n.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])]}},{key:"no-data",fn:function(){return[t._v(" Data belum tersedia ")]},proxy:!0}])})],1)],1)],1)],1)},n=[],s=(a("c975"),a("a434"),a("96cf"),a("1da1")),r=a("94df"),o=a("e477"),l={name:"Jenis",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.$store.getters["auth/AccessToken"]},{text:"DATA MASTER",disabled:!1,href:"#"},{text:"REKENING",disabled:!0,href:"#"},{text:"JENIS",disabled:!0,href:"#"}],this.initialize()},data:function(){return{btnLoading:!1,datatableLoading:!1,expanded:[],datatable:[],headers:[{text:"KELOMPOK",value:"nama_rek2",width:200},{text:"KODE JENIS",value:"Kd_Rek_3",width:100},{text:"NAMA JENIS",value:"JnsNm"},{text:"KET",value:"Descr",width:100},{text:"TA",value:"TA",width:50},{text:"AKSI",value:"actions",sortable:!1,width:100}],search:"",dialogfrm:!1,dialogdetailitem:!1,form_valid:!0,daftar_kelompok:[],formdata:{JnsID:"",KlpID:"",Kd_Rek_3:"",JnsNm:"",Descr:"",TA:"",created_at:"",updated_at:""},formdefault:{JnsID:"",KlpID:"",Kd_Rek_3:"",JnsNm:"",Descr:"",TA:"",created_at:"",updated_at:""},editedIndex:-1,rule_kelompok:[function(t){return!!t||"Mohon untuk dipilih Rekening Transaksi !!!"}],rule_kode_rek:[function(t){return!!t||"Mohon untuk di isi Kode Rekening Jenis!!!"},function(t){return/^[0-9]+$/.test(t)||"Kode Rekening Jenis hanya boleh angka"}],rule_name:[function(t){return!!t||"Mohon untuk di isi Nama Rekening Jenis !!!"},function(t){return/^[A-Za-z\s\\,\\.]*$/.test(t)||"Nama Rekening Jenis hanya boleh string dan spasi"}]}},methods:{initialize:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.datatableLoading=!0,t.next=3,this.$ajax.post("/dmaster/rekening/jenis",{TA:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(t){var a=t.data;e.datatable=a.jenis,e.datatableLoading=!1}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),dataTableRowClicked:function(t){t===this.expanded[0]?this.expanded=[]:this.expanded=[t]},addItem:function(){var t=this;return Object(s["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.btnLoading=!0,e.next=3,t.$ajax.post("/dmaster/rekening/kelompok",{TA:t.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:t.$store.getters["auth/Token"],"Access-Control-Allow-Origin":"*"}}).then((function(e){var a=e.data;t.dialogfrm=!0,t.daftar_kelompok=a.kelompok,t.btnLoading=!1})).catch((function(){t.btnLoading=!1}));case 3:case"end":return e.stop()}}),e)})))()},editItem:function(t){var e=this;return Object(s["a"])(regeneratorRuntime.mark((function a(){return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return e.btnLoading=!0,a.next=3,e.$ajax.post("/dmaster/rekening/kelompok",{TA:e.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:e.$store.getters["auth/Token"]}}).then((function(a){var i=a.data;e.dialogfrm=!0,e.daftar_kelompok=i.kelompok,e.editedIndex=e.datatable.indexOf(t),e.formdata=Object.assign({},t),e.btnLoading=!1})).catch((function(){e.btnLoading=!1}));case 3:case"end":return a.stop()}}),a)})))()},viewItem:function(t){this.formdata=t,this.dialogdetailitem=!0},save:function(){var t=this;this.$refs.frmdata.validate()&&(this.btnLoading=!0,this.editedIndex>-1?this.$ajax.post("/dmaster/rekening/jenis/"+this.formdata.JnsID,{_method:"PUT",KlpID:this.formdata.KlpID,Kd_Rek_3:this.formdata.Kd_Rek_3,JnsNm:this.formdata.JnsNm,Descr:this.formdata.Descr},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(){t.$router.go()})).catch((function(){t.btnLoading=!1})):this.$ajax.post("/dmaster/rekening/jenis/store",{KlpID:this.formdata.KlpID,Kd_Rek_3:this.formdata.Kd_Rek_3,JnsNm:this.formdata.JnsNm,Descr:this.formdata.Descr,TA:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(){t.$router.go()})).catch((function(){t.btnLoading=!1})))},deleteItem:function(t){var e=this;this.$root.$confirm.open("Delete","Apakah Anda ingin menghapus data dengan ID "+t.JnsID+" ?",{color:"red"}).then((function(a){a&&(e.btnLoading=!0,e.$ajax.post("/dmaster/rekening/jenis/"+t.JnsID,{_method:"DELETE"},{headers:{Authorization:e.$store.getters["auth/Token"]}}).then((function(){var a=e.datatable.indexOf(t);e.datatable.splice(a,1),e.btnLoading=!1})).catch((function(){e.btnLoading=!1})))}))},closedialogfrm:function(){var t=this;this.btnLoading=!1,this.dialogfrm=!1,setTimeout((function(){t.formdata=Object.assign({},t.formdefault),t.editedIndex=-1,t.$refs.frmdata.reset()}),300)},closedialogdetailitem:function(){var t=this;this.dialogdetailitem=!1,setTimeout((function(){t.formdata=Object.assign({},t.formdefault),t.editedIndex=-1}),300)}},computed:{formtitle:function(){return-1===this.editedIndex?"TAMBAH DATA":"UBAH DATA"}},components:{DataMasterLayout:r["a"],ModuleHeader:o["a"]}},c=l,d=a("2877"),u=a("6544"),m=a.n(u),h=a("0798"),v=a("c6a6"),f=a("2bc5"),p=a("8336"),g=a("b0af"),_=a("99d9"),b=a("62ad"),A=a("a523"),I=a("8fea"),S=a("169a"),k=a("ce7e"),x=a("4bd4"),C=a("132d"),E=a("6b53"),T=a("0fd9"),N=a("2fa4"),w=a("8654"),D=a("a844"),y=a("71d9"),O=a("2a7f"),R=Object(d["a"])(c,i,n,!1,null,null,null);e["default"]=R.exports;m()(R,{VAlert:h["a"],VAutocomplete:v["a"],VBreadcrumbs:f["a"],VBtn:p["a"],VCard:g["a"],VCardActions:_["a"],VCardSubtitle:_["b"],VCardText:_["c"],VCardTitle:_["d"],VCol:b["a"],VContainer:A["a"],VDataTable:I["a"],VDialog:S["a"],VDivider:k["a"],VForm:x["a"],VIcon:C["a"],VResponsive:E["a"],VRow:T["a"],VSpacer:N["a"],VTextField:w["a"],VTextarea:D["a"],VToolbar:y["a"],VToolbarTitle:O["b"]})},c6a6:function(t,e,a){"use strict";a("4de4"),a("7db0"),a("c975"),a("d81d"),a("45fc"),a("498a");var i=a("5530"),n=(a("2bfd"),a("b974")),s=a("8654"),r=a("d9f7"),o=a("80d2"),l=Object(i["a"])(Object(i["a"])({},n["b"]),{},{offsetY:!0,offsetOverflow:!0,transition:!1});e["a"]=n["a"].extend({name:"v-autocomplete",props:{allowOverflow:{type:Boolean,default:!0},autoSelectFirst:{type:Boolean,default:!1},filter:{type:Function,default:function(t,e,a){return a.toLocaleLowerCase().indexOf(e.toLocaleLowerCase())>-1}},hideNoData:Boolean,menuProps:{type:n["a"].options.props.menuProps.type,default:function(){return l}},noFilter:Boolean,searchInput:{type:String,default:void 0}},data:function(){return{lazySearch:this.searchInput}},computed:{classes:function(){return Object(i["a"])(Object(i["a"])({},n["a"].options.computed.classes.call(this)),{},{"v-autocomplete":!0,"v-autocomplete--is-selecting-index":this.selectedIndex>-1})},computedItems:function(){return this.filteredItems},selectedValues:function(){var t=this;return this.selectedItems.map((function(e){return t.getValue(e)}))},hasDisplayedItems:function(){var t=this;return this.hideSelected?this.filteredItems.some((function(e){return!t.hasItem(e)})):this.filteredItems.length>0},currentRange:function(){return null==this.selectedItem?0:String(this.getText(this.selectedItem)).length},filteredItems:function(){var t=this;return!this.isSearching||this.noFilter||null==this.internalSearch?this.allItems:this.allItems.filter((function(e){var a=Object(o["r"])(e,t.itemText),i=null!=a?String(a):"";return t.filter(e,String(t.internalSearch),i)}))},internalSearch:{get:function(){return this.lazySearch},set:function(t){this.lazySearch=t,this.$emit("update:search-input",t)}},isAnyValueAllowed:function(){return!1},isDirty:function(){return this.searchIsDirty||this.selectedItems.length>0},isSearching:function(){return this.multiple&&this.searchIsDirty||this.searchIsDirty&&this.internalSearch!==this.getText(this.selectedItem)},menuCanShow:function(){return!!this.isFocused&&(this.hasDisplayedItems||!this.hideNoData)},$_menuProps:function(){var t=n["a"].options.computed.$_menuProps.call(this);return t.contentClass="v-autocomplete__content ".concat(t.contentClass||"").trim(),Object(i["a"])(Object(i["a"])({},l),t)},searchIsDirty:function(){return null!=this.internalSearch&&""!==this.internalSearch},selectedItem:function(){var t=this;return this.multiple?null:this.selectedItems.find((function(e){return t.valueComparator(t.getValue(e),t.getValue(t.internalValue))}))},listData:function(){var t=n["a"].options.computed.listData.call(this);return t.props=Object(i["a"])(Object(i["a"])({},t.props),{},{items:this.virtualizedItems,noFilter:this.noFilter||!this.isSearching||!this.filteredItems.length,searchInput:this.internalSearch}),t}},watch:{filteredItems:"onFilteredItemsChanged",internalValue:"setSearch",isFocused:function(t){t?(document.addEventListener("copy",this.onCopy),this.$refs.input&&this.$refs.input.select()):(document.removeEventListener("copy",this.onCopy),this.updateSelf())},isMenuActive:function(t){!t&&this.hasSlot&&(this.lazySearch=void 0)},items:function(t,e){e&&e.length||!this.hideNoData||!this.isFocused||this.isMenuActive||!t.length||this.activateMenu()},searchInput:function(t){this.lazySearch=t},internalSearch:"onInternalSearchChanged",itemText:"updateSelf"},created:function(){this.setSearch()},destroyed:function(){document.removeEventListener("copy",this.onCopy)},methods:{onFilteredItemsChanged:function(t,e){var a=this;t!==e&&(this.setMenuIndex(-1),this.$nextTick((function(){a.internalSearch&&(1===t.length||a.autoSelectFirst)&&(a.$refs.menu.getTiles(),a.setMenuIndex(0))})))},onInternalSearchChanged:function(){this.updateMenuDimensions()},updateMenuDimensions:function(){this.isMenuActive&&this.$refs.menu&&this.$refs.menu.updateDimensions()},changeSelectedIndex:function(t){this.searchIsDirty||(this.multiple&&t===o["x"].left?-1===this.selectedIndex?this.selectedIndex=this.selectedItems.length-1:this.selectedIndex--:this.multiple&&t===o["x"].right?this.selectedIndex>=this.selectedItems.length-1?this.selectedIndex=-1:this.selectedIndex++:t!==o["x"].backspace&&t!==o["x"].delete||this.deleteCurrentItem())},deleteCurrentItem:function(){var t=this.selectedIndex,e=this.selectedItems[t];if(this.isInteractive&&!this.getDisabled(e)){var a=this.selectedItems.length-1;if(-1!==this.selectedIndex||0===a){var i=this.selectedItems.length,n=t!==i-1?t:t-1,s=this.selectedItems[n];s?this.selectItem(e):this.setValue(this.multiple?[]:void 0),this.selectedIndex=n}else this.selectedIndex=a}},clearableCallback:function(){this.internalSearch=void 0,n["a"].options.methods.clearableCallback.call(this)},genInput:function(){var t=s["a"].options.methods.genInput.call(this);return t.data=Object(r["a"])(t.data,{attrs:{"aria-activedescendant":Object(o["p"])(this.$refs.menu,"activeTile.id"),autocomplete:Object(o["p"])(t.data,"attrs.autocomplete","off")},domProps:{value:this.internalSearch}}),t},genInputSlot:function(){var t=n["a"].options.methods.genInputSlot.call(this);return t.data.attrs.role="combobox",t},genSelections:function(){return this.hasSlot||this.multiple?n["a"].options.methods.genSelections.call(this):[]},onClick:function(t){this.isInteractive&&(this.selectedIndex>-1?this.selectedIndex=-1:this.onFocus(),this.isAppendInner(t.target)||this.activateMenu())},onInput:function(t){if(!(this.selectedIndex>-1)&&t.target){var e=t.target,a=e.value;e.value&&this.activateMenu(),this.internalSearch=a,this.badInput=e.validity&&e.validity.badInput}},onKeyDown:function(t){var e=t.keyCode;n["a"].options.methods.onKeyDown.call(this,t),this.changeSelectedIndex(e)},onSpaceDown:function(t){},onTabDown:function(t){n["a"].options.methods.onTabDown.call(this,t),this.updateSelf()},onUpDown:function(t){t.preventDefault(),this.activateMenu()},selectItem:function(t){n["a"].options.methods.selectItem.call(this,t),this.setSearch()},setSelectedItems:function(){n["a"].options.methods.setSelectedItems.call(this),this.isFocused||this.setSearch()},setSearch:function(){var t=this;this.$nextTick((function(){t.multiple&&t.internalSearch&&t.isMenuActive||(t.internalSearch=!t.selectedItems.length||t.multiple||t.hasSlot?null:t.getText(t.selectedItem))}))},updateSelf:function(){(this.searchIsDirty||this.internalValue)&&(this.valueComparator(this.internalSearch,this.getValue(this.internalValue))||this.setSearch())},hasItem:function(t){return this.selectedValues.indexOf(this.getValue(t))>-1},onCopy:function(t){var e,a;if(-1!==this.selectedIndex){var i=this.selectedItems[this.selectedIndex],n=this.getText(i);null==(e=t.clipboardData)||e.setData("text/plain",n),null==(a=t.clipboardData)||a.setData("text/vnd.vuetify.autocomplete.item+plain",n),t.preventDefault()}}}})}}]);