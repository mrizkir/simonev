<?php

namespace App\Controllers\Setting;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class ConfigController extends Controller {
     /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * digunakan untuk mendapatkan seluruh configurasi
     */
    public function all ()
    {
        return [
            'ta'=>\HelperKegiatan::getTahunAnggaran()
        ];
    }    
}