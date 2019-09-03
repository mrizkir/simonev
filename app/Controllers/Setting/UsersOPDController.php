<?php

namespace App\Controllers\Setting;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\User;
use App\Rules\IgnoreIfDataIsEqualValidation;

class UsersOPDController extends Controller {
     /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth','role:superadmin|bapelitbang']);  
    }
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateDataOPD ($userid) 
    {        
        $data = \App\Models\UserOPD::where('id',$userid)
                                    ->where('ta',\HelperKegiatan::getTahunPerencanaan())
                                    ->get();
        return $data;
    }
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData ($currentpage=1) 
    {        
        $columns=['*'];       
        if (!$this->checkStateIsExistSession('usersopd','orderby')) 
        {            
           $this->putControllerStateSession('usersopd','orderby',['column_name'=>'id','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('usersopd.orderby','column_name'); 
        $direction=$this->getControllerStateSession('usersopd.orderby','order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');        
        if ($this->checkStateIsExistSession('usersopd','search')) 
        {
            $search=$this->getControllerStateSession('usersopd','search');
            switch ($search['kriteria']) 
            {
                case 'id' :
                    $data = User::role('opd')->where(['users.id'=>$search['isikriteria']])->orderBy($column_order,$direction); 
                break;
                case 'username' :
                    $data = User::role('opd')->where('username', 'ilike', '%' . $search['isikriteria'] . '%')->orderBy($column_order,$direction);                                        
                break;
                case 'nama' :
                    $data = User::role('opd')->where('name', 'ilike', '%' . $search['isikriteria'] . '%')->orderBy($column_order,$direction); 
                break;
                case 'email' :
                    $data = User::role('opd')->where('email', 'ilike', '%' . $search['isikriteria'] . '%')->orderBy($column_order,$direction); 
                break;
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = User::role('opd')->orderBy($column_order,$direction)->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        }                
        $data->setPath(route('usersopd.index'));
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
        
        $this->setCurrentPageInsideSession('usersopd',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.usersopd.datatable")->with(['page_active'=>'usersopd',
                                                                                'search'=>$this->getControllerStateSession('usersopd','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('usersopd.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('usersopd.orderby','order'),
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
            case 'col-username' :
                $column_name = 'username';
            break; 
            case 'col-nama' :
                $column_name = 'nama';
            break; 
            case 'col-email' :
                $column_name = 'email';
            break;              
            default :
                $column_name = 'id';
        }
        $this->putControllerStateSession('usersopd','orderby',['column_name'=>$column_name,'order'=>$orderby]);        

        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.usersopd.datatable")->with(['page_active'=>'usersopd',
                                                            'search'=>$this->getControllerStateSession('usersopd','search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                            'column_order'=>$this->getControllerStateSession('usersopd.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('usersopd.orderby','order'),
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

        $this->setCurrentPageInsideSession('usersopd',$id);
        $data=$this->populateData($id);
        $datatable = view("pages.$theme.setting.usersopd.datatable")->with(['page_active'=>'usersopd',
                                                                            'search'=>$this->getControllerStateSession('usersopd','search'),
                                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                            'column_order'=>$this->getControllerStateSession('usersopd.orderby','column_name'),
                                                                            'direction'=>$this->getControllerStateSession('usersopd.orderby','order'),
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
            $this->destroyControllerStateSession('usersopd','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('usersopd','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('usersopd',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.usersopd.datatable")->with(['page_active'=>'usersopd',                                                            
                                                            'search'=>$this->getControllerStateSession('usersopd','search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                            'column_order'=>$this->getControllerStateSession('usersopd.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('usersopd.orderby','order'),
                                                            'data'=>$data])->render();      
        
        return response()->json(['success'=>true,'datatable'=>$datatable],200);        
    }
    /**
     * filter resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter (Request $request) 
    {
        $theme = 'dore';

        $json_data = [];
        if ($request->exists('OrgID'))
        {
            $OrgID = $request->input('OrgID')==''?'none':$request->input('OrgID');            
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunPerencanaan(),false,$OrgID);  
            
            $json_data = ['success'=>true,'daftar_unitkerja'=>$daftar_unitkerja];
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

        $search=$this->getControllerStateSession('usersopd','search');
        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('usersopd'); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('usersopd',$data->currentPage());
        
        return view("pages.$theme.setting.usersopd.index")->with(['page_active'=>'usersopd',
                                                'search'=>$this->getControllerStateSession('usersopd','search'),
                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                'column_order'=>$this->getControllerStateSession('usersopd.orderby','column_name'),
                                                'direction'=>$this->getControllerStateSession('usersopd.orderby','order'),
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
        return view("pages.$theme.setting.usersopd.create")->with(['page_active'=>'usersopd']);  
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
            'email'=>'required|string|email|unique:users',
            'username'=>'required|string|unique:users',
            'password'=>'required',    
        ]);
        $OrgID=$request->input('OrgID');
        $SOrgID=$request->input('SOrgID');
        $now = \Carbon\Carbon::now()->toDateTimeString();        
        $user=User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'username'=> $request->input('username'),
            'password'=>\Hash::make($request->input('password')),            
            'email_verified_at'=>\Carbon\Carbon::now(),
            'theme'=> "dore",
            'created_at'=>$now, 
            'updated_at'=>$now
        ]);                    
        $user->assignRole('opd');        
        if ($request->input('do_sync')==1)
        {
            $user->syncPermissions($user->getPermissionsViaRoles()->pluck('name')->toArray());
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
            return redirect(route('usersopd.show',['id'=>$user->id]))->with('success','Data ini telah berhasil disimpan.');
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

        $data = User::findOrFail($id);
        if (!is_null($data) )  
        {
            $dataopd=$this->populateDataOPD($data->id);
            $daftar_opd=\App\Models\DMaster\OrganisasiModel::getDaftarOPD(\HelperKegiatan::getTahunPerencanaan(),false);
            return view("pages.$theme.setting.usersopd.show")->with(['page_active'=>'usersopd',
                                                                    'daftar_opd'=>$daftar_opd,
                                                                    'dataopd'=>$dataopd,
                                                                    'data'=>$data
                                                                ]);
        }        
    }
    public function changelocked (Request $request, $id)
    {
        $theme = 'dore';

        $json_data = [];
        if ($request->exists('locked'))
        {
            $locked = $request->input('locked');
            $user=\App\Models\UserOPD::find($id);
            $user->locked=$locked;
            $user->save();
            $dataopd=$this->populateDataOPD($user->id);

            $datatable=view("pages.$theme.setting.usersopd.datatableopd")->with(['page_active'=>'usersopd',
                                                                            'dataopd'=>$dataopd
                                                                        ])->render();
            $json_data = ['success'=>true,'datatable'=>$datatable];
        } 
        else if ($request->exists('lockall'))
        {
            $json_data=\DB::table('usersopd')
                            ->where('ta',\HelperKegiatan::getTahunPerencanaan())
                            ->update(['locked'=>1]);
        }
        else if ($request->exists('unlockall'))
        {
            $json_data=\DB::table('usersopd')
                            ->where('ta',\HelperKegiatan::getTahunPerencanaan())
                            ->update(['locked'=>0]);
        }
        return response()->json($json_data,200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request, $id)
    {
        $this->validate($request, [              
            'OrgID'=>'required',
        ]);        
        $OrgID=$request->input('OrgID');
        $SOrgID=$request->input('SOrgID');
        $locked=$request->input('locked')==1?true:false;
        $now = \Carbon\Carbon::now()->toDateTimeString();        
        $user=\App\Models\UserOPD::create([
            'id'=>$id,            
            'ta'=>\HelperKegiatan::getTahunPerencanaan(),            
            'OrgID'=> $OrgID,
            'OrgNm'=> \App\Models\DMaster\OrganisasiModel::find($OrgID)->OrgNm,
            'SOrgID'=> $SOrgID,
            'SOrgNm'=> \App\Models\DMaster\SubOrganisasiModel::getNamaUnitKerjaByID($request->input('SOrgID')),            
            'locked'=> $locked,
            'created_at'=>$now, 
            'updated_at'=>$now
        ]); 
        
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ]);
        }
        else
        {
            return redirect(route('usersopd.show',['id'=>$user->id]))->with('success','Data ini telah berhasil disimpan.');
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
        $data = User::findOrFail($id);
        if (!is_null($data) ) 
        {
            return view("pages.$theme.setting.usersopd.edit")->with(['page_active'=>'usersopd',                                                                   
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
        $user = User::find($id);

        $this->validate($request, [
            'username'=>['required',new IgnoreIfDataIsEqualValidation('users',$user->username)],           
            'name'=>'required',            
            'email'=>'required|string|email|unique:users,email,'.$id,              
        ]);        
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        if (!empty(trim($request->input('password')))) {
            $user->password = \Hash::make($request->input('password'));
        }  
        $user->updated_at = \Carbon\Carbon::now()->toDateTimeString();        
        $user->save();

        $user->syncRoles('opd');
        if ($request->input('do_sync')==1)
        {
            $user->syncPermissions($user->getPermissionsViaRoles()->pluck('name')->toArray());
        }
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil diubah.'
            ]);
        }
        else
        {
            return redirect(route('usersopd.show',['id'=>$user->id]))->with('success',"Data dengan id ($id) telah berhasil diubah.");
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
        if ($request->exists('useropd'))
        {
            $user=\App\Models\UserOPD::find($id);
            $userid=$user->id;
            $result=$user->delete();
            if ($request->ajax()) 
            {
                $dataopd=$this->populateDataOPD($userid);
                $datatable = view("pages.$theme.setting.usersopd.datatableopd")->with(['page_active'=>'usersopd',                                                                                
                                                                                'dataopd'=>$dataopd])->render(); 
                
                return response()->json(['success'=>true,'datatable'=>$datatable],200); 
            }
            else
            {
                return redirect(route('usersopd.show',['id'=>$userid]))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
            }
        }
        else
        {
            $usersopd = User::find($id);
            $result=$usersopd->delete();
            if ($request->ajax()) 
            {
            
                $currentpage=$this->getCurrentPageInsideSession('usersopd'); 
                $data=$this->populateData($currentpage);
                if ($currentpage > $data->lastPage())
                {            
                    $data = $this->populateData($data->lastPage());
                }
                $datatable = view("pages.$theme.setting.usersopd.datatable")->with(['page_active'=>'usersopd',
                                                                                    'search'=>$this->getControllerStateSession('usersopd','search'),
                                                                                    'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                                                    'column_order'=>$this->getControllerStateSession('usersopd.orderby','column_name'),
                                                                                    'direction'=>$this->getControllerStateSession('usersopd.orderby','order'),
                                                                                    'data'=>$data])->render();      
                
                return response()->json(['success'=>true,'datatable'=>$datatable],200); 
            }
            else
            {
                return redirect(route('usersopd.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
            }    

        }
           
    }
}