<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\KotaModel;
use App\Models\DMaster\KecamatanModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;

class KotaController extends Controller {        
    /**
     * digunakan untuk mendapatkan daftar kecamatan
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KotaModel::orderBy('Nm_Kota','ASC')
                                ->get();
                                
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'kota'=>$data,
                                'message'=>'Fetch data provinsi berhasil diperoleh'
                            ],200);  
    }
    public function kecamatankota (Request $request,$id)
    {
        
        $kecamatan = KecamatanModel::where('PmKotaID',$id)
                            ->get();

        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',                                
                                'kecamatan'=>$kecamatan,
                                'message'=>'Fetch data kecamatan dari kota berhasil diperoleh'
                            ],200);  

    }
   
}