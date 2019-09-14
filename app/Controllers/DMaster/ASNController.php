<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\ASNModel;
use Illuminate\Http\Request;

class ASNController extends Controller
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
        if (!$this->checkStateIsExistSession('asn', 'orderby')) {
            $this->putControllerStateSession('asn', 'orderby', ['column_name' => 'NIP_ASN', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('asn.orderby', 'column_name');
        $direction = $this->getControllerStateSession('asn.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = ASNModel::where('TA', \HelperKegiatan::getTahunPenyerapan())
                        ->orderBy($column_order, $direction)
                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('asn.index'));
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

        $this->setCurrentPageInsideSession('asn', 1);
        $data = $this->populateData();


        $datatable = view("pages.$theme.dmaster.asn.datatable")->with(['page_active' => 'asn',
                                                                                    'search' => $this->getControllerStateSession('asn', 'search'),
                                                                                    'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                    'column_order' => $this->getControllerStateSession('asn.orderby', 'column_name'),
                                                                                    'direction' => $this->getControllerStateSession('asn.orderby', 'order'),
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
            case 'col-NIP_ASN':
                $column_name = 'NIP_ASN';
                break;
            case 'col-Nm_Urusan':
                $column_name = 'Nm_Urusan';
                break;
            default:
                $column_name = 'NIP_ASN';
        }
        $this->putControllerStateSession('asn', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('asn');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.asn.datatable")->with(['page_active' => 'asn',
                                                                            'search' => $this->getControllerStateSession('asn', 'search'),
                                                                            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                            'column_order' => $this->getControllerStateSession('asn.orderby', 'column_name'),
                                                                            'direction' => $this->getControllerStateSession('asn.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('asn', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.asn.datatable")->with([
                                                                                    'page_active' => 'asn',
                                                                                    'search' => $this->getControllerStateSession('asn', 'search'),
                                                                                    'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                    'column_order' => $this->getControllerStateSession('asn.orderby', 'column_name'),
                                                                                    'direction' => $this->getControllerStateSession('asn.orderby', 'order'),
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
            $this->destroyControllerStateSession('asn', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('asn', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('asn', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.asn.datatable")->with(['page_active' => 'asn',
                                                                                'search' => $this->getControllerStateSession('asn', 'search'),
                                                                                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                'column_order' => $this->getControllerStateSession('asn.orderby', 'column_name'),
                                                                                'direction' => $this->getControllerStateSession('asn.orderby', 'order'),
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

        $search = $this->getControllerStateSession('asn', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('asn');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) 
        {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('asn', $data->currentPage());

        return view("pages.$theme.dmaster.asn.index")->with(['page_active' => 'asn',
                                                                        'search' => $this->getControllerStateSession('asn', 'search'),
                                                                        'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                        'column_order' => $this->getControllerStateSession('asn.orderby', 'column_name'),
                                                                        'direction' => $this->getControllerStateSession('asn.orderby', 'order'),
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
        return view("pages.$theme.dmaster.asn.create")->with(['page_active'=>'asn',
                                                                    
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
            'NIP_ASN'=>'required||digits:20|regex:/^[0-9]+$/',
            'Nm_ASN'=>'required|min:5',
        ]);
        
        $jns = $request->input('Jns');

        $asn = ASNModel::create ([
            'ASNID'=> uniqid ('uid'),
            'NIP_ASN' => $request->input('NIP_ASN'),
            'Nm_ASN' => $request->input('Nm_ASN'),
            'Descr' => $request->input('Descr'),
            'TA'=>\HelperKegiatan::getTahunPenyerapan(),
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
            return redirect(route('asn.show',['uuid'=>$asn->ASNID]))->with('success','Data ini telah berhasil disimpan.');
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

        $data = ASNModel::where('ASNID', $uuid)
                        ->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.asn.show")->with(['page_active' => 'asn',
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
        
        $data = ASNModel::findOrFail($uuid);
        if (!is_null($data) ) 
        {
            return view("pages.$theme.dmaster.asn.edit")->with(['page_active'=>'rkakegiatanmurni',
                                                    'data'=>$data
                                                    ]);
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
        
        $asn = ASNModel::find($uuid);
        $result=$asn->delete();
        if ($request->ajax()) 
        {
            $currentpage=$this->getCurrentPageInsideSession('asn'); 
            $data=$this->populateData($currentpage);
            if ($currentpage > $data->lastPage())
            {            
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.asn.datatable")->with(['page_active'=>'asn',
                                                                                        'search'=>$this->getControllerStateSession('asn','search'),
                                                                                        'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                                                        'column_order'=>$this->getControllerStateSession('asn.orderby','column_name'),
                                                                                        'direction'=>$this->getControllerStateSession('asn.orderby','order'),
                                                                                        'data'=>$data])->render();      
            
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('asn.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
}
