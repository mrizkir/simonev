<?php

namespace App\Controllers\Setting;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\User;
use App\Rules\IgnoreIfDataIsEqualValidation;

class UsersBapelitbangController extends Controller {
     /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth','role:superadmin|simonev']);  
    }
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData ($currentpage=1) 
    {        
        $columns=['*'];       
        if (!$this->checkStateIsExistSession('usersbapelitbang','orderby')) 
        {            
           $this->putControllerStateSession('usersbapelitbang','orderby',['column_name'=>'id','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('usersbapelitbang.orderby','column_name'); 
        $direction=$this->getControllerStateSession('usersbapelitbang.orderby','order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');        
        if ($this->checkStateIsExistSession('usersbapelitbang','search')) 
        {
            $search=$this->getControllerStateSession('usersbapelitbang','search');
            switch ($search['kriteria']) 
            {
                case 'id' :
                    $data = User::role('simonev')->where(['users.id'=>$search['isikriteria']])->orderBy($column_order,$direction); 
                break;
                case 'username' :
                    $data = User::role('simonev')->where('username', 'ilike', '%' . $search['isikriteria'] . '%')->orderBy($column_order,$direction);                                        
                break;
                case 'nama' :
                    $data = User::role('simonev')->where('name', 'ilike', '%' . $search['isikriteria'] . '%')->orderBy($column_order,$direction); 
                break;
                case 'email' :
                    $data = User::role('simonev')->where('email', 'ilike', '%' . $search['isikriteria'] . '%')->orderBy($column_order,$direction); 
                break;
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = User::role('simonev')->orderBy($column_order,$direction)->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        }                
        $data->setPath(route('usersbapelitbang.index'));
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
        
        $this->setCurrentPageInsideSession('usersbapelitbang',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.usersbapelitbang.datatable")->with(['page_active'=>'usersbapelitbang',
                                                                                'search'=>$this->getControllerStateSession('usersbapelitbang','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('usersbapelitbang.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('usersbapelitbang.orderby','order'),
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
        $this->putControllerStateSession('usersbapelitbang','orderby',['column_name'=>$column_name,'order'=>$orderby]);        

        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.usersbapelitbang.datatable")->with(['page_active'=>'usersbapelitbang',
                                                            'search'=>$this->getControllerStateSession('usersbapelitbang','search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                            'column_order'=>$this->getControllerStateSession('usersbapelitbang.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('usersbapelitbang.orderby','order'),
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

        $this->setCurrentPageInsideSession('usersbapelitbang',$id);
        $data=$this->populateData($id);
        $datatable = view("pages.$theme.setting.usersbapelitbang.datatable")->with(['page_active'=>'usersbapelitbang',
                                                                            'search'=>$this->getControllerStateSession('usersbapelitbang','search'),
                                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                            'column_order'=>$this->getControllerStateSession('usersbapelitbang.orderby','column_name'),
                                                                            'direction'=>$this->getControllerStateSession('usersbapelitbang.orderby','order'),
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
            $this->destroyControllerStateSession('usersbapelitbang','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('usersbapelitbang','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('usersbapelitbang',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.setting.usersbapelitbang.datatable")->with(['page_active'=>'usersbapelitbang',                                                            
                                                            'search'=>$this->getControllerStateSession('usersbapelitbang','search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                            'column_order'=>$this->getControllerStateSession('usersbapelitbang.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('usersbapelitbang.orderby','order'),
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
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                
        $theme = 'dore';

        $search=$this->getControllerStateSession('usersbapelitbang','search');
        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('usersbapelitbang'); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('usersbapelitbang',$data->currentPage());
        
        return view("pages.$theme.setting.usersbapelitbang.index")->with(['page_active'=>'usersbapelitbang',
                                                'search'=>$this->getControllerStateSession('usersbapelitbang','search'),
                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                'column_order'=>$this->getControllerStateSession('usersbapelitbang.orderby','column_name'),
                                                'direction'=>$this->getControllerStateSession('usersbapelitbang.orderby','order'),
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
        return view("pages.$theme.setting.usersbapelitbang.create")->with(['page_active'=>'usersbapelitbang']);  
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
        $user->assignRole('simonev');        
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
            return redirect(route('usersbapelitbang.show',['id'=>$user->id]))->with('success','Data ini telah berhasil disimpan.');
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
            return view("pages.$theme.setting.usersbapelitbang.show")->with(['page_active'=>'usersbapelitbang',
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
        
        $data = User::findOrFail($id);
        if (!is_null($data) ) 
        {           
            return view("pages.$theme.setting.usersbapelitbang.edit")->with(['page_active'=>'usersbapelitbang',                                                                   
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
        $user->theme = "dore";
        $user->updated_at = \Carbon\Carbon::now()->toDateTimeString();        
        $user->save();

        $user->syncRoles('simonev');
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
            return redirect(route('usersbapelitbang.show',['id'=>$user->id]))->with('success',"Data dengan id ($id) telah berhasil diubah.");
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
        $usersbapelitbang = User::find($id);
        $result=$usersbapelitbang->delete();
        if ($request->ajax()) 
        {
            $currentpage=$this->getCurrentPageInsideSession('usersbapelitbang'); 
            $data=$this->populateData($currentpage);
            if ($currentpage > $data->lastPage())
            {            
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.setting.usersbapelitbang.datatable")->with(['page_active'=>'usersbapelitbang',
                                                            'search'=>$this->getControllerStateSession('usersbapelitbang','search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                            'column_order'=>$this->getControllerStateSession('usersbapelitbang.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('usersbapelitbang.orderby','order'),
                                                            'data'=>$data])->render();      
            
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('usersbapelitbang.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
}