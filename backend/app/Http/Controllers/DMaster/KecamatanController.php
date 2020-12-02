<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\KotaModel;
use App\Models\DMaster\KecamatanModel;
use App\Models\DMaster\DesaModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;

class KecamatanController extends Controller {        
    /**
     * digunakan untuk mendapatkan daftar kecamatan
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KecamatanModel::orderBy('Nm_Kecamatan','ASC')
                                ->get();
                                
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'kecamatan'=>$data,
                                'message'=>'Fetch data kecamatan berhasil diperoleh'
                            ],200);  
    }
    public function desakecamatan (Request $request,$id)
    {
        
        $desa = DesaModel::where('PmKecamatanID',$id)
                            ->get();

        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',                                
                                'desa'=>$desa,
                                'message'=>'Fetch data desa dari kecamatan berhasil diperoleh'
                            ],200);  

    }
   
}