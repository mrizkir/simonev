<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\TransaksiModel;

use Illuminate\Validation\Rule;

class TransaksiController extends Controller {              
    /**
     * get all transaksi rekening
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $this->hasPermissionTo('REKENING-TRANSAKSI_BROWSE');

        $this->validate($request, [        
            'TA'=>'required'
        ]);    
        $ta = $request->input('TA');
        $transaksi=TransaksiModel::select(\DB::raw('
                                        "StrID",                                        
                                        "Kd_Rek_1",
                                        "StrNm",
                                        CONCAT(\'[\',"Kd_Rek_1",\'] \',"StrNm") AS "nama_rek1",
                                        "Descr",
                                        "TA"
                                    '))
                                    ->orderBy('Kd_Rek_1','ASC')                                    
                                    ->where('TA',$ta)
                                    ->get();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'transaksi'=>$transaksi,
                                    'message'=>'Fetch data rekening transaksi berhasil.'
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
        $this->hasPermissionTo('REKENING-TRANSAKSI_STORE');

        $this->validate($request, [
            'Kd_Rek_1'=> [
                        Rule::unique('tmStr')->where(function($query) use ($request){
                            return $query->where('TA',$request->input('TA'));
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'StrNm'=>'required',
            'TA'=>'required'
        ]);     
            
        $ta = $request->input('TA');
        
        $transaksi = TransaksiModel::create([
            'StrID' => uniqid('uid'),
            'Kd_Rek_1' => $request->input('Kd_Rek_1'),
            'StrNm' => $request->input('StrNm'),
            'Descr' => $request->input('Descr'),
            'TA'=>$ta,
        ]);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'transaksi'=>$transaksi,                                    
                                    'message'=>'Data Rekening Transaksi berhasil disimpan.'
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
        $this->hasPermissionTo('REKENING-TRANSAKSI_UPDATE');

        $transaksi = TransaksiModel::find($id);
        
        if (is_null($transaksi))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'update',                
                                    'message'=>["Data Rekening Transaksi ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [    
                                        'Kd_Rek_1'=>[
                                                    Rule::unique('tmStr')->where(function($query) use ($request,$transaksi) {  
                                                        if ($request->input('Kd_Rek_1')==$transaksi->Kd_Rek_1) 
                                                        {
                                                            return $query->where('Kd_Rek_1','ignore')
                                                                        ->where('TA',$transaksi->TA);
                                                        }                 
                                                        else
                                                        {
                                                            return $query->where('Kd_Rek_1',$request->input('Kd_Rek_1'))
                                                                    ->where('TA',$transaksi->TA);
                                                        }                                                                                    
                                                    }),
                                                    'required',
                                                    'regex:/^[0-9]+$/'
                                                ],
                                        'StrNm'=>'required',
                                    ]);
            
            
            $transaksi->Kd_Rek_1 = $request->input('Kd_Rek_1');
            $transaksi->StrNm = $request->input('StrNm');
            $transaksi->Descr = $request->input('Descr');
            $transaksi->save();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'transaksi'=>$transaksi,                                    
                                    'message'=>'Data Rekening Transaksi '.$transaksi->StrNm.' berhasil diubah.'
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
        $this->hasPermissionTo('REKENING-TRANSAKSI_DESTROY');

        $transaksi = TransaksiModel::find($id);

        if (is_null($transaksi))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'destroy',                
                                    'message'=>["Data Rekening Transaksi ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            
            $result=$transaksi->delete();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>"Data Rekening Transaksi dengan ID ($id) berhasil dihapus"
                                ],200);
        }
    }
}