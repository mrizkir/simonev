<?php

namespace App\Http\Controllers\v2\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\Urusan98Model;

use Illuminate\Validation\Rule;

class KodefikasiUrusanController extends Controller {              
    /**
     * get all urusan
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
        $urusan=Urusan98Model::select(\DB::raw('
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
                                    'urusan'=>$urusan,
                                    'message'=>'Fetch data urusan berhasil.'
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
                        Rule::unique('tmKUrs98')->where(function($query) use ($request){
                            return $query->where('TA',$request->input('TA'));
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'Nm_Urusan'=>'required',
            'TA'=>'required'
        ]);     
            
        $ta = $request->input('TA');
        
        $urusan = Urusan98Model::create([
            'KUrsID' => uniqid('uid'),            
            'Kd_Urusan' => $request->input('Kd_Urusan'),
            'Nm_Urusan' => $request->input('Nm_Urusan'),
            'Descr' => $request->input('Descr'),
            'TA'=>$ta,
        ]);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'urusan'=>$urusan,                                    
                                    'message'=>'Data Urusan berhasil disimpan.'
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

        $urusan = Urusan98Model::find($id);
        
        if (is_null($urusan))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'update',                
                                    'message'=>["Data Urusan ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [    
                                        'Kd_Urusan'=>[
                                                    Rule::unique('tmKUrs98')->where(function($query) use ($request,$urusan) {  
                                                        if ($request->input('Kd_Urusan')==$urusan->Kd_Urusan) 
                                                        {
                                                            return $query->where('Kd_Urusan','ignore')
                                                                        ->where('TA',$urusan->TA);
                                                        }                 
                                                        else
                                                        {
                                                            return $query->where('Kd_Urusan',$request->input('Kd_Urusan'))
                                                                    ->where('TA',$urusan->TA);
                                                        }                                                                                    
                                                    }),
                                                    'required',
                                                    'regex:/^[0-9]+$/'
                                                ],
                                        'Nm_Urusan'=>'required',
                                    ]);
            
            
            $urusan->Kd_Urusan = $request->input('Kd_Urusan');
            $urusan->Nm_Urusan = $request->input('Nm_Urusan');
            $urusan->Descr = $request->input('Descr');
            $urusan->save();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'urusan'=>$urusan,                                    
                                    'message'=>'Data Urusan '.$urusan->Nm_Urusan.' berhasil diubah.'
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

        $urusan = Urusan98Model::find($id);

        if (is_null($urusan))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'destroy',                
                                    'message'=>["Data Urusan ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            
            $result=$urusan->delete();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>"Data Urusan dengan ID ($id) berhasil dihapus"
                                ],200);
        }
    }
}