(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5840e045"],{"4bd4":function(t,e,i){"use strict";i("4de4"),i("7db0"),i("4160"),i("caad"),i("07ac"),i("2532"),i("159b");var a=i("5530"),s=i("58df"),n=i("7e2b"),r=i("3206");e["a"]=Object(s["a"])(n["a"],Object(r["b"])("form")).extend({name:"v-form",provide:function(){return{form:this}},inheritAttrs:!1,props:{disabled:Boolean,lazyValidation:Boolean,readonly:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(t){var e=Object.values(t).includes(!0);this.$emit("input",!e)},deep:!0,immediate:!0}},methods:{watchInput:function(t){var e=this,i=function(t){return t.$watch("hasError",(function(i){e.$set(e.errorBag,t._uid,i)}),{immediate:!0})},a={_uid:t._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?a.shouldValidate=t.$watch("shouldValidate",(function(s){s&&(e.errorBag.hasOwnProperty(t._uid)||(a.valid=i(t)))})):a.valid=i(t),a},validate:function(){return 0===this.inputs.filter((function(t){return!t.validate(!0)})).length},reset:function(){this.inputs.forEach((function(t){return t.reset()})),this.resetErrorBag()},resetErrorBag:function(){var t=this;this.lazyValidation&&setTimeout((function(){t.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(t){return t.resetValidation()})),this.resetErrorBag()},register:function(t){this.inputs.push(t),this.watchers.push(this.watchInput(t))},unregister:function(t){var e=this.inputs.find((function(e){return e._uid===t._uid}));if(e){var i=this.watchers.find((function(t){return t._uid===e._uid}));i&&(i.valid(),i.shouldValidate()),this.watchers=this.watchers.filter((function(t){return t._uid!==e._uid})),this.inputs=this.inputs.filter((function(t){return t._uid!==e._uid})),this.$delete(this.errorBag,e._uid)}}},render:function(t){var e=this;return t("form",{staticClass:"v-form",attrs:Object(a["a"])({novalidate:!0},this.attrs$),on:{submit:function(t){return e.$emit("submit",t)}}},this.$slots.default)}})},"5a52":function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[i("v-spacer"),i("strong",[t._t("system-bar")],2)],1),i("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[i("v-app-bar-nav-icon",{staticClass:"grey--text",class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(e){e.stopPropagation(),t.drawer=!t.drawer}}}),i("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(e){e.stopPropagation(),t.$router.push("/dashboard/"+t.$store.getters["auth/AccessToken"]).catch((function(t){}))}}},[i("span",{staticClass:"hidden-sm-and-down"},[t._v(" "+t._s(t.NamaAPPAlias)+" ")])]),i("v-spacer"),i("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:t._u([{key:"activator",fn:function(e){var a=e.on;return[i("v-avatar",{attrs:{size:"30"}},[i("v-img",t._g({attrs:{src:t.photoUser}},a))],1)]}}])},[i("v-list",[i("v-list-item",[i("v-list-item-avatar",[i("v-img",{attrs:{src:t.photoUser}})],1),i("v-list-item-content",[i("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),i("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),i("v-divider"),i("v-list-item",{attrs:{to:"/system-users/profil"}},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-account")])],1),i("v-list-item-title",[t._v("Profil")])],1),i("v-divider"),i("v-list-item",{on:{click:function(e){return e.preventDefault(),t.logout(e)}}},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-power")])],1),i("v-list-item-title",[t._v("Logout")])],1)],1)],1),i("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),i("v-app-bar-nav-icon",{on:{click:function(e){e.stopPropagation(),t.drawerRight=!t.drawerRight}}},[i("v-icon",[t._v("mdi-menu-open")])],1)],1),i("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",app:""},model:{value:t.drawer,callback:function(e){t.drawer=e},expression:"drawer"}},[i("v-list-item",[i("v-list-item-avatar",[i("v-img",{attrs:{src:t.photoUser},on:{click:function(e){return e.stopPropagation(),t.toProfile(e)}}})],1),i("v-list-item-content",[i("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),i("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),i("v-divider"),i("v-list",{attrs:{expand:""}},[t.CAN_ACCESS("SETTING-USERS-GROUP")?i("v-list-item",{staticClass:"yellow",attrs:{to:{path:"/setting/users"},link:"",color:"green"}},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-home-floor-b")])],1),i("v-list-item-content",[i("v-list-item-title",[t._v("BOARD USERS")])],1)],1):t._e(),t.CAN_ACCESS("PERMISSIONS_BROWSE")?i("v-subheader",[t._v("HAK AKSES")]):t._e(),t.CAN_ACCESS("PERMISSIONS_BROWSE")?i("v-list-item",{attrs:{link:"",to:"/setting/users/permissions"}},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-account-key")])],1),i("v-list-item-content",[i("v-list-item-title",[t._v(" PERMISSIONS ")])],1)],1):t._e(),t.CAN_ACCESS("ROLES_BROWSE")?i("v-list-item",{attrs:{link:"",to:"/setting/users/roles"}},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-account-group")])],1),i("v-list-item-content",[i("v-list-item-title",[t._v(" ROLES ")])],1)],1):t._e(),i("v-subheader",[t._v("PENGGUNA")]),t.CAN_ACCESS("USERS_BROWSE")?i("v-list-item",{attrs:{link:"",to:"/setting/users/superadmin"}},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-account")])],1),i("v-list-item-content",[i("v-list-item-title",[t._v(" USER SUPERADMIN ")])],1)],1):t._e(),t.CAN_ACCESS("USERS BAPELITBANG_BROWSE")?i("v-list-item",{attrs:{link:"",to:"/setting/users/bapelitbang"}},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-account")])],1),i("v-list-item-content",[i("v-list-item-title",[t._v(" USERS BAPELITBANG ")])],1)],1):t._e(),t.CAN_ACCESS("USERS OPD_BROWSE")?i("v-list-item",{attrs:{link:"",to:"/setting/users/opd"}},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-account")])],1),i("v-list-item-content",[i("v-list-item-title",[t._v(" USERS OPD ")])],1)],1):t._e()],1)],1),t.showrightsidebar?i("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:t.drawerRight,callback:function(e){t.drawerRight=e},expression:"drawerRight"}},[i("v-list",{attrs:{dense:""}},[i("v-list-item",[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-menu-open")])],1),i("v-list-item-content",[i("v-list-item-title",{staticClass:"title"},[t._v(" OPTIONS ")])],1)],1),i("v-divider"),i("v-list-item",{staticClass:"teal lighten-5 mb-5"},[i("v-list-item-icon",{staticClass:"mr-2"},[i("v-icon",[t._v("mdi-filter")])],1),i("v-list-item-content",[i("v-list-item-title",[t._v("FILTER")])],1)],1),t._t("filtersidebar")],2)],1):t._e(),i("v-main",{staticClass:"mx-4 mb-4"},[t._t("default")],2),i("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[i("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[i("v-divider"),i("v-card-text",{staticClass:"py-2 white--text text-center"},[i("strong",[t._v(t._s(t.NamaAPP)+" (2019-2020)")]),t._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),i("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev"}},[i("v-icon",[t._v("mdi-github")])],1)],1)],1)],1)],1)},s=[],n=(i("ac1f"),i("5319"),i("5530")),r=i("2f62"),o={name:"SettingUserLayout",props:{showrightsidebar:{type:Boolean,default:!0}},data:function(){return{loginTime:0,drawer:null,drawerRight:null}},methods:{logout:function(){var t=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")})).catch((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")}))}},computed:Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(r["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"})),Object(r["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var t,e=this.ATTRIBUTE_USER("foto");return t=""==e?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+e,t}}),watch:{loginTime:{handler:function(t){var e=this;t>=0?setTimeout((function(){e.loginTime=1==e.AUTHENTICATED?e.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,d=i("2877"),c=i("6544"),u=i.n(c),v=i("40dc"),m=i("5bc1"),h=i("8212"),f=i("8336"),p=i("b0af"),g=i("99d9"),b=i("ce7e"),_=i("553a"),A=i("132d"),x=i("adda"),S=i("8860"),C=i("da13"),T=i("8270"),E=i("5d23"),O=i("34c3"),k=i("f6c4"),w=i("e449"),I=i("f774"),R=i("2fa4"),y=i("e0c7"),L=i("afd9"),V=i("2a7f"),N=Object(d["a"])(l,a,s,!1,null,null,null);e["a"]=N.exports;u()(N,{VAppBar:v["a"],VAppBarNavIcon:m["a"],VAvatar:h["a"],VBtn:f["a"],VCard:p["a"],VCardText:g["c"],VDivider:b["a"],VFooter:_["a"],VIcon:A["a"],VImg:x["a"],VList:S["a"],VListItem:C["a"],VListItemAvatar:T["a"],VListItemContent:E["a"],VListItemIcon:O["a"],VListItemSubtitle:E["b"],VListItemTitle:E["c"],VMain:k["a"],VMenu:w["a"],VNavigationDrawer:I["a"],VSpacer:R["a"],VSubheader:y["a"],VSystemBar:L["a"],VToolbarTitle:V["b"]})},"7f7a":function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("SettingUserLayout",{attrs:{showrightsidebar:!1},scopedSlots:t._u([{key:"system-bar",fn:function(){return[t._v(" Tahun Anggaran: "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" | Bulan Realisasi:"+t._s(t.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0}])},[i("ModuleHeader",{scopedSlots:t._u([{key:"icon",fn:function(){return[t._v(" mdi-account-group ")]},proxy:!0},{key:"name",fn:function(){return[t._v(" ROLES ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[i("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:t.breadcrumbs},scopedSlots:t._u([{key:"divider",fn:function(){return[i("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[i("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[t._v(" Masing-masing user bisa memiliki beberapa role, minimal 1 role untuk bisa menggunakan sistem. Setiap role memiliki permission. ")])]},proxy:!0}])}),i("v-container",{attrs:{fluid:""}},[i("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[i("v-col",{attrs:{xs:"12",sm:"12",md:"12"}},[i("v-card",[i("v-card-text",[i("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1)],1)],1),i("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[i("v-col",{attrs:{xs:"12",sm:"12",md:"12"}},[i("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.datatable,search:t.search,"item-key":"id","sort-by":"name","show-expand":"",expanded:t.expanded,"single-expand":!0,loading:t.datatableLoading,"loading-text":"Loading... Please wait"},on:{"update:expanded":function(e){t.expanded=e},"click:row":t.dataTableRowClicked},scopedSlots:t._u([{key:"top",fn:function(){return[i("v-toolbar",{attrs:{flat:"",color:"white"}},[i("v-toolbar-title",[t._v("DAFTAR ROLE")]),i("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),i("v-spacer"),i("v-dialog",{attrs:{"max-width":"500px",persistent:""},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[i("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:t.form_valid,callback:function(e){t.form_valid=e},expression:"form_valid"}},[i("v-card",[i("v-card-title",[i("span",{staticClass:"headline"},[t._v(t._s(t.formTitle))])]),i("v-card-text",[i("v-alert",{attrs:{color:"error",value:t.form_error_message.length>0,icon:"mdi-close-octagon-outline"}},[t._v(" "+t._s(t.form_error_message)+" ")]),i("v-container",{attrs:{fluid:""}},[i("v-row",[i("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[i("v-text-field",{attrs:{label:"NAMA ROLE",rules:t.rule_role_name},model:{value:t.editedItem.name,callback:function(e){t.$set(t.editedItem,"name",e)},expression:"editedItem.name"}})],1)],1)],1)],1),i("v-card-actions",[i("v-spacer"),i("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.close(e)}}},[t._v("BATAL")]),i("v-btn",{attrs:{color:"blue darken-1",text:"",loading:t.btnLoading,disabled:!t.form_valid||t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.save(e)}}},[t._v(" SIMPAN ")])],1)],1)],1)],1),i("v-dialog",{attrs:{"max-width":"800px",persistent:""},model:{value:t.dialogRolePermission,callback:function(e){t.dialogRolePermission=e},expression:"dialogRolePermission"}},[i("RolePermissions",{attrs:{role:t.editedItem,daftarpermissions:t.daftar_permissions,permissionsselected:t.permissions_selected},on:{closeRolePermissions:t.closeRolePermissions}})],1)],1)]},proxy:!0},{key:"item.actions",fn:function(e){var a=e.item;return[i("v-icon",{staticClass:"mr-2",attrs:{small:"",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.setPermission(a)}}},[t._v(" mdi-axis-arrow-lock ")]),i("v-icon",{staticClass:"mr-2",attrs:{small:"",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.viewItem(a)}}},[t._v(" mdi-eye ")]),i("v-icon",{staticClass:"mr-2",attrs:{small:""},on:{click:function(e){return e.stopPropagation(),t.editItem(a)}}},[t._v(" mdi-pencil ")])]}},{key:"expanded-item",fn:function(e){var a=e.headers,s=e.item;return[i("td",{staticClass:"text-center",attrs:{colspan:a.length}},[i("strong",[t._v("ID:")]),t._v(t._s(s.id)+" "),i("strong",[t._v("created_at:")]),t._v(t._s(t.$date(s.created_at).format("DD/MM/YYYY HH:mm"))+" "),i("strong",[t._v("updated_at:")]),t._v(t._s(t.$date(s.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])]}},{key:"no-data",fn:function(){return[t._v(" Data belum tersedia ")]},proxy:!0}])})],1),i("v-dialog",{attrs:{width:"800px"},model:{value:t.dialogdetail,callback:function(e){t.dialogdetail=e},expression:"dialogdetail"}},[i("v-card",[i("v-card-title",[i("span",{staticClass:"headline"},[t._v("DETAIL ROLE")])]),i("v-card-text",[i("v-container",{attrs:{fluid:""}},[i("v-row",{attrs:{"no-gutters":""}},[i("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[i("v-card",{attrs:{flat:""}},[i("v-card-title",[t._v("ID :")]),i("v-card-subtitle",[t._v(" "+t._s(t.editedItem.id)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e(),i("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[i("v-card",{attrs:{flat:""}},[i("v-card-title",[t._v(" TANGGAL BUAT : ")]),i("v-card-subtitle",[t._v(" "+t._s(t.$date(t.editedItem.created_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e()],1),i("v-row",{attrs:{"no-gutters":""}},[i("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[i("v-card",{attrs:{flat:""}},[i("v-card-title",[t._v("NAMA ROLE :")]),i("v-card-subtitle",[t._v(" "+t._s(t.editedItem.name)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e(),i("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[i("v-card",{attrs:{flat:""}},[i("v-card-title",[t._v("TANGGAL UBAH :")]),i("v-card-subtitle",[t._v(" "+t._s(t.$date(t.editedItem.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e()],1),i("v-row",{attrs:{"no-gutters":""}},[i("v-col",{attrs:{cols:"12"}},[i("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headersdetail,items:t.permissions_selected,"item-key":"name","sort-by":"name"}})],1)],1)],1)],1),i("v-card-actions")],1)],1)],1)],1)],1)},s=[],n=(i("c975"),i("b0c0"),i("5530")),r=i("2f62"),o=i("5a52"),l=i("e477"),d=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-card",[i("v-card-title",[i("span",{staticClass:"headline"},[t._v("ROLE PERMISSIONS")])]),i("v-card-text",[i("v-container",{attrs:{fluid:""}},[i("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[i("v-col",{attrs:{xs:"12",sm:"12",md:"12"}},[i("v-card",[i("v-card-text",[i("v-row",{attrs:{"no-gutters":""}},[i("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[i("v-card",{attrs:{flat:""}},[i("v-card-title",[t._v("ID :")]),i("v-card-subtitle",[t._v(" "+t._s(t.role.id)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e(),i("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[i("v-card",{attrs:{flat:""}},[i("v-card-title",[t._v("TANGGAL BUAT :")]),i("v-card-subtitle",[t._v(" "+t._s(t.$date(t.role.created_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e()],1),i("v-row",{attrs:{"no-gutters":""}},[i("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[i("v-card",{attrs:{flat:""}},[i("v-card-title",[t._v("NAMA ROLE :")]),i("v-card-subtitle",[t._v(" "+t._s(t.role.name)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e(),i("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[i("v-card",{attrs:{flat:""}},[i("v-card-title",[t._v("TANGGAL UBAH :")]),i("v-card-subtitle",[t._v(" "+t._s(t.$date(t.role.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e()],1)],1)],1)],1)],1),i("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[i("v-col",{attrs:{cols:"12"}},[i("v-card",[i("v-card-text",[i("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1)],1)],1),i("v-row",{attrs:{"no-gutters":""}},[i("v-col",{attrs:{col:"12"}},[i("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.daftar_permissions,search:t.search,"item-key":"name","sort-by":"name","show-select":""},scopedSlots:t._u([{key:"item.actions",fn:function(e){var a=e.item;return[i("v-tooltip",{attrs:{color:"info",bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on,n=e.attrs;return[i("v-btn",t._g(t._b({attrs:{icon:"",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.revoke(a)}}},"v-btn",n,!1),s),[i("v-icon",{attrs:{small:""}},[t._v(" mdi-delete ")])],1)]}}],null,!0)},[i("span",[t._v("Hapus Permission dari Role ini")])])]}}]),model:{value:t.permissions_selected,callback:function(e){t.permissions_selected=e},expression:"permissions_selected"}})],1)],1)],1)],1),i("v-card-actions",[i("v-spacer"),i("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.close(e)}}},[t._v("KELUAR")]),i("v-btn",{attrs:{color:"blue darken-1",text:"",loading:t.btnLoading,disabled:t.btnLoading||!t.perm_selected.length>0},on:{click:function(e){return e.stopPropagation(),t.save(e)}}},[t._v(" SIMPAN ")])],1)],1)},c=[],u={name:"RolePermissions",data:function(){return{btnLoading:!1,headers:[{text:"NAMA PERMISSION",value:"name"},{text:"GUARD",value:"guard_name"},{text:"AKSI",value:"actions",sortable:!1,width:100}],search:"",perm_selected:[]}},methods:{save:function(){var t=this;this.btnLoading=!0,this.$ajax.post("/setting/roles/storerolepermissions",{role_id:this.role.id,chkpermission:this.permissions_selected},{headers:{Authorization:this.TOKEN}}).then((function(){t.btnLoading=!1,t.close()})).catch((function(){t.btnLoading=!1}))},revoke:function(t){var e=this;this.btnLoading=!0,this.$ajax.post("/setting/roles/revokerolepermissions",{role_id:this.role.id,name:t.name},{headers:{Authorization:this.TOKEN}}).then((function(){e.btnLoading=!1,e.close()})).catch((function(){e.btnLoading=!1}))},close:function(){this.btnLoading=!1,this.permissions_selected=[],this.$emit("closeRolePermissions",this.role.id)}},props:{role:Object,daftarpermissions:Array,permissionsselected:Array},computed:Object(n["a"])(Object(n["a"])({},Object(r["b"])("auth",{TOKEN:"Token"})),{},{daftar_permissions:function(){return this.daftarpermissions},permissions_selected:{get:function(){return this.perm_selected.length>0?this.perm_selected:this.permissionsselected},set:function(t){this.perm_selected=t}}})},v=u,m=i("2877"),h=i("6544"),f=i.n(h),p=i("8336"),g=i("b0af"),b=i("99d9"),_=i("62ad"),A=i("a523"),x=i("8fea"),S=i("132d"),C=i("6b53"),T=i("0fd9"),E=i("2fa4"),O=i("8654"),k=(i("a9e3"),i("ade3")),w=(i("9734"),i("4ad4")),I=i("a9ad"),R=i("16b7"),y=i("b848"),L=i("75eb"),V=i("f573"),N=i("f2e7"),P=i("80d2"),$=i("d9bd"),B=i("58df"),D=Object(B["a"])(I["a"],R["a"],y["a"],L["a"],V["a"],N["a"]).extend({name:"v-tooltip",props:{closeDelay:{type:[Number,String],default:0},disabled:Boolean,fixed:{type:Boolean,default:!0},openDelay:{type:[Number,String],default:0},openOnHover:{type:Boolean,default:!0},tag:{type:String,default:"span"},transition:String},data:function(){return{calculatedMinWidth:0,closeDependents:!1}},computed:{calculatedLeft:function(){var t=this.dimensions,e=t.activator,i=t.content,a=!this.bottom&&!this.left&&!this.top&&!this.right,s=!1!==this.attach?e.offsetLeft:e.left,n=0;return this.top||this.bottom||a?n=s+e.width/2-i.width/2:(this.left||this.right)&&(n=s+(this.right?e.width:-i.width)+(this.right?10:-10)),this.nudgeLeft&&(n-=parseInt(this.nudgeLeft)),this.nudgeRight&&(n+=parseInt(this.nudgeRight)),"".concat(this.calcXOverflow(n,this.dimensions.content.width),"px")},calculatedTop:function(){var t=this.dimensions,e=t.activator,i=t.content,a=!1!==this.attach?e.offsetTop:e.top,s=0;return this.top||this.bottom?s=a+(this.bottom?e.height:-i.height)+(this.bottom?10:-10):(this.left||this.right)&&(s=a+e.height/2-i.height/2),this.nudgeTop&&(s-=parseInt(this.nudgeTop)),this.nudgeBottom&&(s+=parseInt(this.nudgeBottom)),"".concat(this.calcYOverflow(s+this.pageYOffset),"px")},classes:function(){return{"v-tooltip--top":this.top,"v-tooltip--right":this.right,"v-tooltip--bottom":this.bottom,"v-tooltip--left":this.left,"v-tooltip--attached":""===this.attach||!0===this.attach||"attach"===this.attach}},computedTransition:function(){return this.transition?this.transition:this.isActive?"scale-transition":"fade-transition"},offsetY:function(){return this.top||this.bottom},offsetX:function(){return this.left||this.right},styles:function(){return{left:this.calculatedLeft,maxWidth:Object(P["g"])(this.maxWidth),minWidth:Object(P["g"])(this.minWidth),opacity:this.isActive?.9:0,top:this.calculatedTop,zIndex:this.zIndex||this.activeZIndex}}},beforeMount:function(){var t=this;this.$nextTick((function(){t.value&&t.callActivate()}))},mounted:function(){"v-slot"===Object(P["t"])(this,"activator",!0)&&Object($["b"])("v-tooltip's activator slot must be bound, try '<template #activator=\"data\"><v-btn v-on=\"data.on>'",this)},methods:{activate:function(){this.updateDimensions(),requestAnimationFrame(this.startTransition)},deactivate:function(){this.runDelay("close")},genActivatorListeners:function(){var t=this,e=w["a"].options.methods.genActivatorListeners.call(this);return e.focus=function(e){t.getActivator(e),t.runDelay("open")},e.blur=function(e){t.getActivator(e),t.runDelay("close")},e.keydown=function(e){e.keyCode===P["x"].esc&&(t.getActivator(e),t.runDelay("close"))},e},genTransition:function(){var t=this.genContent();return this.computedTransition?this.$createElement("transition",{props:{name:this.computedTransition}},[t]):t},genContent:function(){var t;return this.$createElement("div",this.setBackgroundColor(this.color,{staticClass:"v-tooltip__content",class:(t={},Object(k["a"])(t,this.contentClass,!0),Object(k["a"])(t,"menuable__content__active",this.isActive),Object(k["a"])(t,"v-tooltip__content--fixed",this.activatorFixed),t),style:this.styles,attrs:this.getScopeIdAttrs(),directives:[{name:"show",value:this.isContentActive}],ref:"content"}),this.getContentSlot())}},render:function(t){var e=this;return t(this.tag,{staticClass:"v-tooltip",class:this.classes},[this.showLazyContent((function(){return[e.genTransition()]})),this.genActivator()])}}),M=Object(m["a"])(v,d,c,!1,null,null,null),j=M.exports;f()(M,{VBtn:p["a"],VCard:g["a"],VCardActions:b["a"],VCardSubtitle:b["b"],VCardText:b["c"],VCardTitle:b["d"],VCol:_["a"],VContainer:A["a"],VDataTable:x["a"],VIcon:S["a"],VResponsive:C["a"],VRow:T["a"],VSpacer:E["a"],VTextField:O["a"],VTooltip:D});var U={name:"Roles",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.ACCESS_TOKEN},{text:"USER SISTEM",disabled:!1,href:"/setting/users"},{text:"ROLES",disabled:!0,href:"#"}],this.initialize()},data:function(){return{breadcrumbs:[],datatableLoading:!1,btnLoading:!1,expanded:[],datatable:[],daftar_permissions:[],permissions_selected:[],headers:[{text:"NAMA ROLE",value:"name"},{text:"GUARD",value:"guard_name"},{text:"AKSI",value:"actions",sortable:!1,width:130}],headersdetail:[{text:"NAMA PERMISSION",value:"name"},{text:"GUARD",value:"guard_name"}],search:"",form_valid:!0,dialog:!1,dialogdetail:!1,dialogRolePermission:!1,editedIndex:-1,editedItem:{id:0,name:"",guard:"",created_at:"",updated_at:""},defaultItem:{id:0,name:"",guard:"api",created_at:"",updated_at:""},rule_role_name:[function(t){return!!t||"Mohon untuk di isi nama Role !!!"},function(t){return/^[A-Za-z]*$/.test(t)||"Nama Role hanya boleh string"}],form_error_message:""}},methods:{initialize:function(){var t=this;this.datatableLoading=!0,this.$ajax.get("/setting/roles",{headers:{Authorization:this.TOKEN}}).then((function(e){var i=e.data,a=e.status;200==a&&(t.datatable=i.roles,t.datatableLoading=!1)}))},dataTableRowClicked:function(t){t===this.expanded[0]?this.expanded=[]:this.expanded=[t]},viewItem:function(t){var e=this;this.editedIndex=this.datatable.indexOf(t),this.editedItem=Object.assign({},t),this.$ajax.get("/setting/roles/"+t.id+"/permission",{headers:{Authorization:this.TOKEN}}).then((function(t){var i=t.data,a=t.status;200==a&&(e.permissions_selected=i.permissions)})),this.dialogdetail=!0},editItem:function(t){this.editedIndex=this.datatable.indexOf(t),this.editedItem=Object.assign({},t),this.dialog=!0},setPermission:function(t){var e=this;this.$ajax.get("/setting/permissions",{headers:{Authorization:this.TOKEN}}).then((function(t){var i=t.data,a=t.status;200==a&&(e.daftar_permissions=i.permissions)})),this.$ajax.get("/setting/roles/"+t.id+"/permission",{headers:{Authorization:this.TOKEN}}).then((function(t){var i=t.data,a=t.status;200==a&&(e.permissions_selected=i.permissions)})),this.dialogRolePermission=!0,this.editedItem=t},close:function(){var t=this;this.btnLoading=!1,this.dialog=!1,this.$refs.frmdata.reset(),this.form_error_message="",setTimeout((function(){t.editedItem=Object.assign({},t.defaultItem),t.editedIndex=-1}),300)},closeRolePermissions:function(){this.permissions_selected=[],this.dialogRolePermission=!1},save:function(){var t=this;this.form_error_message="",this.$refs.frmdata.validate()&&(this.btnLoading=!0,this.editedIndex>-1?this.$ajax.post("/setting/roles/"+this.editedItem.id,{_method:"PUT",name:this.editedItem.name.toLowerCase()},{headers:{Authorization:this.TOKEN}}).then((function(e){var i=e.data;Object.assign(t.datatable[t.editedIndex],i.roles),t.close()})).catch((function(){t.btnLoading=!1})):this.$ajax.post("/setting/roles/store",{name:this.editedItem.name.toLowerCase()},{headers:{Authorization:this.TOKEN}}).then((function(e){var i=e.data;t.datatable.push(i.roles),t.close()})).catch((function(){t.btnLoading=!1})))}},computed:Object(n["a"])({formTitle:function(){return-1===this.editedIndex?"TAMBAH ROLE":"EDIT ROLE"}},Object(r["b"])("auth",{ACCESS_TOKEN:"AccessToken",TOKEN:"Token"})),watch:{dialog:function(t){t||this.close()}},components:{SettingUserLayout:o["a"],ModuleHeader:l["a"],RolePermissions:j}},Y=U,H=i("0798"),z=i("2bc5"),K=i("169a"),G=i("ce7e"),W=i("4bd4"),F=i("71d9"),J=i("2a7f"),X=Object(m["a"])(Y,a,s,!1,null,null,null);e["default"]=X.exports;f()(X,{VAlert:H["a"],VBreadcrumbs:z["a"],VBtn:p["a"],VCard:g["a"],VCardActions:b["a"],VCardSubtitle:b["b"],VCardText:b["c"],VCardTitle:b["d"],VCol:_["a"],VContainer:A["a"],VDataTable:x["a"],VDialog:K["a"],VDivider:G["a"],VForm:W["a"],VIcon:S["a"],VResponsive:C["a"],VRow:T["a"],VSpacer:E["a"],VTextField:O["a"],VToolbar:F["a"],VToolbarTitle:J["b"]})},9734:function(t,e,i){}}]);