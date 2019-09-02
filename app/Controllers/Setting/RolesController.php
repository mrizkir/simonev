<?php

namespace App\Controllers\Setting;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Rules\IgnoreIfDataIsEqualValidation;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller {
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
        if (!$this->checkStateIsExistSession('roles','orderby')) 
        {            
            $this->putControllerStateSession('roles','orderby',['column_name'=>'id','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('roles.orderby','column_name'); 
        $direction=$this->getControllerStateSession('roles.orderby','order'); 
              
        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');        
        $data = Role::select(\DB::raw('DISTINCT roles.id,roles.name,roles.guard_name,(SELECT COUNT(DISTINCT(model_id)) FROM model_has_roles WHERE role_id = roles.id) AS jumlah'))                    
                    ->orderBy($column_order,$direction)
                    ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        $data->setPath(route('roles.index'));
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
        
        $this->setCurrentPageInsideSession('roles',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.roles.datatable")->with(['page_active'=>'roles',
                                                                                'search'=>$this->getControllerStateSession('roles','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('roles.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('roles.orderby','order'),
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
            case 'col-jumlah' :
                $column_name = 'jumlah';
            break;
            default :
                $column_name = 'id';
        }
        $this->putControllerStateSession('roles','orderby',['column_name'=>$column_name,'order'=>$orderby]);        

        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.roles.datatable")->with(['page_active'=>'roles',
                                                                                'search'=>$this->getControllerStateSession('roles','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('roles.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('roles.orderby','order'),
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

        $this->setCurrentPageInsideSession('roles',$id);
        $data=$this->populateData($id);
        $datatable = view("pages.$theme.setting.roles.datatable")->with(['page_active'=>'roles',
                                                                        'search'=>$this->getControllerStateSession('roles','search'),
                                                                        'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                        'column_order'=>$this->getControllerStateSession('roles.orderby','column_name'),
                                                                        'direction'=>$this->getControllerStateSession('roles.orderby','order'),                                                                        
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

        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('roles');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('roles',$data->currentPage());
        return view("pages.$theme.setting.roles.index")->with(['page_active'=>'roles',
                                                                'search'=>$this->getControllerStateSession('roles','search'),
                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                'column_order'=>$this->getControllerStateSession('roles.orderby','column_name'),
                                                                'direction'=>$this->getControllerStateSession('roles.orderby','order'),                                                                        
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

        return view("pages.$theme.setting.roles.create")->with(['page_active'=>'roles'
                                                                    
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
            'name'=>'required|unique:roles',
        ]);
        
        $roles = new Role;
        $roles->name = $request->input('name');
        $roles->save();

        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ]);
        }
        else
        {
            return redirect(route('roles.index'))->with('success','Data ini telah berhasil disimpan.');
        }

    }
    /**
     * Store a roles resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storerolepermission(Request $request)
    {      
        $post = $request->all();
        $permissions = isset($post['chkpermission'])?$post['chkpermission']:[];
        $role_id = $post['role_id'];

        $role = Role::find($role_id);
        $role->syncPermissions($permissions);
            
        return redirect(route('roles.show',$role_id))->with('success','Permission Role ('.$role->name.') berhasil diproses');
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

        $role = Role::select(\DB::raw('DISTINCT roles.id,roles.name,roles.guard_name,(SELECT COUNT(DISTINCT(model_id)) FROM model_has_roles WHERE role_id = roles.id) AS jumlah'))
                    ->find($id);
        if (!is_null($role) )  
        {
            $data_permission = Permission::all();
            $permission_selected = $role->permissions->pluck('name','id')->toArray();            
         
            return view("pages.$theme.setting.roles.show")->with(['page_active'=>'roles',                                                                    
                                                                    'data'=>$role,
                                                                    'data_permission'=>$data_permission,        
                                                                    'permission_selected'=>$permission_selected                                                            
                                                                ]);
        }
        else
        {
            $errormessage="Data dengan ID ($id) tidak ditemukan.";            
            return view("pages.$theme.setting.error")->with(['page_active'=>'permissions',
                                                                    'errormessage'=>$errormessage
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

        $data = Role::find($id);
        if (!is_null($data) ) 
        {
            return view("pages.$theme.setting.roles.edit")->with(['page_active'=>'roles',
                                                                    'data'=>$data
                                                                    ]);
        }
        else
        {
            $errormessage="Data dengan ID ($id) tidak ditemukan.";            
            return view("pages.$theme.setting.error")->with(['page_active'=>'permissions',
                                                                    'errormessage'=>$errormessage
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
        $theme = 'dore';

        $roles = Role::find($id);

        $this->validate($request, [
            'name'=>['required',new IgnoreIfDataIsEqualValidation('roles',$roles->name)],           
        ]);        
       
        $roles->name = $request->input('name');
        $roles->save();

        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil diubah.'
            ]);
        }
        else
        {
            return redirect(route("roles.index"))->with('success',"Data dengan id ($id) telah berhasil diubah.");
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

        $roles = Role::find($id);
        $result=$roles->delete();

        if ($request->ajax()) 
        {
            $currentpage=$this->getCurrentPageInsideSession('roles'); 
            $data=$this->populateData($currentpage);
            if ($currentpage > $data->lastPage())
            {            
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.setting.roles.datatable")->with(['page_active'=>'roles',
                                                                            'search'=>$this->getControllerStateSession('roles','search'),
                                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                            'column_order'=>$this->getControllerStateSession('roles.orderby','column_name'),
                                                                            'direction'=>$this->getControllerStateSession('roles.orderby','order'),                                                                        
                                                                            'data'=>$data])->render();  
                                                                                
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('roles.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
}