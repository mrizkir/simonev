<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Helpers\SQL;
use App\Models\DMaster\ProgramModel;
use App\Models\DMaster\UrusanModel;
use Illuminate\Http\Request;

class programController extends Controller
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
        if (!$this->checkStateIsExistSession('program', 'orderby')) {
            $this->putControllerStateSession('program', 'orderby', ['column_name' => 'kode_program', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('program.orderby', 'column_name');
        $direction = $this->getControllerStateSession('program.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        if (!$this->checkStateIsExistSession('program', 'filters')) {
            $this->putControllerStateSession('program', 'filters', ['UrsID' => '']);
        }
        $filter_ursid = $this->getControllerStateSession('program.filters', 'UrsID');
        if ($this->checkStateIsExistSession('program', 'search')) {
            $search = $this->getControllerStateSession('program', 'search');
            switch ($search['kriteria']) {
                case 'kode_program':
                    $data = \DB::table('v_urusan_program')
                        ->where('TA', \HelperKegiatan::getRPJMDTahunMulai())
                        ->where(['kode_program' => $search['isikriteria']])
                        ->orderBy($column_order, $direction);
                break;
                case 'PrgNm':
                    $data = \DB::table('v_urusan_program')
                        ->where('TA', \HelperKegiatan::getRPJMDTahunMulai())
                        ->where('PrgNm', 'ILIKE', '%' . $search['isikriteria'] . '%')
                        ->orderBy($column_order, $direction);
                break;
            }
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        } else {
            $data = $filter_ursid == '' || $filter_ursid == null ?
            \DB::table('v_urusan_program')
                ->where('TA', \HelperKegiatan::getRPJMDTahunMulai())
                ->orderBy($column_order, $direction)
                ->paginate($numberRecordPerPage, $columns, 'page', $currentpage)
            :
            \DB::table('v_urusan_program')
                ->where('TA', \HelperKegiatan::getRPJMDTahunMulai())
                ->orderBy($column_order, $direction)
                ->where('UrsID', $filter_ursid)
                ->orWhereNull('UrsID')
                ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        }
        $data->setPath(route('program.index'));
        return $data;

    }    
    /**
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {       
        $action = $request->input('action');
        if ($action == 'reset') {
            $this->destroyControllerStateSession('program', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('program', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('program', 1);
        $data = $this->populateData();

        return response()->json(['page_active'=>'program',
                                'search'=>$this->getControllerStateSession('program','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('program.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('program.orderby','order'),
                                'filters'=>$this->getControllerStateSession('program','filters'), 
                                'daftar_program'=>$data],200); 

    }
     /**
     * filter resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter (Request $request) 
    {        
        $UrsID = $request->input('UrsID');
        $this->putControllerStateSession('program','filters',['UrsID'=>$UrsID]);        
        $this->setCurrentPageInsideSession('program',1);
        
        $data=$this->populateData();
        return response()->json(['page_active'=>'program',
                                'search'=>$this->getControllerStateSession('program','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('program.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('program.orderby','order'),
                                'filters'=>$this->getControllerStateSession('program','filters'), 
                                'daftar_program'=>$data],200);     
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $this->getControllerStateSession('program', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('program');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('program', $currentpage);
        return response()->json(['page_active'=>'program',
                                'search'=>$this->getControllerStateSession('program','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('program.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('program.orderby','order'),
                                'filters'=>$this->getControllerStateSession('program','filters'), 
                                'daftar_program'=>$data],200);  

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = ProgramModel::leftJoin('v_urusan_program', 'v_urusan_program.PrgID', 'tmPrg.PrgID')
            ->find($id);

        return response()->json($data,200);

    }
}
