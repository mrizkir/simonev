<?php

namespace App\Http\Controllers\DMaster;

use App\Http\Controllers\Controller;
use App\Models\DMaster\ASNModel;
use App\Models\DMaster\PejabatModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PejabatController extends Controller
{

     /**
     * mendapatkan daftar seluruh PEJABAT
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->hasPermissionTo('PEJABAT_BROWSE');
        
        $this->validate($request, [            
            'tahun'=>'required',
            'OrgID'=>'required'
        ]);     
        
        $tahun=$request->input('tahun');
        $OrgID= $request->input('OrgID');

        $data = PejabatModel::join('tmASN','trRiwayatJabatanASN.ASNID','tmASN.ASNID')
                                ->select(\DB::raw('"RiwayatJabatanASNID","trRiwayatJabatanASN"."ASNID","trRiwayatJabatanASN"."OrgID","NIP_ASN","Nm_ASN","Jenis_Jabatan","trRiwayatJabatanASN".created_at,"trRiwayatJabatanASN".updated_at'))
                                ->where('trRiwayatJabatanASN.TA', $tahun)            
                                ->where('OrgID', $OrgID)            
                                ->orderBy('Nm_ASN', 'ASC')
                                ->get();                                       

        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'pejabat'=>$data,
                                'message'=>'Fetch data Pejabat berhasil diperoleh'
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
        $OrgID=$request->input('OrgID');
        $Jenis_Jabatan=$request->input('Jenis_Jabatan');

        $this->validate($request, [  
            'ASNID'=> [
                        Rule::unique('trRiwayatJabatanASN')->where(function($query) use ($request){
                            return $query->where('OrgID',$request->input('OrgID'))
                                        ->where('Jenis_Jabatan',$request->input('Jenis_Jabatan'));
                        }),
                        'required'],
            'Jenis_Jabatan'=>'required',
        ]);

       
        $asn = PejabatModel::create ([
            'RiwayatJabatanASNID'=> uniqid ('uid'),
            'OrgID'=> $OrgID,
            'ASNID'=> $request->input('ASNID'),
            'Jenis_Jabatan' => $Jenis_Jabatan,
            'TA'=>$request->input('TA'),
        ]);   

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'pejabat'=>$asn,                                    
                                    'message'=>"Data ASN berhasil disimpan sebagai pejabat $Jenis_Jabatan."
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
        $riwayat_asn = PejabatModel::find($id);
        $result=$riwayat_asn->delete();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>"Data Jabatan ASN dengan ID ($id) berhasil dihapus"
                                ],200);
        
    }
}