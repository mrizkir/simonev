<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\UrusanModel;
use Illuminate\Http\Request;

class urusanController extends Controller
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
        $columns = ['tmUrs.UrsID', 'v_urusan.Nm_Urusan', 'Kode_Bidang', 'tmUrs.Nm_Bidang', 'tmUrs.Descr'];
        if (!$this->checkStateIsExistSession('urusan', 'orderby')) {
            $this->putControllerStateSession('urusan', 'orderby', ['column_name' => 'Kode_Bidang', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('urusan.orderby', 'column_name');
        $direction = $this->getControllerStateSession('urusan.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');
        if ($this->checkStateIsExistSession('urusan', 'search')) {
            $search = $this->getControllerStateSession('urusan', 'search');
            switch ($search['kriteria']) {
                case 'Kode_Bidang':
                    $data = UrusanModel::join('v_urusan', 'v_urusan.UrsID', 'tmUrs.UrsID')
                        ->select(\DB::raw('"tmUrs"."UrsID","tmUrs"."KUrsID",v_urusan."Nm_Urusan",v_urusan."Kode_Bidang","tmUrs"."Nm_Bidang","tmUrs"."Descr","tmUrs"."TA","tmUrs"."created_at","tmUrs"."updated_at"'))
                        ->where('tmUrs.TA', \HelperKegiatan::getRPJMDTahunMulai())
                        ->where(['Kode_Bidang' => $search['isikriteria']])
                        ->orderBy($column_order, $direction);
                    break;
                case 'Nm_Bidang':
                    $data = UrusanModel::join('v_urusan', 'v_urusan.UrsID', 'tmUrs.UrsID')
                        ->select(\DB::raw('"tmUrs"."UrsID","tmUrs"."KUrsID",v_urusan."Nm_Urusan",v_urusan."Kode_Bidang","tmUrs"."Nm_Bidang","tmUrs"."Descr","tmUrs"."TA","tmUrs"."created_at","tmUrs"."updated_at"'))
                        ->where('tmUrs.TA', \HelperKegiatan::getRPJMDTahunMulai())
                        ->where('tmUrs.Nm_Bidang', 'ILIKE', '%' . $search['isikriteria'] . '%')
                        ->orderBy($column_order, $direction);
                    break;
            }
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        } else {
            $data = UrusanModel::join('v_urusan', 'v_urusan.UrsID', 'tmUrs.UrsID')
                ->select(\DB::raw('"tmUrs"."UrsID","tmUrs"."KUrsID",v_urusan."Nm_Urusan",v_urusan."Kode_Bidang","tmUrs"."Nm_Bidang","tmUrs"."Descr","tmUrs"."TA","tmUrs"."created_at","tmUrs"."updated_at"'))
                ->where('tmUrs.TA', \HelperKegiatan::getRPJMDTahunMulai())
                ->orderBy($column_order, $direction)
                ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        }
        $data->setPath(route('urusan.index'));
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

        $this->setCurrentPageInsideSession('urusan', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.urusan.datatable")->with(['page_active' => 'urusan',
                                                                        'search' => $this->getControllerStateSession('urusan', 'search'),
                                                                        'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                        'column_order' => $this->getControllerStateSession('urusan.orderby', 'column_name'),
                                                                        'direction' => $this->getControllerStateSession('urusan.orderby', 'order'),
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
            case 'col-Kd_Bidang':
                $column_name = 'Kode_Bidang';
                break;
            case 'col-Nm_Bidang':
                $column_name = 'Nm_Bidang';
                break;
            default:
                $column_name = 'Kode_Bidang';
        }
        $this->putControllerStateSession('urusan', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('urusan');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.urusan.datatable")->with(['page_active' => 'urusan',
                                                                            'search' => $this->getControllerStateSession('urusan', 'search'),
                                                                            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                            'column_order' => $this->getControllerStateSession('urusan.orderby', 'column_name'),
                                                                            'direction' => $this->getControllerStateSession('urusan.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('urusan', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.urusan.datatable")->with(['page_active' => 'urusan',
                                                                        'search' => $this->getControllerStateSession('urusan', 'search'),
                                                                        'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                        'column_order' => $this->getControllerStateSession('urusan.orderby', 'column_name'),
                                                                        'direction' => $this->getControllerStateSession('urusan.orderby', 'order'),
                                                                        'data' => $data])->render();

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
            $this->destroyControllerStateSession('urusan', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('urusan', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('urusan', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.urusan.datatable")->with(['page_active' => 'urusan',
                                                                            'search' => $this->getControllerStateSession('urusan', 'search'),
                                                                            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                            'column_order' => $this->getControllerStateSession('urusan.orderby', 'column_name'),
                                                                            'direction' => $this->getControllerStateSession('urusan.orderby', 'order'),
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

        $search = $this->getControllerStateSession('urusan', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('urusan');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('urusan', $data->currentPage());

        return view("pages.$theme.dmaster.urusan.index")->with([
                                                                'page_active' => 'urusan',
                                                                'search' => $this->getControllerStateSession('urusan', 'search'),
                                                                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                'column_order' => $this->getControllerStateSession('urusan.orderby', 'column_name'),
                                                                'direction' => $this->getControllerStateSession('urusan.orderby', 'order'),
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
        $data = UrusanModel::where('UrsID', $id)
            ->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.urusan.show")->with(['page_active' => 'urusan',
                'data' => $data,
            ]);
        }
    }
}
