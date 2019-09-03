<?php

namespace App\Controllers\Setting;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller {
     /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth','role:superadmin']);
    }
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData ($currentpage=1) {        
        $columns=['*'];        
        if (!$this->checkStateIsExistSession('permissions','orderby')) 
        {            
            $this->putControllerStateSession('permissions','orderby',['column_name'=>'id','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('permissions.orderby','column_name'); 
        $direction=$this->getControllerStateSession('permissions.orderby','order'); 
        
        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');        
        if ($this->checkStateIsExistSession('permissions','search')) 
        {
            $search=$this->getControllerStateSession('permissions','search');
            switch ($search['kriteria']) 
            {
                case 'nama' :
                    $data = Permission::where('name', 'ilike', '%' . $search['isikriteria'] . '%')->orderBy($column_order,$direction); 
                break;
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = Permission::orderBy($column_order,$direction)->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        }        
        $data->setPath(route('permissions.index'));
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
        
        $this->setCurrentPageInsideSession('permissions',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.permissions.datatable")->with(['page_active'=>'permissions',
                                                                                'search'=>$this->getControllerStateSession('permissions','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('permissions.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('permissions.orderby','order'),
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
            case 'col-id' :
                $column_name = 'id';
            break;
            case 'col-name' :
                $column_name = 'name';
            break;
            case 'col-guard' :
                $column_name = 'guard_name';
            break;
            default :
                $column_name = 'id';
        }
        $this->putControllerStateSession('permissions','orderby',['column_name'=>$column_name,'order'=>$orderby]);        

        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.permissions.datatable")->with(['page_active'=>'permissions',
                                                                                'search'=>$this->getControllerStateSession('permissions','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('permissions.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('permissions.orderby','order'),
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

        $this->setCurrentPageInsideSession('permissions',$id);
        $data=$this->populateData($id);
        $datatable = view("pages.$theme.setting.permissions.datatable")->with(['page_active'=>'permissions',
                                                                                'search'=>$this->getControllerStateSession('permissions','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('permissions.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('permissions.orderby','order'),
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
            $this->destroyControllerStateSession('permissions','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('permissions','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('permissions',1);
        $data=$this->populateData();
        
        $datatable = view("pages.$theme.setting.permissions.datatable")->with(['page_active'=>'permissions',
                                                                                'search'=>$this->getControllerStateSession('permissions','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('permissions.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('permissions.orderby','order'),
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

        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('permissions'); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('permissions',$data->currentPage());
        return view("pages.$theme.setting.permissions.index")->with(['page_active'=>'permissions',
                                                                    'search'=>$this->getControllerStateSession('permissions','search'),
                                                                    'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                                    'column_order'=>$this->getControllerStateSession('permissions.orderby','column_name'),
                                                                    'direction'=>$this->getControllerStateSession('permissions.orderby','order'),
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

        return view("pages.$theme.setting.permissions.create")->with(['page_active'=>'permissions'                                                                    
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
            'name'=>'required',
        ]);
        $aksi = $request->input('aksi');
        if (count ($aksi) > 0 ) {
            $permission = new Permission;        
            $now = \Carbon\Carbon::now()->toDateTimeString();
            $nama = $request->input('name');   
            $data = array();         
            foreach ($aksi as $k=>$v) {                     
                $nama_permission = "{$v}_{$nama}";
                $data[]=array('name'=>$nama_permission,
                              'guard_name'=>'web',
                              'created_at'=>$now, 
                              'updated_at'=>$now);
            }
            $permission->insert($data);
        }       
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ]);
        }
        else
        {
            return redirect(route('permissions.index'))->with('success','Data ini telah berhasil disimpan.');
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

        $data = Permission::find($id);
        if (!is_null($data) )  
        {
            return view("pages.$theme.setting.permissions.show")->with(['page_active'=>'permissions',
                                                                        'data'=>$data
                                                                        ]);
        }
        else
        {            
            $errormessage="Data dengan ID ($id) tidak ditemukan.";            
            return view("pages.$theme.setting.permissions.show")->with(['page_active'=>'permissions',
                                                                    'errormessage'=>$errormessage
                                                                ]);
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
        
        $permissions = Permission::find($id);
        $result=$permissions->delete();
        if ($request->ajax()) 
        {
            $currentpage=$this->getCurrentPageInsideSession('permissions'); 
            $data=$this->populateData($currentpage);
            if ($currentpage > $data->lastPage())
            {            
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.setting.permissions.datatable")->with(['page_active'=>'permissions',
                                                                                    'search'=>$this->getControllerStateSession('permissions','search'),
                                                                                    'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                    'column_order'=>$this->getControllerStateSession('permissions.orderby','column_name'),
                                                                                    'direction'=>$this->getControllerStateSession('permissions.orderby','order'),
                                                                                    'data'=>$data])->render();      
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('permissions.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
}