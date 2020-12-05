import Vue from 'vue'
import store from '../store/index'
import VueRouter from 'vue-router'
import NotFoundComponent from '../components/NotFoundComponent'

Vue.use(VueRouter)

const routes = [
	{
		path: '/',
		name: 'DashboardFront',
		meta:{
            title: "BERANDA"
        },
		component: () => import('../views/pages/front/DashboardFront.vue')
	},
	{
		path: '/login',
		name: 'Login',
		meta:{
            title: "LOGIN"
        },
		component: () => import('../views/pages/front/Login.vue')
	},

	//admin
	//dashboard
	{
		path: '/dashboard/:token',
		name: 'DashboardAdmin',
		meta:{
			title: "DASHBOARD",
        },
		component: () => import('../views/pages/admin/DashboardAdmin.vue'),		
	},
	//dmaster
	{
		path: '/dmaster',
		name: 'DMaster',
		meta:{
			title: "DATA MASTER",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/DMaster.vue'),		
	},
	{
		path: '/dmaster/rekening/transaksi',
		name: 'DMasterTransaksi',
		meta:{
			title: "TRANSAKSI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/Transaksi.vue'),		
	},
	{
		path: '/dmaster/rekening/kelompok',
		name: 'DMasterKelompok',
		meta:{
			title: "KELOMPOK",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/Kelompok.vue'),		
	},
	{
		path: '/dmaster/rekening/jenis',
		name: 'DMasterJenis',
		meta:{
			title: "JENIS",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/Jenis.vue'),		
	},
	{
		path: '/dmaster/rekening/rincian',
		name: 'DMasterRincian',
		meta:{
			title: "RINCIAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/Rincian.vue'),		
	},
	{
		path: '/dmaster/rekening/objek',
		name: 'DMasterObjek',
		meta:{
			title: "OBJEK",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/Objek.vue'),		
	},
	{
		path: '/dmaster/opd',
		name: 'DMasterOPD',
		meta:{
			title: "OPD",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/OPD.vue'),		
	},
	{
		path: '/dmaster/unitkerja',
		name: 'DMasterUnitKjera',
		meta:{
			title: "UNIT KERJA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/UnitKerja.vue'),		
	},
	//data master - kegiatan
	{
		path: '/dmaster/kelompokurusan',
		name: 'DMasterKelompokUrusan',
		meta:{
			title: "KELOMPOK URUSAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/KelompokUrusan.vue'),		
	},
	{
		path: '/dmaster/jenispelaksanaan',
		name: 'DMasterJenisPelaksanaan',
		meta:{
			title: "JENIS PELAKSANAAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/JenisPelaksanaan.vue'),		
	},
	{
		path: '/dmaster/jenispembangunan',
		name: 'DMasterJenisPembangunan',
		meta:{
			title: "JENIS PEMBANGUNAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/JenisPembangunan.vue'),		
	},
	{
		path: '/dmaster/asn',
		name: 'DMasterASN',
		meta:{
			title: "ASN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/ASN.vue'),		
	},
	{
		path: '/dmaster/pejabat',
		name: 'DMasterPejabat',
		meta:{
			title: "PEJABAT",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/Pejabat.vue'),		
	},
	{
		path: '/dmaster/sumberdana',
		name: 'DMasterSumberDana',
		meta:{
			title: "SUMBER DANA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/SumberDana.vue'),		
	},
	{
		path: '/dmaster/ta',
		name: 'DMasterTA',
		meta:{
			title: "TAHUN ANGGARAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/TA.vue'),		
	},
	// rpjmd
	{
		path: '/rpjmd',
		name: 'RPJMD',
		meta:{
			title: "RPJMD",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/rpjmd/RPJMD.vue'),		
	},

	//belanja murni
	{
		path: '/belanjamurni',
		name: 'BelanjaMurni',
		meta:{
			title: "BELANJA MURNI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/belanjamurni/BelanjaMurni.vue'),		
	},
	{
		path: '/belanjamurni/rka',
		name: 'BelanjaMurniRKA',
		meta:{
			title: "RKA MURNI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/belanjamurni/RKAMurni.vue'),		
	},
	{
		path: '/belanjamurni/rka/:rkaid/edit',
		name: 'BelanjaMurniEditRKA',
		meta:{
			title: "RKA MURNI - UBAH",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/belanjamurni/EditRKAMurni.vue'),		
	},
	{
		path: '/belanjamurni/rka/uraian/:rkaid',
		name: 'BelanjaMurniUraianRKA',
		meta:{
			title: "RKA MURNI - URAIAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/belanjamurni/UraianRKAMurni.vue'),		
	},
	{
		path: '/belanjamurni/rka/uraian/:rkarincid/edit',
		name: 'BelanjaEditUraianRKAMurni',
		meta:{
			title: "RKA MURNI - UBAH URAIAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/belanjamurni/EditUraianRKAMurni.vue'),		
	},
	{
		path: '/belanjamurni/rka/realisasi/:rkarincid',
		name: 'BelanjaMurniRealisasiRKAMurni',
		meta:{
			title: "RKA MURNI - REALISASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/belanjamurni/RealisasiRKAMurni.vue'),		
	},
	//report murni
	{
		path: '/belanjamurni/report/forma',
		name: 'ReportFormAMurni',
		meta:{			
			title: "BELANJA MURNI - LAPORAN FORM A",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/report/FormAMurni.vue'),		
	},
	{
		path: '/belanjamurni/report/forma/:rkaid',
		name: 'ReportFormAMurniDetail',
		meta:{			
			title: "BELANJA MURNI - LAPORAN FORM A",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/report/FormAMurni.vue'),		
	},
	{
		path: '/belanjamurni/report/formbopd',
		name: 'ReportFormBOPDMurni',
		meta:{			
			title: "BELANJA MURNI - LAPORAN FORM B OPD",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/report/FormBOPDMurni.vue'),		
	},
	{
		path: '/belanjamurni/report/formbunitkerja',
		name: 'ReportFormBUnitKerjaMurni',
		meta:{
			title: "BELANJA MURNI - LAPORAN FORM B UNIT KERJA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/report/FormBUnitKerjaMurni.vue'),		
	},
	// statistik murni
	{
		path: '/belanjamurni/statistik/peringkatopd',
		name: 'StatistikPeringkatOPDMurni',
		meta:{
			title: "BELANJA MURNI - STATISTIK PERINGKAT OPD",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/statistik/StatistikPeringkatOPDMurni.vue'),		
	},
	//belanja perubahan
	{
		path: '/belanjaperubahan',
		name: 'BelanjaPerubahan',
		meta:{
			title: "BELANJA PERUBAHAN",
			requiresAuth:true,
		},
		component: () => import('../views/pages/admin/belanjaperubahan/BelanjaPerubahan.vue'),		
	},
	{
		path: '/belanjaperubahan/rka',
		name: 'BelanjaPerubahanRKA',
		meta:{
			title: "RKA PERUBAHAN",
			requiresAuth:true,
		},
		component: () => import('../views/pages/admin/belanjaperubahan/RKAPerubahan.vue'),		
	},
	{
		path: '/belanjaperubahan/rka/:rkaid/edit',
		name: 'BelanjaPerubahanEditRKA',
		meta:{
			title: "RKA PERUBAHAN - UBAH",
			requiresAuth:true,
		},
		component: () => import('../views/pages/admin/belanjaperubahan/EditRKAPerubahan.vue'),		
	},
	{
		path: '/belanjaperubahan/rka/uraian/:rkaid',
		name: 'BelanjaPerubahanUraianRKA',
		meta:{
			title: "RKA PERUBAHAN - URAIAN",
			requiresAuth:true,
		},
		component: () => import('../views/pages/admin/belanjaperubahan/UraianRKAPerubahan.vue'),		
	},
	{
		path: '/belanjaperubahan/rka/uraian/:rkarincid/edit',
		name: 'BelanjaEditUraianRKAPerubahan',
		meta:{
			title: "RKA PERUBAHAN - UBAH URAIAN",
			requiresAuth:true,
		},
		component: () => import('../views/pages/admin/belanjaperubahan/EditUraianRKAPerubahan.vue'),		
	},
	{
		path: '/belanjaperubahan/rka/realisasi/:rkarincid',
		name: 'BelanjaPerubahanRealisasiRKAPerubahan',
		meta:{
			title: "RKA PERUBAHAN - REALISASI",
			requiresAuth:true,
		},
		component: () => import('../views/pages/admin/belanjaperubahan/RealisasiRKAPerubahan.vue'),		
	},	
	//report perubahan
	{
		path: '/belanjaperubahan/report/forma',
		name: 'ReportFormAPerubahan',
		meta:{			
			title: "BELANJA PERUBAHAN - LAPORAN FORM A",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/report/FormAPerubahan.vue'),		
	},
	{
		path: '/belanjaperubahan/report/forma/:rkaid',
		name: 'ReportFormAPerubahanDetail',
		meta:{			
			title: "BELANJA PERUBAHAN - LAPORAN FORM A",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/report/FormAPerubahan.vue'),		
	},
	{
		path: '/belanjaperubahan/report/formbopd',
		name: 'ReportFormBOPDPerubahan',
		meta:{			
			title: "BELANJA PERUBAHAN - LAPORAN FORM B OPD",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/report/FormBOPDPerubahan.vue'),		
	},
	{
		path: '/belanjaperubahan/report/formbunitkerja',
		name: 'ReportFormBUnitKerjaPerubahan',
		meta:{
			title: "BELANJA PERUBAHAN - LAPORAN FORM B UNIT KERJA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/report/FormBUnitKerjaPerubahan.vue'),		
	},
	// statistik perubahan
	{
		path: '/belanjaperubahan/statistik/peringkatopd',
		name: 'StatistikPeringkatOPDPerubahan',
		meta:{
			title: "BELANJA PERUBAHAN - STATISTIK PERINGKAT OPD",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/statistik/StatistikPeringkatOPDPerubahan.vue'),		
	},
	//evaluasi rkpd
	{
		path: '/evaluasirkpd',
		name: 'EvaluasiRKPD',
		meta:{
			title: "EVALUASI RKPD",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/evaluasi/EvaluasiRKPD.vue'),		
	},
	{
		path: '/evaluasirkpd/murni',
		name: 'EvaluasiRKPDMurni',
		meta:{
			title: "EVALUASI RKPD MURNI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/evaluasi/EvaluasiRKPDMurni.vue'),		
	},
	{
		path: '/evaluasirkpd/perubahan',
		name: 'EvaluasiRKPDPerubahan',
		meta:{
			title: "EVALUASI RKPD PERUBAHAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/evaluasi/EvaluasiRKPDPerubahan.vue'),		
	},
	//evaluasi renja
	{
		path: '/evaluasirenja',
		name: 'EvaluasiRenja',
		meta:{
			title: "EVALUASI RENJA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/evaluasi/EvaluasiRenja.vue'),		
	},
	{
		path: '/evaluasirenja/murni',
		name: 'EvaluasiRenjaMurni',
		meta:{
			title: "EVALUASI RENJA MURNI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/evaluasi/EvaluasiRenjaMurni.vue'),		
	},
	{
		path: '/evaluasirenja/perubahan',
		name: 'EvaluasiRenjaPerubahan',
		meta:{
			title: "EVALUASI RENJA PERUBAHAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/evaluasi/EvaluasiRenjaPerubahan.vue'),		
	},
	//settings
	{
		path: '/setting/users',
		name: 'SettingUsers',
		meta:{
			title: "SETTING - USERS",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/setting/SettingUsers.vue'),		
	},
	{
		path: '/setting/users/permissions',
		name: 'SettingPermissions',
		meta:{
			title: "SETTING USERS - PERMISSIONS",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/setting/Permissions.vue'),		
	},
	{
		path: '/setting/users/roles',
		name: 'SettingRoles',
		meta:{
			title: "SETTING USERS - ROLES",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/setting/Roles.vue'),		
	},
	{
		path: '/setting/users/superadmin',
		name: 'SettingUsersSuperAdmin',
		meta:{
			title: "SETTING USERS - SUPERADMIN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/setting/UsersSuperadmin.vue'),		
	},
	{
		path: '/setting/users/bapelitbang',
		name: 'SettingUsersBapelitbang',
		meta:{
			title: "USERS BAPELITBANG",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/setting/UsersBapelitbang.vue'),		
	},
	{
		path: '/setting/users/opd',
		name: 'SettingUsersOPD',
		meta:{
			title: "USERS OPD",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/setting/UsersOPD.vue'),		
	},
	//page error
	{
		path: '/404',
		name: 'NotFoundComponent',
		meta:{
            title: "PAGE NOT FOUND"
        },
		component: NotFoundComponent
	},
	{ 
		path: '*', 
		redirect: '/404' 
	}, 
]

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes
})

router.beforeEach((to, from, next) => {
	document.title = to.meta.title;	
	if (to.matched.some(record => record.meta.requiresAuth))	
	{
		if (store.getters['auth/Authenticated'])
		{
			next();
			return;
		}
		next('/login');
	}
	else
	{
		next();
	}
})

export default router
