(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-4a46c438"],{"2bfd":function(t,e,a){},"4bd4":function(t,e,a){"use strict";a("4de4"),a("7db0"),a("4160"),a("caad"),a("07ac"),a("2532"),a("159b");var i=a("5530"),s=a("58df"),n=a("7e2b"),r=a("3206");e["a"]=Object(s["a"])(n["a"],Object(r["b"])("form")).extend({name:"v-form",provide:function(){return{form:this}},inheritAttrs:!1,props:{disabled:Boolean,lazyValidation:Boolean,readonly:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(t){var e=Object.values(t).includes(!0);this.$emit("input",!e)},deep:!0,immediate:!0}},methods:{watchInput:function(t){var e=this,a=function(t){return t.$watch("hasError",(function(a){e.$set(e.errorBag,t._uid,a)}),{immediate:!0})},i={_uid:t._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?i.shouldValidate=t.$watch("shouldValidate",(function(s){s&&(e.errorBag.hasOwnProperty(t._uid)||(i.valid=a(t)))})):i.valid=a(t),i},validate:function(){return 0===this.inputs.filter((function(t){return!t.validate(!0)})).length},reset:function(){this.inputs.forEach((function(t){return t.reset()})),this.resetErrorBag()},resetErrorBag:function(){var t=this;this.lazyValidation&&setTimeout((function(){t.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(t){return t.resetValidation()})),this.resetErrorBag()},register:function(t){this.inputs.push(t),this.watchers.push(this.watchInput(t))},unregister:function(t){var e=this.inputs.find((function(e){return e._uid===t._uid}));if(e){var a=this.watchers.find((function(t){return t._uid===e._uid}));a&&(a.valid(),a.shouldValidate()),this.watchers=this.watchers.filter((function(t){return t._uid!==e._uid})),this.inputs=this.inputs.filter((function(t){return t._uid!==e._uid})),this.$delete(this.errorBag,e._uid)}}},render:function(t){var e=this;return t("form",{staticClass:"v-form",attrs:Object(i["a"])({novalidate:!0},this.attrs$),on:{submit:function(t){return e.$emit("submit",t)}}},this.$slots.default)}})},"5a52":function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[a("v-spacer"),a("strong",[t._t("system-bar")],2)],1),a("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[a("v-app-bar-nav-icon",{staticClass:"grey--text",class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(e){e.stopPropagation(),t.drawer=!t.drawer}}}),a("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(e){e.stopPropagation(),t.$router.push("/dashboard/"+t.$store.getters["auth/AccessToken"]).catch((function(t){}))}}},[a("span",{staticClass:"hidden-sm-and-down"},[t._v(" "+t._s(t.NamaAPPAlias)+" ")])]),a("v-spacer"),a("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:t._u([{key:"activator",fn:function(e){var i=e.on;return[a("v-avatar",{attrs:{size:"30"}},[a("v-img",t._g({attrs:{src:t.photoUser}},i))],1)]}}])},[a("v-list",[a("v-list-item",[a("v-list-item-avatar",[a("v-img",{attrs:{src:t.photoUser}})],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),a("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),a("v-divider"),a("v-list-item",{attrs:{to:"/system-users/profil"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account")])],1),a("v-list-item-title",[t._v("Profil")])],1),a("v-divider"),a("v-list-item",{on:{click:function(e){return e.preventDefault(),t.logout(e)}}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-power")])],1),a("v-list-item-title",[t._v("Logout")])],1)],1)],1),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-app-bar-nav-icon",{on:{click:function(e){e.stopPropagation(),t.drawerRight=!t.drawerRight}}},[a("v-icon",[t._v("mdi-menu-open")])],1)],1),a("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",app:""},model:{value:t.drawer,callback:function(e){t.drawer=e},expression:"drawer"}},[a("v-list-item",[a("v-list-item-avatar",[a("v-img",{attrs:{src:t.photoUser},on:{click:function(e){return e.stopPropagation(),t.toProfile(e)}}})],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),a("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),a("v-divider"),a("v-list",{attrs:{expand:""}},[t.CAN_ACCESS("SETTING-USERS-GROUP")?a("v-list-item",{staticClass:"yellow",attrs:{to:{path:"/setting/users"},link:"",color:"green"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-home-floor-b")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("BOARD USERS")])],1)],1):t._e(),t.CAN_ACCESS("PERMISSIONS_BROWSE")?a("v-subheader",[t._v("HAK AKSES")]):t._e(),t.CAN_ACCESS("PERMISSIONS_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/setting/users/permissions"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account-key")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" PERMISSIONS ")])],1)],1):t._e(),t.CAN_ACCESS("ROLES_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/setting/users/roles"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account-group")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" ROLES ")])],1)],1):t._e(),a("v-subheader",[t._v("PENGGUNA")]),t.CAN_ACCESS("USERS_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/setting/users/superadmin"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" USER SUPERADMIN ")])],1)],1):t._e(),t.CAN_ACCESS("USERS BAPELITBANG_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/setting/users/bapelitbang"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" USERS BAPELITBANG ")])],1)],1):t._e(),t.CAN_ACCESS("USERS OPD_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/setting/users/opd"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" USERS OPD ")])],1)],1):t._e()],1)],1),t.showrightsidebar?a("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:t.drawerRight,callback:function(e){t.drawerRight=e},expression:"drawerRight"}},[a("v-list",{attrs:{dense:""}},[a("v-list-item",[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-menu-open")])],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" OPTIONS ")])],1)],1),a("v-divider"),a("v-list-item",{staticClass:"teal lighten-5 mb-5"},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-filter")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("FILTER")])],1)],1),t._t("filtersidebar")],2)],1):t._e(),a("v-main",{staticClass:"mx-4 mb-4"},[t._t("default")],2),a("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[a("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[a("v-divider"),a("v-card-text",{staticClass:"py-2 white--text text-center"},[a("strong",[t._v(t._s(t.NamaAPP)+" (2019-2020)")]),t._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),a("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev"}},[a("v-icon",[t._v("mdi-github")])],1)],1)],1)],1)],1)},s=[],n=(a("ac1f"),a("5319"),a("5530")),r=a("2f62"),o={name:"SettingUserLayout",props:{showrightsidebar:{type:Boolean,default:!0}},data:function(){return{loginTime:0,drawer:null,drawerRight:null}},methods:{logout:function(){var t=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")})).catch((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")}))}},computed:Object(n["a"])(Object(n["a"])(Object(n["a"])({},Object(r["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"})),Object(r["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var t,e=this.ATTRIBUTE_USER("foto");return t=""==e?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+e,t}}),watch:{loginTime:{handler:function(t){var e=this;t>=0?setTimeout((function(){e.loginTime=1==e.AUTHENTICATED?e.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,d=a("2877"),c=a("6544"),u=a.n(c),m=a("40dc"),h=a("5bc1"),v=a("8212"),p=a("8336"),f=a("b0af"),g=a("99d9"),b=a("ce7e"),_=a("553a"),I=a("132d"),S=a("adda"),x=a("8860"),y=a("da13"),A=a("8270"),k=a("5d23"),E=a("34c3"),w=a("f6c4"),O=a("e449"),C=a("f774"),T=a("2fa4"),P=a("e0c7"),L=a("afd9"),R=a("2a7f"),V=Object(d["a"])(l,i,s,!1,null,null,null);e["a"]=V.exports;u()(V,{VAppBar:m["a"],VAppBarNavIcon:h["a"],VAvatar:v["a"],VBtn:p["a"],VCard:f["a"],VCardText:g["c"],VDivider:b["a"],VFooter:_["a"],VIcon:I["a"],VImg:S["a"],VList:x["a"],VListItem:y["a"],VListItemAvatar:A["a"],VListItemContent:k["a"],VListItemIcon:E["a"],VListItemSubtitle:k["b"],VListItemTitle:k["c"],VMain:w["a"],VMenu:O["a"],VNavigationDrawer:C["a"],VSpacer:T["a"],VSubheader:P["a"],VSystemBar:L["a"],VToolbarTitle:R["b"]})},9727:function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("SettingUserLayout",{attrs:{showrightsidebar:!1},scopedSlots:t._u([{key:"system-bar",fn:function(){return[t._v(" Tahun Anggaran: "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" | Bulan Realisasi:"+t._s(t.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0}])},[a("ModuleHeader",{scopedSlots:t._u([{key:"icon",fn:function(){return[t._v(" mdi-account ")]},proxy:!0},{key:"name",fn:function(){return[t._v(" USERS OPD ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[a("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:t.breadcrumbs},scopedSlots:t._u([{key:"divider",fn:function(){return[a("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[a("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[t._v(" User SIMONEV ditampilkan berdasarkan role opd. ")])]},proxy:!0}])}),a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-card",[a("v-card-text",[a("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1)],1)],1),a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.daftar_users,search:t.search,"item-key":"id","sort-by":"name","show-expand":"",expanded:t.expanded,"single-expand":!0,loading:t.datatableLoading,"loading-text":"Loading... Please wait"},on:{"update:expanded":function(e){t.expanded=e},"click:row":t.dataTableRowClicked},scopedSlots:t._u([{key:"top",fn:function(){return[a("v-toolbar",{attrs:{flat:"",color:"white"}},[a("v-toolbar-title",[t._v("DAFTAR USERS OPD")]),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-spacer"),t.$store.getters["auth/can"]("USER_STOREPERMISSIONS")?a("v-btn",{staticClass:"mb-2 mr-2",attrs:{color:"warning",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.syncPermission(e)}}},[t._v(" SYNC PERMISSION ")]):t._e(),a("v-btn",{staticClass:"mb-2",attrs:{color:"primary",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.showDialogTambahUserOPD(e)}}},[t._v(" TAMBAH ")]),a("v-dialog",{attrs:{"max-width":"500px",persistent:""},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[a("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:t.form_valid,callback:function(e){t.form_valid=e},expression:"form_valid"}},[a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[t._v(t._s(t.formTitle))])]),a("v-card-subtitle",[t._v(" Bila OPD / SKPD, tidak dipilih artinya user ini tidak dapat mengakses data opd. ")]),a("v-card-text",[a("v-text-field",{attrs:{label:"NAMA USER",outlined:"",rules:t.rule_user_name},model:{value:t.editedItem.name,callback:function(e){t.$set(t.editedItem,"name",e)},expression:"editedItem.name"}}),a("v-text-field",{attrs:{label:"EMAIL",outlined:"",rules:t.rule_user_email},model:{value:t.editedItem.email,callback:function(e){t.$set(t.editedItem,"email",e)},expression:"editedItem.email"}}),a("v-text-field",{attrs:{label:"USERNAME",outlined:"",rules:t.rule_user_username},model:{value:t.editedItem.username,callback:function(e){t.$set(t.editedItem,"username",e)},expression:"editedItem.username"}}),a("v-text-field",{attrs:{label:"PASSWORD",type:"password",outlined:"",rules:t.rule_user_password},model:{value:t.editedItem.password,callback:function(e){t.$set(t.editedItem,"password",e)},expression:"editedItem.password"}}),a("v-autocomplete",{attrs:{items:t.daftar_opd,label:"OPD / SKPD","item-text":"OrgNm","item-value":"OrgID",multiple:"","small-chips":"",outlined:"",rules:t.rule_user_payload},model:{value:t.editedItem.payload,callback:function(e){t.$set(t.editedItem,"payload",e)},expression:"editedItem.payload"}})],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.close(e)}}},[t._v("BATAL")]),a("v-btn",{attrs:{color:"blue darken-1",text:"",loading:t.btnLoading,disabled:!t.form_valid||t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.save(e)}}},[t._v(" SIMPAN ")])],1)],1)],1)],1),a("v-dialog",{attrs:{"max-width":"500px",persistent:""},model:{value:t.dialogEdit,callback:function(e){t.dialogEdit=e},expression:"dialogEdit"}},[a("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:t.form_valid,callback:function(e){t.form_valid=e},expression:"form_valid"}},[a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[t._v(t._s(t.formTitle))])]),a("v-card-subtitle",[t._v(" Bila program studi, tidak dipilih artinya user ini dapat mengakses seluruh data program studi ")]),a("v-card-text",[a("v-text-field",{attrs:{label:"NAMA USER",outlined:"",rules:t.rule_user_name},model:{value:t.editedItem.name,callback:function(e){t.$set(t.editedItem,"name",e)},expression:"editedItem.name"}}),a("v-text-field",{attrs:{label:"EMAIL",outlined:"",rules:t.rule_user_email},model:{value:t.editedItem.email,callback:function(e){t.$set(t.editedItem,"email",e)},expression:"editedItem.email"}}),a("v-text-field",{attrs:{label:"USERNAME",outlined:"",rules:t.rule_user_username},model:{value:t.editedItem.username,callback:function(e){t.$set(t.editedItem,"username",e)},expression:"editedItem.username"}}),a("v-text-field",{attrs:{label:"PASSWORD",type:"password",outlined:"",rules:t.rule_user_passwordEdit},model:{value:t.editedItem.password,callback:function(e){t.$set(t.editedItem,"password",e)},expression:"editedItem.password"}}),a("v-autocomplete",{attrs:{items:t.daftar_opd,label:"OPD / SKPD","item-text":"OrgNm","item-value":"OrgID",multiple:"","small-chips":"",outlined:"",rules:t.rule_user_payload},model:{value:t.editedItem.payload,callback:function(e){t.$set(t.editedItem,"payload",e)},expression:"editedItem.payload"}})],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.close(e)}}},[t._v("BATAL")]),a("v-btn",{attrs:{color:"blue darken-1",text:"",loading:t.btnLoading,disabled:!t.form_valid||t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.save(e)}}},[t._v("SIMPAN")])],1)],1)],1)],1),a("v-dialog",{attrs:{"max-width":"800px",persistent:""},model:{value:t.dialogUserPermission,callback:function(e){t.dialogUserPermission=e},expression:"dialogUserPermission"}},[a("UserPermissions",{attrs:{user:t.editedItem,daftarpermissions:t.daftar_permissions,permissionsselected:t.permissions_selected},on:{closeUserPermissions:t.closeUserPermissions}})],1)],1)]},proxy:!0},{key:"item.actions",fn:function(e){var i=e.item;return[a("v-icon",{staticClass:"mr-2",attrs:{small:"",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.setPermission(i)}}},[t._v(" mdi-axis-arrow-lock ")]),a("v-icon",{staticClass:"mr-2",attrs:{small:"",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.editItem(i)}}},[t._v(" mdi-pencil ")]),a("v-icon",{attrs:{small:"",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.deleteItem(i)}}},[t._v(" mdi-delete ")])]}},{key:"item.foto",fn:function(e){var i=e.item;return[a("v-avatar",{attrs:{size:"30"}},[a("v-img",{attrs:{src:t.$api.url+"/"+i.foto}})],1)]}},{key:"expanded-item",fn:function(e){var i=e.headers,s=e.item;return[a("td",{staticClass:"text-center",attrs:{colspan:i.length}},[a("v-col",{attrs:{cols:"12"}},[a("strong",[t._v("ID:")]),t._v(t._s(s.id)+" "),a("strong",[t._v("created_at:")]),t._v(t._s(t.$date(s.created_at).format("DD/MM/YYYY HH:mm"))+" "),a("strong",[t._v("updated_at:")]),t._v(t._s(t.$date(s.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)]}},{key:"no-data",fn:function(){return[t._v(" Data belum tersedia ")]},proxy:!0}])})],1)],1)],1)],1)},s=[],n=(a("c975"),a("a434"),a("b0c0"),a("07ac"),a("5530")),r=(a("96cf"),a("1da1")),o=a("2f62"),l=a("5a52"),d=a("e477"),c=a("da27"),u={name:"UsersOPD",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.ACCESS_TOKEN},{text:"USER SISTEM",disabled:!1,href:"/system-users"},{text:"USERS OPD",disabled:!0,href:"#"}],this.initialize()},data:function(){return{role_id:0,datatableLoading:!1,btnLoading:!1,headers:[{text:"",value:"foto"},{text:"USERNAME",value:"username",sortable:!0},{text:"NAME",value:"name",sortable:!0},{text:"EMAIL",value:"email",sortable:!0},{text:"AKSI",value:"actions",sortable:!1,width:100}],expanded:[],search:"",daftar_users:[],daftar_permissions:[],permissions_selected:[],form_valid:!0,dialog:!1,dialogEdit:!1,dialogUserPermission:!1,editedIndex:-1,daftar_opd:[],editedItem:{id:0,username:"",password:"",name:"",email:"",payload:[],created_at:"",updated_at:""},defaultItem:{id:0,username:"",password:"",name:"",email:"",payload:[],created_at:"",updated_at:""},rule_user_name:[function(t){return!!t||"Mohon untuk di isi nama User !!!"},function(t){return/^[A-Za-z\s]*$/.test(t)||"Nama User hanya boleh string dan spasi"}],rule_user_email:[function(t){return!!t||"Mohon untuk di isi email User !!!"},function(t){return/.+@.+\..+/.test(t)||"Format E-mail harus benar"}],rule_user_nomorhp:[function(t){return!!t||"Nomor HP mohon untuk diisi !!!"},function(t){return/^\+[1-9]{1}[0-9]{1,14}$/.test(t)||"Nomor HP hanya boleh angka dan gunakan kode negara didepan seperti +6281214553388"}],rule_user_username:[function(t){return!!t||"Mohon untuk di isi username User !!!"},function(t){return/^[A-Za-z_]*$/.test(t)||"Username hanya boleh string dan underscore"}],rule_user_password:[function(t){return!!t||"Mohon untuk di isi password User !!!"},function(t){return!(t&&"undefined"!==typeof t&&t.length>0)||(t.length>=8||"Minimial Password 8 karaketer")}],rule_user_passwordEdit:[function(t){return!(t&&"undefined"!==typeof t&&t.length>0)||(t.length>=8||"Minimial Password 8 karaketer")}],rule_user_payload:[function(t){return t.length>0||"Mohon untuk di pilih OPD / SKPD dari User ini !!!"}]}},methods:{initialize:function(){var t=Object(r["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.datatableLoading=!0,t.next=3,this.$ajax.get("/setting/usersopd",{headers:{Authorization:this.TOKEN}}).then((function(t){var a=t.data;e.daftar_users=a.users,e.role_id=a.role.id,e.datatableLoading=!1}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),dataTableRowClicked:function(t){t===this.expanded[0]?this.expanded=[]:this.expanded=[t]},syncPermission:function(){var t=Object(r["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.btnLoading=!0,t.next=3,this.$ajax.post("/setting/users/syncallpermissions",{role_name:"opd"},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(){e.btnLoading=!1})).catch((function(){e.btnLoading=!1}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),showDialogTambahUserOPD:function(){var t=Object(r["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.btnLoading=!0,t.next=3,this.$ajax.post("/dmaster/opd",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.TOKEN}}).then((function(t){var a=t.data;e.daftar_opd=a.opd,e.btnLoading=!1,e.dialog=!0})).catch((function(){e.btnLoading=!1}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),editItem:function(){var t=Object(r["a"])(regeneratorRuntime.mark((function t(e){var a=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$ajax.post("/dmaster/opd",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.TOKEN}}).then((function(t){var i=t.data,s=t.status;200==s&&(a.daftar_opd=i.opd,a.editedIndex=a.daftar_users.indexOf(e),e.password="",a.editedItem=Object.assign({},e),a.editedItem.payload=Object.values(JSON.parse(e.payload)),a.btnLoading=!1,a.dialogEdit=!0)})).catch((function(){a.btnLoading=!1}));case 2:case"end":return t.stop()}}),t,this)})));function e(e){return t.apply(this,arguments)}return e}(),setPermission:function(){var t=Object(r["a"])(regeneratorRuntime.mark((function t(e){var a=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.btnLoading=!0,this.$ajax.get("/setting/roles/"+this.role_id+"/permission",{headers:{Authorization:this.TOKEN}}).then((function(t){var e=t.data;a.daftar_permissions=e.permissions})).catch((function(){a.btnLoading=!1})),t.next=4,this.$ajax.get("/setting/users/"+e.id+"/permission",{headers:{Authorization:this.TOKEN}}).then((function(t){var e=t.data;a.permissions_selected=e.permissions,a.btnLoading=!1})).catch((function(){a.btnLoading=!1}));case 4:this.dialogUserPermission=!0,this.editedItem=e;case 6:case"end":return t.stop()}}),t,this)})));function e(e){return t.apply(this,arguments)}return e}(),close:function(){var t=this;this.btnLoading=!1,this.dialog=!1,this.dialogEdit=!1,setTimeout((function(){t.$refs.frmdata.reset(),t.editedItem=Object.assign({},t.defaultItem),t.editedIndex=-1}),300)},closeUserPermissions:function(){this.btnLoading=!1,this.permissions_selected=[],this.dialogUserPermission=!1},save:function(){var t=this;this.$refs.frmdata.validate()&&(this.btnLoading=!0,this.editedIndex>-1?this.$ajax.post("/setting/usersopd/"+this.editedItem.id,{_method:"PUT",name:this.editedItem.name,email:this.editedItem.email,username:this.editedItem.username,password:this.editedItem.password,payload:JSON.stringify(Object.assign({},this.editedItem.payload))},{headers:{Authorization:this.TOKEN}}).then((function(e){var a=e.data;Object.assign(t.daftar_users[t.editedIndex],a.user),t.close()})).catch((function(){t.btnLoading=!1})):this.$ajax.post("/setting/usersopd/store",{name:this.editedItem.name,email:this.editedItem.email,username:this.editedItem.username,password:this.editedItem.password,payload:JSON.stringify(Object.assign({},this.editedItem.payload))},{headers:{Authorization:this.TOKEN}}).then((function(e){var a=e.data;t.daftar_users.push(a.user),t.close()})).catch((function(){t.btnLoading=!1})))},deleteItem:function(t){var e=this;this.$root.$confirm.open("Delete","Apakah Anda ingin menghapus username "+t.username+" ?",{color:"red"}).then((function(a){a&&(e.btnLoading=!0,e.$ajax.post("/setting/usersopd/"+t.id,{_method:"DELETE"},{headers:{Authorization:e.TOKEN}}).then((function(){var a=e.daftar_users.indexOf(t);e.daftar_users.splice(a,1),e.btnLoading=!1})).catch((function(){e.btnLoading=!1})))}))}},computed:Object(n["a"])({formTitle:function(){return-1===this.editedIndex?"TAMBAH USER OPD":"EDIT USER OPD"}},Object(o["b"])("auth",{ACCESS_TOKEN:"AccessToken",TOKEN:"Token"})),watch:{dialog:function(t){t||this.close()},dialogEdit:function(t){t||this.close()}},components:{SettingUserLayout:l["a"],ModuleHeader:d["a"],UserPermissions:c["a"]}},m=u,h=a("2877"),v=a("6544"),p=a.n(v),f=a("0798"),g=a("c6a6"),b=a("8212"),_=a("2bc5"),I=a("8336"),S=a("b0af"),x=a("99d9"),y=a("62ad"),A=a("a523"),k=a("8fea"),E=a("169a"),w=a("ce7e"),O=a("4bd4"),C=a("132d"),T=a("adda"),P=a("0fd9"),L=a("2fa4"),R=a("8654"),V=a("71d9"),$=a("2a7f"),D=Object(h["a"])(m,i,s,!1,null,null,null);e["default"]=D.exports;p()(D,{VAlert:f["a"],VAutocomplete:g["a"],VAvatar:b["a"],VBreadcrumbs:_["a"],VBtn:I["a"],VCard:S["a"],VCardActions:x["a"],VCardSubtitle:x["b"],VCardText:x["c"],VCardTitle:x["d"],VCol:y["a"],VContainer:A["a"],VDataTable:k["a"],VDialog:E["a"],VDivider:w["a"],VForm:O["a"],VIcon:C["a"],VImg:T["a"],VRow:P["a"],VSpacer:L["a"],VTextField:R["a"],VToolbar:V["a"],VToolbarTitle:$["b"]})},c6a6:function(t,e,a){"use strict";a("4de4"),a("7db0"),a("c975"),a("d81d"),a("45fc"),a("498a");var i=a("5530"),s=(a("2bfd"),a("b974")),n=a("8654"),r=a("d9f7"),o=a("80d2"),l=Object(i["a"])(Object(i["a"])({},s["b"]),{},{offsetY:!0,offsetOverflow:!0,transition:!1});e["a"]=s["a"].extend({name:"v-autocomplete",props:{allowOverflow:{type:Boolean,default:!0},autoSelectFirst:{type:Boolean,default:!1},filter:{type:Function,default:function(t,e,a){return a.toLocaleLowerCase().indexOf(e.toLocaleLowerCase())>-1}},hideNoData:Boolean,menuProps:{type:s["a"].options.props.menuProps.type,default:function(){return l}},noFilter:Boolean,searchInput:{type:String,default:void 0}},data:function(){return{lazySearch:this.searchInput}},computed:{classes:function(){return Object(i["a"])(Object(i["a"])({},s["a"].options.computed.classes.call(this)),{},{"v-autocomplete":!0,"v-autocomplete--is-selecting-index":this.selectedIndex>-1})},computedItems:function(){return this.filteredItems},selectedValues:function(){var t=this;return this.selectedItems.map((function(e){return t.getValue(e)}))},hasDisplayedItems:function(){var t=this;return this.hideSelected?this.filteredItems.some((function(e){return!t.hasItem(e)})):this.filteredItems.length>0},currentRange:function(){return null==this.selectedItem?0:String(this.getText(this.selectedItem)).length},filteredItems:function(){var t=this;return!this.isSearching||this.noFilter||null==this.internalSearch?this.allItems:this.allItems.filter((function(e){var a=Object(o["r"])(e,t.itemText),i=null!=a?String(a):"";return t.filter(e,String(t.internalSearch),i)}))},internalSearch:{get:function(){return this.lazySearch},set:function(t){this.lazySearch=t,this.$emit("update:search-input",t)}},isAnyValueAllowed:function(){return!1},isDirty:function(){return this.searchIsDirty||this.selectedItems.length>0},isSearching:function(){return this.multiple&&this.searchIsDirty||this.searchIsDirty&&this.internalSearch!==this.getText(this.selectedItem)},menuCanShow:function(){return!!this.isFocused&&(this.hasDisplayedItems||!this.hideNoData)},$_menuProps:function(){var t=s["a"].options.computed.$_menuProps.call(this);return t.contentClass="v-autocomplete__content ".concat(t.contentClass||"").trim(),Object(i["a"])(Object(i["a"])({},l),t)},searchIsDirty:function(){return null!=this.internalSearch&&""!==this.internalSearch},selectedItem:function(){var t=this;return this.multiple?null:this.selectedItems.find((function(e){return t.valueComparator(t.getValue(e),t.getValue(t.internalValue))}))},listData:function(){var t=s["a"].options.computed.listData.call(this);return t.props=Object(i["a"])(Object(i["a"])({},t.props),{},{items:this.virtualizedItems,noFilter:this.noFilter||!this.isSearching||!this.filteredItems.length,searchInput:this.internalSearch}),t}},watch:{filteredItems:"onFilteredItemsChanged",internalValue:"setSearch",isFocused:function(t){t?(document.addEventListener("copy",this.onCopy),this.$refs.input&&this.$refs.input.select()):(document.removeEventListener("copy",this.onCopy),this.updateSelf())},isMenuActive:function(t){!t&&this.hasSlot&&(this.lazySearch=void 0)},items:function(t,e){e&&e.length||!this.hideNoData||!this.isFocused||this.isMenuActive||!t.length||this.activateMenu()},searchInput:function(t){this.lazySearch=t},internalSearch:"onInternalSearchChanged",itemText:"updateSelf"},created:function(){this.setSearch()},destroyed:function(){document.removeEventListener("copy",this.onCopy)},methods:{onFilteredItemsChanged:function(t,e){var a=this;t!==e&&(this.setMenuIndex(-1),this.$nextTick((function(){a.internalSearch&&(1===t.length||a.autoSelectFirst)&&(a.$refs.menu.getTiles(),a.setMenuIndex(0))})))},onInternalSearchChanged:function(){this.updateMenuDimensions()},updateMenuDimensions:function(){this.isMenuActive&&this.$refs.menu&&this.$refs.menu.updateDimensions()},changeSelectedIndex:function(t){this.searchIsDirty||(this.multiple&&t===o["x"].left?-1===this.selectedIndex?this.selectedIndex=this.selectedItems.length-1:this.selectedIndex--:this.multiple&&t===o["x"].right?this.selectedIndex>=this.selectedItems.length-1?this.selectedIndex=-1:this.selectedIndex++:t!==o["x"].backspace&&t!==o["x"].delete||this.deleteCurrentItem())},deleteCurrentItem:function(){var t=this.selectedIndex,e=this.selectedItems[t];if(this.isInteractive&&!this.getDisabled(e)){var a=this.selectedItems.length-1;if(-1!==this.selectedIndex||0===a){var i=this.selectedItems.length,s=t!==i-1?t:t-1,n=this.selectedItems[s];n?this.selectItem(e):this.setValue(this.multiple?[]:void 0),this.selectedIndex=s}else this.selectedIndex=a}},clearableCallback:function(){this.internalSearch=void 0,s["a"].options.methods.clearableCallback.call(this)},genInput:function(){var t=n["a"].options.methods.genInput.call(this);return t.data=Object(r["a"])(t.data,{attrs:{"aria-activedescendant":Object(o["p"])(this.$refs.menu,"activeTile.id"),autocomplete:Object(o["p"])(t.data,"attrs.autocomplete","off")},domProps:{value:this.internalSearch}}),t},genInputSlot:function(){var t=s["a"].options.methods.genInputSlot.call(this);return t.data.attrs.role="combobox",t},genSelections:function(){return this.hasSlot||this.multiple?s["a"].options.methods.genSelections.call(this):[]},onClick:function(t){this.isInteractive&&(this.selectedIndex>-1?this.selectedIndex=-1:this.onFocus(),this.isAppendInner(t.target)||this.activateMenu())},onInput:function(t){if(!(this.selectedIndex>-1)&&t.target){var e=t.target,a=e.value;e.value&&this.activateMenu(),this.internalSearch=a,this.badInput=e.validity&&e.validity.badInput}},onKeyDown:function(t){var e=t.keyCode;s["a"].options.methods.onKeyDown.call(this,t),this.changeSelectedIndex(e)},onSpaceDown:function(t){},onTabDown:function(t){s["a"].options.methods.onTabDown.call(this,t),this.updateSelf()},onUpDown:function(t){t.preventDefault(),this.activateMenu()},selectItem:function(t){s["a"].options.methods.selectItem.call(this,t),this.setSearch()},setSelectedItems:function(){s["a"].options.methods.setSelectedItems.call(this),this.isFocused||this.setSearch()},setSearch:function(){var t=this;this.$nextTick((function(){t.multiple&&t.internalSearch&&t.isMenuActive||(t.internalSearch=!t.selectedItems.length||t.multiple||t.hasSlot?null:t.getText(t.selectedItem))}))},updateSelf:function(){(this.searchIsDirty||this.internalValue)&&(this.valueComparator(this.internalSearch,this.getValue(this.internalValue))||this.setSearch())},hasItem:function(t){return this.selectedValues.indexOf(this.getValue(t))>-1},onCopy:function(t){var e,a;if(-1!==this.selectedIndex){var i=this.selectedItems[this.selectedIndex],s=this.getText(i);null==(e=t.clipboardData)||e.setData("text/plain",s),null==(a=t.clipboardData)||a.setData("text/vnd.vuetify.autocomplete.item+plain",s),t.preventDefault()}}}})},da27:function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[t._v("USER PERMISSIONS")])]),a("v-card-text",[a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"12",md:"12"}},[a("v-card",[a("v-card-text",[a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v("ID :")]),a("v-card-text",[t._v(" "+t._s(t.user.id)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v("NOMOR HP :")]),a("v-card-text",[t._v(" "+t._s(t.user.nomor_hp)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1),a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v("USERNAME :")]),a("v-card-text",[t._v(" "+t._s(t.user.username)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v("THEME :")]),a("v-card-text",[t._v(" "+t._s(t.user.theme)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1),a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v("NAMA :")]),a("v-card-text",[t._v(" "+t._s(t.user.name)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v("CREATED :")]),a("v-card-text",[t._v(" "+t._s(t.$date(t.user.created_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1),a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v("EMAIL :")]),a("v-card-text",[t._v(" "+t._s(t.user.email)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e(),a("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[a("v-card",{attrs:{flat:""}},[a("v-card-title",[t._v("UPDATED :")]),a("v-card-text",[t._v(" "+t._s(t.$date(t.user.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?a("v-responsive",{attrs:{width:"100%"}}):t._e()],1)],1)],1)],1)],1),a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-card",[a("v-card-text",[a("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1)],1)],1),a("v-row",{attrs:{"no-gutters":""}},[a("v-col",{attrs:{col:"12"}},[a("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.daftar_permissions,search:t.search,"item-key":"name","sort-by":"name","show-select":""},scopedSlots:t._u([{key:"item.actions",fn:function(e){var i=e.item;return[a("v-icon",{attrs:{small:"",loading:t.btnLoading,disabled:t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.revoke(i)}}},[t._v(" mdi-delete ")])]}}]),model:{value:t.permissions_selected,callback:function(e){t.permissions_selected=e},expression:"permissions_selected"}})],1)],1)],1)],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(e){return e.stopPropagation(),t.close(e)}}},[t._v("KELUAR")]),a("v-btn",{attrs:{color:"blue darken-1",text:"",loading:t.btnLoading,disabled:t.btnLoading||!t.perm_selected.length>0},on:{click:function(e){return e.stopPropagation(),t.save(e)}}},[t._v(" SIMPAN ")])],1)],1)},s=[],n=(a("b0c0"),a("5530")),r=a("2f62"),o={name:"UserPermissions",data:function(){return{btnLoading:!1,headers:[{text:"NAMA PERMISSION",value:"name"},{text:"GUARD",value:"guard_name"},{text:"AKSI",value:"actions",sortable:!1,width:100}],search:"",perm_selected:[],perm_revoked:[]}},methods:{save:function(){var t=this;this.btnLoading=!0,this.$ajax.post("/setting/users/storeuserpermissions",{user_id:this.user.id,chkpermission:this.permissions_selected},{headers:{Authorization:this.TOKEN}}).then((function(){t.close()})).catch((function(){t.btnLoading=!1}))},revoke:function(t){var e=this;this.btnLoading=!0,this.$ajax.post("/setting/users/revokeuserpermissions",{user_id:this.user.id,name:t.name},{headers:{Authorization:this.TOKEN}}).then((function(){e.close()})).catch((function(){e.btnLoading=!1}))},close:function(){this.btnLoading=!1,this.permissions_selected=[],this.$emit("closeUserPermissions")}},props:{user:Object,daftarpermissions:Array,permissionsselected:Array},computed:Object(n["a"])(Object(n["a"])({},Object(r["b"])("auth",{TOKEN:"Token"})),{},{daftar_permissions:function(){return this.daftarpermissions},permissions_selected:{get:function(){return this.perm_selected.length>0?this.perm_selected:this.permissionsselected},set:function(t){this.perm_selected=t}}})},l=o,d=a("2877"),c=a("6544"),u=a.n(c),m=a("8336"),h=a("b0af"),v=a("99d9"),p=a("62ad"),f=a("a523"),g=a("8fea"),b=a("132d"),_=a("6b53"),I=a("0fd9"),S=a("2fa4"),x=a("8654"),y=Object(d["a"])(l,i,s,!1,null,null,null);e["a"]=y.exports;u()(y,{VBtn:m["a"],VCard:h["a"],VCardActions:v["a"],VCardText:v["c"],VCardTitle:v["d"],VCol:p["a"],VContainer:f["a"],VDataTable:g["a"],VIcon:b["a"],VResponsive:_["a"],VRow:I["a"],VSpacer:S["a"],VTextField:x["a"]})}}]);