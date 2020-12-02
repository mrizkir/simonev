<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\ObjekModel;

use Illuminate\Validation\Rule;

class ObjekController extends Controller {              
    /**
     * get all objek objek
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $this->hasPermissionTo('REKENING-OBJEK_BROWSE');

        $this->validate($request, [        
            'TA'=>'required'
        ]);    
        $ta = $request->input('TA');

        $objek=ObjekModel::select(\DB::raw('
                                        "tmROby"."RObyID",                                        
                                        "tmROby"."ObyID",                                        
                                        "tmROby"."Kd_Rek_5",
                                        "tmROby"."RObyNm",                                                                                                                        
                                        CONCAT(\'[\',"Kd_Rek_1",\'.\',"Kd_Rek_2",\'.\',"Kd_Rek_3",\'.\',"Kd_Rek_4",\'] \',"ObyNm") AS "nama_rek4",
                                        CONCAT(\'[\',"Kd_Rek_1",\'.\',"Kd_Rek_2",\'.\',"Kd_Rek_3",\'.\',"Kd_Rek_4",\'.\',"Kd_Rek_5",\'] \',"RObyNm") AS "nama_rek5",
                                        "tmROby"."Descr",
                                        "tmROby"."TA"
                                    '))
                                    ->join('tmOby','tmOby.ObyID','tmROby.ObyID')
                                    ->join('tmJns','tmJns.JnsID','tmOby.JnsID')
                                    ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                                    ->join('tmStr','tmStr.StrID','tmKlp.StrID')
                                    ->where('tmROby.TA',$ta)
                                    ->orderBy('Kd_Rek_1','ASC')
                                    ->orderBy('Kd_Rek_2','ASC')
                                    ->orderBy('Kd_Rek_3','ASC')
                                    ->orderBy('Kd_Rek_4','ASC')
                                    ->orderBy('Kd_Rek_5','ASC')
                                    ->get();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'objek'=>$objek,
                                    'message'=>'Fetch data objek objek berhasil.'
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
        $this->hasPermissionTo('REKENING-OBJEK_STORE');

        $this->validate($request, [
            'ObyID'=>'required|exists:tmOby,ObyID',
            'Kd_Rek_5'=> [
                        Rule::unique('tmROby')->where(function($query) use ($request){
                            return $query->where('ObyID',$request->input('ObyID'))
                                        ->where('TA',$request->input('TA'));
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'RObyNm'=>'required',
            'TA'=>'required'
        ]);     
            
        $ta = $request->input('TA');
        
        $objek = ObjekModel::create([
            'RObyID' => uniqid('uid'),
            'ObyID' => $request->input('ObyID'),
            'Kd_Rek_5' => $request->input('Kd_Rek_5'),
            'RObyNm' => $request->input('RObyNm'),
            'Descr' => $request->input('Descr'),
            'TA'=>$ta,
        ]);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'objek'=>$objek,                                    
                                    'message'=>'Data Rekening Objek berhasil disimpan.'
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
        $this->hasPermissionTo('REKENING-OBJEK_UPDATE');

        $objek = ObjekModel::find($id);
        
        if (is_null($objek))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'update',                
                                    'message'=>["Data Rekening Objek ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [    
                                        'ObyID'=>'required|exists:tmOby,ObyID',
                                        'Kd_Rek_5'=>[
                                                    Rule::unique('tmROby')->where(function($query) use ($request,$objek) {  
                                                        if ($request->input('Kd_Rek_5')==$objek->Kd_Rek_5) 
                                                        {
                                                            return $query->where('ObyID',$request->input('ObyID'))
                                                                        ->where('Kd_Rek_5','ignore')
                                                                        ->where('TA',$objek->TA);
                                                        }                 
                                                        else
                                                        {
                                                            return $query->where('Kd_Rek_5',$request->input('Kd_Rek_5'))
                                                                    ->where('ObyID',$request->input('ObyID'))
                                                                    ->where('TA',$objek->TA);
                                                        }                                                                                    
                                                    }),
                                                    'required',
                                                    'regex:/^[0-9]+$/'
                                                ],
                                        'RObyNm'=>'required',
                                    ]);
            
            
            $objek->ObyID = $request->input('ObyID');
            $objek->Kd_Rek_5 = $request->input('Kd_Rek_5');
            $objek->RObyNm = $request->input('RObyNm');
            $objek->Descr = $request->input('Descr');
            $objek->save();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'objek'=>$objek,                                    
                                    'message'=>'Data Rekening Objek '.$objek->RObyNm.' berhasil diubah.'
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
        $this->hasPermissionTo('REKENING-OBJEK_DESTROY');

        $objek = ObjekModel::find($id);

        if (is_null($objek))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'destroy',                
                                    'message'=>["Data Rekening Objek ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            
            $result=$objek->delete();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>"Data Rekening Objek dengan ID ($id) berhasil dihapus"
                                ],200);
        }
    }
}