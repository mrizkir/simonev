<?php

namespace App\Helpers;

class HelperKegiatan {
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
}