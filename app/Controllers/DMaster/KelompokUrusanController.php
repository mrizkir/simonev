<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\KelompokUrusanModel;
use Illuminate\Http\Request;

class KelompokUrusanController extends Controller
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
        if (!$this->checkStateIsExistSession('kelompokurusan', 'orderby')) {
            $this->putControllerStateSession('kelompokurusan', 'orderby', ['column_name' => 'Kd_Urusan', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('kelompokurusan.orderby', 'column_name');
        $direction = $this->getControllerStateSession('kelompokurusan.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = KelompokUrusanModel::where('TA', \HelperKegiatan::getRPJMDTahunMulai())->orderBy($column_order, $direction)->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('kelompokurusan.index'));
        return $data;
    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $this->getControllerStateSession('kelompokurusan', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('kelompokurusan');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) 
        {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('kelompokurusan', $currentpage);

        return response()->json(['page_active'=>'kelompokurusan',
                                'search'=>$this->getControllerStateSession('kelompokurusan','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('kelompokurusan.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('kelompokurusan.orderby','order'),
                                'daftar_kelompokurusan'=>$data],200);   
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = KelompokUrusanModel::find($id);
        
        return response()->json($data,200);   
    }
}
