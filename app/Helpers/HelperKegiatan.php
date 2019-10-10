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
    public static function getPageTitle()
    {
        switch (\Helper::getNameOfPage()) 
        {            
            case 'rkakegiatanmurni' :
                $pagetitle = 'RENCANA KERJA DAN ANGGARAN (RKA) MURNI';
            break;            
            case 'formamurni' :
                $pagetitle = 'FORM A MURNI';
            break;            
            default :
                $pagetitle = 'WORKFLOW';
        }
        return $pagetitle;
    }
    /**
     * digunakan untuk mendapatkan nama view db
     */
    public static function getViewName ($nameofpage)
    {
        switch ($nameofpage) 
        {         
            case 'rkakegiatanmurni' :
            case 'formamurni' :
                $dbViewName = 'v_rka';
            break;                      
            default :
                $dbViewName = null;
        }
        return $dbViewName;
    }   
    /**
    * digunakan untuk mendapatkan entri level
    */
    public static function getLevelEntriByName ($level_name) {        
        switch ($level_name) 
        {            
            case 'rkakegiatanmurni' :
            case 'formamurni' :
                $level = 1;
            break;            
            default :
                $level = null;
        }
        return $level;
    }
}