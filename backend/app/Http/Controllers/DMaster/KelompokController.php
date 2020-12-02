<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\KelompokModel;

use Illuminate\Validation\Rule;

class KelompokController extends Controller {              
    /**
     * get all kelompok rekening
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $this->hasPermissionTo('REKENING-KELOMPOK_BROWSE');

        $this->validate($request, [        
            'TA'=>'required'
        ]);    
        $ta = $request->input('TA');

        $kelompok=KelompokModel::select(\DB::raw('
                                        "tmKlp"."KlpID",                                        
                                        "tmKlp"."StrID",                                        
                                        "tmKlp"."Kd_Rek_2",
                                        "tmKlp"."KlpNm",
                                        CONCAT(\'[\',"Kd_Rek_1",\'] \',"StrNm") AS "nama_rek1",
                                        CONCAT(\'[\',"Kd_Rek_1",\'.\',"Kd_Rek_2",\'] \',"KlpNm") AS "nama_rek2",
                                        "tmKlp"."Descr",
                                        "tmKlp"."TA"
                                    '))
                                    ->join('tmStr','tmStr.StrID','tmKlp.StrID')
                                    ->where('tmKlp.TA',$ta)
                                    ->orderBy('Kd_Rek_1','ASC')
                                    ->orderBy('Kd_Rek_2','ASC')
                                    ->get();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'kelompok'=>$kelompok,
                                    'message'=>'Fetch data rekening kelompok berhasil.'
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
        $this->hasPermissionTo('REKENING-KELOMPOK_STORE');

        $this->validate($request, [
            'StrID'=>'required|exists:tmStr,StrID',
            'Kd_Rek_2'=> [
                        Rule::unique('tmKlp')->where(function($query) use ($request){
                            return $query->where('StrID',$request->input('StrID'))
                                        ->where('TA',$request->input('TA'));
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'KlpNm'=>'required',
            'TA'=>'required'
        ]);     
            
        $ta = $request->input('TA');
        
        $kelompok = KelompokModel::create([
            'KlpID' => uniqid('uid'),
            'StrID' => $request->input('StrID'),
            'Kd_Rek_2' => $request->input('Kd_Rek_2'),
            'KlpNm' => $request->input('KlpNm'),
            'Descr' => $request->input('Descr'),
            'TA'=>$ta,
        ]);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'kelompok'=>$kelompok,                                    
                                    'message'=>'Data Rekening Kelompok berhasil disimpan.'
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
        $this->hasPermissionTo('REKENING-KELOMPOK_UPDATE');

        $kelompok = KelompokModel::find($id);
        
        if (is_null($kelompok))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'update',                
                                    'message'=>["Data Rekening Kelompok ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [    
                                        'StrID'=>'required|exists:tmStr,StrID',
                                        'Kd_Rek_2'=>[
                                                    Rule::unique('tmKlp')->where(function($query) use ($request,$kelompok) {  
                                                        if ($request->input('Kd_Rek_2')==$kelompok->Kd_Rek_2) 
                                                        {
                                                            return $query->where('StrID',$request->input('StrID'))
                                                                        ->where('Kd_Rek_2','ignore')
                                                                        ->where('TA',$kelompok->TA);
                                                        }                 
                                                        else
                                                        {
                                                            return $query->where('Kd_Rek_2',$request->input('Kd_Rek_2'))
                                                                    ->where('StrID',$request->input('StrID'))
                                                                    ->where('TA',$kelompok->TA);
                                                        }                                                                                    
                                                    }),
                                                    'required',
                                                    'regex:/^[0-9]+$/'
                                                ],
                                        'KlpNm'=>'required',
                                    ]);
            
            $jenkelompokis->StrID = $request->input('StrID');
            $kelompok->Kd_Rek_2 = $request->input('Kd_Rek_2');
            $kelompok->KlpNm = $request->input('KlpNm');
            $kelompok->Descr = $request->input('Descr');
            $kelompok->save();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'kelompok'=>$kelompok,                                    
                                    'message'=>'Data Rekening Kelompok '.$kelompok->KlpNm.' berhasil diubah.'
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
        $this->hasPermissionTo('REKENING-KELOMPOK_DESTROY');

        $kelompok = KelompokModel::find($id);

        if (is_null($kelompok))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'destroy',                
                                    'message'=>["Data Rekening Kelompok ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            
            $result=$kelompok->delete();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>"Data Rekening Kelompok dengan ID ($id) berhasil dihapus"
                                ],200);
        }
    }
}