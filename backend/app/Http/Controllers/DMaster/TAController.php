<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\TAModel;

use Illuminate\Validation\Rule;

class TAController extends Controller {              
    /**
     * get all Tahun Anggaran
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $ta=TAModel::all();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'ta'=>$ta,
                                    'message'=>'Fetch data tahun anggaran berhasil.'
                                ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $this->hasPermissionTo('TA_STORE');
        
        $this->validate($request, [
            'TACd'=> [
                        Rule::unique('tmTA')->where(function($query){
                            return $query;
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'TANm'=>'required',
        ]);

              
        $ta = TAModel::create ([
                                    'TAID'=> uniqid ('uid'),
                                    'TACd' => $request->input('TACd'),
                                    'TANm' => $request->input('TANm'),
                                    'Descr' => $request->input('Descr')                                    
                                ]);  
        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'ta'=>$ta,                                    
                                'message'=>'Data TA berhasil disimpan.'
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
        $this->hasPermissionTo('TA_UPDATE');
        $ta = TAModel::find($id);
        
        $this->validate($request, [    
                                    'TACd'=>[
                                                Rule::unique('tmTA')->where(function($query) use ($request,$ta) {  
                                                    if ($request->input('TACd')==$ta->TACd) 
                                                    {
                                                        return $query->where('TACd',0);
                                                    }                 
                                                    else
                                                    {
                                                        return $query->where('TACd',$request->input('TACd'))
                                                                ->where('TA',$ta->TA);
                                                    }                                                                                    
                                                }),
                                                'required',
                                                'regex:/^[0-9]+$/'
                                            ],
                                    'TANm'=>'required',
                                ]);
        
        
        $ta->TACd = $request->input('TACd');
        $ta->TANm = $request->input('TANm');
        $ta->Descr = $request->input('Descr');
        $ta->save();

        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'ta'=>$ta,                                    
                                'message'=>'Data TA '.$ta->TANm.' berhasil diubah.'
                            ],200);
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {   
        $this->hasPermissionTo('TA_DESTROY');
        $ta = TAModel::find($id);
        $result=$ta->delete();
        return Response()->json([
                                'status'=>1,
                                'pid'=>'destroy',                
                                'message'=>"Data TA dengan ID ($id) berhasil dihapus"
                            ],200);
    }
}