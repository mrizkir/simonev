<?php

namespace App\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\DMaster\ProgramModel;
use App\Models\DMaster\ProgramKegiatanModel;

class ProgramKegiatanController extends Controller {
     /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData ($currentpage=1) 
    {        
        $columns=['*'];       
        if (!$this->checkStateIsExistSession('programkegiatan','orderby')) 
        {            
           $this->putControllerStateSession('programkegiatan','orderby',['column_name'=>'kode_kegiatan','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('programkegiatan.orderby','column_name'); 
        $direction=$this->getControllerStateSession('programkegiatan.orderby','order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');        

        //filter
        if (!$this->checkStateIsExistSession('programkegiatan','filters')) 
        {            
            $this->putControllerStateSession('programkegiatan','filters',['PrgID'=>'']);
        }
        $filter_prgid=$this->getControllerStateSession('programkegiatan.filters','PrgID'); 
        if ($this->checkStateIsExistSession('programkegiatan','search')) 
        {
            $search=$this->getControllerStateSession('programkegiatan','search');
            switch ($search['kriteria']) 
            {
                case 'kode_kegiatan' :
                    $data = \DB::table('v_program_kegiatan')
                    ->select(\DB::raw('"KgtID","PrgID","kode_kegiatan","KgtNm","PrgNm","TA","created_at","updated_at"'))
                            ->where('TA',\HelperKegiatan::getTahunPerencanaan())
                            ->where(['kode_kegiatan'=>$search['isikriteria']])
                            ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                            ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                            ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                            ->orderByRaw('"Kd_Keg" ASC NULLS FIRST');
                break;
                case 'KgtNm' :
                    $data = \DB::table('v_program_kegiatan')
                            ->select(\DB::raw('"KgtID","PrgID","kode_kegiatan","KgtNm","PrgNm","TA","created_at","updated_at"'))
                            ->where('TA',\HelperKegiatan::getTahunPerencanaan())
                            ->where('KgtNm', 'ilike', '%' . $search['isikriteria'] . '%')
                            ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                            ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                            ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                            ->orderByRaw('"Kd_Keg" ASC NULLS FIRST');     
                break;
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data =$filter_prgid == '' ? 
                                            \DB::table('v_program_kegiatan')
                                                    ->select(\DB::raw('"KgtID","PrgID","kode_kegiatan","KgtNm","PrgNm","TA","created_at","updated_at"'))
                                                    ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                                                    ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                                                    ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                                                    ->orderByRaw('"Kd_Keg" ASC NULLS FIRST')
                                                    ->where('TA',\HelperKegiatan::getTahunPerencanaan())
                                                    ->paginate($numberRecordPerPage, $columns, 'page', $currentpage)
                                            :
                                            \DB::table('v_program_kegiatan')
                                                    ->select(\DB::raw('"KgtID","PrgID","kode_kegiatan","KgtNm","PrgNm","TA","created_at","updated_at"'))
                                                    ->orderByRaw('"Kd_Urusan" ASC NULLS FIRST')
                                                    ->orderByRaw('"Kd_Bidang" ASC NULLS FIRST')
                                                    ->orderByRaw('"Kd_Prog" ASC NULLS FIRST')
                                                    ->orderByRaw('"Kd_Keg" ASC NULLS FIRST')
                                                    ->where('TA',\HelperKegiatan::getTahunPerencanaan())
                                                    ->where('PrgID',$filter_prgid)                                                
                                                    ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        }        
        
        $data->setPath(route('programkegiatan.index'));
        return $data;
    }    
    /**
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search (Request $request) 
    {        
        $action = $request->input('action');
        if ($action == 'reset') 
        {
            $this->destroyControllerStateSession('programkegiatan','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('programkegiatan','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('programkegiatan',1);
        $data=$this->populateData();
        
        return response()->json(['page_active'=>'programkegiatan',
                                'search'=>$this->getControllerStateSession('programkegiatan','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('programkegiatan.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('programkegiatan.orderby','order'),
                                'filters'=>$this->getControllerStateSession('programkegiatan','filters'), 
                                'daftar_kegiatan'=>$data],200);        
    }
    /**
     * filter resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request) 
    {    
        $PrgID = $request->input('PrgID')==''?'':$request->input('PrgID');
        $filters['PrgID']=$PrgID;

        $this->putControllerStateSession('programkegiatan','filters',$filters);
        $this->setCurrentPageInsideSession('programkegiatan',1);

        $data = $this->populateData();            
        return response()->json(['page_active'=>'programkegiatan',
                                'search'=>$this->getControllerStateSession('programkegiatan','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('programkegiatan.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('programkegiatan.orderby','order'),
                                'filters'=>$this->getControllerStateSession('programkegiatan','filters'), 
                                'daftar_kegiatan'=>$data],200); 
                  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                
        $search=$this->getControllerStateSession('programkegiatan','search');
        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('programkegiatan'); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('programkegiatan',$currentpage);

         return response()->json(['page_active'=>'programkegiatan',
                                'search'=>$this->getControllerStateSession('programkegiatan','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('programkegiatan.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('programkegiatan.orderby','order'),
                                'filters'=>$this->getControllerStateSession('programkegiatan','filters'), 
                                'daftar_kegiatan'=>$data],200);  
    }    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \DB::table('v_program_kegiatan')
                    ->select(\DB::raw('"KgtID","Kd_Urusan","Nm_Urusan","Kd_Bidang","Nm_Bidang","KgtID","Kd_Prog","Kd_Keg","KgtNm","kode_kegiatan","PrgNm","Descr","TA","created_at","updated_at"'))
                    ->where('KgtID',$id)
                    ->get();   
                    
        return response()->json($data,200);

    }
}