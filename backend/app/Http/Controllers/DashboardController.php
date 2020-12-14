<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Statistik1Model;
use App\Models\DMaster\OrganisasiModel;
use App\Helpers\Helper;

use App\Models\Statistik2Model;

class DashboardController extends Controller
{
    public function indexfront(Request $request)
    {
        $this->validate($request, [            
            'ta'=>'required',
            'bulan_realisasi'=>'required'            
        ]);
        $tahun=$request->input('ta');
        $bulan_realisasi=$request->input('bulan_realisasi');
        
        $statistik1_murni = Statistik1Model::select(\DB::raw('
                                            "PaguDana1",
                                            "JumlahProgram1",
                                            "JumlahKegiatan1",
                                            "RealisasiKeuangan1",
                                            "RealisasiFisik1",
                                            0 AS "PersenRealisasiKeuangan1"
                                        '))
                                        ->find($tahun);
                            
        $statistik1_murni->PersenRealisasiKeuangan1=Helper::formatPersen($statistik1_murni->RealisasiKeuangan1,$statistik1_murni->PaguDana1);
        
        $chart_keuangan_murni=[
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ],
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ]
        ];
        $chart_fisik_murni=[
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ],
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ]
        ];

        $jumlah_opd = OrganisasiModel::select('OrgID')
                                    ->where('TA',$tahun)
                                    ->count();
                                    
        $statistik2=Statistik2Model::select(\DB::raw('
                                                "Bulan",
                                                SUM("PersenTargetKeuangan1") AS "PersenTargetKeuangan1",
                                                SUM("PersenRealisasiKeuangan1") AS "PersenRealisasiKeuangan1",                                                
                                                SUM("TargetFisik1") AS "TargetFisik1",
                                                SUM("RealisasiFisik1") AS "RealisasiFisik1"                                                
                                            '))
                                            ->where('TA',$tahun)                                                                                       
                                            ->where('EntryLvl',0)        
                                            ->groupBy('Bulan')                                
                                            ->get();
        foreach($statistik2 as $v)
        {
            switch($v->Bulan)
            {
                case 1 :
                    $chart_keuangan_murni[0][0]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][0]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);

                    $chart_fisik_murni[0][0]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][0]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 2 :
                    $chart_keuangan_murni[0][1]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][1]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);

                    $chart_fisik_murni[0][1]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][1]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 3 :
                    $chart_keuangan_murni[0][2]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][2]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);

                    $chart_fisik_murni[0][2]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][2]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 4 :
                    $chart_keuangan_murni[0][3]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][3]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);

                    $chart_fisik_murni[0][3]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][3]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 5 :
                    $chart_keuangan_murni[0][4]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][4]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);

                    $chart_fisik_murni[0][4]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][4]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 6 :
                    $chart_keuangan_murni[0][5]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][5]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);

                    $chart_fisik_murni[0][5]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][5]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 7 :
                    $chart_keuangan_murni[0][6]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][6]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);
                    
                    $chart_fisik_murni[0][6]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][6]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 8 :
                    $chart_keuangan_murni[0][7]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][7]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);
                    
                    $chart_fisik_murni[0][7]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][7]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 9 :
                    $chart_keuangan_murni[0][8]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][8]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);
                    
                    $chart_fisik_murni[0][8]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][8]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 10 :
                    $chart_keuangan_murni[0][9]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][9]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);
                    
                    $chart_fisik_murni[0][9]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][9]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 11 :
                    $chart_keuangan_murni[0][10]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][10]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);
                    
                    $chart_fisik_murni[0][10]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][10]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
                case 12 :
                    $chart_keuangan_murni[0][11]=Helper::formatPecahan($v->PersenTargetKeuangan1,$jumlah_opd);
                    $chart_keuangan_murni[1][11]=Helper::formatPecahan($v->PersenRealisasiKeuangan1,$jumlah_opd);
                    
                    $chart_fisik_murni[0][11]=Helper::formatPecahan($v->TargetFisik1,$jumlah_opd);
                    $chart_fisik_murni[1][11]=Helper::formatPecahan($v->RealisasiFisik1,$jumlah_opd);
                break;
            }
        }
        //perubahan
        $statistik1_perubahan = Statistik1Model::select(\DB::raw('
                                            "PaguDana2",
                                            "JumlahProgram2",
                                            "JumlahKegiatan2",
                                            "RealisasiKeuangan2",
                                            "RealisasiFisik2",
                                            0 AS "PersenRealisasiKeuangan2"
                                        '))
                                        ->find($tahun);

        $statistik1_perubahan->PersenRealisasiKeuangan2=Helper::formatPersen($statistik1_perubahan->RealisasiKeuangan2,$statistik1_perubahan->PaguDana2);

        $chart_keuangan_perubahan=[
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ],
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ]
        ];
        $chart_fisik_perubahan=[
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ],
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ]
        ];

        $statistik2=Statistik2Model::select(\DB::raw('
                                                "Bulan",
                                                SUM("PersenTargetKeuangan2") AS "PersenTargetKeuangan2",
                                                SUM("PersenRealisasiKeuangan2") AS "PersenRealisasiKeuangan2",                                                
                                                SUM("TargetFisik2") AS "TargetFisik2",
                                                SUM("RealisasiFisik2") AS "RealisasiFisik2"                                                
                                            '))
                                            ->where('TA',$tahun)                                                                                   
                                            ->where('EntryLvl',0)        
                                            ->groupBy('Bulan')                                
                                            ->get();

        foreach($statistik2 as $v)
        {
            switch($v->Bulan)
            {
                case 1 :
                    $chart_keuangan_perubahan[0][0]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][0]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                    $chart_fisik_perubahan[0][0]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][0]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 2 :
                    $chart_keuangan_perubahan[0][1]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][1]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                    $chart_fisik_perubahan[0][1]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][1]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 3 :
                    $chart_keuangan_perubahan[0][2]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][2]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                    $chart_fisik_perubahan[0][2]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][2]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 4 :
                    $chart_keuangan_perubahan[0][3]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][3]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                    $chart_fisik_perubahan[0][3]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][3]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 5 :
                    $chart_keuangan_perubahan[0][4]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][4]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                    $chart_fisik_perubahan[0][4]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][4]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 6 :
                    $chart_keuangan_perubahan[0][5]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][5]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                    $chart_fisik_perubahan[0][5]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][5]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 7 :
                    $chart_keuangan_perubahan[0][6]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][6]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                    
                    $chart_fisik_perubahan[0][6]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][6]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 8 :
                    $chart_keuangan_perubahan[0][7]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][7]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                    
                    $chart_fisik_perubahan[0][7]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][7]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 9 :
                    $chart_keuangan_perubahan[0][8]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][8]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                    
                    $chart_fisik_perubahan[0][8]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][8]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 10 :
                    $chart_keuangan_perubahan[0][9]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][9]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                    
                    $chart_fisik_perubahan[0][9]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][9]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 11 :
                    $chart_keuangan_perubahan[0][10]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][10]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                    
                    $chart_fisik_perubahan[0][10]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][10]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
                case 12 :
                    $chart_keuangan_perubahan[0][11]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                    $chart_keuangan_perubahan[1][11]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                    
                    $chart_fisik_perubahan[0][11]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                    $chart_fisik_perubahan[1][11]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                break;
            }
        }
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',                                                             
                                'statistik1_murni'=>$statistik1_murni,                                                                                                                                                             
                                'statistik1_perubahan'=>$statistik1_perubahan,              
                                'chart_keuangan_murni'=>$chart_keuangan_murni,
                                'chart_keuangan_perubahan'=>$chart_keuangan_perubahan,
                                'chart_fisik_murni'=>$chart_fisik_murni,                                                                                                                                               
                                'chart_fisik_perubahan'=>$chart_fisik_perubahan,                                                                                                                                               
                                'message'=>'Fetch data dashboard berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
}
