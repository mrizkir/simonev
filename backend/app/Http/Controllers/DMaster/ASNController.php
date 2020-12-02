<?php

namespace App\Http\Controllers\DMaster;

use App\Http\Controllers\Controller;
use App\Models\DMaster\ASNModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ASNController extends Controller
{    
    /**
     * mendapatkan daftar seluruh ASN
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->hasPermissionTo('ASN_BROWSE');
        
        $this->validate($request, [            
            'tahun'=>'required',            
        ]);     
        
        $tahun=$request->input('tahun');
        
        $data = ASNModel::where('TA',$tahun)
                        ->orderBy('Nm_ASN', 'ASC')
                        ->get();
        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'asn'=>$data,
                                'message'=>'Fetch data ASN berhasil diperoleh'
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
        $this->hasPermissionTo('ASN_STORE');
        $this->validate($request, [           
            'TA'=>'required'
        ]);

        $ta = $request->input('TA');

        $this->validate($request, [
            'NIP_ASN'=> [
                        Rule::unique('tmASN')->where(function($query) use ($request){
                            return $query->where('NIP_ASN',$request->input('NIP_ASN'))
                                        ->where('TA',$request->input('TA'));
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'Nm_ASN'=>'required',
        ]);

              
        $asn = ASNModel::create ([
                                    'ASNID'=> uniqid ('uid'),
                                    'NIP_ASN' => $request->input('NIP_ASN'),
                                    'Nm_ASN' => $request->input('Nm_ASN'),
                                    'Descr' => $request->input('Descr'),
                                    'TA'=>$ta,
                                ]);  
        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'asn'=>$asn,                                    
                                'message'=>'Data ASN berhasil disimpan.'
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
        $this->hasPermissionTo('ASN_UPDATE');
        $asn = ASNModel::find($id);
        
        $this->validate($request, [    
                                    'NIP_ASN'=>[
                                                Rule::unique('tmASN')->where(function($query) use ($request,$asn) {  
                                                    if ($request->input('NIP_ASN')==$asn->NIP_ASN) 
                                                    {
                                                        return $query->where('NIP_ASN','ignore');
                                                    }                 
                                                    else
                                                    {
                                                        return $query->where('NIP_ASN',$request->input('NIP_ASN'))
                                                                ->where('TA',$asn->TA);
                                                    }                                                                                    
                                                }),
                                                'required',
                                                'regex:/^[0-9]+$/'
                                            ],
                                    'Nm_ASN'=>'required',
                                ]);
        
        
        $asn->NIP_ASN = $request->input('NIP_ASN');
        $asn->Nm_ASN = $request->input('Nm_ASN');
        $asn->Descr = $request->input('Descr');
        $asn->save();

        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'asn'=>$asn,                                    
                                'message'=>'Data ASN '.$asn->Nm_ASN.' berhasil diubah.'
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
        $this->hasPermissionTo('ASN_DESTROY');
        $asn = ASNModel::find($id);
        $result=$asn->delete();
        return Response()->json([
                                'status'=>1,
                                'pid'=>'destroy',                
                                'message'=>"Data ASN dengan ID ($id) berhasil dihapus"
                            ],200);
    }
}
