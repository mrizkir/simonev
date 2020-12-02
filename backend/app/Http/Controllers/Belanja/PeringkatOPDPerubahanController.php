<?php

namespace App\Http\Controllers\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\DMaster\OrganisasiModel;
use App\Models\Statistik2Model;

class PeringkatOPDPerubahanController extends Controller {     
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $this->validate($request, [            
            'tahun'=>'required',                     
        ]);        
        $tahun=$request->input('tahun');
        
        $subquery = \DB::table('statistik2')
                            ->select(\DB::raw('"OrgID",MAX("Bulan") AS "Bulan"'))
                            ->where('TA',$tahun)
                            ->where('EntryLvl',0)
                            ->groupBy('OrgID');

        $peringkat=\DB::table('statistik2')
                        ->select(\DB::raw('                            
                            statistik2."OrgID",
                            statistik2.kode_organisasi,
                            statistik2."OrgNm",
                            statistik2."RealisasiFisik2",
                            statistik2."PersenRealisasiKeuangan2"
                        '))
                        ->joinSub($subquery,'B',function($join){
                            $join->on('statistik2.OrgID','=','B.OrgID');
                            $join->on('statistik2.Bulan','=','B.Bulan');
                        })  
                        ->where('EntryLvl',0)
                        ->orderBy('statistik2.RealisasiFisik2','DESC')
                        ->orderBy('statistik2.PersenRealisasiKeuangan2','DESC')
                        ->get();
        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'peringkat'=>$peringkat,
                                'message'=>'Fetch data untuk peringkat opd berhasil diperoleh'
                            ],200);    
        
    }    
}