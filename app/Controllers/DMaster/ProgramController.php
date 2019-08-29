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
            $this->putControllerStateSession('program', 'filters', ['UrsID' => 'none']);
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
            $data = $filter_ursid == 'none' || $filter_ursid == null ?
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
     * digunakan untuk mengganti jumlah record per halaman
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changenumberrecordperpage(Request $request)
    {
        $theme = 'dore';

        $numberRecordPerPage = $request->input('numberRecordPerPage');
        $this->putControllerStateSession('global_controller', 'numberRecordPerPage', $numberRecordPerPage);

        $this->setCurrentPageInsideSession('program', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.program.datatable")->with(['page_active' => 'program',
            'search' => $this->getControllerStateSession('program', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('program.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('program.orderby', 'order'),
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

        $daftar_urusan = UrusanModel::getDaftarUrusan(\HelperKegiatan::getRPJMDTahunMulai());
        $daftar_urusan['none'] = 'SELURUH URUSAN';
        $filter_kode_urusan_selected = UrusanModel::getKodeUrusanByUrsID($this->getControllerStateSession('program.filters', 'UrsID'));

        $orderby = $request->input('orderby') == 'asc' ? 'desc' : 'asc';
        $column = $request->input('column_name');
        switch ($column) {
            case 'col-Kode_Program':
                $column_name = 'kode_program';
                break;
            case 'col-PrgNm':
                $column_name = 'PrgNm';
                break;
            case 'col-Nm_Urusan':
                $column_name = 'Nm_Urusan';
                break;
            default:
                $column_name = 'kode_program';
        }
        $this->putControllerStateSession('program', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('program');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }

        $datatable = view("pages.$theme.dmaster.program.datatable")->with([
            'page_active' => 'program',
            'search' => $this->getControllerStateSession('program', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('program.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('program.orderby', 'order'),
            'daftar_urusan' => $daftar_urusan,
            'filter_ursid_selected' => $this->getControllerStateSession('program.filters', 'UrsID'),
            'filter_kode_urusan_selected' => $filter_kode_urusan_selected,
            'data' => $data
        ])->render();
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
        $this->setCurrentPageInsideSession('program', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.program.datatable")->with([
            'page_active' => 'program',
            'search' => $this->getControllerStateSession('program', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('program.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('program.orderby', 'order'),
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

        $$theme = \Auth::user()->theme;
        $daftar_urusan = UrusanModel::getDaftarUrusan(\HelperKegiatan::getRPJMDTahunMulai());
        $daftar_urusan['none'] = 'SELURUH URUSAN';
        $filter_kode_urusan_selected = UrusanModel::getKodeUrusanByUrsID($this->getControllerStateSession('program.filters', 'UrsID'));

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

        $datatable = view("pages.$theme.dmaster.program.datatable")->with(['page_active' => 'program',
                                                                        'search' => $this->getControllerStateSession('program', 'search'),
                                                                        'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                        'column_order' => $this->getControllerStateSession('program.orderby', 'column_name'),
                                                                        'direction' => $this->getControllerStateSession('program.orderby', 'order'),
                                                                        'daftar_urusan' => $daftar_urusan,
                                                                        'filter_ursid_selected' => $this->getControllerStateSession('program.filters', 'UrsID'),
                                                                        'filter_kode_urusan_selected' => $filter_kode_urusan_selected,
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

        $daftar_urusan = UrusanModel::getDaftarUrusan(\HelperKegiatan::getRPJMDTahunMulai());
        $daftar_urusan['none'] = 'SELURUH URUSAN';

        $search = $this->getControllerStateSession('program', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('program');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('program', $data->currentPage());
        $filter_kode_urusan_selected = UrusanModel::getKodeUrusanByUrsID($this->getControllerStateSession('program.filters', 'UrsID'));

        return view("pages.$theme.dmaster.program.index")->with(['page_active' => 'program',
            'search' => $this->getControllerStateSession('program', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('program.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('program.orderby', 'order'),
            'daftar_urusan' => $daftar_urusan,
            'filter_ursid_selected' => $this->getControllerStateSession('program.filters', 'UrsID'),
            'filter_kode_urusan_selected' => $filter_kode_urusan_selected,
            'data' => $data]);

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

        $data = ProgramModel::leftJoin('v_urusan_program', 'v_urusan_program.PrgID', 'tmPrg.PrgID')
            ->where('tmPrg.PrgID', $id)
            ->firstOrFail(['tmPrg.PrgID', 'v_urusan_program.kode_program', 'tmPrg.PrgNm', 'tmPrg.Descr', 'tmPrg.Jns', 'tmPrg.TA', 'tmPrg.created_at', 'tmPrg.updated_at']);

        if (!is_null($data)) {
            return view("pages.$theme.dmaster.program.show")->with(['page_active' => 'program',
                'data' => $data,
            ]);
        }

    }
}
