<?php

namespace App\Helpers;
use Carbon\Carbon;
use URL;
class Helper {
    /**
     * bulan murni
     */
    private static $daftar_bulan=[
        1=>'Januari',
        2=>'Februari',
        3=>'Maret',
        4=>'April',
        5=>'Mei',
        6=>'Juni',
        7=>'Juli',
        8=>'Agustus',
        9=>'September',
        10=>'Oktober',
        11=>'November',
        12=>'Desember'
    ];    
    /*
     * nama hari dalam bahasa indonesia
     */
    private static $namaHari = [
        1=>'Senin',
        2=>'Selasa',
        3=>'Rabu',
        4=>'Kamis',
        5=>'Jumat',
        6=>'Sabtu',
        7=>'Minggu',
    ];
    public static function getNamaBulan($no_bulan=null)
    {
        if ($no_bulan===null)
        {
            return Helper::$daftar_bulan;
        }
        else if ($no_bulan >=1 && $no_bulan <=12)
        {
            return Helper::$daftar_bulan[$no_bulan];
        }
        else
        {
            return null;
        }

    }
    /**
	* digunakan untuk mendapatkan nama hari
	*/
	public static function getNamaHari ($no_hari=null) {
		if ($no_hari===null)
        {
			return Helper::$namaHari;
        }
        else if ($no_hari >=1 && $no_hari <=7)
        {
			return Helper::$namaHari[$no_hari];
        }
        else
        {
            return null;
        }
	}    
    /**
     * digunakan untuk memformat tanggal
     * @param type $format
     * @param type $date
     * @return type date
     */
    public static function tanggal($format, $date=null) {
        Carbon::setLocale(app()->getLocale());
        if ($date == null){
            $tanggal=Carbon::parse(Carbon::now())->format($format);
        }else{
            $tanggal = Carbon::parse($date)->format($format);
        }
        $result = str_replace([
                                'Sunday',
                                'Monday',
                                'Tuesday',
                                'Wednesday',
                                'Thursday',
                                'Friday',
                                'Saturday'
                            ],
                            [
                                'Minggu',
                                'Senin',
                                'Selasa',
                                'Rabu',
                                'Kamis',
                                'Jumat',
                                'Sabtu'
                            ],
                            $tanggal);

        return str_replace([
                            'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'July',
                            'August',
                            'September',
                            'October',
                            'November' ,
                            'December'
                        ],
                        [
                            'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember'
                        ], $result);
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
		if ($pembilang > 0 && $penyebut > 0) {
            $temp=round(number_format((float)($pembilang/$penyebut)*100,2),$dec_sep);
            $result = $temp;
        }       
        return $result;
	}
    /**
	* digunakan untuk mem-format pecahan
	*/
	public static function formatPecahan ($pembilang,$penyebut=0,$dec_sep=2) {
        $result=0;
		if ($pembilang > 0 && $penyebut > 0) {
            $result=round(number_format((float)($pembilang/$penyebut),2),$dec_sep);
        }
        return $result;
    }

    public static function public_path($path = null)
    {
        return rtrim(app()->basePath('storage/app/public/' . $path), '/');
    }
    public static function exported_path()
    {
        return app()->basePath('storage/app/exported/');
    }
    /**
     * Format NIP
     * @param type $nip integer
     */
    public static function formatNIP ($nip) {        
        $formatnip=$nip;        
        if (isset($nip[17])) {             
            $tgllahir=  substr($nip, 0, 8);
            $tmtcpns=  substr($nip, 8, 6);
            $jk=  substr($nip, 14, 1);
            $nourut=substr($nip, 15, 3);
            $formatnip = "$tgllahir $tmtcpns $jk $nourut";
        }       
        return $formatnip;
    }
    /**
     * dapatkan kode warna sesuai permenagri 55/2010
     * @param type $triwulan
     * @param type $value
     * @return string
     */
    public static function getKodeWarna($triwulan,$value) {
        switch ($triwulan) {
            case 1 :
                if ($value >= 23) {
                    $color='#29af28';
                }elseif ($value >= 20 && $value < 23 ){
                    $color='#8ec189';
                }elseif ($value >= 17 && $value < 20 ){
                    $color='#e1c027';
                }elseif ($value >= 13 && $value < 17 ){
                    $color='#d49dc5';
                }else{
                    $color='#b71b1c';
                }
            break;
            case 2 :
                if ($value >= 45) {
                    $color='#29af28';
                }elseif ($value >= 39 && $value < 45 ){
                    $color='#8ec189';
                }elseif ($value >= 33 && $value < 39 ){
                    $color='#e1c027';
                }elseif ($value >= 26 && $value < 33 ){
                    $color='#d49dc5';
                }else{
                    $color='#b71b1c';
                }
            break;
            case 3 :
                if ($value >= 79) {
                    $color='#29af28';
                }elseif ($value >= 70 && $value < 79 ){
                    $color='#8ec189';
                }elseif ($value >= 61 && $value < 70 ){
                    $color='#e1c027';
                }elseif ($value >= 51 && $value < 60 ){
                    $color='#d49dc5';
                }else{
                    $color='#b71b1c';
                }
            break;
            case 4 :
                if ($value >= 98) {
                    $color='#29af28';
                }elseif ($value >= 95 && $value < 98 ){
                    $color='#8ec189';
                }elseif ($value >= 92 && $value < 95 ){
                    $color='#e1c027';
                }elseif ($value >= 88 && $value < 92 ){
                    $color='#d49dc5';
                }else{
                    $color='#b71b1c';
                }
            break;
            default :
                if ($value >= 91 ) {
                    $color='#29af28';
                }elseif ($value >= 76 && $value < 91 ){
                    $color='#8ec189';
                }elseif ($value >= 66 && $value < 76 ){
                    $color='#e1c027';
                }elseif ($value >= 51 && $value < 66 ){
                    $color='#d49dc5';
                }else{
                    $color='#b71b1c';
                }
        }
        return $color;
    }
    /**
     * dapatkan kode keterangan warna sesuai permenagri 55/2010
     * @param type $triwulan
     * @param type $value
     * @return string
     */
    public static function getKeteranganWarna($triwulan,$value) {
        switch ($triwulan) {
            case 1 :
                if ($value >= 23) {
                    $keterangan='SANGAT TINGGI';                    
                }elseif ($value >= 20 && $value < 23 ){
                    $keterangan='TINGGI';                    
                }elseif ($value >= 17 && $value < 20 ){
                    $keterangan='SEDANG';
                }elseif ($value >= 13 && $value < 17 ){
                    $keterangan='RENDAH';
                }else{
                    $keterangan='SANGAT RENDAH';
                }
            break;
            case 2 :
                if ($value >= 45) {
                    $keterangan='SANGAT TINGGI';
                }elseif ($value >= 39 && $value < 45 ){
                    $keterangan='TINGGI';
                }elseif ($value >= 33 && $value < 39 ){
                    $keterangan='SEDANG';
                }elseif ($value >= 26 && $value < 33 ){
                    $keterangan='RENDAH';
                }else{
                    $keterangan='SANGAT RENDAH';
                }
            break;
            case 3 :
                if ($value >= 79) {
                    $keterangan='SANGAT TINGGI';
                }elseif ($value >= 70 && $value < 79 ){
                    $keterangan='TINGGI';
                }elseif ($value >= 61 && $value < 70 ){
                    $keterangan='SEDANG';
                }elseif ($value >= 51 && $value < 60 ){
                    $keterangan='RENDAH';
                }else{
                    $keterangan='SANGAT RENDAH';
                }
            break;
            case 4 :
                if ($value >= 98) {
                    $keterangan='SANGAT TINGGI';
                }elseif ($value >= 95 && $value < 98 ){
                    $keterangan='TINGGI';
                }elseif ($value >= 92 && $value < 95 ){
                    $keterangan='SEDANG';
                }elseif ($value >= 88 && $value < 92 ){
                    $keterangan='RENDAH';
                }else{
                    $keterangan='SANGAT RENDAH';
                }
            break;
            default :
                if ($value >= 91 ) {
                    $keterangan='SANGAT TINGGI';
                }elseif ($value >= 76 && $value < 91 ){
                    $keterangan='TINGGI';
                }elseif ($value >= 66 && $value < 76 ){
                    $keterangan='SEDANG';
                }elseif ($value >= 51 && $value < 66 ){
                    $keterangan='RENDAH';
                }else{
                    $keterangan='SANGAT RENDAH';
                }
        }
        return $keterangan;
    }
}
