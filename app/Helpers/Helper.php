<?php

namespace App\Helpers;
use Carbon\Carbon;
use URL;
class Helper {
    /*
     * nama bulan dalam bahasa indonesia
     */
    private static $Bulan = array(1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei',6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember');
    
    /*
     * nama bulan dalam bahasa indonesia
     */
    private static $BulanM = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei',6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September'];
    
    /*
     * nama bulan dalam bahasa indonesia
     */
    private static $BulanP = array(10=>'Oktober', 11=>'November', 12=>'Desember');
    /**
     * digunakan untuk mendapatkan bulan
     */
    public static function getBulan($idx=null) {
        if ($idx === null) {
            return Helper::$Bulan;
        }else{
            return Helper::$Bulan[$idx];
        }
    }
    
    /**
     * digunakan untuk mendapatkan bulan
     */
    public static function getBulanM($idx=null) {
        if ($idx === null) {
            return Helper::$BulanM;
        }else{
            return Helper::$BulanM[$idx];
        }
    }
    
    /**
     * digunakan untuk mendapatkan bulan
     */
    public static function getBulanP($idx=null) {
        if ($idx === null) {
            return Helper::$BulanP;
        }else{
            return Helper::$BulanP[$idx];
        }
    }
    /**
     * digunakan untuk mendapatkan nama halaman yang sedang diakses
     */
    public static function getNameOfPage (string $action = null)
    {
        $name = explode('.',\Route::currentRouteName());
        if ($action === null)
        {
            return $name[0];
        }
        else
        {
            return $name[0].'.'.$action;
        }
        
    }
    /**
     * digunakan controller yang sedang diakses
     */
    public static function getCurrentController() 
    {
        $controller_name=strtolower(class_basename(\Route::current()->controller));
        $controller=str_replace('controller','',$controller_name); 
        return $controller;    
    } 
    /**
     * digunakan untuk mendapatkan url halaman yang sedang diakses
     */
    public static function getCurrentPageURL() 
    {   
        return route(Helper::getNameOfPage('index'));    
    }
    /**
     * digunakan untuk mendapatkan status aktif menu
     */
    public static function isMenuActive ($current_page_active,$page_name,$callback='active') 
    {
        if ($current_page_active == $page_name) {
            return $callback;
        }else{
            return '';
        }
    }
    /**
     * digunakan untuk memformat tanggal
     * @param type $format
     * @param type $date
     * @return type date
     */
    public static function tanggal($format, $date=null) {
        if ($date == null){
            $tanggal=Carbon::parse(Carbon::now())->format($format);
        }else{
            $tanggal = Carbon::parse($date)->format($format);
        }        
        return $tanggal;
    }   
    /**
	* digunakan untuk mem-format uang
	*/
	public static function formatUang ($uang=0,$decimal=2) {
		$formatted = number_format((float)$uang,$decimal,',','.');
        return $formatted;
    }
    /**
	* digunakan untuk mem-format angka
	*/
	public static function formatAngka ($angka=0) {
        $bil = intval($angka);
        $formatted = ($bil < $angka) ? $angka : $bil;
        return $formatted;
    }
    /**
	* digunakan untuk mem-format persentase
	*/
	public static function formatPersen ($pembilang,$penyebut=0,$dec_sep=2) {
        $result=0.00;
		if ((float)$pembilang > 0 && (float)$penyebut > 0) {
            $temp=number_format(((float)$pembilang/(float)$penyebut)*100,$dec_sep);
            $result = $temp > 100 ? 100.00 : $temp;
        }
        return $result;
	}
    /**
	* digunakan untuk mem-format pecahan
	*/
	public static function formatPecahan ($pembilang,$penyebut=0,$dec_sep=2) {
        $result=0.00;
		if ((float)$pembilang > 0 && (float)$penyebut > 0) {
            $result=number_format(((float)$pembilang/(float)$penyebut),$dec_sep);
        }
        return $result;
	}    
}