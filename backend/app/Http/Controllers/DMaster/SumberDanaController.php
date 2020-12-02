<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\SumberDanaModel;
use Illuminate\Validation\Rule;

class SumberDanaController extends Controller {      
    /**
     * mendapatkan daftar seluruh ASN
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->hasPermissionTo('SUMBER DANA_BROWSE');
        
        $tahun=$request->input('tahun');
        $this->validate($request, [            
            'tahun'=>'required',            
        ]);     
        $tahun=$request->input('tahun');
        $data = SumberDanaModel::where('TA',$tahun)
                                ->orderBy('Nm_SumberDana','ASC')
                                ->get();
        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'sumberdana'=>$data,
                                'message'=>'Fetch data Sumber Dana berhasil diperoleh'
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
        $this->hasPermissionTo('SUMBER DANA_STORE');

        $tahun=$request->input('TA');
        $this->validate($request,
            [
                'Kd_SumberDana' => [                                
                                Rule::unique('tmSumberDana')->where(function($query) use ($request){
                                    return $query->where('TA',$request->input('TA'));
                                }),
                                'required',
                                'min:1',
                                'regex:/^[0-9]+$/'
                ],               
                'Nm_SumberDana'=>'required', 
            ],
            [   
                'Kd_SumberDana.required'=>'Mohon Kode Sumber Dana untuk di isi karena ini diperlukan',
                'Kd_SumberDana.min'=>'Mohon Kode Sumber Dana untuk di isi minimal 1 digit',

                'Nm_SumberDana.required'=>'Mohon Nama Sumber Dana untuk di isi karena ini diperlukan',
                'Nm_SumberDana.min'=>'Mohon Nama Sumber Dana di isi minimal 5 karakter'
            ]
        );
        
        $sumberdana = SumberDanaModel::create ([
                                                'SumberDanaID'=> uniqid ('uid'),
                                                'Kd_SumberDana'=>$request->input('Kd_SumberDana'),        
                                                'Nm_SumberDana'=>$request->input('Nm_SumberDana'),
                                                'Descr'=>$request->input('Descr'),
                                                'TA'=>$tahun,
                                            ]);

         return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'sumberdana'=>$sumberdana,                                    
                                'message'=>'Data Sumber Dana berhasil disimpan.'
                            ],200); 

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->hasPermissionTo('SUMBER DANA_UPDATE');

        $sumberdana = SumberDanaModel::find($id);        
        $this->validate($request,
        [
            'Kd_SumberDana'=>['required',
                        Rule::unique('tmSumberDana')->where(function($query) use ($request,$sumberdana) {  
                            if ($request->input('Kd_SumberDana')==$sumberdana->Kd_SumberDana) 
                            {
                                return $query->where('Kd_SumberDana',0);
                            }                 
                            else
                            {
                                return $query->where('Kd_SumberDana',$request->input('Kd_SumberDana'))
                                                ->where('TA',$sumberdana->TA);
                            }                                                                                    
                        }),
                        'min:1',
                        'regex:/^[0-9]+$/'

                    ],   
             
            'Nm_SumberDana'=>'required', 
        ],
        [            
            'Kd_SumberDana.required'=>'Mohon Kode Sumber Dana untuk di isi karena ini diperlukan',
            'Kd_SumberDana.min'=>'Mohon Kode Sumber Dana untuk di isi minimal 1 digit',

            'Nm_SumberDana.required'=>'Mohon Nama Sumber Dana untuk di isi karena ini diperlukan',
            'Nm_SumberDana.min'=>'Mohon Nama Sumber Dana di isi minimal 5 karakter'
        ]
        );

        $sumberdana->Kd_SumberDana = $request->input('Kd_SumberDana');
        $sumberdana->Nm_SumberDana = $request->input('Nm_SumberDana');
        $sumberdana->Descr = $request->input('Descr');
        
        $sumberdana->save();

        return Response()->json([
                            'status'=>1,
                            'pid'=>'update',
                            'sumberdana'=>$sumberdana,                                    
                            'message'=>'Data Sumber Dana '.$sumberdana->Nm_SumberDana.' berhasil diubah.'
                        ],200);

    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->hasPermissionTo('SUMBER DANA_DESTROY');

        $sumberdana = SumberDanaModel::find($id);        
        $result=$sumberdana->delete();
            
        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'destroy',                
                                'message'=>"Data Sumber Dana dengan ID ($id) berhasil dihapus"
                            ],200);
    }
}