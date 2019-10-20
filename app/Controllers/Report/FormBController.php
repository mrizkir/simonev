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
	*
	* total fisik satu proyek, tahun, bulan penggunaan
	*/
	private function getTotalFisik ($RKAID,$no_bulan) {
		$str = "SELECT SUM(fisik1) AS total FROM penggunaan_m pm WHERE bulan <='$no_bulan' AND idproyek='$idproyek'";				
		$this->DB->setFieldTable (array('total'));
		$r=$this->DB->getRecord($str);
		if ($r[1]['total'] > 0) {
			return $r[1]['total'];
        }else{
			return 0.00;
        }
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
        $daftar_unitkerja=[];
        $json_data = [];

        //index
        if ($request->exists('OrgID'))
        {
            $OrgID = $request->input('OrgID')==''?'':$request->input('OrgID');
            $filters['OrgID']=$OrgID;
            $filters['SOrgID']='';
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunAnggaran(),false,$OrgID);  
            
            $this->putControllerStateSession($this->SessionName,'filters',$filters);

            $data = [];

            $datatable = view("pages.$theme.report.formb.datatable")->with(['page_active'=>$this->SessionName,   
                                                                            'search'=>$this->getControllerStateSession($this->SessionName,'search'),
                                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                            'column_order'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'column_name'),
                                                                            'direction'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'order'),
                                                                            'data'=>$data])->render();

          
            $json_data = ['success'=>true,'daftar_unitkerja'=>$daftar_unitkerja,'datatable'=>$datatable];
        } 
        //index
        if ($request->exists('SOrgID'))
        {
            $SOrgID = $request->input('SOrgID')==''?'':$request->input('SOrgID');
            $filters['SOrgID']=$SOrgID;
            $this->putControllerStateSession($this->SessionName,'filters',$filters);
            $this->setCurrentPageInsideSession($this->SessionName,1);

            $data = $this->populateData();            
            $datatable = view("pages.$theme.report.formb.datatable")->with(['page_active'=>$this->SessionName,   
                                                                                'search'=>$this->getControllerStateSession($this->SessionName,'search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'column_name'),
                                                                                'direction'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'order'),
                                                                                'data'=>$data])->render();                                                                                       
            
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
        $locked=false;
        $filters=$this->getControllerStateSession($this->SessionName,'filters');      
        $daftar_opd=\App\Models\DMaster\OrganisasiModel::getDaftarOPD(\HelperKegiatan::getTahunAnggaran(),false);  
        $daftar_opd['']='';
        $daftar_unitkerja=[];
        $daftar_program=[];
        if ($filters['SOrgID'] != 'none'&&$filters['SOrgID'] != ''&&$filters['SOrgID'] != null && $locked==false)
        {
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunPerencanaan(),false,$filters['OrgID']);        
            $daftar_unitkerja['']='';

            $SOrgID = $filters['SOrgID'];
            $organisasi=\App\Models\DMaster\SubOrganisasiModel::select(\DB::raw('"v_suborganisasi"."OrgID","v_suborganisasi"."OrgIDRPJMD","v_suborganisasi"."UrsID","v_suborganisasi"."OrgNm","v_suborganisasi"."SOrgNm","v_suborganisasi"."kode_organisasi","v_suborganisasi"."kode_suborganisasi"'))
                                                                ->join('v_suborganisasi','tmSOrg.OrgID','v_suborganisasi.OrgID')
                                                                ->find($SOrgID);
            
            $daftar_program = \App\Models\DMaster\ProgramModel::getDaftarProgramByOPDComplete($organisasi->OrgIDRPJMD,false);
            // dd($daftar_program);
            $col_name='SOrgID';
            $col_value=$filters['SOrgID'];
        }
        elseif ($filters['OrgID'] != 'none'&&$filters['OrgID'] != ''&&$filters['OrgID'] != null)
        {
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunPerencanaan(),false,$filters['OrgID']);        
            $daftar_unitkerja['']='';  
            
            $col_name='OrgID';
            $col_value=$filters['OrgID'];
        }          
        return view("pages.$theme.report.formb.index")->with(['page_active'=>$this->SessionName,
                                                                    'daftar_opd'=>$daftar_opd,
                                                                    'daftar_unitkerja'=>$daftar_unitkerja,
                                                                    'daftar_program'=>$daftar_program,
                                                                    'col_name'=>$col_name,
                                                                    'col_value'=>$col_value,
                                                                    'filters'=>$filters]);               
    }   
}