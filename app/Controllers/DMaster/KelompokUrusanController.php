<?php

namespace App\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\DMaster\KelompokUrusanModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;

class KelompokUrusanController extends Controller {    
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
        if (!$this->checkStateIsExistSession('kelompokurusan','orderby')) 
        {            
           $this->putControllerStateSession('kelompokurusan','orderby',['column_name'=>'Kd_Urusan','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('kelompokurusan.orderby','column_name'); 
        $direction=$this->getControllerStateSession('kelompokurusan.orderby','order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');        
  
        $data = KelompokUrusanModel::where('TA',\HelperKegiatan::getRPJMDTahunMulai())->orderBy($column_order,$direction)->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        
        $data->setPath(route('kelompokurusan.index'));
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
        
        $this->setCurrentPageInsideSession('kelompokurusan',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with(['page_active'=>'kelompokurusan',
                                                                                        'search'=>$this->getControllerStateSession('kelompokurusan','search'),
                                                                                        'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                        'column_order'=>$this->getControllerStateSession('kelompokurusan.orderby','column_name'),
                                                                                        'direction'=>$this->getControllerStateSession('kelompokurusan.orderby','order'),
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
            case 'col-Kd_Urusan' :
                $column_name = 'Kd_Urusan';
            break;     
            case 'col-Nm_Urusan' :
                $column_name = 'Nm_Urusan';
            break;       
            default :
                $column_name = 'Kd_Urusan';
        }
        $this->putControllerStateSession('kelompokurusan','orderby',['column_name'=>$column_name,'order'=>$orderby]);        

        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('kelompokurusan'); 
        $data=$this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with(['page_active'=>'kelompokurusan',
                                                                                        'search'=>$this->getControllerStateSession('kelompokurusan','search'),
                                                                                        'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                        'column_order'=>$this->getControllerStateSession('kelompokurusan.orderby','column_name'),
                                                                                        'direction'=>$this->getControllerStateSession('kelompokurusan.orderby','order'),
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

        $this->setCurrentPageInsideSession('kelompokurusan',$id);
        $data=$this->populateData($id);
        $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with(['page_active'=>'kelompokurusan',
                                                                                        'search'=>$this->getControllerStateSession('kelompokurusan','search'),
                                                                                        'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                        'column_order'=>$this->getControllerStateSession('kelompokurusan.orderby','column_name'),
                                                                                        'direction'=>$this->getControllerStateSession('kelompokurusan.orderby','order'),
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
            $this->destroyControllerStateSession('kelompokurusan','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('kelompokurusan','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('kelompokurusan',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with(['page_active'=>'kelompokurusan',                                                            
                                                                                        'search'=>$this->getControllerStateSession('kelompokurusan','search'),
                                                                                        'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                        'column_order'=>$this->getControllerStateSession('kelompokurusan.orderby','column_name'),
                                                                                        'direction'=>$this->getControllerStateSession('kelompokurusan.orderby','order'),
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

        $search=$this->getControllerStateSession('kelompokurusan','search');
        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('kelompokurusan'); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('kelompokurusan',$data->currentPage());
        
        return view("pages.$theme.dmaster.kelompokurusan.index")->with(['page_active'=>'kelompokurusan',
                                                                                'search'=>$this->getControllerStateSession('kelompokurusan','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                                                'column_order'=>$this->getControllerStateSession('kelompokurusan.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('kelompokurusan.orderby','order'),
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

        return view("pages.$theme.dmaster.kelompokurusan.create")->with(['page_active'=>'kelompokurusan',
                                                                    
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
        $this->validate($request,
        [
            'Kd_Urusan'=>[new CheckRecordIsExistValidation('tmKUrs',['where'=>['TA','=',\HelperKegiatan::getRPJMDTahunMulai()]]),
                            'required',
                            'min:1',
                            'max:4',
                        ],   
            'Nm_Urusan'=>'required|min:5', 
        ],
        [
            'Kd_Urusan.required'=>'Mohon Kode Kelompok Urusan untuk di isi karena ini diperlukan',
            'Kd_Urusan.min'=>'Mohon Kode Kelompok Urusan untuk di isi minimal 1 digit',
            'Kd_Urusan.max'=>'Mohon Kode Kelompok Urusan untuk di isi maksimal 4 digit',
            'Nm_Urusan.required'=>'Mohon Nama Kelompok Urusan untuk di isi karena ini diperlukan',
            'Nm_Urusan.min'=>'Mohon Nama Kelompok Urusan di isi minimal 5 karakter'
        ]
        );

        $kelompokurusan = KelompokUrusanModel::create ([
            'KUrsID'=> uniqid ('uid'),
            'RpjmdVisiID'=>config('eplanning.rpjmd_visi_id'),
            'Kd_Urusan'=>$request->input('Kd_Urusan'),
            'Nm_Urusan'=>$request->input('Nm_Urusan'),
            'Descr'=>$request->input('Descr'),
            'TA'=>\HelperKegiatan::getRPJMDTahunMulai(),
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
            return redirect(route('kelompokurusan.show',['id'=>$kelompokurusan->KUrsID]))->with('success','Data ini telah berhasil disimpan.');
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

        $data = KelompokUrusanModel::where('KUrsID',$id)
                                    ->firstOrFail();
        if (!is_null($data) )  
        {
            return view("pages.$theme.dmaster.kelompokurusan.show")->with(['page_active'=>'kelompokurusan',
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
        
        $data = KelompokUrusanModel::where('TA',\HelperKegiatan::getRPJMDTahunMulai())
                                    ->where('KUrsID',$id)
                                    ->firstOrFail();
        if (!is_null($data) ) 
        {
            return view("pages.$theme.dmaster.kelompokurusan.edit")->with(['page_active'=>'kelompokurusan',
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
        $kelompokurusan = KelompokUrusanModel::find($id);
        $this->validate($request, 
        [
            'Kd_Urusan'=>[new IgnoreIfDataIsEqualValidation('tmKUrs',$kelompokurusan->Kd_Urusan,['where'=>['TA','=',\HelperKegiatan::getRPJMDTahunMulai()]]),
                            'required',
                            'min:1',
                            'max:4',
                        ],   
            'Nm_Urusan'=>'required|min:5', 
        ],
        [
            'Kd_Urusan.required'=>'Mohon Kode Kelompok Urusan untuk di isi karena ini diperlukan',
            'Kd_Urusan.min'=>'Mohon Kode Kelompok Urusan untuk di isi minimal 1 digit',
            'Kd_Urusan.max'=>'Mohon Kode Kelompok Urusan untuk di isi maksimal 4 digit',
            'Nm_Urusan.required'=>'Mohon Nama Kelompok Urusan untuk di isi karena ini diperlukan',
            'Nm_Urusan.min'=>'Mohon Nama Kelompok Urusan di isi minimal 5 karakter'        
        ]);        
        
        $kelompokurusan->Kd_Urusan = $request->input('Kd_Urusan');
        $kelompokurusan->Nm_Urusan = $request->input('Nm_Urusan');
        $kelompokurusan->Descr = $request->input('Descr');
        $kelompokurusan->save();

        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil diubah.'
            ]);
        }
        else
        {
            return redirect(route('kelompokurusan.show',['id'=>$kelompokurusan->KUrsID]))->with('success',"Data dengan id ($id) telah berhasil diubah.");
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
        
        $kelompokurusan = KelompokUrusanModel::find($id);
        \DB::update('UPDATE "tmPrg" SET "Jns"=false FROM "v_urusan_program","tmPrg" AS program WHERE program."PrgID"=v_urusan_program."PrgID" AND v_urusan_program."KUrsID"=?',[$kelompokurusan->KUrsID]);
        $result=$kelompokurusan->delete();
        if ($request->ajax()) 
        {
            $currentpage=$this->getCurrentPageInsideSession('kelompokurusan'); 
            $data=$this->populateData($currentpage);
            if ($currentpage > $data->lastPage())
            {            
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with(['page_active'=>'kelompokurusan',
                                                            'search'=>$this->getControllerStateSession('kelompokurusan','search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                            'column_order'=>$this->getControllerStateSession('kelompokurusan.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('kelompokurusan.orderby','order'),
                                                            'data'=>$data])->render();      
            
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('kelompokurusan.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
    /**
     * digunakan untuk mendapatkan kode kelompok urusan
     */

    public function getkodekelompokurusan(Request $request,$id)
    {
        $data_kelompok = KelompokUrusanModel::where('KUrsID',$id)
                                            ->get()->pluck('Kd_Urusan')->toArray();
        $kode_kelompok_urusan = null;
        if (isset($data_kelompok[0]))
        {
            $kode_kelompok_urusan=$data_kelompok[0];
        }
        return response()->json(['success'=>true,'kodekelompokurusan'=>$kode_kelompok_urusan],200);
    }
}