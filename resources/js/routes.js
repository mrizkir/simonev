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

// const PaguAnggaranOPD = () => import ('./pages/dmaster/PaguAnggaranOPD.vue');

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

import PaguAnggaranOPD from './pages/dmaster/PaguAnggaranOPD.vue';

export const routes =  [
    {
        path: '/',
        meta:{
            title: "DASHBOARD"
        },
        component: DashboardFront
    },
    {
        path: '/formvalidation',
        meta:{
            title: "LATIHAN FORM VALIDATION"
        },
        component: FormValidation
    },
    // DATA MASTER
    {
        path: '/dmaster/kelompokurusan',
        meta:{
            title: "KELOMPOK URUSAN"
        },
        component: KelompokUrusan
    },
    {
        path: '/dmaster/urusan',
        meta:{
            title: "URUSAN"
        },
        component: Urusan
    },    
    {
        path: '/dmaster/organisasi',
        meta:{
            title: "OPD / SKPD"
        },
        component: Organisasi
    }, 
    {
        path: '/dmaster/unitkerja',
        meta:{
            title: "UNIT KERJA"
        },
        component: UnitKerja
    }, 
    {
        path: '/dmaster/program',
        meta:{
            title: "PROGRAM"
        },
        component: Program
    }, 
    {
        path: '/dmaster/programkegiatan',
        meta:{
            title: "PROGRAM KEGIATAN"
        },
        component: ProgramKegiatan
    }, 
    {
        path: '/dmaster/transaksi',
        meta:{
            title: "TRANSAKSI"
        },
        component: Transaksi
    },    
    {
        path: '/dmaster/kelompok',
        meta:{
            title: "KELOMPOK"
        },
        component: Kelompok
    }, 
    {
        path: '/dmaster/jenis',
        meta:{
            title: "JENIS"
        },
        component: Jenis
    }, 
    {
        path: '/dmaster/rincian',
        meta:{
            title: "RINCIAN"
        },
        component: Rincian
    }, 
    {
        path: '/dmaster/objek',
        meta:{
            title: "OBJEK"
        },
        component: Objek
    }, 
    {
        path: '/dmaster/asn',
        meta:{
            title: "APARAT SIPILI NEGARA (ASN)"
        },
        component: ASN
    }, 
    {
        path: '/dmaster/paguanggaranopd',
        meta:{
            title: "PAGU ANGGARAN OPD / SKPD"
        },
        component: PaguAnggaranOPD
    },    
];