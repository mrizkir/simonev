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
// const JenisPembangunan = () => import ('./pages/dmaster/JenisPembangunan.vue');
// const PaguAnggaranOPD = () => import ('./pages/dmaster/PaguAnggaranOPD.vue');

// const APBDMurni = () => import ('./pages/APBDMurni.vue');
// const APBDMurniUraian = () => import ('./pages/apbdmurni/APBDMurniUraian.vue');
// const APBDMurniCreate = () => import ('./pages/apbdmurni/APBDMurniCreate.vue');
// const APBDMurniUraianPilihRekening = () => import ('./pages/apbdmurni/APBDMurniUraianPilihRekening.vue');
// const APBDMurniUraianCreate = () => import ('./pages/apbdmurni/APBDMurniUraianCreate.vue');
// const APBDMurniUraianRencanaTarget = () => import ('./pages/apbdmurni/APBDMurniUraianRencanaTarget.vue');
// const APBDMurniUraianRealisasi = () => import ('./pages/apbdmurni/APBDMurniUraianRealisasi.vue');

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
import JenisPembangunan from './pages/dmaster/JenisPembangunan.vue';
import PaguAnggaranOPD from './pages/dmaster/PaguAnggaranOPD.vue';

//APBD MURNI
import APBDMurni from './pages/APBDMurni.vue';
import APBDMurniUraian from './pages/apbdmurni/APBDMurniUraian.vue';
import APBDMurniCreate from './pages/apbdmurni/APBDMurniCreate.vue';
import APBDMurniUraianPilihRekening from './pages/apbdmurni/APBDMurniUraianPilihRekening.vue';
import APBDMurniUraianCreate from './pages/apbdmurni/APBDMurniUraianCreate.vue';
import APBDMurniUraianRencanaTarget from './pages/apbdmurni/APBDMurniUraianRencanaTarget.vue';
import APBDMurniUraianRealisasi from './pages/apbdmurni/APBDMurniUraianRealisasi.vue';

//APBD PERUBAHAN
import APBDPerubahan from './pages/APBDPerubahan.vue';
import APBDPerubahanUraian from './pages/apbdperubahan/APBDPerubahanUraian.vue';
import APBDPerubahanCreate from './pages/apbdperubahan/APBDPerubahanCreate.vue';
import APBDPerubahanUraianPilihRekening from './pages/apbdperubahan/APBDPerubahanUraianPilihRekening.vue';
import APBDPerubahanUraianCreate from './pages/apbdperubahan/APBDPerubahanUraianCreate.vue';
import APBDPerubahanUraianRencanaTarget from './pages/apbdperubahan/APBDPerubahanUraianRencanaTarget.vue';
import APBDPerubahanUraianRealisasi from './pages/apbdperubahan/APBDPerubahanUraianRealisasi.vue';

//REPORT
import FormAMurni from './pages/report/FormAMurni.vue';
import FormBMurni from './pages/report/FormBMurni.vue';
import EvaluasiRKPDMurni from './pages/report/EvaluasiRKPDMurni.vue';

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
        name:'dmaster_jenispembangunan',
        path: '/dmaster/jenispembangunan',
        meta:{
            title: "JENIS PEMBANGUNAN"
        },
        component: JenisPembangunan
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
        name:'apbdmurniuraian',
        path: '/apbdmurni/uraian',
        meta:{
            title: "APBD MURNI | DETAIL"
        },
        component: APBDMurniUraian
    },    
    {
        name:'apbdmurnicreate',
        path: '/apbdmurni/create',
        meta:{
            title: "APBD MURNI | KEGIATAN BARU"
        },
        component: APBDMurniCreate
    },    
    {
        name:'apbdmurniuraianpilihrekening',
        path: '/apbdmurni/uraian/pilihrekening',
        meta:{
            title: "APBD MURNI | PILIH REKENING"
        },
        component: APBDMurniUraianPilihRekening
    },    
    {
        name:'apbdmurniuraiancreate',
        path: '/apbdmurni/uraian/create',
        meta:{
            title: "APBD MURNI | URAIAN BARU"
        },
        component: APBDMurniUraianCreate
    },    
    {
        name:'apbdmurniuraianrencanatarget',
        path: '/apbdmurni/uraian/rencanatarget',
        meta:{
            title: "APBD MURNI | RENCANA TARGET FISIK"
        },
        component: APBDMurniUraianRencanaTarget
    },    
    {
        name:'apbdmurniuraianrealisasi',
        path: '/apbdmurni/uraian/realisasi',
        meta:{
            title: "APBD MURNI | REALISASI URAIAN"
        },
        component: APBDMurniUraianRealisasi
    },
    {
        name:'apbdperubahan',
        path: '/apbdperubahan',
        meta:{
            title: "APBD PERUBAHAN"
        },
        component: APBDPerubahan
    },    
    {
        name:'apbdperubahanuraian',
        path: '/apbdperubahan/uraian',
        meta:{
            title: "APBD PERUBAHAN | DETAIL"
        },
        component: APBDPerubahanUraian
    },    
    {
        name:'apbdperubahancreate',
        path: '/apbdperubahan/create',
        meta:{
            title: "APBD PERUBAHAN | KEGIATAN BARU"
        },
        component: APBDPerubahanCreate
    },    
    {
        name:'apbdperubahanuraianpilihrekening',
        path: '/apbdperubahan/uraian/pilihrekening',
        meta:{
            title: "APBD PERUBAHAN | PILIH REKENING"
        },
        component: APBDPerubahanUraianPilihRekening
    },    
    {
        name:'apbdperubahanuraiancreate',
        path: '/apbdperubahan/uraian/create',
        meta:{
            title: "APBD PERUBAHAN | URAIAN BARU"
        },
        component: APBDPerubahanUraianCreate
    },    
    {
        name:'apbdperubahanuraianrencanatarget',
        path: '/apbdperubahan/uraian/rencanatarget',
        meta:{
            title: "APBD PERUBAHAN | RENCANA TARGET FISIK"
        },
        component: APBDPerubahanUraianRencanaTarget
    },    
    {
        name:'apbdperubahanuraianrealisasi',
        path: '/apbdperubahan/uraian/realisasi',
        meta:{
            title: "APBD PERUBAHAN | REALISASI URAIAN"
        },
        component: APBDPerubahanUraianRealisasi
    },        
    {
        name:'reportformamurni',
        path: '/report/reportformamurni',
        meta:{
            title: "LAPORAN FORM A MURNI"
        },
        component: FormAMurni
    },        
    {
        name:'reportformbmurni',
        path: '/report/reportformbmurni',
        meta:{
            title: "LAPORAN FORM B MURNI"
        },
        component: FormBMurni
    },        
    {
        name:'reportevaluasirkpdmurni',
        path: '/report/evaluasirkpdmurni',
        meta:{
            title: "LAPORAN EVALUASI RKPD MURNI"
        },
        component: EvaluasiRKPDMurni
    },        
];