(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-e8c4d37c"],{"220f":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("BelanjaPerubahanLayout",{attrs:{showrightsidebar:!1},scopedSlots:t._u([{key:"system-bar",fn:function(){return[t._v(" Tahun Anggaran: "+t._s(t.$store.getters["uifront/getTahunAnggaran"])+" | Bulan Realisasi:"+t._s(t.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0}])},[a("ModuleHeader",{scopedSlots:t._u([{key:"icon",fn:function(){return[t._v(" mdi-graph ")]},proxy:!0},{key:"name",fn:function(){return[t._v(" RKA PERUBAHAN ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[a("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:t.breadcrumbs},scopedSlots:t._u([{key:"divider",fn:function(){return[a("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[a("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[t._v(" Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Perubahan ")])]},proxy:!0}])}),a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-card",[a("v-card-title",[t._v(" FILTER ")]),a("v-card-text",[a("v-autocomplete",{attrs:{items:t.daftar_opd,label:"OPD / SKPD","item-text":"OrgNm","item-value":"OrgID"},model:{value:t.OrgID_Selected,callback:function(e){t.OrgID_Selected=e},expression:"OrgID_Selected"}}),a("v-autocomplete",{attrs:{items:t.daftar_unitkerja,label:"UNIT KERJA","item-text":"SOrgNm","item-value":"SOrgID"},model:{value:t.SOrgID_Selected,callback:function(e){t.SOrgID_Selected=e},expression:"SOrgID_Selected"}})],1)],1)],1)],1),a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-card",[a("v-card-text",[a("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1)],1)],1),a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.datatable,search:t.search,"item-key":"RKAID","sort-by":"kode_kegiatan","show-expand":"",dense:"",expanded:t.expanded,"single-expand":!0,loading:t.datatableLoading,"loading-text":"Loading... Please wait"},on:{"update:expanded":function(e){t.expanded=e},"click:row":t.dataTableRowClicked},scopedSlots:t._u([{key:"top",fn:function(){return[a("v-toolbar",{attrs:{flat:"",color:"white"}},[a("v-toolbar-title",[t._v("DAFTAR KEGIATAN")]),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-spacer")],1)]},proxy:!0},{key:"item.actions",fn:function(e){var i=e.item;return[a("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on,s=e.attrs;return[a("v-icon",t._g(t._b({staticClass:"ma-2",attrs:{small:"",color:"primary"},on:{click:function(e){return e.stopPropagation(),t.viewUraian(i)}}},"v-icon",s,!1),n),[t._v(" mdi-eye ")])]}}],null,!0)},[a("span",[t._v("detail uraian kegiatan")])]),a("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var n=e.on,s=e.attrs;return[a("v-icon",t._g(t._b({staticClass:"ma-2",attrs:{small:"",color:"warning",loading:t.btnLoading,disabled:i.PaguDana2>0},on:{click:function(e){return e.stopPropagation(),t.loaddatauraianfirsttime(i)}}},"v-icon",s,!1),n),[t._v(" mdi-sync-circle ")])]}}],null,!0)},[a("span",[t._v("load uraian")])])]}},{key:"item.PaguDana2",fn:function(e){var a=e.item;return[t._v(" "+t._s(t._f("formatUang")(a.PaguDana2))+" ")]}},{key:"item.RealisasiKeuangan2",fn:function(e){var a=e.item;return[t._v(" "+t._s(t._f("formatUang")(a.RealisasiKeuangan2))+" ")]}},{key:"item.SisaAnggaran",fn:function(e){var a=e.item;return[t._v(" "+t._s(t._f("formatUang")(a.PaguDana2-a.RealisasiKeuangan2))+" ")]}},{key:"expanded-item",fn:function(e){var i=e.headers,n=e.item;return[a("td",{staticClass:"text-center",attrs:{colspan:i.length}},[a("v-col",{attrs:{cols:"12","clœass":"mb1"}},[a("strong",[t._v("ID:")]),t._v(t._s(n.RKAID)+" "),a("strong",[t._v("created_at:")]),t._v(t._s(t.$date(n.created_at).format("DD/MM/YYYY HH:mm"))+" "),a("strong",[t._v("updated_at:")]),t._v(t._s(t.$date(n.created_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)]}},{key:"body.append",fn:function(){return[a("tr",{staticClass:"amber darken-1 font-weight-black"},[a("td",{staticClass:"text-right",attrs:{colspan:"3"}},[t._v("TOTAL")]),a("td",{staticClass:"text-right"},[t._v(t._s(t._f("formatUang")(t.footers.pagukegiatan)))]),a("td",{staticClass:"text-right"},[t._v(t._s(t.footers.fisik))]),a("td",{staticClass:"text-right"},[t._v(t._s(t._f("formatUang")(t.footers.realisasi)))]),a("td",{staticClass:"text-right"},[t._v(t._s(t.footers.persen_keuangan.toFixed(2)))]),a("td",{staticClass:"text-right"},[t._v(t._s(t._f("formatUang")(t.footers.sisa)))]),a("td")])]},proxy:!0},{key:"no-data",fn:function(){return[a("v-btn",{staticClass:"ma-2",attrs:{loading:t.btnLoading,disabled:t.showBtnLoadDataKegiatan||t.btnLoading,color:"primary"},on:{click:function(e){return e.stopPropagation(),t.loaddatakegiatanFirsttime(e)}},scopedSlots:t._u([{key:"loader",fn:function(){return[a("span",[t._v("LOADING DATA ...")])]},proxy:!0}])},[t._v(" LOAD DATA KEGIATAN ")])]},proxy:!0}])},[t._v(" > ")])],1)],1)],1)],1)},n=[],s=(a("a9e3"),a("96cf"),a("1da1")),r=a("9278"),o=a("e477"),l={name:"RKAPerubahan",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.$store.getters["auth/AccessToken"]},{text:"BELANJA PERUBAHAN",disabled:!1,href:"/belanjaperubahan"},{text:"RKA (RENCANA KEGIATAN DAN ANGGARAN)",disabled:!0,href:"#"}],this.$store.dispatch("uiadmin/addToPages",{name:"rkaperubahan",OrgID_Selected:"",SOrgID_Selected:"",datakegiatan:{RKAID:""},datauraian:{RKARincID:""},datarekening:{}})},mounted:function(){this.fetchOPD();var t=this.$store.getters["uiadmin/AtributeValueOfPage"]("rkaperubahan","OrgID_Selected"),e=this.$store.getters["uiadmin/AtributeValueOfPage"]("rkaperubahan","SOrgID_Selected");t.length>0&&(this.OrgID_Selected=t,this.SOrgID_Selected=e),e.length>0&&(this.OrgID_Selected=t,this.SOrgID_Selected=e),this.firstloading=!1},data:function(){return{firstloading:!0,expanded:[],search:"",btnLoading:!1,datatableLoading:!1,datatableLoaded:!1,datatable:[],headers:[{text:"KODE",value:"kode_kegiatan",width:80},{text:"NAMA KEGIATAN",value:"KgtNm",width:300},{text:"PAGU KEGIATAN",value:"PaguDana2",align:"end",width:100},{text:"REALISASI FISIK",value:"RealisasiFisik2",align:"end",width:100},{text:"REALISASI KEUANGAN",value:"RealisasiKeuangan2",align:"end",width:100},{text:"%",value:"persen_keuangan2",align:"end",width:100},{text:"SISA PAGU",value:"SisaAnggaran",align:"end",width:100},{text:"AKSI",value:"actions",sortable:!1,width:110}],footers:{paguunitkerja:0,pagukegiatan:0,realisasi:0,sisa:0,persen_keuangan:0,fisik:0},daftar_opd:[],OrgID_Selected:"",daftar_unitkerja:[],SOrgID_Selected:"",DataOPD:null,DataUnitKerja:null}},methods:{dataTableRowClicked:function(t){t===this.expanded[0]?this.expanded=[]:this.expanded=[t]},footersummary:function(){var t=this.datatable,e={paguunitkerja:0,pagukegiatan:0,realisasi:0,sisa:0,persen_keuangan:0,fisik:0};if(t.length>0){for(var a=0,i=0;i<t.length;i++){var n=new Number(t[i].PaguDana2);a+=n}e.paguunitkerja=this.DataUnitKerja.PaguDana2,e.pagukegiatan=a;var s=parseFloat(this.DataUnitKerja.RealisasiKeuangan2);e.realisasi=s,e.sisa=a-s,e.persen_keuangan=s>0&&a>0?s/a*100:0,e.fisik=this.DataUnitKerja.RealisasiFisik2}this.footers=e},fetchOPD:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$ajax.post("/dmaster/opd",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(t){var a=t.data,i=t.status;200==i&&(e.daftar_opd=a.opd,e.datatableLoaded=!1)}));case 2:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),loadunitkerja:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$ajax.get("/dmaster/opd/"+this.OrgID_Selected+"/unitkerja",{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(t){var a=t.data;e.DataOPD=a.organisasi,e.daftar_unitkerja=a.unitkerja,e.datatableLoaded=!1}));case 2:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),loaddatakegiatanFirsttime:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.btnLoading=!0,t.next=3,this.$ajax.post("/belanja/rkaperubahan/loaddatakegiatanfirsttime",{tahun:this.$store.getters["uifront/getTahunAnggaran"],SOrgID:this.SOrgID_Selected},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(t){var a=t.data;e.DataUnitKerja=a.unitkerja,e.datatable=a.rka,e.footersummary(),e.btnLoading=!1})).catch((function(){e.btnLoading=!1}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),loaddatauraianfirsttime:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(e){var a=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!(!e.PaguDana2>0)){t.next=4;break}return this.btnLoading=!0,t.next=4,this.$ajax.post("/belanja/rkaperubahan/loaddatauraianfirsttime",{RKAID:e.RKAID},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(){a.$router.go(),a.btnLoading=!1})).catch((function(){a.btnLoading=!1}));case 4:case"end":return t.stop()}}),t,this)})));function e(e){return t.apply(this,arguments)}return e}(),loaddatakegiatan:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.datatableLoading=!0,t.next=3,this.$ajax.post("/belanja/rkaperubahan",{tahun:this.$store.getters["uifront/getTahunAnggaran"],SOrgID:this.SOrgID_Selected},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(t){var a=t.data;e.DataUnitKerja=a.unitkerja,e.datatable=a.rka,e.datatableLoaded=!0,e.datatableLoading=!1,e.footersummary()}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),viewUraian:function(t){var e=this,a=this.$store.getters["uiadmin/Page"]("rkaperubahan");""==a.datakegiatan.RKAID?(a.datakegiatan=t,this.$store.dispatch("uiadmin/updatePage",a),this.$router.push("/belanjaperubahan/rka/uraian/"+a.datakegiatan.RKAID)):this.$root.$confirm.open("INFO","Kegiatan lain sedang dibuka, jadi tidak bisa membuka kegiatan ini",{color:"warning"}).then((function(t){t&&e.$router.push("/belanjaperubahan/rka/uraian/"+a.datakegiatan.RKAID)}))}},components:{BelanjaPerubahanLayout:r["a"],ModuleHeader:o["a"]},computed:{showBtnLoadDataKegiatan:function(){var t=!0;return this.SOrgID_Selected.length>0&&1==this.datatableLoaded&&(t=this.datatable.length>0),t}},watch:{OrgID_Selected:function(t){var e=this.$store.getters["uiadmin/Page"]("rkaperubahan");1==this.firstloading&&t.length>0?(e.OrgID_Selected=t,this.$store.dispatch("uiadmin/updatePage",e),this.loadunitkerja()):0==this.firstloading&&t.length>0&&(e.OrgID_Selected=t,this.$store.dispatch("uiadmin/updatePage",e),this.loadunitkerja(),this.datatableLoaded=!1,this.datatable=[])},SOrgID_Selected:function(t){var e=this.$store.getters["uiadmin/Page"]("rkaperubahan");0==this.firstloading&&t.length>0&&(this.datatableLoaded=!1),e.SOrgID_Selected=t,this.$store.dispatch("uiadmin/updatePage",e),this.loaddatakegiatan()}}},c=l,u=a("2877"),d=a("6544"),h=a.n(d),m=a("0798"),p=a("c6a6"),v=a("2bc5"),f=a("8336"),g=a("b0af"),b=a("99d9"),_=a("62ad"),A=a("a523"),I=a("8fea"),S=a("ce7e"),k=a("132d"),x=a("0fd9"),D=a("2fa4"),y=a("8654"),O=a("71d9"),C=a("2a7f"),T=a("3a2f"),w=Object(u["a"])(c,i,n,!1,null,null,null);e["default"]=w.exports;h()(w,{VAlert:m["a"],VAutocomplete:p["a"],VBreadcrumbs:v["a"],VBtn:f["a"],VCard:g["a"],VCardText:b["c"],VCardTitle:b["d"],VCol:_["a"],VContainer:A["a"],VDataTable:I["a"],VDivider:S["a"],VIcon:k["a"],VRow:x["a"],VSpacer:D["a"],VTextField:y["a"],VToolbar:O["a"],VToolbarTitle:C["b"],VTooltip:T["a"]})},"2bfd":function(t,e,a){},"3a2f":function(t,e,a){"use strict";a("a9e3");var i=a("ade3"),n=(a("9734"),a("4ad4")),s=a("a9ad"),r=a("16b7"),o=a("b848"),l=a("75eb"),c=a("f573"),u=a("f2e7"),d=a("80d2"),h=a("d9bd"),m=a("58df");e["a"]=Object(m["a"])(s["a"],r["a"],o["a"],l["a"],c["a"],u["a"]).extend({name:"v-tooltip",props:{closeDelay:{type:[Number,String],default:0},disabled:Boolean,fixed:{type:Boolean,default:!0},openDelay:{type:[Number,String],default:0},openOnHover:{type:Boolean,default:!0},tag:{type:String,default:"span"},transition:String},data:function(){return{calculatedMinWidth:0,closeDependents:!1}},computed:{calculatedLeft:function(){var t=this.dimensions,e=t.activator,a=t.content,i=!this.bottom&&!this.left&&!this.top&&!this.right,n=!1!==this.attach?e.offsetLeft:e.left,s=0;return this.top||this.bottom||i?s=n+e.width/2-a.width/2:(this.left||this.right)&&(s=n+(this.right?e.width:-a.width)+(this.right?10:-10)),this.nudgeLeft&&(s-=parseInt(this.nudgeLeft)),this.nudgeRight&&(s+=parseInt(this.nudgeRight)),"".concat(this.calcXOverflow(s,this.dimensions.content.width),"px")},calculatedTop:function(){var t=this.dimensions,e=t.activator,a=t.content,i=!1!==this.attach?e.offsetTop:e.top,n=0;return this.top||this.bottom?n=i+(this.bottom?e.height:-a.height)+(this.bottom?10:-10):(this.left||this.right)&&(n=i+e.height/2-a.height/2),this.nudgeTop&&(n-=parseInt(this.nudgeTop)),this.nudgeBottom&&(n+=parseInt(this.nudgeBottom)),"".concat(this.calcYOverflow(n+this.pageYOffset),"px")},classes:function(){return{"v-tooltip--top":this.top,"v-tooltip--right":this.right,"v-tooltip--bottom":this.bottom,"v-tooltip--left":this.left,"v-tooltip--attached":""===this.attach||!0===this.attach||"attach"===this.attach}},computedTransition:function(){return this.transition?this.transition:this.isActive?"scale-transition":"fade-transition"},offsetY:function(){return this.top||this.bottom},offsetX:function(){return this.left||this.right},styles:function(){return{left:this.calculatedLeft,maxWidth:Object(d["g"])(this.maxWidth),minWidth:Object(d["g"])(this.minWidth),opacity:this.isActive?.9:0,top:this.calculatedTop,zIndex:this.zIndex||this.activeZIndex}}},beforeMount:function(){var t=this;this.$nextTick((function(){t.value&&t.callActivate()}))},mounted:function(){"v-slot"===Object(d["t"])(this,"activator",!0)&&Object(h["b"])("v-tooltip's activator slot must be bound, try '<template #activator=\"data\"><v-btn v-on=\"data.on>'",this)},methods:{activate:function(){this.updateDimensions(),requestAnimationFrame(this.startTransition)},deactivate:function(){this.runDelay("close")},genActivatorListeners:function(){var t=this,e=n["a"].options.methods.genActivatorListeners.call(this);return e.focus=function(e){t.getActivator(e),t.runDelay("open")},e.blur=function(e){t.getActivator(e),t.runDelay("close")},e.keydown=function(e){e.keyCode===d["x"].esc&&(t.getActivator(e),t.runDelay("close"))},e},genTransition:function(){var t=this.genContent();return this.computedTransition?this.$createElement("transition",{props:{name:this.computedTransition}},[t]):t},genContent:function(){var t;return this.$createElement("div",this.setBackgroundColor(this.color,{staticClass:"v-tooltip__content",class:(t={},Object(i["a"])(t,this.contentClass,!0),Object(i["a"])(t,"menuable__content__active",this.isActive),Object(i["a"])(t,"v-tooltip__content--fixed",this.activatorFixed),t),style:this.styles,attrs:this.getScopeIdAttrs(),directives:[{name:"show",value:this.isContentActive}],ref:"content"}),this.getContentSlot())}},render:function(t){var e=this;return t(this.tag,{staticClass:"v-tooltip",class:this.classes},[this.showLazyContent((function(){return[e.genTransition()]})),this.genActivator()])}})},9278:function(t,e,a){"use strict";var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[a("v-spacer"),a("strong",[t._t("system-bar")],2)],1),a("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[a("v-app-bar-nav-icon",{staticClass:"grey--text",class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(e){e.stopPropagation(),t.drawer=!t.drawer}}}),a("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(e){e.stopPropagation(),t.$router.push("/dashboard/"+t.$store.getters["auth/AccessToken"]).catch((function(t){}))}}},[a("span",{staticClass:"hidden-sm-and-down"},[t._v(" "+t._s(t.NamaAPPAlias)+" ")])]),a("v-spacer"),a("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:t._u([{key:"activator",fn:function(e){var i=e.on;return[a("v-avatar",{attrs:{size:"30"}},[a("v-img",t._g({attrs:{src:t.photoUser}},i))],1)]}}])},[a("v-list",[a("v-list-item",[a("v-list-item-avatar",[a("v-img",{attrs:{src:t.photoUser}})],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),a("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),a("v-divider"),a("v-list-item",{attrs:{to:"/system-users/profil"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-account")])],1),a("v-list-item-title",[t._v("Profil")])],1),a("v-divider"),a("v-list-item",{on:{click:function(e){return e.preventDefault(),t.logout(e)}}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-power")])],1),a("v-list-item-title",[t._v("Logout")])],1)],1)],1),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-app-bar-nav-icon",{on:{click:function(e){e.stopPropagation(),t.drawerRight=!t.drawerRight}}},[a("v-icon",[t._v("mdi-menu-open")])],1)],1),a("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",temporary:t.temporaryleftsidebar,app:""},model:{value:t.drawer,callback:function(e){t.drawer=e},expression:"drawer"}},[a("v-list-item",[a("v-list-item-avatar",[a("v-img",{attrs:{src:t.photoUser},on:{click:function(e){return e.stopPropagation(),t.toProfile(e)}}})],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),a("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),a("v-divider"),a("v-list",{attrs:{expand:""}},[t.CAN_ACCESS("BELANJA-GROUP_BROWSE")?a("v-list-item",{staticClass:"yellow",attrs:{to:{path:"/belanjaperubahan"},link:"",color:"green"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-home-floor-b")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("BOARD BELANJA PERUBAHAN")])],1)],1):t._e(),a("v-divider"),a("v-subheader",[t._v("TRANSAKSI")]),t.CAN_ACCESS("RKA PERUBAHAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/belanjaperubahan/rka"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-graph")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" RKA PERUBAHAN ")])],1)],1):t._e(),a("v-subheader",[t._v("LAPORAN")]),t.CAN_ACCESS("FORM A PERUBAHAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/belanjaperubahan/report/forma"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-graph")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" FORM A ")])],1)],1):t._e(),t.CAN_ACCESS("FORM B PERUBAHAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/belanjaperubahan/report/formbopd"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-graph")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" FORM B OPD ")])],1)],1):t._e(),t.CAN_ACCESS("FORM B PERUBAHAN_BROWSE")?a("v-list-item",{attrs:{link:"",to:"/belanjaperubahan/report/formbunitkerja"}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-graph")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v(" FORM B UNIT KERJA ")])],1)],1):t._e(),a("v-subheader",[t._v("STATISTIK")]),a("v-list-item",{attrs:{to:"/belanjaperubahan/statistik/peringkatopd",link:""}},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-chart-timeline-variant")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("PERINGKAT OPD")])],1)],1)],1)],1),t.showrightsidebar?a("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:t.drawerRight,callback:function(e){t.drawerRight=e},expression:"drawerRight"}},[a("v-list",{attrs:{dense:""}},[a("v-list-item",[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-menu-open")])],1),a("v-list-item-content",[a("v-list-item-title",{staticClass:"title"},[t._v(" OPTIONS ")])],1)],1),a("v-divider"),a("v-list-item",{staticClass:"teal lighten-5 mb-5"},[a("v-list-item-icon",{staticClass:"mr-2"},[a("v-icon",[t._v("mdi-filter")])],1),a("v-list-item-content",[a("v-list-item-title",[t._v("FILTER")])],1)],1),t._t("filtersidebar")],2)],1):t._e(),a("v-main",{staticClass:"mx-4 mb-4"},[t._t("default")],2),a("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[a("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[a("v-divider"),a("v-card-text",{staticClass:"py-2 white--text text-center"},[a("strong",[t._v(t._s(t.NamaAPP)+" (2019-2020)")]),t._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),a("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev"}},[a("v-icon",[t._v("mdi-github")])],1)],1)],1)],1)],1)},n=[],s=(a("ac1f"),a("5319"),a("5530")),r=a("2f62"),o={name:"BelanjaPerubahanLayout",props:{showrightsidebar:{type:Boolean,default:!0},temporaryleftsidebar:{type:Boolean,default:!1}},data:function(){return{loginTime:0,drawer:null,drawerRight:null}},methods:{logout:function(){var t=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")})).catch((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")}))}},computed:Object(s["a"])(Object(s["a"])(Object(s["a"])({},Object(r["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"})),Object(r["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var t,e=this.ATTRIBUTE_USER("foto");return t=""==e?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+e,t}}),watch:{loginTime:{handler:function(t){var e=this;t>=0?setTimeout((function(){e.loginTime=1==e.AUTHENTICATED?e.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,c=a("2877"),u=a("6544"),d=a.n(u),h=a("40dc"),m=a("5bc1"),p=a("8212"),v=a("8336"),f=a("b0af"),g=a("99d9"),b=a("ce7e"),_=a("553a"),A=a("132d"),I=a("adda"),S=a("8860"),k=a("da13"),x=a("8270"),D=a("5d23"),y=a("34c3"),O=a("f6c4"),C=a("e449"),T=a("f774"),w=a("2fa4"),R=a("e0c7"),P=a("afd9"),j=a("2a7f"),L=Object(c["a"])(l,i,n,!1,null,null,null);e["a"]=L.exports;d()(L,{VAppBar:h["a"],VAppBarNavIcon:m["a"],VAvatar:p["a"],VBtn:v["a"],VCard:f["a"],VCardText:g["c"],VDivider:b["a"],VFooter:_["a"],VIcon:A["a"],VImg:I["a"],VList:S["a"],VListItem:k["a"],VListItemAvatar:x["a"],VListItemContent:D["a"],VListItemIcon:y["a"],VListItemSubtitle:D["b"],VListItemTitle:D["c"],VMain:O["a"],VMenu:C["a"],VNavigationDrawer:T["a"],VSpacer:w["a"],VSubheader:R["a"],VSystemBar:P["a"],VToolbarTitle:j["b"]})},9734:function(t,e,a){},c6a6:function(t,e,a){"use strict";a("4de4"),a("7db0"),a("c975"),a("d81d"),a("45fc"),a("498a");var i=a("5530"),n=(a("2bfd"),a("b974")),s=a("8654"),r=a("d9f7"),o=a("80d2"),l=Object(i["a"])(Object(i["a"])({},n["b"]),{},{offsetY:!0,offsetOverflow:!0,transition:!1});e["a"]=n["a"].extend({name:"v-autocomplete",props:{allowOverflow:{type:Boolean,default:!0},autoSelectFirst:{type:Boolean,default:!1},filter:{type:Function,default:function(t,e,a){return a.toLocaleLowerCase().indexOf(e.toLocaleLowerCase())>-1}},hideNoData:Boolean,menuProps:{type:n["a"].options.props.menuProps.type,default:function(){return l}},noFilter:Boolean,searchInput:{type:String,default:void 0}},data:function(){return{lazySearch:this.searchInput}},computed:{classes:function(){return Object(i["a"])(Object(i["a"])({},n["a"].options.computed.classes.call(this)),{},{"v-autocomplete":!0,"v-autocomplete--is-selecting-index":this.selectedIndex>-1})},computedItems:function(){return this.filteredItems},selectedValues:function(){var t=this;return this.selectedItems.map((function(e){return t.getValue(e)}))},hasDisplayedItems:function(){var t=this;return this.hideSelected?this.filteredItems.some((function(e){return!t.hasItem(e)})):this.filteredItems.length>0},currentRange:function(){return null==this.selectedItem?0:String(this.getText(this.selectedItem)).length},filteredItems:function(){var t=this;return!this.isSearching||this.noFilter||null==this.internalSearch?this.allItems:this.allItems.filter((function(e){var a=Object(o["r"])(e,t.itemText),i=null!=a?String(a):"";return t.filter(e,String(t.internalSearch),i)}))},internalSearch:{get:function(){return this.lazySearch},set:function(t){this.lazySearch=t,this.$emit("update:search-input",t)}},isAnyValueAllowed:function(){return!1},isDirty:function(){return this.searchIsDirty||this.selectedItems.length>0},isSearching:function(){return this.multiple&&this.searchIsDirty||this.searchIsDirty&&this.internalSearch!==this.getText(this.selectedItem)},menuCanShow:function(){return!!this.isFocused&&(this.hasDisplayedItems||!this.hideNoData)},$_menuProps:function(){var t=n["a"].options.computed.$_menuProps.call(this);return t.contentClass="v-autocomplete__content ".concat(t.contentClass||"").trim(),Object(i["a"])(Object(i["a"])({},l),t)},searchIsDirty:function(){return null!=this.internalSearch&&""!==this.internalSearch},selectedItem:function(){var t=this;return this.multiple?null:this.selectedItems.find((function(e){return t.valueComparator(t.getValue(e),t.getValue(t.internalValue))}))},listData:function(){var t=n["a"].options.computed.listData.call(this);return t.props=Object(i["a"])(Object(i["a"])({},t.props),{},{items:this.virtualizedItems,noFilter:this.noFilter||!this.isSearching||!this.filteredItems.length,searchInput:this.internalSearch}),t}},watch:{filteredItems:"onFilteredItemsChanged",internalValue:"setSearch",isFocused:function(t){t?(document.addEventListener("copy",this.onCopy),this.$refs.input&&this.$refs.input.select()):(document.removeEventListener("copy",this.onCopy),this.updateSelf())},isMenuActive:function(t){!t&&this.hasSlot&&(this.lazySearch=void 0)},items:function(t,e){e&&e.length||!this.hideNoData||!this.isFocused||this.isMenuActive||!t.length||this.activateMenu()},searchInput:function(t){this.lazySearch=t},internalSearch:"onInternalSearchChanged",itemText:"updateSelf"},created:function(){this.setSearch()},destroyed:function(){document.removeEventListener("copy",this.onCopy)},methods:{onFilteredItemsChanged:function(t,e){var a=this;t!==e&&(this.setMenuIndex(-1),this.$nextTick((function(){a.internalSearch&&(1===t.length||a.autoSelectFirst)&&(a.$refs.menu.getTiles(),a.setMenuIndex(0))})))},onInternalSearchChanged:function(){this.updateMenuDimensions()},updateMenuDimensions:function(){this.isMenuActive&&this.$refs.menu&&this.$refs.menu.updateDimensions()},changeSelectedIndex:function(t){this.searchIsDirty||(this.multiple&&t===o["x"].left?-1===this.selectedIndex?this.selectedIndex=this.selectedItems.length-1:this.selectedIndex--:this.multiple&&t===o["x"].right?this.selectedIndex>=this.selectedItems.length-1?this.selectedIndex=-1:this.selectedIndex++:t!==o["x"].backspace&&t!==o["x"].delete||this.deleteCurrentItem())},deleteCurrentItem:function(){var t=this.selectedIndex,e=this.selectedItems[t];if(this.isInteractive&&!this.getDisabled(e)){var a=this.selectedItems.length-1;if(-1!==this.selectedIndex||0===a){var i=this.selectedItems.length,n=t!==i-1?t:t-1,s=this.selectedItems[n];s?this.selectItem(e):this.setValue(this.multiple?[]:void 0),this.selectedIndex=n}else this.selectedIndex=a}},clearableCallback:function(){this.internalSearch=void 0,n["a"].options.methods.clearableCallback.call(this)},genInput:function(){var t=s["a"].options.methods.genInput.call(this);return t.data=Object(r["a"])(t.data,{attrs:{"aria-activedescendant":Object(o["p"])(this.$refs.menu,"activeTile.id"),autocomplete:Object(o["p"])(t.data,"attrs.autocomplete","off")},domProps:{value:this.internalSearch}}),t},genInputSlot:function(){var t=n["a"].options.methods.genInputSlot.call(this);return t.data.attrs.role="combobox",t},genSelections:function(){return this.hasSlot||this.multiple?n["a"].options.methods.genSelections.call(this):[]},onClick:function(t){this.isInteractive&&(this.selectedIndex>-1?this.selectedIndex=-1:this.onFocus(),this.isAppendInner(t.target)||this.activateMenu())},onInput:function(t){if(!(this.selectedIndex>-1)&&t.target){var e=t.target,a=e.value;e.value&&this.activateMenu(),this.internalSearch=a,this.badInput=e.validity&&e.validity.badInput}},onKeyDown:function(t){var e=t.keyCode;n["a"].options.methods.onKeyDown.call(this,t),this.changeSelectedIndex(e)},onSpaceDown:function(t){},onTabDown:function(t){n["a"].options.methods.onTabDown.call(this,t),this.updateSelf()},onUpDown:function(t){t.preventDefault(),this.activateMenu()},selectItem:function(t){n["a"].options.methods.selectItem.call(this,t),this.setSearch()},setSelectedItems:function(){n["a"].options.methods.setSelectedItems.call(this),this.isFocused||this.setSearch()},setSearch:function(){var t=this;this.$nextTick((function(){t.multiple&&t.internalSearch&&t.isMenuActive||(t.internalSearch=!t.selectedItems.length||t.multiple||t.hasSlot?null:t.getText(t.selectedItem))}))},updateSelf:function(){(this.searchIsDirty||this.internalValue)&&(this.valueComparator(this.internalSearch,this.getValue(this.internalValue))||this.setSearch())},hasItem:function(t){return this.selectedValues.indexOf(this.getValue(t))>-1},onCopy:function(t){var e,a;if(-1!==this.selectedIndex){var i=this.selectedItems[this.selectedIndex],n=this.getText(i);null==(e=t.clipboardData)||e.setData("text/plain",n),null==(a=t.clipboardData)||a.setData("text/vnd.vuetify.autocomplete.item+plain",n),t.preventDefault()}}}})}}]);