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
     * digunakan untuk mengganti jumlah record per halaman
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changenumberrecordperpage(Request $request)
    {
        $theme = 'dore';

        $numberRecordPerPage = $request->input('numberRecordPerPage');
        $this->putControllerStateSession('global_controller', 'numberRecordPerPage', $numberRecordPerPage);

        $this->setCurrentPageInsideSession('kelompokurusan', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with([
            'page_active' => 'kelompokurusan',
            'search' => $this->getControllerStateSession('kelompokurusan', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompokurusan.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompokurusan.orderby', 'order'),
            'data' => $data
        ])->render();
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
            case 'col-Kd_Urusan':
                $column_name = 'Kd_Urusan';
                break;
            case 'col-Nm_Urusan':
                $column_name = 'Nm_Urusan';
                break;
            default:
                $column_name = 'Kd_Urusan';
        }
        $this->putControllerStateSession('kelompokurusan', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('kelompokurusan');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with(['page_active' => 'kelompokurusan',
            'search' => $this->getControllerStateSession('kelompokurusan', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompokurusan.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompokurusan.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('kelompokurusan', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with([
            'page_active' => 'kelompokurusan',
            'search' => $this->getControllerStateSession('kelompokurusan', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompokurusan.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompokurusan.orderby', 'order'),
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
            $this->destroyControllerStateSession('kelompokurusan', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('kelompokurusan', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('kelompokurusan', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.kelompokurusan.datatable")->with(['page_active' => 'kelompokurusan',
            'search' => $this->getControllerStateSession('kelompokurusan', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompokurusan.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompokurusan.orderby', 'order'),
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

        $search = $this->getControllerStateSession('kelompokurusan', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('kelompokurusan');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('kelompokurusan', $data->currentPage());

        return view("pages.$theme.dmaster.kelompokurusan.index")->with(['
            page_active' => 'kelompokurusan',
            'search' => $this->getControllerStateSession('kelompokurusan', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompokurusan.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompokurusan.orderby', 'order'),
            'data' => $data,
        ]);
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

        $data = KelompokUrusanModel::where('KUrsID', $id)
            ->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.kelompokurusan.show")->with([
                'page_active' => 'kelompokurusan',
                'data' => $data,
            ]);
        }
    }
}
