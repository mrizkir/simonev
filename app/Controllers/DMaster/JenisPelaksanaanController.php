<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\JenisPelaksanaanModel;
use Illuminate\Http\Request;

class JenisPelaksanaanController extends Controller
{
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
    public function populateData($currentpage = 1)
    {
        $columns = ['*'];
        if (!$this->checkStateIsExistSession('jenispelaksanaan', 'orderby')) {
            $this->putControllerStateSession('jenispelaksanaan', 'orderby', ['column_name' => 'NamaJenis', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('jenispelaksanaan.orderby', 'column_name');
        $direction = $this->getControllerStateSession('jenispelaksanaan.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = JenisPelaksanaanModel::where('TA', \HelperKegiatan::getTahunAnggaran())
                        ->orderBy($column_order, $direction)
                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('jenispelaksanaan.index'));
        return $data;
    }
    /**
     * digunakan untuk mengganti jumlah record per halaman
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changenumberrecordperpage(Request $request)
    {
        $theme = 'dore';

        $numberRecordPerPage = $request->input('numberRecordPerPage');
        $this->putControllerStateSession('global_controller', 'numberRecordPerPage', $numberRecordPerPage);

        $this->setCurrentPageInsideSession('jenispelaksanaan', 1);
        $data = $this->populateData();


        $datatable = view("pages.$theme.dmaster.jenispelaksanaan.datatable")->with(['page_active' => 'jenispelaksanaan',
                                                                                    'search' => $this->getControllerStateSession('jenispelaksanaan', 'search'),
                                                                                    'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                    'column_order' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'column_name'),
                                                                                    'direction' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'order'),
                                                                                    'data' => $data])->render();

        return response()->json(['success' => true, 'datatable' => $datatable], 200);
    }
    /**
     * digunakan untuk mengurutkan record
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderby(Request $request)
    {
        $theme = 'dore';

        $orderby = $request->input('orderby') == 'asc' ? 'desc' : 'asc';
        $column = $request->input('column_name');
        switch ($column) {
            case 'col-NamaJenis':
                $column_name = 'NamaJenis';
            break;
            default:
                $column_name = 'NamaJenis';
        }
        $this->putControllerStateSession('jenispelaksanaan', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('jenispelaksanaan');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.jenispelaksanaan.datatable")->with(['page_active' => 'jenispelaksanaan',
                                                                            'search' => $this->getControllerStateSession('jenispelaksanaan', 'search'),
                                                                            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                            'column_order' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'column_name'),
                                                                            'direction' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'order'),
                                                                            'data' => $data])->render();

        return response()->json(['success' => true, 'datatable' => $datatable], 200);
    }
    /**
     * paginate resource in storage called by ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginate($id)
    {
        $theme = 'dore';

        $this->setCurrentPageInsideSession('jenispelaksanaan', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.jenispelaksanaan.datatable")->with([
                                                                                    'page_active' => 'jenispelaksanaan',
                                                                                    'search' => $this->getControllerStateSession('jenispelaksanaan', 'search'),
                                                                                    'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                    'column_order' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'column_name'),
                                                                                    'direction' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'order'),
                                                                                    'data' => $data
                                                                                ])->render();
        return response()->json(['success' => true, 'datatable' => $datatable], 200);
    }
    /**
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $theme = 'dore';

        $action = $request->input('action');
        if ($action == 'reset') {
            $this->destroyControllerStateSession('jenispelaksanaan', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('jenispelaksanaan', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('jenispelaksanaan', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.jenispelaksanaan.datatable")->with(['page_active' => 'jenispelaksanaan',
                                                                                'search' => $this->getControllerStateSession('jenispelaksanaan', 'search'),
                                                                                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                'column_order' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'column_name'),
                                                                                'direction' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'order'),
                                                                                'data' => $data])->render();

        return response()->json(['success' => true, 'datatable' => $datatable], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $theme = 'dore';

        $search = $this->getControllerStateSession('jenispelaksanaan', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('jenispelaksanaan');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) 
        {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('jenispelaksanaan', $data->currentPage());

        return view("pages.$theme.dmaster.jenispelaksanaan.index")->with(['page_active' => 'jenispelaksanaan',
                                                                        'search' => $this->getControllerStateSession('jenispelaksanaan', 'search'),
                                                                        'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                        'column_order' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'column_name'),
                                                                        'direction' => $this->getControllerStateSession('jenispelaksanaan.orderby', 'order'),
                                                                        'data' => $data,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $theme = 'dore';
        return view("pages.$theme.dmaster.jenispelaksanaan.create")->with(['page_active'=>'jenispelaksanaan',
                                                                    
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
            'NamaJenis'=>'required|min:5',
        ]);
        
        $jns = $request->input('Jns');

        $jenispelaksanaan = JenisPelaksanaanModel::create ([
            'JenisPelaksanaanID'=> uniqid ('uid'),
            'NamaJenis' => $request->input('NamaJenis'),
            'Descr' => $request->input('Descr'),
            'TA'=>\HelperKegiatan::getTahunAnggaran(),
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
            return redirect(route('jenispelaksanaan.show',['uuid'=>$jenispelaksanaan->JenisPelaksanaanID]))->with('success','Data ini telah berhasil disimpan.');
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $theme = 'dore';

        $data = JenisPelaksanaanModel::where('JenisPelaksanaanID', $uuid)
                        ->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.jenispelaksanaan.show")->with(['page_active' => 'jenispelaksanaan',
                                                                'data' => $data,
                                                            ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $theme = 'dore';
        
        $data = JenisPelaksanaanModel::findOrFail($uuid);
        if (!is_null($data) ) 
        {
            return view("pages.$theme.dmaster.jenispelaksanaan.edit")->with(['page_active'=>'rkakegiatanmurni',
                                                    'data'=>$data
                                                    ]);
        }        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$uuid)
    {        
        $jenispelaksanaan = JenisPelaksanaanModel::find($uuid);
        
        $this->validate($request, [            
            'NamaJenis'=>'required|min:5',
        ]);
        
        $jenispelaksanaan->NamaJenis = $request->input('NamaJenis');
        $jenispelaksanaan->Descr = $request->input('Descr');
        $jenispelaksanaan->save();
     
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ]);
        }
        else
        {
            return redirect(route('jenispelaksanaan.show',['uuid'=>$jenispelaksanaan->JenisPelaksanaanID]))->with('success','Data ini telah berhasil disimpan.');
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$uuid)
    {
        $theme = 'dore';
        
        $jenispelaksanaan = JenisPelaksanaanModel::find($uuid);
        $result=$jenispelaksanaan->delete();
        if ($request->ajax()) 
        {
            $currentpage=$this->getCurrentPageInsideSession('jenispelaksanaan'); 
            $data=$this->populateData($currentpage);
            if ($currentpage > $data->lastPage())
            {            
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.jenispelaksanaan.datatable")->with(['page_active'=>'jenispelaksanaan',
                                                                                        'search'=>$this->getControllerStateSession('jenispelaksanaan','search'),
                                                                                        'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                                                        'column_order'=>$this->getControllerStateSession('jenispelaksanaan.orderby','column_name'),
                                                                                        'direction'=>$this->getControllerStateSession('jenispelaksanaan.orderby','order'),
                                                                                        'data'=>$data])->render();      
            
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('jenispelaksanaan.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
}
