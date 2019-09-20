<?php

namespace App\Controllers\RKA;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\RKA\RKAKegiatanMurniModel;

class RKAKegiatanMurniController extends Controller 
{
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
        if (!$this->checkStateIsExistSession('rkakegiatanmurni','orderby')) 
        {            
           $this->putControllerStateSession('rkakegiatanmurni','orderby',['column_name'=>'KgtNm','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('rkakegiatanmurni.orderby','column_name'); 
        $direction=$this->getControllerStateSession('rkakegiatanmurni.orderby','order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');        
        if ($this->checkStateIsExistSession('rkakegiatanmurni','search')) 
        {
            $search=$this->getControllerStateSession('rkakegiatanmurni','search');
            switch ($search['kriteria']) 
            {
                case 'KgtNm' :
                    $data = RKAKegiatanMurniModel::where(['KgtNm'=>$search['isikriteria']])->orderBy($column_order,$direction); 
                break;                
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = RKAKegiatanMurniModel::orderBy($column_order,$direction)->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        }        
        $data->setPath(route('rkakegiatanmurni.index'));
        return $data;
    }
    /**
     * digunakan untuk mengganti jumlah record per halaman
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changenumberrecordperpage (Request $request) 
    {
        $theme = 'dore';

        $numberRecordPerPage = $request->input('numberRecordPerPage');
        $this->putControllerStateSession('global_controller','numberRecordPerPage',$numberRecordPerPage);
        
        $this->setCurrentPageInsideSession('rkakegiatanmurni',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.rka.rkakegiatanmurni.datatable")->with(['page_active'=>'rkakegiatanmurni',
                                                                                'search'=>$this->getControllerStateSession('rkakegiatanmurni','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','order'),
                                                                                'data'=>$data])->render();      
        return response()->json(['success'=>true,'datatable'=>$datatable],200);
    }
    /**
     * digunakan untuk mengurutkan record 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderby (Request $request) 
    {
        $theme = 'dore';

        $orderby = $request->input('orderby') == 'asc'?'desc':'asc';
        $column=$request->input('column_name');
        switch($column) 
        {
            case 'KgtNm' :
                $column_name = 'KgtNm';
            break;           
            default :
                $column_name = 'KgtNm';
        }
        $this->putControllerStateSession('rkakegiatanmurni','orderby',['column_name'=>$column_name,'order'=>$orderby]);      

        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('rkakegiatanmurni');         
        $data=$this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        
        $datatable = view("pages.$theme.rka.rkakegiatanmurni.datatable")->with(['page_active'=>'rkakegiatanmurni',
                                                            'search'=>$this->getControllerStateSession('rkakegiatanmurni','search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                            'column_order'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','order'),
                                                            'data'=>$data])->render();     

        return response()->json(['success'=>true,'datatable'=>$datatable],200);
    }
    
    /**
     * paginate resource in storage called by ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginate ($id) 
    {
        $theme = 'dore';

        $this->setCurrentPageInsideSession('rkakegiatanmurni',$id);
        $data=$this->populateData($id);
        $datatable = view("pages.$theme.rka.rkakegiatanmurni.datatable")->with(['page_active'=>'rkakegiatanmurni',
                                                                            'search'=>$this->getControllerStateSession('rkakegiatanmurni','search'),
                                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                            'column_order'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','column_name'),
                                                                            'direction'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','order'),
                                                                            'data'=>$data])->render(); 

        return response()->json(['success'=>true,'datatable'=>$datatable],200);        
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

        $filters=$this->getControllerStateSession('rkakegiatanmurni','filters');
        $daftar_unitkerja=[];
        $json_data = [];

        //index
        if ($request->exists('OrgID'))
        {
            $OrgID = $request->input('OrgID')==''?'none':$request->input('OrgID');
            $filters['OrgID']=$OrgID;
            $filters['SOrgID']='none';
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunPenyerapan(),false,$OrgID);  
            
            $this->putControllerStateSession('rkakegiatanmurni','filters',$filters);

            $data = [];

            $datatable = view("pages.$theme.rka.rkakegiatanmurni.datatable")->with(['page_active'=>'rkakegiatanmurni',   
                                                                            'search'=>$this->getControllerStateSession('rkakegiatanmurni','search'),
                                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                            'column_order'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'column_name'),
                                                                            'direction'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'order'),
                                                                            'data'=>$data])->render();

          
            $json_data = ['success'=>true,'daftar_unitkerja'=>$daftar_unitkerja,'datatable'=>$datatable];
        } 
        //index
        if ($request->exists('SOrgID'))
        {
            $SOrgID = $request->input('SOrgID')==''?'none':$request->input('SOrgID');
            $filters['SOrgID']=$SOrgID;
            $this->putControllerStateSession('rkakegiatanmurni','filters',$filters);
            $this->setCurrentPageInsideSession('rkakegiatanmurni',1);

            $data = $this->populateData();            
            $datatable = view("pages.$theme.rka.rkakegiatanmurni.datatable")->with(['page_active'=>'rkakegiatanmurni',   
                                                                                'search'=>$this->getControllerStateSession('rkakegiatanmurni','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'column_name'),
                                                                                'direction'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'order'),
                                                                                'data'=>$data])->render();                                                                                       
            
            $json_data = ['success'=>true,'datatable'=>$datatable];            
        } 

        //select prgid create 0
        if ($request->exists('PrgID') && $request->exists('create'))
        {
            $PrgID = $request->input('PrgID')==''?'none':$request->input('PrgID');   
            $r=\DB::table('v_rkpd')
                    ->select(\DB::raw('"RKPDID","kode_kegiatan","KgtNm"'))
                    ->where('TA',\HelperKegiatan::getTahunPenyerapan())
                    ->where('PrgID',$PrgID)
                    ->WhereNotIn('RKPDID',function($query) use ($filters) {
                        $query->select('RKPDID')
                                ->from('trRKA')
                                ->where('TA', \HelperKegiatan::getTahunPenyerapan())
                                ->where('OrgID', $filters['OrgID']);
                    }) 
                    ->orderBy('Kd_Keg')
                    ->orderBy('kode_kegiatan')
                    ->get();
            $daftar_rkpd=[];        
            foreach ($r as $k=>$v)
            {               
                $daftar_rkpd[$v->RKPDID]='['.$v->kode_kegiatan.']. '.$v->KgtNm . ' ('.$v->RKPDID.')';
            }            
            $json_data['success']=true;
            $json_data['PrgID']=$PrgID;
            $json_data['daftar_rkpd']=$daftar_rkpd;
        } 
        return response()->json($json_data,200);  
    }
    /**
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search (Request $request) 
    {
        $theme = 'dore';

        $action = $request->input('action');
        if ($action == 'reset') 
        {
            $this->destroyControllerStateSession('rkakegiatanmurni','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('rkakegiatanmurni','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('rkakegiatanmurni',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.rka.rkakegiatanmurni.datatable")->with(['page_active'=>'rkakegiatanmurni',                                                            
                                                                                'search'=>$this->getControllerStateSession('rkakegiatanmurni','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','order'),
                                                                                'data'=>$data])->render();      
        
        return response()->json(['success'=>true,'datatable'=>$datatable],200);        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                
        $theme = 'dore';

        $filters=$this->getControllerStateSession('rkakegiatanmurni','filters');
        $search=$this->getControllerStateSession('rkakegiatanmurni','search');
        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('rkakegiatanmurni'); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('rkakegiatanmurni',$data->currentPage());
        $daftar_opd=\App\Models\DMaster\OrganisasiModel::getDaftarOPD(\HelperKegiatan::getTahunPenyerapan(),false);  
        $daftar_opd['']='';
        $daftar_unitkerja=[];
        if ($filters['OrgID'] != 'none'&&$filters['OrgID'] != ''&&$filters['OrgID'] != null)
        {
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunPerencanaan(),false,$filters['OrgID']);        
            $daftar_unitkerja['']='';
        }  
        return view("pages.$theme.rka.rkakegiatanmurni.index")->with(['page_active'=>'rkakegiatanmurni',
                                                                    'daftar_opd'=>$daftar_opd,
                                                                    'daftar_unitkerja'=>$daftar_unitkerja,
                                                                    'filters'=>$filters,
                                                                    'search'=>$this->getControllerStateSession('rkakegiatanmurni','search'),
                                                                    'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                                    'column_order'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','column_name'),
                                                                    'direction'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','order'),
                                                                    'data'=>$data]);               
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $theme = 'dore';
        $filters=$this->getControllerStateSession($this->SessionName,'filters');         
        $locked=false;
        if ($filters['SOrgID'] != 'none'&&$filters['SOrgID'] != ''&&$filters['SOrgID'] != null && $locked==false)
        {
            $SOrgID=$filters['SOrgID'];            
            $OrgID=$filters['OrgID'];

            $organisasi=\App\Models\DMaster\SubOrganisasiModel::select(\DB::raw('"v_suborganisasi"."OrgID","v_suborganisasi"."OrgIDRPJMD","v_suborganisasi"."UrsID","v_suborganisasi"."OrgNm","v_suborganisasi"."SOrgNm","v_suborganisasi"."kode_organisasi","v_suborganisasi"."kode_suborganisasi"'))
                                                                ->join('v_suborganisasi','tmSOrg.OrgID','v_suborganisasi.OrgID')
                                                                ->find($SOrgID);  

            $daftar_program = \App\Models\DMaster\ProgramModel::getDaftarProgramByOPD($organisasi->OrgIDRPJMD);            
            $daftar_pa=[];
            $daftar_kpa=[];
            $daftar_ppk=[];
            $daftar_pptk=[];
            
            return view("pages.$theme.rka.rkakegiatanmurni.create")->with(['page_active'=>'rkakegiatanmurni',
                                                                            'daftar_program'=>$daftar_program,                                                                                                                                                       
                                                                            'daftar_rkpd'=>[],
                                                                            'daftar_pa'=>$daftar_pa,
                                                                            'daftar_kpa'=>$daftar_kpa,
                                                                            'daftar_ppk'=>$daftar_ppk,
                                                                            'daftar_pptk'=>$daftar_pptk,
                                                                        ]);  
        }
        else
        {
            return view("pages.$theme.rka.rkakegiatanmurni.error")->with(['page_active'=>$this->NameOfPage,
                                                                    'page_title'=>\HelperKegiatan::getPageTitle($this->NameOfPage),
                                                                    'errormessage'=>'Mohon unit kerja untuk di pilih terlebih dahulu. bila sudah terpilih ternyata tidak bisa, berarti saudara tidak diperkenankan menambah kegiatan karena telah dikunci.'
                                                                ]);  
        }  
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'PrgID'=>'required',
            'Kd_Keg'=>'required',
            'KgtNm'=>'required',
            'PaguDana1'=>'required',
        ]);
        $filters=$this->getControllerStateSession($this->SessionName,'filters');
        $rkakegiatanmurni = RKAKegiatanMurniModel::create([
            'RKAID' => uniqid ('uid'),
            'OrgID' => $filters['OrgID'],
            'SOrgID' => $filters['SOrgID'],
            'PrgID' => $request->input('PrgID'),
            'RKPDID' => $request->input('RKPDID'),
            'Kd_Keg' => $request->input('Kd_Keg'),
            'KgtNm' => $request->input('KgtNm'),
            'PaguDana1' => $request->input('PaguDana1'),
            'PaguDana1' => 0,
            'nip_pa' => $request->input('nip_pa'),
            'nip_kpa' => $request->input('nip_kpa'),
            'nip_ppk' => $request->input('nip_ppk'),
            'nip_pptk' => $request->input('nip_pptk'),
            'user_id' => $theme = \Auth::user()->id,
            'Descr' => '-',
            'TA' => \HelperKegiatan::getTahunPenyerapan(),
        ]);        
        
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
        }
        else
        {
            return redirect(route('rkakegiatanmurni.show',['id'=>$rkakegiatanmurni->replaceit]))->with('success','Data ini telah berhasil disimpan.');
        }

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

        $data = RKAKegiatanMurniModel::findOrFail($id);
        if (!is_null($data) )  
        {
            return view("pages.$theme.rka.rkakegiatanmurni.show")->with(['page_active'=>'rkakegiatanmurni',
                                                    'data'=>$data
                                                    ]);
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theme = 'dore';
        
        $data = RKAKegiatanMurniModel::findOrFail($id);
        if (!is_null($data) ) 
        {
            return view("pages.$theme.rka.rkakegiatanmurni.edit")->with(['page_active'=>'rkakegiatanmurni',
                                                    'data'=>$data
                                                    ]);
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rkakegiatanmurni = RKAKegiatanMurniModel::find($id);
        
        $this->validate($request, [
            'replaceit'=>'required',
        ]);
        
        $rkakegiatanmurni->replaceit = $request->input('replaceit');
        $rkakegiatanmurni->save();

        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil diubah.'
            ],200);
        }
        else
        {
            return redirect(route('rkakegiatanmurni.show',['id'=>$rkakegiatanmurni->replaceit]))->with('success','Data ini telah berhasil disimpan.');
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $theme = 'dore';
        
        $rkakegiatanmurni = RKAKegiatanMurniModel::find($id);
        $result=$rkakegiatanmurni->delete();
        if ($request->ajax()) 
        {
            $currentpage=$this->getCurrentPageInsideSession('rkakegiatanmurni'); 
            $data=$this->populateData($currentpage);
            if ($currentpage > $data->lastPage())
            {            
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.rka.rkakegiatanmurni.datatable")->with(['page_active'=>'rkakegiatanmurni',
                                                            'search'=>$this->getControllerStateSession('rkakegiatanmurni','search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                            'column_order'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('rkakegiatanmurni.orderby','order'),
                                                            'data'=>$data])->render();      
            
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('rkakegiatanmurni.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
}