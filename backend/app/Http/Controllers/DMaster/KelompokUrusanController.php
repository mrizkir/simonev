<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\KelompokUrusanModel;

use Illuminate\Validation\Rule;

class KelompokUrusanController extends Controller {              
    /**
     * get all kelompok urusan
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $this->hasPermissionTo('KELOMPOK URUSAN_BROWSE');

        $this->validate($request, [        
            'TA'=>'required'
        ]);    
        $ta = $request->input('TA');
        $kelompokurusan=KelompokUrusanModel::select(\DB::raw('
                                        "KUrsID",                                        
                                        "RpjmdVisiID",
                                        "Kd_Urusan",
                                        "Nm_Urusan",
                                        CONCAT(\'[\',"Kd_Urusan",\'] \',"Nm_Urusan") AS "kelompok_urusan",
                                        "Descr",
                                        "TA"
                                    '))
                                    ->orderBy('Kd_Urusan','ASC')                                    
                                    ->where('TA',$ta)
                                    ->get();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'kelompokurusan'=>$kelompokurusan,
                                    'message'=>'Fetch data kelompok urusan berhasil.'
                                ],200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $this->hasPermissionTo('KELOMPOK URUSAN_STORE');

        $this->validate($request, [
            'Kd_Urusan'=> [
                        Rule::unique('tmKUrs')->where(function($query) use ($request){
                            return $query->where('TA',$request->input('TA'));
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'Nm_Urusan'=>'required',
            'TA'=>'required'
        ]);     
            
        $ta = $request->input('TA');
        
        $kelompokurusan = KelompokUrusanModel::create([
            'KUrsID' => uniqid('uid'),
            'RpjmdVisiID' => $request->input('RpjmdVisiID'),
            'Kd_Urusan' => $request->input('Kd_Urusan'),
            'Nm_Urusan' => $request->input('Nm_Urusan'),
            'Descr' => $request->input('Descr'),
            'TA'=>$ta,
        ]);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'kelompokurusan'=>$kelompokurusan,                                    
                                    'message'=>'Data Kelompok Urusan berhasil disimpan.'
                                ],200); 
    }               
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {        
        $this->hasPermissionTo('KELOMPOK URUSAN_UPDATE');

        $kelompokurusan = KelompokUrusanModel::find($id);
        
        if (is_null($kelompokurusan))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'update',                
                                    'message'=>["Data Kelompok Urusan ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [    
                                        'Kd_Urusan'=>[
                                                    Rule::unique('tmKUrs')->where(function($query) use ($request,$kelompokurusan) {  
                                                        if ($request->input('Kd_Urusan')==$kelompokurusan->Kd_Urusan) 
                                                        {
                                                            return $query->where('Kd_Urusan','ignore')
                                                                        ->where('TA',$kelompokurusan->TA);
                                                        }                 
                                                        else
                                                        {
                                                            return $query->where('Kd_Urusan',$request->input('Kd_Urusan'))
                                                                    ->where('TA',$kelompokurusan->TA);
                                                        }                                                                                    
                                                    }),
                                                    'required',
                                                    'regex:/^[0-9]+$/'
                                                ],
                                        'Nm_Urusan'=>'required',
                                    ]);
            
            
            $kelompokurusan->Kd_Urusan = $request->input('Kd_Urusan');
            $kelompokurusan->Nm_Urusan = $request->input('Nm_Urusan');
            $kelompokurusan->Descr = $request->input('Descr');
            $kelompokurusan->save();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'kelompokurusan'=>$kelompokurusan,                                    
                                    'message'=>'Data Kelompok Urusan '.$kelompokurusan->Nm_Urusan.' berhasil diubah.'
                                ],200);
        }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {   
        $this->hasPermissionTo('KELOMPOK URUSAN_DESTROY');

        $kelompokurusan = KelompokUrusanModel::find($id);

        if (is_null($kelompokurusan))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'destroy',                
                                    'message'=>["Data Kelompok Urusan ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            
            $result=$kelompokurusan->delete();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>"Data Kelompok Urusan dengan ID ($id) berhasil dihapus"
                                ],200);
        }
    }
}