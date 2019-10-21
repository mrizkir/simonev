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
     * filter resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request) 
    {
        $auth = \Auth::user();    
        $theme = 'dore';

        $filters=$this->getControllerStateSession($this->SessionName,'filters');
        $json_data = [];
        
        //index
        if ($request->exists('OrgID'))
        {
            $OrgID = $request->input('OrgID')==''?'':$request->input('OrgID');
            $filters['OrgID']=$OrgID;            
            $this->putControllerStateSession($this->SessionName,'filters',$filters);
            $col_name='OrgID';
            $col_value=$filters['OrgID'];
            
            $organisasi=\App\Models\DMaster\OrganisasiModel::find($filters['OrgID']);            
            $daftar_program = \App\Models\DMaster\ProgramModel::getDaftarProgramByOPDComplete($organisasi->OrgIDRPJMD,false);  

            $datatable = view("pages.$theme.report.formb.datatable")->with(['page_active'=>$this->SessionName,
                                                                            'organisasi'=>$organisasi,
                                                                            'daftar_program'=>$daftar_program,
                                                                            'col_name'=>$col_name,
                                                                            'col_value'=>$col_value,
                                                                            'filters'=>$filters])->render();

          
            $json_data = ['success'=>true,'datatable'=>$datatable];
        }       
        return response()->json($json_data,200);  
    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                
        $theme = 'dore';

        //filter
        if (!$this->checkStateIsExistSession($this->SessionName,'filters')) 
        {            
            $this->putControllerStateSession($this->SessionName,'filters',[
                                                                            'OrgID'=>'',
                                                                            'bulan_realisasi'=>\HelperKegiatan::getBulanRealisasi() > 9 ? 9:HelperKegiatan::getBulanRealisasi(),
                                                                        ]);
        }        
        $locked=false;
        $filters=$this->getControllerStateSession($this->SessionName,'filters');      
        $daftar_opd=\App\Models\DMaster\OrganisasiModel::getDaftarOPD(\HelperKegiatan::getTahunAnggaran(),false);  
        $daftar_opd['']='';
        $daftar_program=[];
        $col_name='OrgID';
        $col_value=$filters['OrgID'];
        $organisasi=[];
        if ($filters['OrgID'] != 'none'&&$filters['OrgID'] != ''&&$filters['OrgID'] != null)
        {
            $organisasi=\App\Models\DMaster\OrganisasiModel::find($filters['OrgID']);            
            $daftar_program = \App\Models\DMaster\ProgramModel::getDaftarProgramByOPDComplete($organisasi->OrgIDRPJMD,false);            
        }          
        return view("pages.$theme.report.formb.index")->with(['page_active'=>$this->SessionName,
                                                                    'daftar_opd'=>$daftar_opd,
                                                                    'daftar_program'=>$daftar_program,
                                                                    'organisasi'=>$organisasi,
                                                                    'col_name'=>$col_name,
                                                                    'col_value'=>$col_value,
                                                                    'filters'=>$filters]);               
    }   
}