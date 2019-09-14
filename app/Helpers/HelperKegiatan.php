<?php

namespace App\Helpers;

class HelperKegiatan {
    /**
     * digunakan untuk mendapatkan tahun awal rpjmd saat user login
     */ 
    public static function getRPJMDTahunAwal ()
    {
        return request()->session()->get("global_controller.rpjmd_tahun_awal");
    }
    /**
     * digunakan untuk mendapatkan tahun mulai rpjmd saat user login
     */ 
    public static function getRPJMDTahunMulai ()
    {
        return request()->session()->get("global_controller.rpjmd_tahun_mulai");
    }
    /**
     * digunakan untuk mendapatkan tahun akhir rpjmd saat user login
     */ 
    public static function getRPJMDTahunAkhir ()
    {
        return request()->session()->get("global_controller.rpjmd_tahun_akhir");
    }
    /**
     * digunakan untuk mendapatkan tahun mulai renstra saat user login
     */ 
    public static function getRENSTRATahunMulai ()
    {
        return request()->session()->get("global_controller.renstra_tahun_mulai");
    }
    /**
     * digunakan untuk mendapatkan tahun akhir renstra saat user login
     */ 
    public static function getRENSTRATahunAkhir ()
    {
        return request()->session()->get("global_controller.renstra_tahun_akhir");
    }
    /**
     * digunakan untuk mendapatkan tahun perencanaan saat user login
     */ 
    public static function getTahunPerencanaan ()
    {
        return request()->session()->get("global_controller.tahun_perencanaan");
    }
    /**
     * digunakan untuk mendapatkan tahun penyerapan saat user login
     */ 
    public static function getTahunPenyerapan ()
    {
        return request()->session()->get("global_controller.tahun_penyerapan");
    }   
    public static function getPageTitle($nameofpage)
    {
        switch ($nameofpage) 
        {            
            case 'rkakegiatanmurni' :
                $pagetitle = 'RENCANA KERJA DAN ANGGARAN (RKA) MURNI';
            break;            
            default :
                $pagetitle = 'WORKFLOW';
        }
        return $pagetitle;
    }
}