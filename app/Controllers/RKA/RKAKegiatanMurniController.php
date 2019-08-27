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
        $daftar_opd=\App\Models\DMaster\OrganisasiModel::getDaftarOPD(\HelperKegiatan::getTahunPerencanaan(),false);  
        $daftar_unitkerja=[];
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

        return view("pages.$theme.rka.rkakegiatanmurni.create")->with(['page_active'=>'rkakegiatanmurni',
                                                                    
                                                                    ]);  
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
            'replaceit'=>'required',
        ]);
        
        $rkakegiatanmurni = RKAKegiatanMurniModel::create([
            'replaceit' => $request->input('replaceit'),
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