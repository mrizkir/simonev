<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\RincianModel;

use Illuminate\Validation\Rule;

class RincianController extends Controller {              
    /**
     * get all rincian rekening
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $this->hasPermissionTo('REKENING-RINCIAN_BROWSE');

        $this->validate($request, [        
            'TA'=>'required'
        ]);    
        $ta = $request->input('TA');

        $rincian=RincianModel::select(\DB::raw('
                                        "tmOby"."ObyID",                                        
                                        "tmOby"."JnsID",                                        
                                        "tmOby"."Kd_Rek_4",
                                        "tmOby"."ObyNm",                                                                                
                                        CONCAT(\'[\',"Kd_Rek_1",\'.\',"Kd_Rek_2",\'.\',"Kd_Rek_3",\'] \',"JnsNm") AS "nama_rek3",
                                        CONCAT(\'[\',"Kd_Rek_1",\'.\',"Kd_Rek_2",\'.\',"Kd_Rek_3",\'.\',"Kd_Rek_4",\'] \',"ObyNm") AS "nama_rek4",
                                        "tmOby"."Descr",
                                        "tmOby"."TA"
                                    '))
                                    ->join('tmJns','tmJns.JnsID','tmOby.JnsID')
                                    ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                                    ->join('tmStr','tmStr.StrID','tmKlp.StrID')
                                    ->where('tmOby.TA',$ta)
                                    ->orderBy('Kd_Rek_1','ASC')
                                    ->orderBy('Kd_Rek_2','ASC')
                                    ->orderBy('Kd_Rek_3','ASC')
                                    ->orderBy('Kd_Rek_4','ASC')
                                    ->get();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'rincian'=>$rincian,
                                    'message'=>'Fetch data rekening rincian berhasil.'
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
        $this->hasPermissionTo('REKENING-RINCIAN_STORE');

        $this->validate($request, [
            'JnsID'=>'required|exists:tmJns,JnsID',
            'Kd_Rek_4'=> [
                        Rule::unique('tmOby')->where(function($query) use ($request){
                            return $query->where('JnsID',$request->input('JnsID'))
                                        ->where('TA',$request->input('TA'));
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'ObyNm'=>'required',
            'TA'=>'required'
        ]);     
            
        $ta = $request->input('TA');
        
        $rincian = RincianModel::create([
            'ObyID' => uniqid('uid'),
            'JnsID' => $request->input('JnsID'),
            'Kd_Rek_4' => $request->input('Kd_Rek_4'),
            'ObyNm' => $request->input('ObyNm'),
            'Descr' => $request->input('Descr'),
            'TA'=>$ta,
        ]);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'rincian'=>$rincian,                                    
                                    'message'=>'Data Rekening Rincian berhasil disimpan.'
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
        $this->hasPermissionTo('REKENING-RINCIAN_UPDATE');

        $rincian = RincianModel::find($id);
        
        if (is_null($rincian))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'update',                
                                    'message'=>["Data Rekening Rincian ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [    
                                        'JnsID'=>'required|exists:tmJns,JnsID',
                                        'Kd_Rek_4'=>[
                                                    Rule::unique('tmOby')->where(function($query) use ($request,$rincian) {  
                                                        if ($request->input('Kd_Rek_4')==$rincian->Kd_Rek_4) 
                                                        {
                                                            return $query->where('JnsID',$request->input('JnsID'))
                                                                        ->where('Kd_Rek_4','ignore')
                                                                        ->where('TA',$rincian->TA);
                                                        }                 
                                                        else
                                                        {
                                                            return $query->where('Kd_Rek_4',$request->input('Kd_Rek_4'))
                                                                    ->where('JnsID',$request->input('JnsID'))
                                                                    ->where('TA',$rincian->TA);
                                                        }                                                                                    
                                                    }),
                                                    'required',
                                                    'regex:/^[0-9]+$/'
                                                ],
                                        'ObyNm'=>'required',
                                    ]);
            
            
            $rincian->JnsID = $request->input('JnsID');
            $rincian->Kd_Rek_4 = $request->input('Kd_Rek_4');
            $rincian->ObyNm = $request->input('ObyNm');
            $rincian->Descr = $request->input('Descr');
            $rincian->save();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'rincian'=>$rincian,                                    
                                    'message'=>'Data Rekening Rincian '.$rincian->ObyNm.' berhasil diubah.'
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
        $this->hasPermissionTo('REKENING-RINCIAN_DESTROY');

        $rincian = RincianModel::find($id);

        if (is_null($rincian))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'destroy',                
                                    'message'=>["Data Rekening Rincian ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            
            $result=$rincian->delete();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>"Data Rekening Rincian dengan ID ($id) berhasil dihapus"
                                ],200);
        }
    }
}