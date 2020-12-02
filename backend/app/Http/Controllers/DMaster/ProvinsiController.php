<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\KotaModel;
use App\Models\DMaster\ProvinsiModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;

class ProvinsiController extends Controller {        
    /**
     * digunakan untuk mendapatkan daftar kecamatan
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ProvinsiModel::orderBy('Nm_Prov','ASC')
                                ->get();
                                
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'provinsi'=>$data,
                                'message'=>'Fetch data provinsi berhasil diperoleh'
                            ],200);  
    }
    public function kotaprovinsi (Request $request,$id)
    {
        
        $kota = KotaModel::where('PMProvID',$id)
                            ->get();

        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',                                
                                'kota'=>$kota,
                                'message'=>'Fetch data kota dari provinsi berhasil diperoleh'
                            ],200);  

    }
   
}