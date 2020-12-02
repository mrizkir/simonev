<?php

namespace App\Http\Controllers\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;

use App\Models\DMaster\OrganisasiModel;
use App\Models\Statistik1Model;
use App\Models\Statistik2Model;

class BelanjaPerubahanController extends Controller 
{
    public function index(Request $request)
    {
        $this->validate($request, [            
            'ta'=>'required',
            'bulan_realisasi'=>'required'            
        ]);
        
        $tahun=$request->input('ta');
        $bulan_realisasi=$request->input('bulan_realisasi');
        
        $statistik1=[
                        'PaguDana2'=>0,             
                        'JumlahProgram2'=>0,             
                        'JumlahKegiatan2'=>0,             
                        'RealisasiKeuangan2'=>0,             
                        'RealisasiFisik2'=>0, 
                    ];
        
        $chart_keuangan=[
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ],
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ]
        ];
        $chart_fisik=[
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ],
            [
                0,0,0,0,0,0,0,0,0,0,0,0
            ]
        ];
        if ($this->hasRole(['superadmin','bapelitbang']))
        {
            $statistik1 = Statistik1Model::select(\DB::raw('
                                            "PaguDana2",
                                            "JumlahProgram2",
                                            "JumlahKegiatan2",
                                            "RealisasiKeuangan2",
                                            "RealisasiFisik2",
                                            0 AS "PersenRealisasiKeuangan2"
                                        '))
                                        ->find($tahun);

            $statistik1->PersenRealisasiKeuangan2=Helper::formatPersen($statistik1->RealisasiKeuangan2,$statistik1->PaguDana2);
            $statistik1=[
                            'PaguDana2'=>$statistik1->PaguDana2,             
                            'JumlahProgram2'=>$statistik1->JumlahProgram2,             
                            'JumlahKegiatan2'=>$statistik1->JumlahKegiatan2,             
                            'RealisasiKeuangan2'=>$statistik1->RealisasiKeuangan2,             
                            'RealisasiFisik2'=>$statistik1->RealisasiFisik2, 
                            'PersenRealisasiKeuangan2'=>$statistik1->PersenRealisasiKeuangan2, 
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

            $jumlah_opd = OrganisasiModel::select('OrgID')
                                        ->where('TA',$tahun)
                                        ->count();

            foreach($statistik2 as $v)
            {
                switch($v->Bulan)
                {
                    case 1 :
                        $chart_keuangan[0][0]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][0]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                        $chart_fisik[0][0]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][0]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 2 :
                        $chart_keuangan[0][1]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][1]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                        $chart_fisik[0][1]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][1]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 3 :
                        $chart_keuangan[0][2]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][2]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                        $chart_fisik[0][2]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][2]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 4 :
                        $chart_keuangan[0][3]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][3]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                        $chart_fisik[0][3]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][3]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 5 :
                        $chart_keuangan[0][4]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][4]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                        $chart_fisik[0][4]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][4]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 6 :
                        $chart_keuangan[0][5]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][5]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                        $chart_fisik[0][5]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][5]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 7 :
                        $chart_keuangan[0][6]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][6]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                        
                        $chart_fisik[0][6]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][6]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 8 :
                        $chart_keuangan[0][7]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][7]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                        
                        $chart_fisik[0][7]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][7]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 9 :
                        $chart_keuangan[0][8]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][8]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                        
                        $chart_fisik[0][8]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][8]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 10 :
                        $chart_keuangan[0][9]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][9]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                        
                        $chart_fisik[0][9]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][9]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 11 :
                        $chart_keuangan[0][10]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][10]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                        
                        $chart_fisik[0][10]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][10]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                    case 12 :
                        $chart_keuangan[0][11]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                        $chart_keuangan[1][11]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                        
                        $chart_fisik[0][11]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                        $chart_fisik[1][11]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                    break;
                }
            }
        }       
        else if ($this->hasRole('opd'))
        {
            $daftar_opd=$this->getDaftarOPDUser();
            $jumlah_opd=count($daftar_opd);
            if ($jumlah_opd > 0)
            {
                $statistik1 = OrganisasiModel::where('TA',$tahun)
                                ->select(\DB::raw('
                                    COALESCE(SUM("PaguDana2"),0) AS "PaguDana2", 
                                    COALESCE(SUM("JumlahProgram2"),0) AS "JumlahProgram2", 
                                    COALESCE(SUM("JumlahKegiatan2"),0) AS "JumlahKegiatan2",
                                    COALESCE(SUM("RealisasiKeuangan2"),0) AS "RealisasiKeuangan2",
                                    COALESCE(SUM("RealisasiFisik2"),0) AS "RealisasiFisik2",
                                    0 AS "PersenRealisasiKeuangan2"
                                '))
                                ->whereIn('OrgID',$daftar_opd)                                
                                ->first();

                $statistik1->PersenRealisasiKeuangan2=Helper::formatPersen($statistik1->RealisasiKeuangan2,$statistik1->PaguDana2);                
                $statistik1=[
                            'PaguDana2'=>$statistik1->PaguDana2,             
                            'JumlahProgram2'=>$statistik1->JumlahProgram2,             
                            'JumlahKegiatan2'=>$statistik1->JumlahKegiatan2,             
                            'RealisasiKeuangan2'=>$statistik1->RealisasiKeuangan2,             
                            'RealisasiFisik2'=>Helper::formatPecahan($statistik1->RealisasiFisik2,$jumlah_opd), 
                            'PersenRealisasiKeuangan2'=>Helper::formatPecahan($statistik1->PersenRealisasiKeuangan2,$jumlah_opd), 
                        ];

                $statistik2=Statistik2Model::select(\DB::raw('
                                                "Bulan",
                                                SUM("PersenTargetKeuangan2") AS "PersenTargetKeuangan2",
                                                SUM("PersenRealisasiKeuangan2") AS "PersenRealisasiKeuangan2",                                                
                                                SUM("TargetFisik2") AS "TargetFisik2",
                                                SUM("RealisasiFisik2") AS "RealisasiFisik2"                                                
                                            '))
                                            ->where('TA',$tahun)
                                            ->whereIn('OrgID',$daftar_opd)                                             
                                            ->where('EntryLvl',0)        
                                            ->groupBy('Bulan')                                
                                            ->get();

                foreach($statistik2 as $v)
                {
                    switch($v->Bulan)
                    {
                        case 1 :
                            $chart_keuangan[0][0]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][0]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                            $chart_fisik[0][0]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][0]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 2 :
                            $chart_keuangan[0][1]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][1]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                            $chart_fisik[0][1]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][1]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 3 :
                            $chart_keuangan[0][2]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][2]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                            $chart_fisik[0][2]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][2]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 4 :
                            $chart_keuangan[0][3]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][3]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                            $chart_fisik[0][3]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][3]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 5 :
                            $chart_keuangan[0][4]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][4]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                            $chart_fisik[0][4]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][4]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 6 :
                            $chart_keuangan[0][5]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][5]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);

                            $chart_fisik[0][5]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][5]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 7 :
                            $chart_keuangan[0][6]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][6]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                            
                            $chart_fisik[0][6]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][6]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 8 :
                            $chart_keuangan[0][7]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][7]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                            
                            $chart_fisik[0][7]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][7]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 9 :
                            $chart_keuangan[0][8]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][8]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                            
                            $chart_fisik[0][8]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][8]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 10 :
                            $chart_keuangan[0][9]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][9]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                            
                            $chart_fisik[0][9]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][9]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 11 :
                            $chart_keuangan[0][10]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][10]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                            
                            $chart_fisik[0][10]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][10]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                        case 12 :
                            $chart_keuangan[0][11]=Helper::formatPecahan($v->PersenTargetKeuangan2,$jumlah_opd);
                            $chart_keuangan[1][11]=Helper::formatPecahan($v->PersenRealisasiKeuangan2,$jumlah_opd);
                            
                            $chart_fisik[0][11]=Helper::formatPecahan($v->TargetFisik2,$jumlah_opd);
                            $chart_fisik[1][11]=Helper::formatPecahan($v->RealisasiFisik2,$jumlah_opd);
                        break;
                    }
                }
            }
            
        }
        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'statistik1'=>$statistik1,
                                'chart_keuangan'=>$chart_keuangan,
                                'chart_fisik'=>$chart_fisik,
                                'message'=>'Fetch data ringkasan perubahan berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    public function reloadstatistik1(Request $request)
    {
        $this->validate($request, [            
            'ta'=>'required',          
        ]);
        
        $tahun=$request->input('ta');        
        $statistik1=[
                    'PaguDana2'=>0,             
                    'JumlahProgram2'=>0,             
                    'JumlahKegiatan2'=>0,             
                    'RealisasiKeuangan2'=>0,             
                    'RealisasiFisik2'=>0, 
                ];
        if ($this->hasRole(['superadmin','bapelitbang']))
        {
            $str_jumlah_pagudana='UPDATE statistik1 SET "PaguDana2"=level1.PaguDana2 FROM (
                SELECT SUM("PaguUraian2") AS PaguDana2 FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2) AS level1    
                WHERE statistik1."statistikID"='.$tahun;

            \DB::statement($str_jumlah_pagudana); 

            $str_jumlah_program1='UPDATE statistik1 SET "JumlahProgram2"=level2.jumlah_program FROM (
                SELECT COUNT("Kd_Prog") AS jumlah_program FROM 
                (SELECT "Kd_Prog" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 GROUP BY "Kd_Prog") AS level1
    
            )level2 WHERE statistik1."statistikID"='.$tahun;
    
            \DB::statement($str_jumlah_program1); 
    
            $str_jumlah_kegiatan1='UPDATE statistik1 SET "JumlahKegiatan2"=level2.jumlah_kegiatan FROM (
                SELECT COUNT("Kd_Keg") AS jumlah_kegiatan FROM 
                (SELECT "Kd_Keg" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 GROUP BY "Kd_Prog","Kd_Keg") AS level1
    
            )level2 WHERE statistik1."statistikID"='.$tahun;
    
            \DB::statement($str_jumlah_kegiatan1);             
            
            $jumlahuraian = \DB::table('trRKARinc')->where('TA',$tahun)->count();

            $totalfisik=\DB::table('trRKARealisasiRinc')                                   
                                    ->where('TA',$tahun)                                    
                                    ->sum('fisik2');
            
            $persen_realisasi_fisik=Helper::formatPecahan($totalfisik,$jumlahuraian);

            $str_jumlah_realisasi1='UPDATE statistik1 SET "RealisasiKeuangan2"=level1.realisasi2,"RealisasiFisik2"='.$persen_realisasi_fisik.' FROM (
                SELECT SUM("realisasi2") AS realisasi2 FROM "trRKARealisasiRinc" WHERE "TA"='.$tahun.' AND "EntryLvl"=2) AS level1    
                WHERE statistik1."statistikID"='.$tahun;

            \DB::statement($str_jumlah_realisasi1); 

            $statistik1 = Statistik1Model::select(\DB::raw('
                                            "PaguDana2",
                                            "JumlahProgram2",
                                            "JumlahKegiatan2",
                                            "RealisasiKeuangan2",
                                            "RealisasiFisik2",
                                            0 AS "PersenRealisasiKeuangan2"
                                        '))
                                        ->find($tahun);

            $statistik1->PersenRealisasiKeuangan2=Helper::formatPersen($statistik1->RealisasiKeuangan2,$statistik1->PaguDana2);
            $statistik1=[
                            'PaguDana2'=>$statistik1->PaguDana2,             
                            'JumlahProgram2'=>$statistik1->JumlahProgram2,             
                            'JumlahKegiatan2'=>$statistik1->JumlahKegiatan2,             
                            'RealisasiKeuangan2'=>$statistik1->RealisasiKeuangan2,             
                            'RealisasiFisik2'=>$statistik1->RealisasiFisik2, 
                            'PersenRealisasiKeuangan2'=>$statistik1->PersenRealisasiKeuangan2, 
                        ];
        }
        else if ($this->hasRole('opd'))
        {
            $daftar_opd=$this->getDaftarOPDUser();
            $jumlah_opd=count($daftar_opd);
            if ($jumlah_opd > 0)
            {
                foreach ($daftar_opd as $OrgID)
                {
                    $total_data=$this->generateStatistikOPD($OrgID,$tahun);
                    $persen_realisasi_fisik=$total_data['totalPersenRealisasiFisik'];
                    $total_realisasi=$total_data['totalRealisasiKeuanganKeseluruhan'];

                    $str_jumlah_realisasi1='UPDATE "tmOrg" SET "RealisasiKeuangan2"='.$total_realisasi.',"RealisasiFisik2"='.$persen_realisasi_fisik.' WHERE "tmOrg"."OrgID"=\''.$OrgID.'\'';

                    \DB::statement($str_jumlah_realisasi1); 
                }                
                      
                $statistik1 = OrganisasiModel::where('TA',$tahun)
                                ->select(\DB::raw('
                                    COALESCE(SUM("PaguDana2"),0) AS "PaguDana2", 
                                    COALESCE(SUM("JumlahProgram2"),0) AS "JumlahProgram2", 
                                    COALESCE(SUM("JumlahKegiatan2"),0) AS "JumlahKegiatan2",
                                    COALESCE(SUM("RealisasiKeuangan2"),0) AS "RealisasiKeuangan2",
                                    COALESCE(SUM("RealisasiFisik2"),0) AS "RealisasiFisik2",
                                    0 AS "PersenRealisasiKeuangan2"
                                '))
                                ->whereIn('OrgID',$daftar_opd)                                
                                ->first();

                $statistik1->PersenRealisasiKeuangan2=Helper::formatPersen($statistik1->RealisasiKeuangan2,$statistik1->PaguDana2);                
                $statistik1=[
                            'PaguDana2'=>$statistik1->PaguDana2,             
                            'JumlahProgram2'=>$statistik1->JumlahProgram2,             
                            'JumlahKegiatan2'=>$statistik1->JumlahKegiatan2,             
                            'RealisasiKeuangan2'=>$statistik1->RealisasiKeuangan2,             
                            'RealisasiFisik2'=>$statistik1->RealisasiFisik2, 
                            'PersenRealisasiKeuangan2'=>$statistik1->PersenRealisasiKeuangan2, 
                        ];
            }                         
        }

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',                                    
                                    'statistik1'=>$statistik1,                                    
                                    'message'=>'Data statistik1 berhasil di update'
                                ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    public function reloadstatistik2(Request $request)
    {
        $this->validate($request, [            
            'ta'=>'required',          
        ]);
        $tahun=$request->input('ta');  
        if ($this->hasRole(['superadmin','bapelitbang']))
        {
            $daftar_opd = OrganisasiModel::select('OrgID')
                                        ->where('TA',$tahun)
                                        ->get();

            foreach ($daftar_opd as $v)
            {
                $this->generateStatistikOPDBulan($v->OrgID,$tahun);
            }  
        }
        else
        {
            $daftar_opd=$this->getDaftarOPDUser();
            $jumlah_opd=count($daftar_opd);
            if ($jumlah_opd > 0)
            {
                foreach ($daftar_opd as $OrgID)
                {
                    $this->generateStatistikOPDBulan($OrgID,$tahun);
                }                  
            }
        }
    }
    private function generateStatistikOPD ($OrgID,$tahun)
    {
        $opd = OrganisasiModel::find($OrgID);
        
        $str_jumlah_program1='UPDATE "tmOrg" SET "JumlahProgram2"=level2.jumlah_program FROM (
            SELECT COUNT("Kd_Prog") AS jumlah_program FROM 
            (SELECT "Kd_Prog" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 AND kode_organisasi=\''.$opd->kode_organisasi.'\' GROUP BY "Kd_Prog") AS level1

        )level2 WHERE "tmOrg"."OrgID"=\''.$OrgID.'\' AND "tmOrg"."TA"='.$tahun;

        \DB::statement($str_jumlah_program1); 

        $str_jumlah_kegiatan1='UPDATE "tmOrg" SET "JumlahKegiatan2"=level2.jumlah_kegiatan FROM (
            SELECT COUNT("Kd_Keg") AS jumlah_kegiatan FROM 
            (SELECT "Kd_Keg" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 AND kode_organisasi=\''.$opd->kode_organisasi.'\' GROUP BY "Kd_Prog","Kd_Keg") AS level1

        )level2 WHERE "tmOrg"."OrgID"=\''.$OrgID.'\' AND "tmOrg"."TA"='.$tahun;

        \DB::statement($str_jumlah_kegiatan1);          

        $totalPaguOPD = $opd->PaguDana2;        
        
        $total_kegiatan=0;
        $total_uraian=0;
        $totalPersenBobot=0;
        $totalPersenTargetFisik=0;
        $totalPersenRealisasiFisik=0;
        $total_ttb_fisik=0;
        $totalTargetKeuanganKeseluruhan=0;
        $totalRealisasiKeuanganKeseluruhan=0;
        $total_ttb_keuangan=0;
        $totalSisaAnggaran=0;     
        
        $daftar_kegiatan = \DB::table('trRKA')
                                    ->select(\DB::raw('"RKAID","kode_kegiatan","KgtNm","PaguDana2","lokasi_kegiatan2"'))                                                                             
                                    ->where('kode_organisasi',$opd->kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',2)
                                    ->orderBy('kode_kegiatan','ASC')
                                    ->get();

        
        if(isset($daftar_kegiatan[0]))
        {
            foreach ($daftar_kegiatan as $n)
            {
                $RKAID=$n->RKAID;
                $nilai_pagu_proyek=$n->PaguDana2;
                $persen_bobot=Helper::formatPersen($nilai_pagu_proyek,$totalPaguOPD);
                $totalPersenBobot+=$persen_bobot;

                //jumlah baris uraian
                $jumlahuraian = \DB::table('trRKARinc')->where('RKAID',$RKAID)->count();	
                $total_uraian+=$jumlahuraian;

                $data_target=\DB::table('trRKATargetRinc')
                                    ->select(\DB::raw('COALESCE(SUM(target2),0) AS totaltarget, COALESCE(SUM(fisik2),0) AS jumlah_fisik'))
                                    ->where('RKAID',$RKAID)                                        
                                    ->get();

                $data_realisasi=\DB::table('trRKARealisasiRinc')
                                ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                ->where('RKAID',$RKAID)                                    
                                ->get();

                //menghitung persen target fisik         
                $target_fisik=Helper::formatPecahan($data_target[0]->jumlah_fisik,$jumlahuraian);                            
                $persen_target_fisik= $target_fisik > 100 ?'100.00':$target_fisik;
                $totalPersenTargetFisik+=$persen_target_fisik;               

                //menghitung persen realisasi fisik                
                $persen_realisasi_fisik=Helper::formatPecahan($data_realisasi[0]->fisik2,$jumlahuraian);
                $totalPersenRealisasiFisik+=$persen_realisasi_fisik; 
                
                $persen_tertimbang_fisik=0.00;
                if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                {
                    $persen_tertimbang_fisik=number_format(($persen_realisasi_fisik*$persen_bobot)/100,2);                            
                }							
                $total_ttb_fisik+=$persen_tertimbang_fisik;

                //menghitung total target dan realisasi keuangan 
                $totalTargetKeuangan=$data_target[0]->totaltarget;
                $totalTargetKeuanganKeseluruhan+=$totalTargetKeuangan;
                $persen_target_keuangan=Helper::formatPersen($totalTargetKeuangan,$nilai_pagu_proyek);                            							                                 
            
                $totalRealisasiKeuangan=$data_realisasi[0]->realisasi2;
                $totalRealisasiKeuanganKeseluruhan+=$totalRealisasiKeuangan;
                $persen_realisasi_keuangan=Helper::formatPersen($totalRealisasiKeuangan,$nilai_pagu_proyek);  
                
                $persen_tertimbang_keuangan=0.00;
                if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                {
                    $persen_tertimbang_keuangan=number_format(($persen_realisasi_keuangan*$persen_bobot)/100,2);                            
                }	
                $total_ttb_keuangan += $persen_tertimbang_keuangan;

                $sisa_anggaran=$nilai_pagu_proyek-$totalRealisasiKeuangan;
                $totalSisaAnggaran+=$sisa_anggaran; 
                
                $persen_sisa_anggaran=Helper::formatPersen($sisa_anggaran,$nilai_pagu_proyek);

                $total_kegiatan+=1;
            }
        }        
        
        if ($totalPersenBobot > 100) {
            $totalPersenBobot = 100.000;
        }
        $totalPersenTargetFisik = Helper::formatPecahan($totalPersenTargetFisik,$total_kegiatan);        
        $totalPersenRealisasiFisik=Helper::formatPecahan($totalPersenRealisasiFisik,$total_kegiatan); 
        $totalPersenTargetKeuangan=Helper::formatPersen($totalTargetKeuanganKeseluruhan,$totalPaguOPD);                
        $totalPersenRealisasiKeuangan=Helper::formatPersen($totalRealisasiKeuanganKeseluruhan,$totalPaguOPD);
        $totalPersenSisaAnggaran=Helper::formatPersen($totalSisaAnggaran,$totalPaguOPD);
        $totalPersenBobot=round($totalPersenBobot,2);
        $total_ttb_fisik=round($total_ttb_fisik,2);
        $total_ttb_keuangan=round($total_ttb_keuangan,2);
        $total_data=[
            'totalPaguOPD'=>$totalPaguOPD,
            'totalPersenBobot'=>$totalPersenBobot,
            'totalPersenTargetFisik'=>$totalPersenTargetFisik,
            'totalPersenRealisasiFisik'=>$totalPersenRealisasiFisik,
            'total_ttb_fisik'=>$total_ttb_fisik,
            'totalTargetKeuanganKeseluruhan'=>$totalTargetKeuanganKeseluruhan,
            'totalRealisasiKeuanganKeseluruhan'=>$totalRealisasiKeuanganKeseluruhan,
            'totalPersenTargetKeuangan'=>$totalPersenTargetKeuangan,
            'totalPersenRealisasiKeuangan'=>$totalPersenRealisasiKeuangan,
            'total_ttb_keuangan'=>$total_ttb_keuangan,
            'totalSisaAnggaran'=>$totalSisaAnggaran,
            'totalPersenSisaAnggaran'=>$totalPersenSisaAnggaran,
        ];               

        return $total_data;
    }
    private function generateStatistikOPDBulan ($OrgID,$tahun)
    {
        $opd = OrganisasiModel::find($OrgID);        
        
        $str_jumlah_program1='UPDATE "tmOrg" SET "JumlahProgram2"=level2.jumlah_program FROM (
            SELECT COUNT("Kd_Prog") AS jumlah_program FROM 
            (SELECT "Kd_Prog" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 AND kode_organisasi=\''.$opd->kode_organisasi.'\' GROUP BY "Kd_Prog") AS level1

        )level2 WHERE "tmOrg"."OrgID"=\''.$OrgID.'\' AND "tmOrg"."TA"='.$tahun;

        \DB::statement($str_jumlah_program1); 

        $str_jumlah_kegiatan1='UPDATE "tmOrg" SET "JumlahKegiatan2"=level2.jumlah_kegiatan FROM (
            SELECT COUNT("Kd_Keg") AS jumlah_kegiatan FROM 
            (SELECT "Kd_Keg" FROM simda WHERE "TA"='.$tahun.' AND "EntryLvl"=2 AND kode_organisasi=\''.$opd->kode_organisasi.'\' GROUP BY "Kd_Prog","Kd_Keg") AS level1

        )level2 WHERE "tmOrg"."OrgID"=\''.$OrgID.'\' AND "tmOrg"."TA"='.$tahun;

        \DB::statement($str_jumlah_kegiatan1);          

        $totalPaguOPD = $opd->PaguDana2;        
        
        $total_kegiatan=0;
        $total_uraian=0;
        $totalPersenBobot=0;
        $totalPersenTargetFisik=0;
        $totalPersenRealisasiFisik=0;
        $total_ttb_fisik=0;
        $totalTargetKeuanganKeseluruhan=0;
        $totalRealisasiKeuanganKeseluruhan=0;
        $total_ttb_keuangan=0;
        $totalSisaAnggaran=0; 
       
        for ($i=1;$i<=12;$i++)
        {   
            $total_kegiatan=0;
            $total_uraian=0;
            $totalPersenBobot=0;
            $totalPersenTargetFisik=0;
            $totalPersenRealisasiFisik=0;
            $total_ttb_fisik=0;
            $totalTargetKeuanganKeseluruhan=0;
            $totalRealisasiKeuanganKeseluruhan=0;
            $total_ttb_keuangan=0;
            $totalSisaAnggaran=0;     

            $daftar_kegiatan = \DB::table('trRKA')
                                    ->select(\DB::raw('"RKAID","kode_kegiatan","KgtNm","PaguDana2","lokasi_kegiatan2"'))                                                                             
                                    ->where('kode_organisasi',$opd->kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',2)
                                    ->orderBy('kode_kegiatan','ASC')
                                    ->get();

            if(isset($daftar_kegiatan[0]))
            {
                foreach ($daftar_kegiatan as $n)
                {
                    $RKAID=$n->RKAID;
                    $nilai_pagu_proyek=$n->PaguDana2;
                    $persen_bobot=Helper::formatPersen($nilai_pagu_proyek,$totalPaguOPD);
                    $totalPersenBobot+=$persen_bobot;

                    //jumlah baris uraian
                    $jumlahuraian = \DB::table('trRKARinc')->where('RKAID',$RKAID)->count();	
                    $total_uraian+=$jumlahuraian;

                    $data_target=\DB::table('trRKATargetRinc')
                                    ->select(\DB::raw('COALESCE(SUM(target2),0) AS totaltarget, COALESCE(SUM(fisik2),0) AS jumlah_fisik'))
                                    ->where('RKAID',$RKAID)                   
                                    ->where('bulan2','<=',$i)                     
                                    ->get();

                    $data_realisasi=\DB::table('trRKARealisasiRinc')
                                    ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                    ->where('RKAID',$RKAID)      
                                    ->where('bulan2','<=',$i)                                   
                                    ->get();

                    //menghitung persen target fisik         
                    $target_fisik=Helper::formatPecahan($data_target[0]->jumlah_fisik,$jumlahuraian);                            
                    $persen_target_fisik= $target_fisik > 100 ?'100.00':$target_fisik;
                    $totalPersenTargetFisik+=$persen_target_fisik;               

                    //menghitung persen realisasi fisik                
                    $persen_realisasi_fisik=Helper::formatPecahan($data_realisasi[0]->fisik2,$jumlahuraian);
                    $totalPersenRealisasiFisik+=$persen_realisasi_fisik; 
                    
                    $persen_tertimbang_fisik=0.00;
                    if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                    {
                        $persen_tertimbang_fisik=number_format(($persen_realisasi_fisik*$persen_bobot)/100,2);                            
                    }							
                    $total_ttb_fisik+=$persen_tertimbang_fisik;

                    //menghitung total target dan realisasi keuangan 
                    $totalTargetKeuangan=$data_target[0]->totaltarget;
                    $totalTargetKeuanganKeseluruhan+=$totalTargetKeuangan;
                    $persen_target_keuangan=Helper::formatPersen($totalTargetKeuangan,$nilai_pagu_proyek);                            							                                 
                
                    $totalRealisasiKeuangan=$data_realisasi[0]->realisasi2;
                    $totalRealisasiKeuanganKeseluruhan+=$totalRealisasiKeuangan;
                    $persen_realisasi_keuangan=Helper::formatPersen($totalRealisasiKeuangan,$nilai_pagu_proyek);  
                    
                    $persen_tertimbang_keuangan=0.00;
                    if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                    {
                        $persen_tertimbang_keuangan=number_format(($persen_realisasi_keuangan*$persen_bobot)/100,2);                            
                    }	
                    $total_ttb_keuangan += $persen_tertimbang_keuangan;

                    $sisa_anggaran=$nilai_pagu_proyek-$totalRealisasiKeuangan;
                    $totalSisaAnggaran+=$sisa_anggaran; 
                    
                    $persen_sisa_anggaran=Helper::formatPersen($sisa_anggaran,$nilai_pagu_proyek);

                    $total_kegiatan+=1;
                }
            }
            if ($totalPersenBobot > 100) {
                $totalPersenBobot = 100.000;
            }
            $totalPersenTargetFisik = Helper::formatPecahan($totalPersenTargetFisik,$total_kegiatan);        
            $totalPersenRealisasiFisik=Helper::formatPecahan($totalPersenRealisasiFisik,$total_kegiatan); 
            $totalPersenTargetKeuangan=Helper::formatPersen($totalTargetKeuanganKeseluruhan,$totalPaguOPD);                
            $totalPersenRealisasiKeuangan=Helper::formatPersen($totalRealisasiKeuanganKeseluruhan,$totalPaguOPD);
            $totalPersenSisaAnggaran=Helper::formatPersen($totalSisaAnggaran,$totalPaguOPD);
            $totalPersenBobot=round($totalPersenBobot,2);
            $total_ttb_fisik=round($total_ttb_fisik,2);
            $total_ttb_keuangan=round($total_ttb_keuangan,2);

            $statistik2 = Statistik2Model::where('Bulan',$i)
                                            ->where('OrgID',$OrgID)
                                            ->where('TA',$tahun)   
                                            ->where('EntryLvl',0)                                                                                   
                                            ->first();

            if (is_null($statistik2))
            {
                Statistik2Model::create([
                    'Statistik2ID' => uniqid ('uid'),
                    'OrgID'=>$OrgID,
                    'kode_organisasi'=>$opd->kode_organisasi,
                    'OrgNm'=>$opd->OrgNm,
                    'PaguDana1'=>0,
                    'PaguDana2'=>$totalPaguOPD,            
                    'PaguDana3'=>0,            
                    'JumlahKegiatan1'=>0,
                    'JumlahKegiatan2'=>$total_kegiatan,
                    'JumlahKegiatan3'=>0,
                    'JumlahUraian1'=>0,
                    'JumlahUraian2'=>$total_uraian,
                    'JumlahUraian3'=>0,
                        
                    'TargetFisik1'=>0,
                    'TargetFisik2'=>$totalPersenTargetFisik,
                    'TargetFisik3'=>0,
                    'RealisasiFisik1'=>0,
                    'RealisasiFisik2'=>$totalPersenRealisasiFisik,
                    'RealisasiFisik3'=>0,

                    'TargetKeuangan1'=>0,
                    'TargetKeuangan2'=>$totalTargetKeuanganKeseluruhan,
                    'TargetKeuangan3'=>0,
                    'RealisasiKeuangan1'=>0,
                    'RealisasiKeuangan2'=>$totalRealisasiKeuanganKeseluruhan,
                    'RealisasiKeuangan3'=>0,

                    'PersenTargetKeuangan1'=>0,
                    'PersenTargetKeuangan2'=>$totalPersenTargetKeuangan,
                    'PersenTargetKeuangan3'=>0,
                    'PersenRealisasiKeuangan1'=>0,
                    'PersenRealisasiKeuangan2'=>$totalPersenRealisasiKeuangan,
                    'PersenRealisasiKeuangan3'=>0,
                        
                    'SisaPaguDana1'=>0,
                    'SisaPaguDana2'=>$totalSisaAnggaran,
                    'SisaPaguDana3'=>0,

                    'PersenSisaPaguDana1'=>0,
                    'PersenSisaPaguDana2'=>$totalPersenSisaAnggaran,
                    'PersenSisaPaguDana3'=>0,

                    'Bobot1'=>0,
                    'Bobot2'=>$totalPersenBobot,
                    'Bobot3'=>0,
                    
                    'Bulan'=>$i,
                    'TA'=>$tahun,
                    'EntryLvl'=>0,
                ]);
            }
            else
            {
             
                $statistik2->PaguDana2=$totalPaguOPD;            
                $statistik2->JumlahKegiatan2=$total_kegiatan;
                $statistik2->JumlahUraian2=$total_uraian;              
                $statistik2->TargetFisik2=$totalPersenTargetFisik;
                $statistik2->RealisasiFisik2=$totalPersenRealisasiFisik;
                $statistik2->TargetKeuangan2=$totalTargetKeuanganKeseluruhan;
                $statistik2->RealisasiKeuangan2=$totalRealisasiKeuanganKeseluruhan;
                $statistik2->PersenTargetKeuangan2=$totalPersenTargetKeuangan;
                $statistik2->PersenRealisasiKeuangan2=$totalPersenRealisasiKeuangan;
                $statistik2->SisaPaguDana2=$totalSisaAnggaran;
                $statistik2->PersenSisaPaguDana2=$totalPersenSisaAnggaran;
                $statistik2->Bobot2=$totalPersenBobot;

                $statistik2->save();
              
            }
        }
    }
}