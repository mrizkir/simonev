<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\DMaster\TAModel;
use App\Models\Settings\ConfigurationModel;

class UIController extends Controller
{
    /**
     * digunakan untuk mendapatkan setting variabel ui frontend
     */
    public function frontend ()
    {
        $config = ConfigurationModel::getCache();        
        $tahun_anggaran = $config['DEFAULT_TA'];
        $bulan_realisasi = date('m');

        $identitas['nama_app']=$config['NAMA_APP'];
        $identitas['nama_app_alias']=$config['NAMA_APP_ALIAS'];
        $identitas['nama_opd']=$config['NAMA_OPD'];
        $identitas['nama_opd_alias']=$config['NAMA_OPD_ALIAS'];

        $theme=[
            'V-SYSTEM-BAR-CSS-CLASS'=>$config['V-SYSTEM-BAR-CSS-CLASS'],
            'V-APP-BAR-NAV-ICON-CSS-CLASS'=>$config['V-APP-BAR-NAV-ICON-CSS-CLASS'],
            'V-NAVIGATION-DRAWER-CSS-CLASS'=>$config['V-NAVIGATION-DRAWER-CSS-CLASS'],
            'V-LIST-ITEM-BOARD-CSS-CLASS'=>$config['V-LIST-ITEM-BOARD-CSS-CLASS'],
            'V-LIST-ITEM-BOARD-COLOR'=>$config['V-LIST-ITEM-BOARD-COLOR'],
            'V-LIST-ITEM-ACTIVE-CSS-CLASS'=>$config['V-LIST-ITEM-ACTIVE-CSS-CLASS'],            
        ];
        $daftar_ta=TAModel::select(\DB::raw('"TACd" AS value,"TANm" AS text'))
                            ->orderBy('TACd','asc')
                            ->get();
                            
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata', 
                                    'daftar_ta'=>$daftar_ta,                                   
                                    'tahun_anggaran'=>$tahun_anggaran,
                                    'bulan_realisasi'=>$bulan_realisasi,                                    
                                    'identitas'=>$identitas,
                                    'theme'=>$theme,                                    
                                    'message'=>'Fetch data ui untuk front berhasil diperoleh'
                                ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
    }
    /**
     * digunakan untuk mendapatkan setting variabel ui admin
     */
    public function admin ()
    {
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',                                                                           
                                    'message'=>'Fetch data ui untuk admin berhasil diperoleh'
                                ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);
    
       
    }
}
