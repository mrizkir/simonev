(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-4a72f14c"],{9336:function(a,t,e){"use strict";e.r(t);var n=function(){var a=this,t=a.$createElement,e=a._self._c||t;return e("BelanjaMurniLayout",{attrs:{showrightsidebar:!1},scopedSlots:a._u([{key:"system-bar",fn:function(){return[a._v(" Tahun Anggaran: "+a._s(a.$store.getters["uifront/getTahunAnggaran"])+" | Bulan Realisasi:"+a._s(a.$store.getters["uifront/getNamaBulan"])+" ")]},proxy:!0}])},[e("ModuleHeader",{scopedSlots:a._u([{key:"icon",fn:function(){return[a._v(" mdi-graph ")]},proxy:!0},{key:"name",fn:function(){return[a._v(" RKA MURNI ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[e("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:a.breadcrumbs},scopedSlots:a._u([{key:"divider",fn:function(){return[e("v-icon",[a._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[e("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[a._v(" Ubah Uraian Rencana Kegiatan dan Anggaran (RKA) OPD / Unit Kerja APBD Murni ")])]},proxy:!0}])}),e("v-container",[e("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[e("v-col",{attrs:{cols:"12"}},[e("v-bottom-navigation",{attrs:{color:"purple lighten-1"}},[e("v-btn",{attrs:{to:{path:"/belanjamurni/rka/uraian/"+a.datauraian.RKAID}}},[e("span",[a._v("Keluar")]),e("v-icon",[a._v("mdi-close")])],1)],1)],1)],1),e("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[e("v-col",{attrs:{cols:"12"}},[e("v-form",{ref:"frmedituraian",attrs:{"lazy-validation":""},model:{value:a.form_valid,callback:function(t){a.form_valid=t},expression:"form_valid"}},[e("v-card",{staticClass:"mb-2"},[e("v-card-text",[e("h5",[a._v("DATA URAIAN")]),e("v-divider",{staticClass:"mb-2"}),e("v-text-field",{attrs:{label:"KEGIATAN",type:"text",filled:"",value:"["+a.datakegiatan.kode_kegiatan+"] "+a.datakegiatan.KgtNm,disabled:!0}}),e("v-text-field",{attrs:{label:"URAIAN",type:"text",filled:"",value:"["+a.datauraian.kode_uraian+"] "+a.datauraian.nama_uraian,disabled:!0}}),e("v-text-field",{attrs:{label:"PAGU URAIAN",type:"text",filled:"",value:a._f("formatUang")(a.datauraian.PaguUraian1),disabled:!0}}),e("v-select",{attrs:{label:"SUMBER DANA",rules:a.rule_sumberdana,items:a.daftar_sumberdana,"item-text":"Nm_SumberDana","item-value":"SumberDanaID",filled:""},model:{value:a.formdata.SumberDanaID,callback:function(t){a.$set(a.formdata,"SumberDanaID",t)},expression:"formdata.SumberDanaID"}}),e("v-select",{attrs:{label:"JENIS PELAKSANAAN","item-text":"NamaJenis","item-value":"JenisPelaksanaanID",items:a.daftar_jenispelaksanaan,filled:""},model:{value:a.formdata.JenisPelaksanaanID,callback:function(t){a.$set(a.formdata,"JenisPelaksanaanID",t)},expression:"formdata.JenisPelaksanaanID"}}),e("v-select",{attrs:{label:"JENIS PEMBANGUNAN","item-text":"NamaJenis","item-value":"JenisPembangunanID",items:a.daftar_jenispembangunan,filled:""},model:{value:a.formdata.JenisPembangunanID,callback:function(t){a.$set(a.formdata,"JenisPembangunanID",t)},expression:"formdata.JenisPembangunanID"}})],1)],1),e("v-card",{staticClass:"mb-2"},[e("v-tabs",{model:{value:a.tab,callback:function(t){a.tab=t},expression:"tab"}},[e("v-tab",[a._v("LOKASI DEFAULT")]),e("v-tab",[a._v("LOKASI LAIN")])],1),e("v-tabs-items",{model:{value:a.tab,callback:function(t){a.tab=t},expression:"tab"}},[e("v-tab-item",{key:0},[e("v-card",{attrs:{flat:""}},[e("v-card-text",[e("v-select",{attrs:{label:"PROVINSI",items:a.daftar_prov,"item-text":"Nm_Prov","item-value":"PMProvID",filled:"",loading:a.btnLoading,disabled:a.btnLoading},model:{value:a.formlokasi_PMProvID,callback:function(t){a.formlokasi_PMProvID=t},expression:"formlokasi_PMProvID"}}),e("v-select",{attrs:{label:"KABUPATEN/KOTA",items:a.daftar_kab,loading:a.btnLoading,disabled:a.btnLoading,"item-text":"Nm_Kota","item-value":"PmKotaID",filled:""},model:{value:a.formlokasi_PmKotaID,callback:function(t){a.formlokasi_PmKotaID=t},expression:"formlokasi_PmKotaID"}}),e("v-select",{attrs:{label:"KECAMATAN",loading:a.btnLoading,disabled:a.btnLoading,items:a.daftar_kecamatan,"item-text":"Nm_Kecamatan","item-value":"PmKecamatanID",filled:""},model:{value:a.formlokasi_PmKecamatanID,callback:function(t){a.formlokasi_PmKecamatanID=t},expression:"formlokasi_PmKecamatanID"}}),e("v-select",{attrs:{label:"DESA/KELURAHAN",items:a.daftar_desa,"item-text":"Nm_Desa","item-value":"PmDesaID",filled:""},model:{value:a.formlokasi_PmDesaID,callback:function(t){a.formlokasi_PmDesaID=t},expression:"formlokasi_PmDesaID"}}),e("v-select",{attrs:{label:"RW",items:a.daftar_rtrw,filled:""},model:{value:a.formlokasi_rw,callback:function(t){a.formlokasi_rw=t},expression:"formlokasi_rw"}}),e("v-select",{attrs:{label:"RT",items:a.daftar_rtrw,filled:""},model:{value:a.formlokasi_rt,callback:function(t){a.formlokasi_rt=t},expression:"formlokasi_rt"}})],1)],1)],1),e("v-tab-item",{key:1},[e("v-card",{attrs:{flat:""}},[e("v-card-text",[e("v-text-field",{attrs:{label:"LOKASI KEGIATAN",type:"text",filled:""},model:{value:a.formdata.ket_lok,callback:function(t){a.$set(a.formdata,"ket_lok",t)},expression:"formdata.ket_lok"}})],1)],1)],1)],1)],1),e("v-card",[e("v-card-text",[e("h5",[a._v("DATA URAIAN")]),e("v-divider",{staticClass:"mb-2"}),e("v-text-field",{attrs:{label:"NAMA PERUSAHAAN",type:"text",filled:""},model:{value:a.formdata.nama_perusahaan,callback:function(t){a.$set(a.formdata,"nama_perusahaan",t)},expression:"formdata.nama_perusahaan"}}),e("v-text-field",{attrs:{label:"ALAMAT PERUSAHAAN",type:"text",filled:""},model:{value:a.formdata.alamat_perusahaan,callback:function(t){a.$set(a.formdata,"alamat_perusahaan",t)},expression:"formdata.alamat_perusahaan"}}),e("v-text-field",{attrs:{label:"NOMOR TELEPON",type:"text",rules:a.rule_notelepon,filled:""},model:{value:a.formdata.no_telepon,callback:function(t){a.$set(a.formdata,"no_telepon",t)},expression:"formdata.no_telepon"}}),e("v-text-field",{attrs:{label:"NAMA DIREKTUR",type:"text",filled:""},model:{value:a.formdata.nama_direktur,callback:function(t){a.$set(a.formdata,"nama_direktur",t)},expression:"formdata.nama_direktur"}}),e("v-text-field",{attrs:{label:"NPWP",type:"text",filled:""},model:{value:a.formdata.npwp,callback:function(t){a.$set(a.formdata,"npwp",t)},expression:"formdata.npwp"}}),e("v-text-field",{attrs:{label:"NOMOR KONTRAK",type:"text",filled:""},model:{value:a.formdata.no_kontrak,callback:function(t){a.$set(a.formdata,"no_kontrak",t)},expression:"formdata.no_kontrak"}}),e("v-menu",{ref:"menuTanggalKontrak",attrs:{"close-on-content-click":!1,"return-value":a.formdata.tgl_kontrak,transition:"scale-transition","offset-y":"","max-width":"290px","min-width":"290px"},on:{"update:returnValue":function(t){return a.$set(a.formdata,"tgl_kontrak",t)},"update:return-value":function(t){return a.$set(a.formdata,"tgl_kontrak",t)}},scopedSlots:a._u([{key:"activator",fn:function(t){var n=t.on;return[e("v-text-field",a._g({attrs:{label:"TANGGAL KONTRAK",readonly:""},model:{value:a.formdata.tgl_kontrak,callback:function(t){a.$set(a.formdata,"tgl_kontrak",t)},expression:"formdata.tgl_kontrak"}},n))]}}]),model:{value:a.menuTanggalKontrak,callback:function(t){a.menuTanggalKontrak=t},expression:"menuTanggalKontrak"}},[e("v-date-picker",{attrs:{"no-title":"",scrollable:""},model:{value:a.formdata.tgl_kontrak,callback:function(t){a.$set(a.formdata,"tgl_kontrak",t)},expression:"formdata.tgl_kontrak"}},[e("v-spacer"),e("v-btn",{attrs:{text:"",color:"primary"},on:{click:function(t){a.menuTanggalKontrak=!1}}},[a._v("Cancel")]),e("v-btn",{attrs:{text:"",color:"primary"},on:{click:function(t){return a.$refs.menuTanggalKontrak.save(a.formdata.tgl_kontrak)}}},[a._v("OK")])],1)],1),e("v-menu",{ref:"menuTanggalMulaiPelaksanaan",attrs:{"close-on-content-click":!1,"return-value":a.formdata.tgl_mulai_pelaksanaan,transition:"scale-transition","offset-y":"","max-width":"290px","min-width":"290px"},on:{"update:returnValue":function(t){return a.$set(a.formdata,"tgl_mulai_pelaksanaan",t)},"update:return-value":function(t){return a.$set(a.formdata,"tgl_mulai_pelaksanaan",t)}},scopedSlots:a._u([{key:"activator",fn:function(t){var n=t.on;return[e("v-text-field",a._g({attrs:{label:"TANGGAL MULAI PELAKSANAAN",readonly:""},model:{value:a.formdata.tgl_mulai_pelaksanaan,callback:function(t){a.$set(a.formdata,"tgl_mulai_pelaksanaan",t)},expression:"formdata.tgl_mulai_pelaksanaan"}},n))]}}]),model:{value:a.menuTanggalMulaiPelaksanaan,callback:function(t){a.menuTanggalMulaiPelaksanaan=t},expression:"menuTanggalMulaiPelaksanaan"}},[e("v-date-picker",{attrs:{"no-title":"",scrollable:""},model:{value:a.formdata.tgl_mulai_pelaksanaan,callback:function(t){a.$set(a.formdata,"tgl_mulai_pelaksanaan",t)},expression:"formdata.tgl_mulai_pelaksanaan"}},[e("v-spacer"),e("v-btn",{attrs:{text:"",color:"primary"},on:{click:function(t){a.menuTanggalMulaiPelaksanaan=!1}}},[a._v("Cancel")]),e("v-btn",{attrs:{text:"",color:"primary"},on:{click:function(t){return a.$refs.menuTanggalMulaiPelaksanaan.save(a.formdata.tgl_mulai_pelaksanaan)}}},[a._v("OK")])],1)],1),e("v-menu",{ref:"menuTanggalSelesaiPelaksanaan",attrs:{"close-on-content-click":!1,"return-value":a.formdata.tgl_mulai_pelaksanaan,transition:"scale-transition","offset-y":"","max-width":"290px","min-width":"290px"},on:{"update:returnValue":function(t){return a.$set(a.formdata,"tgl_mulai_pelaksanaan",t)},"update:return-value":function(t){return a.$set(a.formdata,"tgl_mulai_pelaksanaan",t)}},scopedSlots:a._u([{key:"activator",fn:function(t){var n=t.on;return[e("v-text-field",a._g({attrs:{label:"TANGGAL SELESAI PELAKSANAAN",readonly:""},model:{value:a.formdata.tgl_selesai_pelaksanaan,callback:function(t){a.$set(a.formdata,"tgl_selesai_pelaksanaan",t)},expression:"formdata.tgl_selesai_pelaksanaan"}},n))]}}]),model:{value:a.menuTanggalSelesaiPelaksanaan,callback:function(t){a.menuTanggalSelesaiPelaksanaan=t},expression:"menuTanggalSelesaiPelaksanaan"}},[e("v-date-picker",{attrs:{"no-title":"",scrollable:""},model:{value:a.formdata.tgl_selesai_pelaksanaan,callback:function(t){a.$set(a.formdata,"tgl_selesai_pelaksanaan",t)},expression:"formdata.tgl_selesai_pelaksanaan"}},[e("v-spacer"),e("v-btn",{attrs:{text:"",color:"primary"},on:{click:function(t){a.menuTanggalSelesaiPelaksanaan=!1}}},[a._v("Cancel")]),e("v-btn",{attrs:{text:"",color:"primary"},on:{click:function(t){return a.$refs.menuTanggalSelesaiPelaksanaan.save(a.formdata.tgl_selesai_pelaksanaan)}}},[a._v("OK")])],1)],1),e("v-select",{attrs:{label:"STATUS LELANG",items:a.daftar_statuslelang,filled:""},model:{value:a.formdata.status_lelang,callback:function(t){a.$set(a.formdata,"status_lelang",t)},expression:"formdata.status_lelang"}}),e("h5",[a._v("LAIN-LAIN")]),e("v-divider",{staticClass:"mb-2"}),e("v-textarea",{attrs:{label:"KETERANGAN",type:"text",filled:""},model:{value:a.formdata.Descr,callback:function(t){a.$set(a.formdata,"Descr",t)},expression:"formdata.Descr"}})],1),e("v-card-actions",[e("v-spacer"),e("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(t){return t.stopPropagation(),a.closeedituraian(t)}}},[a._v("BATAL")]),e("v-btn",{attrs:{color:"blue darken-1",text:"",loading:a.btnLoading,disabled:!a.form_valid||a.btnLoading},on:{click:function(t){return t.stopPropagation(),a.updateuraian(t)}}},[a._v(" SIMPAN ")])],1)],1)],1)],1)],1)],1)],1)},r=[],i=(e("b64b"),e("96cf"),e("1da1")),s=e("9388"),o=e("e477"),l={name:"EditUraianRKAMurni",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.$store.getters["auth/AccessToken"]},{text:"BELANJA",disabled:!1,href:"#"},{text:"RKA MURNI",disabled:!1,href:"#"},{text:"URAIAN RKA MURNI",disabled:!1,href:"#"},{text:"UBAH URAIAN RKA",disabled:!0,href:"#"}],this.RKARincID=this.$route.params.rkarincid;var a=this.$store.getters["uiadmin/Page"]("rkamurni");this.datakegiatan=a.datakegiatan,this.datauraian=a.datauraian,Object.keys(this.datauraian).length>1?(this.OrgID=a.OrgID_Selected,this.initialize(),null!=this.formdata.SumberDanaID&&""!=this.formdata.SumberDanaID||(this.formdata.SumberDanaID=this.datakegiatan.SumberDanaID),null!=this.formdata.idlok&&""!=this.formdata.idlok&&this.formdata.idlok.length>0?this.formlokasi_PMProvID=this.formdata.PMProvID:this.tab=1,this.formlokasi_rw=this.formdata.rw,this.formlokasi_rt=this.formdata.rt):Object.keys(this.datakegiatan).length>1?this.closeedituraian():(a.datakegiatan={RKAID:""},a.datauraian={RKARincID:""},a.datarekening={},this.$store.dispatch("uiadmin/updatePage",a),this.$router.push("/belanjamurni/rka"))},data:function(){return{OrgID:"",RKARincID:"",btnLoading:!1,datakegiatan:[],datauraian:[],firstformload_prov:!0,firstformload_kota:!0,firstformload_kecamatan:!0,menuTanggalKontrak:!1,menuTanggalMulaiPelaksanaan:!1,menuTanggalSelesaiPelaksanaan:!1,tab:null,form_valid:!0,daftar_sumberdana:[],daftar_jenispelaksanaan:[],daftar_jenispembangunan:[],daftar_prov:[],daftar_kab:[],daftar_kecamatan:[],daftar_desa:[],daftar_rtrw:[{value:"1",text:"I"},{value:"2",text:"II"},{value:"3",text:"III"},{value:"4",text:"IV"},{value:"5",text:"V"},{value:"6",text:"VI"},{value:"7",text:"VII"},{value:"8",text:"VIII"},{value:"9",text:"IX"},{value:"10",text:"X"},{value:"11",text:"XI"},{value:"12",text:"XII"},{value:"13",text:"XIII"},{value:"14",text:"XIV"},{value:"15",text:"XV"},{value:"16",text:"XVI"},{value:"17",text:"XVII"},{value:"18",text:"XVIII"},{value:"19",text:"XIX"},{value:"20",text:"XX"}],daftar_statuslelang:[{value:"0",text:"BELUM DILELANG"},{value:"2",text:"PROSES LELANG"},{value:"1",text:"TELAH DILELANG"}],formlokasi_PMProvID:"",formlokasi_PmKotaID:"",formlokasi_PmKecamatanID:"",formlokasi_PmDesaID:"",formlokasi_rw:"",formlokasi_rt:"",formdata:{RKARincID:"",RKAID:"",JenisPelaksanaanID:"",SumberDanaID:null,JenisPembangunanID:"",kode_uraian:"",nama_uraian:"",volume1:0,satuan1:"",harga_satuan1:0,PaguUraian1:0,PMProvID:"",PmKotaID:"",PmKecamatanID:"",idlok:"",ket_lok:"",rw:"",rt:"",nama_perusahaan:"",alamat_perusahaan:"",no_telepon:"",nama_direktur:"",npwp:"",no_kontrak:"",tgl_kontrak:"",tgl_mulai_pelaksanaan:"",tgl_selesai_pelaksanaan:"",status_lelang:"",Descr:"",TA:"",created_at:"",updated_at:""},rule_sumberdana:[function(a){return!!a||"Mohon untuk di pilih sumber dana !!!"}],rule_notelepon:[function(a){return!(null!==a&&""!==a&&a.length>0)||(/^[0-9]+$/.test(a)||"Nomor Telepon harus angka")}]}},methods:{initialize:function(){var a=Object(i["a"])(regeneratorRuntime.mark((function a(){var t=this;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return this.formdata=Object.assign({},this.datauraian),a.next=3,this.$ajax.post("/dmaster/jenispelaksanaan",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.daftar_jenispelaksanaan=e.jenispelaksanaan})).catch((function(){t.btnLoading=!1}));case 3:return a.next=5,this.$ajax.post("/dmaster/jenispembangunan",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.daftar_jenispembangunan=e.jenispembangunan})).catch((function(){t.btnLoading=!1}));case 5:return a.next=7,this.$ajax.post("/dmaster/sumberdana",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.daftar_sumberdana=e.sumberdana})).catch((function(){t.btnLoading=!1}));case 7:return a.next=9,this.$ajax.get("/dmaster/provinsi",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.daftar_prov=e.provinsi})).catch((function(){t.btnLoading=!1}));case 9:case"end":return a.stop()}}),a,this)})));function t(){return a.apply(this,arguments)}return t}(),updateuraian:function(){var a=Object(i["a"])(regeneratorRuntime.mark((function a(){var t,e,n=this;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:if(!this.$refs.frmedituraian.validate()){a.next=7;break}return this.btnLoading=!0,t=this.formdata.idlok,e=this.formdata.ket_lok,1==this.tab&&(t=""),a.next=7,this.$ajax.post("/belanja/rkamurni/updatedetailuraian/"+this.formdata.RKARincID,{_method:"PUT",JenisPelaksanaanID:this.formdata.JenisPelaksanaanID,SumberDanaID:this.formdata.SumberDanaID,JenisPembangunanID:this.formdata.JenisPembangunanID,idlok:t,ket_lok:e,rw:this.formlokasi_rw,rt:this.formlokasi_rt,nama_perusahaan:this.formdata.nama_perusahaan,alamat_perusahaan:this.formdata.alamat_perusahaan,no_telepon:this.formdata.no_telepon,nama_direktur:this.formdata.nama_direktur,npwp:this.formdata.npwp,no_kontrak:this.formdata.no_kontrak,tgl_kontrak:this.formdata.tgl_kontrak,tgl_mulai_pelaksanaan:this.formdata.tgl_mulai_pelaksanaan,tgl_selesai_pelaksanaan:this.formdata.tgl_selesai_pelaksanaan,status_lelang:this.formdata.status_lelang,Descr:this.formdata.Descr},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(){var a=n.$store.getters["uiadmin/Page"]("rkamurni");a.datauraian.JenisPelaksanaanID=n.formdata.JenisPelaksanaanID,a.datauraian.SumberDanaID=n.formdata.SumberDanaID,a.datauraian.JenisPembangunanID=n.formdata.JenisPembangunanID,a.datauraian.idlok=t,a.datauraian.ket_lok=e,a.datauraian.PMProvID=n.formlokasi_PMProvID,a.datauraian.PmKotaID=n.formlokasi_PmKotaID,a.datauraian.PmKecamatanID=n.formlokasi_PmKecamatanID,a.datauraian.PmDesaID=n.formlokasi_PmDesaID,a.datauraian.rw=n.formlokasi_rw,a.datauraian.rt=n.formlokasi_rt,a.datauraian.nama_perusahaan=n.formdata.nama_perusahaan,a.datauraian.alamat_perusahaan=n.formdata.alamat_perusahaan,a.datauraian.no_telepon=n.formdata.no_telepon,a.datauraian.nama_direktur=n.formdata.nama_direktur,a.datauraian.npwp=n.formdata.npwp,a.datauraian.no_kontrak=n.formdata.no_kontrak,a.datauraian.tgl_kontrak=n.formdata.tgl_kontrak,a.datauraian.tgl_mulai_pelaksanaan=n.formdata.tgl_mulai_pelaksanaan,a.datauraian.tgl_selesai_pelaksanaan=n.formdata.tgl_selesai_pelaksanaan,a.datauraian.status_lelang=n.formdata.status_lelang,a.datauraian.Descr=n.formdata.Descr,n.$store.dispatch("uiadmin/updatePage",a),n.closeedituraian(),n.btnLoading=!1})).catch((function(){n.btnLoading=!1}));case 7:case"end":return a.stop()}}),a,this)})));function t(){return a.apply(this,arguments)}return t}(),closeedituraian:function(){this.$router.push("/belanjamurni/rka/realisasi/"+this.formdata.RKARincID)}},watch:{formlokasi_PMProvID:function(){var a=Object(i["a"])(regeneratorRuntime.mark((function a(t){var e,n=this;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return e=t,this.btnLoading=!0,a.next=4,this.$ajax.get("/dmaster/provinsi/"+e+"/kota",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var t=a.data;n.daftar_kab=t.kota,n.formdata.idlok=e,n.formdata.ket_lok="provinsi",n.btnLoading=!1})).catch((function(){n.btnLoading=!1}));case 4:this.firstformload_prov&&(this.firstformload_prov=!1,this.formlokasi_PmKotaID=this.formdata.PmKotaID),this.daftar_kecamatan=[],this.daftar_desa=[];case 7:case"end":return a.stop()}}),a,this)})));function t(t){return a.apply(this,arguments)}return t}(),formlokasi_PmKotaID:function(){var a=Object(i["a"])(regeneratorRuntime.mark((function a(t){var e,n=this;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return e=t,this.btnLoading=!0,a.next=4,this.$ajax.get("/dmaster/kota/"+e+"/kecamatan",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var t=a.data;n.daftar_kecamatan=t.kecamatan,n.formdata.idlok=e,n.formdata.ket_lok="kota",n.btnLoading=!1})).catch((function(){n.btnLoading=!1}));case 4:this.firstformload_kota&&(this.firstformload_kota=!1,this.formlokasi_PmKecamatanID=this.formdata.PmKecamatanID),this.daftar_desa=[];case 6:case"end":return a.stop()}}),a,this)})));function t(t){return a.apply(this,arguments)}return t}(),formlokasi_PmKecamatanID:function(){var a=Object(i["a"])(regeneratorRuntime.mark((function a(t){var e,n=this;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return e=t,a.next=3,this.$ajax.get("/dmaster/kecamatan/"+e+"/desa",{tahun:this.$store.getters["uifront/getTahunAnggaran"]},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var t=a.data;n.daftar_desa=t.desa,n.formdata.idlok=e,n.formdata.ket_lok="kecamatan",n.btnLoading=!1})).catch((function(){n.btnLoading=!1}));case 3:this.firstformload_kecamatan&&(this.firstformload_kecamatan=!1,this.formlokasi_PmDesaID=this.formdata.PmDesaID);case 4:case"end":return a.stop()}}),a,this)})));function t(t){return a.apply(this,arguments)}return t}(),formlokasi_PmDesaID:function(a){this.formdata.idlok=a,this.formdata.ket_lok="desa"}},components:{BelanjaMurniLayout:s["a"],ModuleHeader:o["a"]}},u=l,m=e("2877"),d=e("6544"),c=e.n(d),f=e("0798"),v=e("b81c"),k=e("2bc5"),_=e("8336"),h=e("b0af"),p=e("99d9"),g=e("62ad"),b=e("a523"),A=e("2e4b"),I=e("ce7e"),x=e("4bd4"),D=e("132d"),P=e("e449"),T=e("0fd9"),R=e("b974"),N=e("2fa4"),S=e("71a3"),$=e("c671"),K=e("fe57"),w=e("aac8"),L=e("8654"),E=e("a844"),C=Object(m["a"])(u,n,r,!1,null,null,null);t["default"]=C.exports;c()(C,{VAlert:f["a"],VBottomNavigation:v["a"],VBreadcrumbs:k["a"],VBtn:_["a"],VCard:h["a"],VCardActions:p["a"],VCardText:p["c"],VCol:g["a"],VContainer:b["a"],VDatePicker:A["a"],VDivider:I["a"],VForm:x["a"],VIcon:D["a"],VMenu:P["a"],VRow:T["a"],VSelect:R["a"],VSpacer:N["a"],VTab:S["a"],VTabItem:$["a"],VTabs:K["a"],VTabsItems:w["a"],VTextField:L["a"],VTextarea:E["a"]})},9388:function(a,t,e){"use strict";var n=function(){var a=this,t=a.$createElement,e=a._self._c||t;return e("div",[e("v-system-bar",{class:this.$store.getters["uifront/getTheme"]("V-SYSTEM-BAR-CSS-CLASS"),attrs:{app:"",dark:""}},[e("v-spacer"),e("strong",[a._t("system-bar")],2)],1),e("v-app-bar",{attrs:{color:"blue",dark:"",app:""}},[e("v-app-bar-nav-icon",{staticClass:"grey--text",class:this.$store.getters["uifront/getTheme"]("V-APP-BAR-NAV-ICON-CSS-CLASS"),on:{click:function(t){t.stopPropagation(),a.drawer=!a.drawer}}}),e("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(t){t.stopPropagation(),a.$router.push("/dashboard/"+a.$store.getters["auth/AccessToken"]).catch((function(a){}))}}},[e("span",{staticClass:"hidden-sm-and-down"},[a._v(" "+a._s(a.NamaAPPAlias)+" ")])]),e("v-spacer"),e("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:a._u([{key:"activator",fn:function(t){var n=t.on;return[e("v-avatar",{attrs:{size:"30"}},[e("v-img",a._g({attrs:{src:a.photoUser}},n))],1)]}}])},[e("v-list",[e("v-list-item",[e("v-list-item-avatar",[e("v-img",{attrs:{src:a.photoUser}})],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[a._v(" "+a._s(a.ATTRIBUTE_USER("username"))+" ")]),e("v-list-item-subtitle",[a._v(" "+a._s(a.ROLE)+" ")])],1)],1),e("v-divider"),e("v-list-item",{attrs:{to:"/system-users/profil"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-account")])],1),e("v-list-item-title",[a._v("Profil")])],1),e("v-divider"),e("v-list-item",{on:{click:function(t){return t.preventDefault(),a.logout(t)}}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-power")])],1),e("v-list-item-title",[a._v("Logout")])],1)],1)],1),e("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),e("v-app-bar-nav-icon",{on:{click:function(t){t.stopPropagation(),a.drawerRight=!a.drawerRight}}},[e("v-icon",[a._v("mdi-menu-open")])],1)],1),e("v-navigation-drawer",{class:this.$store.getters["uifront/getTheme"]("V-NAVIGATION-DRAWER-CSS-CLASS"),attrs:{width:"300",dark:"",temporary:a.temporaryleftsidebar,app:""},model:{value:a.drawer,callback:function(t){a.drawer=t},expression:"drawer"}},[e("v-list-item",[e("v-list-item-avatar",[e("v-img",{attrs:{src:a.photoUser},on:{click:function(t){return t.stopPropagation(),a.toProfile(t)}}})],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[a._v(" "+a._s(a.ATTRIBUTE_USER("username"))+" ")]),e("v-list-item-subtitle",[a._v(" "+a._s(a.ROLE)+" ")])],1)],1),e("v-divider"),e("v-list",{attrs:{expand:""}},[a.CAN_ACCESS("BELANJA-GROUP_BROWSE")?e("v-list-item",{staticClass:"yellow",attrs:{to:{path:"/belanjamurni"},link:"",color:"green"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-home-floor-b")])],1),e("v-list-item-content",[e("v-list-item-title",[a._v("BOARD BELANJA MURNI")])],1)],1):a._e(),e("v-divider"),e("v-subheader",[a._v("TRANSAKSI")]),a.CAN_ACCESS("RKA MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/rka"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-graph")])],1),e("v-list-item-content",[e("v-list-item-title",[a._v(" RKA MURNI ")])],1)],1):a._e(),e("v-subheader",[a._v("LAPORAN")]),a.CAN_ACCESS("FORM A MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/report/forma"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-graph")])],1),e("v-list-item-content",[e("v-list-item-title",[a._v(" FORM A ")])],1)],1):a._e(),a.CAN_ACCESS("FORM B MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/report/formbopd"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-graph")])],1),e("v-list-item-content",[e("v-list-item-title",[a._v(" FORM B OPD ")])],1)],1):a._e(),a.CAN_ACCESS("FORM B MURNI_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/belanjamurni/report/formbunitkerja"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-graph")])],1),e("v-list-item-content",[e("v-list-item-title",[a._v(" FORM B UNIT KERJA ")])],1)],1):a._e(),e("v-subheader",[a._v("STATISTIK")]),e("v-list-item",{attrs:{to:"/belanjamurni/statistik/peringkatopd",link:""}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-chart-timeline-variant")])],1),e("v-list-item-content",[e("v-list-item-title",[a._v("PERINGKAT OPD")])],1)],1)],1)],1),a.showrightsidebar?e("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:a.drawerRight,callback:function(t){a.drawerRight=t},expression:"drawerRight"}},[e("v-list",{attrs:{dense:""}},[e("v-list-item",[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-menu-open")])],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[a._v(" OPTIONS ")])],1)],1),e("v-divider"),e("v-list-item",{staticClass:"teal lighten-5 mb-5"},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[a._v("mdi-filter")])],1),e("v-list-item-content",[e("v-list-item-title",[a._v("FILTER")])],1)],1),a._t("filtersidebar")],2)],1):a._e(),e("v-main",{staticClass:"mx-4 mb-4"},[a._t("default")],2),e("v-footer",{attrs:{app:"",padless:"",fixed:"",dark:""}},[e("v-card",{staticClass:"flex",attrs:{flat:"",tile:""}},[e("v-divider"),e("v-card-text",{staticClass:"py-2 white--text text-center"},[e("strong",[a._v(a._s(a.NamaAPP)+" (2019-2020)")]),a._v(" dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. "),e("v-btn",{attrs:{dark:"",icon:"",href:"https://github.com/mrizkir/simonev"}},[e("v-icon",[a._v("mdi-github")])],1)],1)],1)],1)],1)},r=[],i=(e("ac1f"),e("5319"),e("5530")),s=e("2f62"),o={name:"BelanjaMurniLayout",props:{showrightsidebar:{type:Boolean,default:!0},temporaryleftsidebar:{type:Boolean,default:!1}},data:function(){return{loginTime:0,drawer:null,drawerRight:null}},methods:{logout:function(){var a=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){a.$store.dispatch("auth/logout"),a.$store.dispatch("uifront/reinit"),a.$store.dispatch("uiadmin/reinit"),a.$router.push("/")})).catch((function(){a.$store.dispatch("auth/logout"),a.$store.dispatch("uifront/reinit"),a.$store.dispatch("uiadmin/reinit"),a.$router.push("/")}))}},computed:Object(i["a"])(Object(i["a"])(Object(i["a"])({},Object(s["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"})),Object(s["b"])("uifront",{NamaAPP:"getNamaAPP",NamaAPPAlias:"getNamaAPPAlias"})),{},{photoUser:function(){var a,t=this.ATTRIBUTE_USER("foto");return a=""==t?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+t,a}}),watch:{loginTime:{handler:function(a){var t=this;a>=0?setTimeout((function(){t.loginTime=1==t.AUTHENTICATED?t.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,u=e("2877"),m=e("6544"),d=e.n(m),c=e("40dc"),f=e("5bc1"),v=e("8212"),k=e("8336"),_=e("b0af"),h=e("99d9"),p=e("ce7e"),g=e("553a"),b=e("132d"),A=e("adda"),I=e("8860"),x=e("da13"),D=e("8270"),P=e("5d23"),T=e("34c3"),R=e("f6c4"),N=e("e449"),S=e("f774"),$=e("2fa4"),K=e("e0c7"),w=e("afd9"),L=e("2a7f"),E=Object(u["a"])(l,n,r,!1,null,null,null);t["a"]=E.exports;d()(E,{VAppBar:c["a"],VAppBarNavIcon:f["a"],VAvatar:v["a"],VBtn:k["a"],VCard:_["a"],VCardText:h["c"],VDivider:p["a"],VFooter:g["a"],VIcon:b["a"],VImg:A["a"],VList:I["a"],VListItem:x["a"],VListItemAvatar:D["a"],VListItemContent:P["a"],VListItemIcon:T["a"],VListItemSubtitle:P["b"],VListItemTitle:P["c"],VMain:R["a"],VMenu:N["a"],VNavigationDrawer:S["a"],VSpacer:$["a"],VSubheader:K["a"],VSystemBar:w["a"],VToolbarTitle:L["b"]})}}]);