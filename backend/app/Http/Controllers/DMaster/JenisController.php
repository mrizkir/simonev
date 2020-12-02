<?php

namespace App\Http\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DMaster\JenisModel;

use Illuminate\Validation\Rule;

class JenisController extends Controller {              
    /**
     * get all jenis rekening
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $this->hasPermissionTo('REKENING-JENIS_BROWSE');

        $this->validate($request, [        
            'TA'=>'required'
        ]);    
        $ta = $request->input('TA');

        $jenis=JenisModel::select(\DB::raw('
                                        "tmJns"."JnsID",                                        
                                        "tmJns"."KlpID",                                        
                                        "tmJns"."Kd_Rek_3",
                                        "tmJns"."JnsNm",                                        
                                        CONCAT(\'[\',"Kd_Rek_1",\'.\',"Kd_Rek_2",\'] \',"KlpNm") AS "nama_rek2",
                                        CONCAT(\'[\',"Kd_Rek_1",\'.\',"Kd_Rek_2",\'.\',"Kd_Rek_3",\'] \',"JnsNm") AS "nama_rek3",
                                        "tmJns"."Descr",
                                        "tmJns"."TA"
                                    '))
                                    ->join('tmKlp','tmJns.KlpID','tmKlp.KlpID')
                                    ->join('tmStr','tmStr.StrID','tmKlp.StrID')
                                    ->where('tmKlp.TA',$ta)
                                    ->orderBy('Kd_Rek_1','ASC')
                                    ->orderBy('Kd_Rek_2','ASC')
                                    ->orderBy('Kd_Rek_3','ASC')
                                    ->get();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'jenis'=>$jenis,
                                    'message'=>'Fetch data rekening jenis berhasil.'
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
        $this->hasPermissionTo('REKENING-JENIS_STORE');

        $this->validate($request, [
            'KlpID'=>'required|exists:tmKlp,KlpID',
            'Kd_Rek_3'=> [
                        Rule::unique('tmJns')->where(function($query) use ($request){
                            return $query->where('KlpID',$request->input('KlpID'))
                                        ->where('TA',$request->input('TA'));
                        }),
                        'required',
                        'regex:/^[0-9]+$/'],
            'JnsNm'=>'required',
            'TA'=>'required'
        ]);     
            
        $ta = $request->input('TA');
        
        $jenis = JenisModel::create([
            'JnsID' => uniqid('uid'),
            'KlpID' => $request->input('KlpID'),
            'Kd_Rek_3' => $request->input('Kd_Rek_3'),
            'JnsNm' => $request->input('JnsNm'),
            'Descr' => $request->input('Descr'),
            'TA'=>$ta,
        ]);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'jenis'=>$jenis,                                    
                                    'message'=>'Data Rekening Jenis berhasil disimpan.'
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
        $this->hasPermissionTo('REKENING-JENIS_UPDATE');

        $jenis = JenisModel::find($id);
        
        if (is_null($jenis))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'update',                
                                    'message'=>["Data Rekening Jenis ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [    
                                        'KlpID'=>'required|exists:tmKlp,KlpID',
                                        'Kd_Rek_3'=>[
                                                    Rule::unique('tmJns')->where(function($query) use ($request,$jenis) {  
                                                        if ($request->input('Kd_Rek_3')==$jenis->Kd_Rek_3) 
                                                        {
                                                            return $query->where('KlpID',$request->input('KlpID'))
                                                                        ->where('Kd_Rek_3','ignore')
                                                                        ->where('TA',$jenis->TA);
                                                        }                 
                                                        else
                                                        {
                                                            return $query->where('Kd_Rek_3',$request->input('Kd_Rek_3'))
                                                                    ->where('KlpID',$request->input('KlpID'))
                                                                    ->where('TA',$jenis->TA);
                                                        }                                                                                    
                                                    }),
                                                    'required',
                                                    'regex:/^[0-9]+$/'
                                                ],
                                        'JnsNm'=>'required',
                                    ]);
            
            
            $jenis->KlpID = $request->input('KlpID');
            $jenis->Kd_Rek_3 = $request->input('Kd_Rek_3');
            $jenis->JnsNm = $request->input('JnsNm');
            $jenis->Descr = $request->input('Descr');
            $jenis->save();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'jenis'=>$jenis,                                    
                                    'message'=>'Data Rekening Jenis '.$jenis->JnsNm.' berhasil diubah.'
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
        $this->hasPermissionTo('REKENING-JENIS_DESTROY');

        $jenis = JenisModel::find($id);

        if (is_null($jenis))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'destroy',                
                                    'message'=>["Data Rekening Jenis ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            
            $result=$jenis->delete();

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>"Data Rekening Jenis dengan ID ($id) berhasil dihapus"
                                ],200);
        }
    }
}