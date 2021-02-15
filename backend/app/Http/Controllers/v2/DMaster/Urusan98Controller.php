<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\Urusan98Model;

use Illuminate\Validation\Rule;

class Urusan98Controller extends Controller {              
    /**
     * get all kelompok urusan
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $this->hasPermissionTo('URUSAN_BROWSE');

        $this->validate($request, [        
            'TA'=>'required'
        ]);    
        $ta = $request->input('TA');
        $kelompokurusan=Urusan98Model::select(\DB::raw('
                                        "KUrsID",                                                                                
                                        "Kd_Urusan",
                                        "Nm_Urusan",
                                        CONCAT(\'[\',"Kd_Urusan",\'] \',"Nm_Urusan") AS "nama_urusan",
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
        $this->hasPermissionTo('URUSAN_STORE');

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
        
        $kelompokurusan = Urusan98Model::create([
            'KUrsID' => uniqid('uid'),            
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
        $this->hasPermissionTo('URUSAN_UPDATE');

        $kelompokurusan = Urusan98Model::find($id);
        
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
        $this->hasPermissionTo('URUSAN_DESTROY');

        $kelompokurusan = Urusan98Model::find($id);

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