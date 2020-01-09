<?php

namespace App\Controllers\Report;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\RKA\RKAKegiatanModel;
use App\Models\RKA\RKARincianKegiatanModel;
use App\Models\RKA\RKARealisasiRincianKegiatanModel;

class FormBController extends Controller 
{
    private $dataRKA;
     /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth']);
        //set nama session 
        $this->SessionName=$this->getNameForSession();      
        //set nama halaman saat ini
        $this->NameOfPage = \Helper::getNameOfPage();
    }    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $OrgID = $request->input('OrgID');      
        $no_bulan = $request->input('no_bulan');
          
        $daftar_program=[];
        $col_name='OrgID';
        $col_value=$OrgID;
        
        $organisasi=\App\Models\DMaster\OrganisasiModel::find($OrgID);     
        
        $daftar_program = \App\Models\DMaster\ProgramModel::getDaftarProgramByOPDComplete($organisasi->OrgIDRPJMD,false);            

        $generated_html=view("pages.formb.datatable")->with([
                                                            'daftar_program'=>$daftar_program,
                                                            'filters'=>[
                                                                'OrgID'=>$OrgID,
                                                                'bulan_realisasi'=>$no_bulan
                                                            ],
                                                            'organisasi'=>$organisasi,
                                                            'col_name'=>$col_name,
                                                            'col_value'=>$col_value
                                                        ])->render();
        return response()->json([
                                    'generated_html'=>$generated_html
                            ],200);               
    }   
}