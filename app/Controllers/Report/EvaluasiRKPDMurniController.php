<?php

namespace App\Controllers\Report;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\RKA\RKAKegiatanModel;
use App\Models\RKA\RKARincianKegiatanModel;
use App\Models\RKA\RKARealisasiRincianKegiatanModel;
use App\Models\RPJMD\RPJMDSasaranModel;

class EvaluasiRKPDMurniController extends Controller 
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
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData ($currentpage=1) 
    {        
        $columns=['*'];       
        if (!$this->checkStateIsExistSession($this->SessionName,'orderby')) 
        {            
           $this->putControllerStateSession($this->SessionName,'orderby',['column_name'=>'Nm_Sasaran','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'column_name'); 
        $direction=$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');  
        
        //filter
        if (!$this->checkStateIsExistSession($this->SessionName,'filters')) 
        {            
            $this->putControllerStateSession($this->SessionName,'filters',[
                                                                            'OrgIDRPJMD'=>'',
                                                                        ]);
        }        
        $OrgIDRPJMD= $this->getControllerStateSession(\Helper::getNameOfPage('filters'),'OrgIDRPJMD');

        if ($this->checkStateIsExistSession($this->SessionName,'search')) 
        {
            $search=$this->getControllerStateSession($this->SessionName,'search');
            switch ($search['kriteria']) 
            {
                case 'Nm_Sasaran' :
                    $data = \DB::table('v_opd_sasaran_rpjmd')
                            ->where('OrgIDRPJMD',$OrgIDRPJMD)                                            
                            ->where(['KgtNm'=>$search['isikriteria']])
                            ->where('TA', \HelperKegiatan::getRPJMDTahunMulai())
                            ->orderBy($column_order,$direction);                             
                break;                
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = \DB::table('v_opd_sasaran_rpjmd')
                        ->where('OrgIDRPJMD',$OrgIDRPJMD)                                            
                        ->where('TA', \HelperKegiatan::getRPJMDTahunMulai())  
                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        }      
        $data->setPath(route(\Helper::getNameOfPage('index')));
        return $data;
    }        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      

        //dapatkan daftar sasaran yang terkait dengan OrgID
        $daftar_sasaran = RPJMDSasaranModel::where('TA',\HelperKegiatan::getRPJMDTahunMulai())
                                            ->get();
                                            
        $generated_html = view("pages.evaluasirkpdm.datatable")->with([
                                                                    'daftar_sasaran'=>$daftar_sasaran,
                                                                    ])->render();
        return response()->json([
                                'generated_html'=>$generated_html
                                ],200);          

        // $filters=$this->getControllerStateSession($this->SessionName,'filters');
        // $search=$this->getControllerStateSession($this->SessionName,'search');
        // $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession($this->SessionName); 
        // $data = $this->populateData($currentpage);
        // if ($currentpage > $data->lastPage())
        // {            
        //     $data = $this->populateData($data->lastPage());
        // }
        // $this->setCurrentPageInsideSession($this->SessionName,$data->currentPage());
        // $daftar_opd=\App\Models\DMaster\OrganisasiRPJMDModel::getDaftarOPDMaster(\HelperKegiatan::getRPJMDTahunMulai(),false);
        // $daftar_opd['']='';             
        // return view("pages.$theme.report.evaluasirkpdm.index")->with(['page_active'=>$this->SessionName,
        //                                                             'daftar_opd'=>$daftar_opd,
        //                                                             'filters'=>$filters,
        //                                                             'search'=>$this->getControllerStateSession($this->SessionName,'search'),
        //                                                             'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
        //                                                             'column_order'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'column_name'),
        //                                                             'direction'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'order'),
        //                                                             'data'=>$data]);               
    }     
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $theme = 'dore';

        $data = \App\Models\RPJMD\RPJMDSasaranModel::select(\DB::raw('"tmPrioritasSasaranKab"."PrioritasSasaranKabID",
                                                    "tmPrioritasTujuanKab"."Kd_Tujuan",
                                                    "tmPrioritasTujuanKab"."Nm_Tujuan",
                                                    "tmPrioritasSasaranKab"."Kd_Sasaran",
                                                    "tmPrioritasSasaranKab"."Nm_Sasaran",
                                                    "tmPrioritasSasaranKab"."Descr",
                                                    "tmPrioritasSasaranKab"."PrioritasSasaranKabID_Src",
                                                    "tmPrioritasSasaranKab"."created_at",
                                                    "tmPrioritasSasaranKab"."updated_at"'))
                                ->join('tmPrioritasTujuanKab','tmPrioritasTujuanKab.PrioritasTujuanKabID','tmPrioritasSasaranKab.PrioritasTujuanKabID')
                                ->findOrFail($id);
        if (!is_null($data) )  
        {
            $filters=$this->getControllerStateSession($this->SessionName,'filters');   
            return view("pages.$theme.report.evaluasirkpdm.show")->with(['page_active'=>$this->SessionName,
                                                                        'filters'=>$filters,
                                                                        'data'=>$data,
                                                                    ]);
        }        
    }
 
}