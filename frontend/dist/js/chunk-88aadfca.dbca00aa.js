(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-88aadfca"],{"0bc6":function(t,a,e){},"4bd4":function(t,a,e){"use strict";e("4de4"),e("7db0"),e("4160"),e("caad"),e("07ac"),e("2532"),e("159b");var r=e("5530"),n=e("58df"),i=e("7e2b"),s=e("3206");a["a"]=Object(n["a"])(i["a"],Object(s["b"])("form")).extend({name:"v-form",provide:function(){return{form:this}},inheritAttrs:!1,props:{disabled:Boolean,lazyValidation:Boolean,readonly:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(t){var a=Object.values(t).includes(!0);this.$emit("input",!a)},deep:!0,immediate:!0}},methods:{watchInput:function(t){var a=this,e=function(t){return t.$watch("hasError",(function(e){a.$set(a.errorBag,t._uid,e)}),{immediate:!0})},r={_uid:t._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?r.shouldValidate=t.$watch("shouldValidate",(function(n){n&&(a.errorBag.hasOwnProperty(t._uid)||(r.valid=e(t)))})):r.valid=e(t),r},validate:function(){return 0===this.inputs.filter((function(t){return!t.validate(!0)})).length},reset:function(){this.inputs.forEach((function(t){return t.reset()})),this.resetErrorBag()},resetErrorBag:function(){var t=this;this.lazyValidation&&setTimeout((function(){t.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(t){return t.resetValidation()})),this.resetErrorBag()},register:function(t){this.inputs.push(t),this.watchers.push(this.watchInput(t))},unregister:function(t){var a=this.inputs.find((function(a){return a._uid===t._uid}));if(a){var e=this.watchers.find((function(t){return t._uid===a._uid}));e&&(e.valid(),e.shouldValidate()),this.watchers=this.watchers.filter((function(t){return t._uid!==a._uid})),this.inputs=this.inputs.filter((function(t){return t._uid!==a._uid})),this.$delete(this.errorBag,a._uid)}}},render:function(t){var a=this;return t("form",{staticClass:"v-form",attrs:Object(r["a"])({novalidate:!0},this.attrs$),on:{submit:function(t){return a.$emit("submit",t)}}},this.$slots.default)}})},a56a:function(t,a,e){"use strict";e.r(a);var r=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",[e("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[e("v-spacer"),e("strong",[t._v(" Tahun Anggaran: "+t._s(t.formlogin.tahun_anggaran)+" | Bulan Realisasi:"+t._s(t.$store.getters["uifront/getNamaBulan"])+" ")])],1),e("v-main",{staticClass:"mx-4 mb-4"},[e("v-container",{staticClass:"fill-height",attrs:{fluid:""}},[e("v-row",{attrs:{align:"center",justify:"center"}},[e("v-col",{attrs:{cols:"12",sm:"8",md:"4"}},[e("v-card",{staticClass:"elevation-12"},[e("v-toolbar",{attrs:{color:"primary",dark:"",flat:""}},[e("v-toolbar-title",[t._v("LOGIN")])],1),e("v-form",{ref:"frmlogin",attrs:{"lazy-validation":""},nativeOn:{keyup:function(a){return!a.type.indexOf("key")&&t._k(a.keyCode,"enter",13,a.key,"Enter")?null:t.doLogin(a)}}},[e("v-card-text",[e("v-alert",{attrs:{outlined:"",dense:"",type:"error",value:t.form_error,icon:"mdi-close-octagon-outline"}},[t._v(" Username atau Password tidak dikenal ")]),e("v-text-field",{attrs:{label:"Username",rules:t.rule_username,outlined:"",dense:""},model:{value:t.formlogin.username,callback:function(a){t.$set(t.formlogin,"username",a)},expression:"formlogin.username"}}),e("v-text-field",{attrs:{label:"Password",type:"password",rules:t.rule_password,outlined:"",dense:""},model:{value:t.formlogin.password,callback:function(a){t.$set(t.formlogin,"password",a)},expression:"formlogin.password"}}),e("v-select",{attrs:{items:t.daftar_ta,label:"TAHUN ANGGARAN",rules:t.rule_tahun_anggaran,dense:"",outlined:""},model:{value:t.formlogin.tahun_anggaran,callback:function(a){t.$set(t.formlogin,"tahun_anggaran",a)},expression:"formlogin.tahun_anggaran"}})],1),e("v-card-actions",[e("v-spacer"),e("v-btn",{attrs:{color:"grey",dark:"",to:"/"}},[t._v(" KEMBALI ")]),e("v-btn",{attrs:{color:"primary",loading:t.btnLoading,disabled:t.btnLoading},on:{click:t.doLogin}},[t._v(" LOGIN ")])],1)],1)],1)],1)],1)],1)],1),e("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[e("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[e("v-divider"),e("v-card-text",{staticClass:"py-2 white--text text-center"},[e("strong",[t._v(t._s(t.NamaAPP)+" (2019-2020)")]),t._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),e("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev-vuetify"}},[e("v-icon",[t._v("mdi-github")])],1)],1)],1)],1)],1)},n=[],i=e("5530"),s=(e("96cf"),e("1da1")),o=e("2f62"),u={name:"Login",created:function(){this.$store.dispatch("uifront/init",this.$ajax),this.daftar_ta=this.$store.getters["uifront/getDaftarTA"],this.formlogin.tahun_anggaran=this.$store.getters["uifront/getTahunAnggaran"],this.$store.getters["auth/Authenticated"]&&this.$router.push("/dashboard/"+this.$store.getters["auth/AccessToken"])},data:function(){return{btnLoading:!1,form_error:!1,daftar_ta:[],formlogin:{username:"",password:"",tahun_anggaran:""},rule_username:[function(t){return!!t||"Username mohon untuk diisi !!!"}],rule_password:[function(t){return!!t||"Password mohon untuk diisi !!!"}],rule_tahun_anggaran:[function(t){return!!t||"Tahun Anggaran mohon untuk dipilih !!!"}]}},methods:{doLogin:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var a=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!this.$refs.frmlogin.validate()){t.next=4;break}return this.btnLoading=!0,t.next=4,this.$ajax.post("/auth/login",{username:this.formlogin.username,password:this.formlogin.password,tahun_anggaran:this.formlogin.tahun_anggaran}).then((function(t){var e=t.data;a.$ajax.get("/auth/me",{headers:{Authorization:e.token_type+" "+e.access_token}}).then((function(t){var r={token:e,user:t.data};a.$store.dispatch("auth/afterLoginSuccess",r)})),a.btnLoading=!1,a.form_error=!1,a.$router.push("/dashboard/"+e.access_token)})).catch((function(){a.form_error=!0,a.btnLoading=!1}));case 4:case"end":return t.stop()}}),t,this)})));function a(){return t.apply(this,arguments)}return a}()},computed:Object(i["a"])({},Object(o["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"}))},d=u,l=e("2877"),c=e("6544"),h=e.n(c),f=e("0798"),g=e("8336"),m=e("b0af"),v=e("99d9"),p=e("62ad"),b=e("a523"),_=e("ce7e"),w=e("553a"),k=e("4bd4"),V=e("132d"),$=e("f6c4"),A=e("0fd9"),x=e("b974"),B=e("2fa4"),y=e("afd9"),T=e("8654"),C=e("71d9"),L=e("2a7f"),O=Object(l["a"])(d,r,n,!1,null,null,null);a["default"]=O.exports;h()(O,{VAlert:f["a"],VBtn:g["a"],VCard:m["a"],VCardActions:v["a"],VCardText:v["c"],VCol:p["a"],VContainer:b["a"],VDivider:_["a"],VFooter:w["a"],VForm:k["a"],VIcon:V["a"],VMain:$["a"],VRow:A["a"],VSelect:x["a"],VSpacer:B["a"],VSystemBar:y["a"],VTextField:T["a"],VToolbar:C["a"],VToolbarTitle:L["b"]})},e0c7:function(t,a,e){"use strict";var r=e("5530"),n=(e("0bc6"),e("7560")),i=e("58df");a["a"]=Object(i["a"])(n["a"]).extend({name:"v-subheader",props:{inset:Boolean},render:function(t){return t("div",{staticClass:"v-subheader",class:Object(r["a"])({"v-subheader--inset":this.inset},this.themeClasses),attrs:this.$attrs,on:this.$listeners},this.$slots.default)}})}}]);
//# sourceMappingURL=chunk-88aadfca.dbca00aa.js.map