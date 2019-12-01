// const DashboardFront = () => import ('./pages/DashboardFront.vue');
// const FormValidation = () => import ('./pages/FormValidation.vue');

// DATA MASTER
// const KelompokUrusan = () => import ('./pages/dmaster/KelompokUrusan.vue');
// const Urusan = () => import ('./pages/dmaster/Urusan.vue');
// const Organisasi = () => import ('./pages/dmaster/Organisasi.vue');
// const UnitKerja = () => import ('./pages/dmaster/UnitKerja.vue');
// const Program = () => import ('./pages/dmaster/Program.vue');
// const ProgramKegiatan = () => import ('./pages/dmaster/ProgramKegiatan.vue');

// const Transaksi = () => import ('./pages/dmaster/Transaksi.vue');
// const Kelompok = () => import ('./pages/dmaster/Kelompok.vue');
// const Jenis = () => import ('./pages/dmaster/Jenis.vue');
// const Rincian = () => import ('./pages/dmaster/Rincian.vue');
// const Objek = () => import ('./pages/dmaster/Objek.vue');

// const ASN = () => import ('./pages/dmaster/ASN.vue');
// const ASNOPD = () => import ('./pages/dmaster/ASNOPD.vue');

// const JenisPelaksanaan = () => import ('./pages/dmaster/JenisPelaksanaan.vue');
// const PaguAnggaranOPD = () => import ('./pages/dmaster/PaguAnggaranOPD.vue');

// const APBDMurni = () => import ('./pages/APBDMurni.vue');
// const APBDMurniDetail = () => import ('./pages/apbdmurni/APBDMurniDetail.vue');
// const APBDMurniCreate = () => import ('./pages/apbdmurni/APBDMurniCreate.vue');

import DashboardFront from './pages/DashboardFront.vue';
import FormValidation from './pages/FormValidation.vue';

// DATA MASTER
import KelompokUrusan from './pages/dmaster/KelompokUrusan.vue';
import Urusan from './pages/dmaster/Urusan.vue';
import Organisasi from './pages/dmaster/Organisasi.vue';
import UnitKerja from './pages/dmaster/UnitKerja.vue';
import Program from './pages/dmaster/Program.vue';
import ProgramKegiatan from './pages/dmaster/ProgramKegiatan.vue';

import Transaksi from './pages/dmaster/Transaksi.vue';
import Kelompok from './pages/dmaster/Kelompok.vue';
import Jenis from './pages/dmaster/Jenis.vue';
import Rincian from './pages/dmaster/Rincian.vue';
import Objek from './pages/dmaster/Objek.vue';

import ASN from './pages/dmaster/ASN.vue';
import ASNOPD from './pages/dmaster/ASNOPD.vue';

import JenisPelaksanaan from './pages/dmaster/JenisPelaksanaan.vue';
import PaguAnggaranOPD from './pages/dmaster/PaguAnggaranOPD.vue';

import APBDMurni from './pages/APBDMurni.vue';
import APBDMurniDetail from './pages/apbdmurni/APBDMurniDetail.vue';
import APBDMurniCreate from './pages/apbdmurni/APBDMurniCreate.vue';

export const routes =  [
    {
        name:'dashboard',
        path: '/',
        meta:{
            title: "DASHBOARD"
        },
        component: DashboardFront
    },
    {
        name:'formvalidation',
        path: '/formvalidation',
        meta:{
            title: "LATIHAN FORM VALIDATION"
        },
        component: FormValidation
    },
    // DATA MASTER
    {
        name:'dmaster_kelompokurusan',
        path: '/dmaster/kelompokurusan',
        meta:{
            title: "KELOMPOK URUSAN"
        },
        component: KelompokUrusan
    },
    {
        name:'dmaster_urusan',
        path: '/dmaster/urusan',
        meta:{
            title: "URUSAN"
        },
        component: Urusan
    },    
    {
        name:'dmaster_organisasi',
        path: '/dmaster/organisasi',
        meta:{
            title: "OPD / SKPD"
        },
        component: Organisasi
    }, 
    {
        name:'dmaster_unitkerja',
        path: '/dmaster/unitkerja',
        meta:{
            title: "UNIT KERJA"
        },
        component: UnitKerja
    }, 
    {
        name:'dmaster_program',
        path: '/dmaster/program',
        meta:{
            title: "PROGRAM"
        },
        component: Program
    }, 
    {
        name:'dmaster_programkegiatan',
        path: '/dmaster/programkegiatan',
        meta:{
            title: "PROGRAM KEGIATAN"
        },
        component: ProgramKegiatan
    }, 
    {
        name:'dmaster_transaksi',
        path: '/dmaster/transaksi',
        meta:{
            title: "TRANSAKSI"
        },
        component: Transaksi
    },    
    {
        name:'dmaster_kelompok',
        path: '/dmaster/kelompok',
        meta:{
            title: "KELOMPOK"
        },
        component: Kelompok
    }, 
    {
        name:'dmaster_jenis',
        path: '/dmaster/jenis',
        meta:{
            title: "JENIS"
        },
        component: Jenis
    }, 
    {
        name:'dmaster_rincian',
        path: '/dmaster/rincian',
        meta:{
            title: "RINCIAN"
        },
        component: Rincian
    }, 
    {
        name:'dmaster_objek',
        path: '/dmaster/objek',
        meta:{
            title: "OBJEK"
        },
        component: Objek
    }, 
    {
        name:'dmaster_asn',
        path: '/dmaster/asn',
        meta:{
            title: "APARAT SIPIL NEGARA (ASN)"
        },
        component: ASN
    }, 
    {
        name:'dmaster_asnopd',
        path: '/dmaster/asnopd',
        meta:{
            title: "APARAT SIPIL NEGARA (ASN) OPD"
        },
        component: ASNOPD
    }, 
    {
        name:'dmaster_paguanggaranopd',
        path: '/dmaster/paguanggaranopd',
        meta:{
            title: "PAGU ANGGARAN OPD / SKPD"
        },
        component: PaguAnggaranOPD
    },    
    {
        name:'dmaster_jenispelaksanaan',
        path: '/dmaster/jenispelaksanaan',
        meta:{
            title: "JENIS PELAKSANAAN"
        },
        component: JenisPelaksanaan
    },    
    {
        name:'apbdmurni',
        path: '/apbdmurni',
        meta:{
            title: "APBD MURNI"
        },
        component: APBDMurni
    },    
    {
        name:'apbdmurnidetail',
        path: '/apbdmurni/detail',
        meta:{
            title: "APBD MURNI | DETAIL"
        },
        component: APBDMurniDetail
    },    
    {
        name:'apbdmurnicreate',
        path: '/apbdmurni/create',
        meta:{
            title: "APBD MURNI | KEGIATAN BARU"
        },
        component: APBDMurniCreate
    },    
];