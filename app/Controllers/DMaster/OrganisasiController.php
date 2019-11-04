<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\organisasiModel;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
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
    public function getdaftaropd (Request $request)
    {
        $daftar_opd=\App\Models\DMaster\OrganisasiModel::getDaftarOPD(\HelperKegiatan::getTahunAnggaran(),false);  
        return response()->json($daftar_opd,200);
    }
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData($currentpage = 1)
    {
        $columns = ['*'];
        if (!$this->checkStateIsExistSession('organisasi', 'orderby')) {
            $this->putControllerStateSession('organisasi', 'orderby', ['column_name' => 'kode_organisasi', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('organisasi.orderby', 'column_name');
        $direction = $this->getControllerStateSession('organisasi.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');
        if ($this->checkStateIsExistSession('organisasi', 'search')) {
            $search = $this->getControllerStateSession('organisasi', 'search');
            switch ($search['kriteria']) {
                case 'kode_organisasi':
                    $data = \DB::table('v_urusan_organisasi')
                        ->where('TA', \HelperKegiatan::getTahunPerencanaan())
                        ->where(['kode_organisasi' => $search['isikriteria']])
                        ->orderBy($column_order, $direction);
                    break;
                case 'OrgNm':
                    $data = \DB::table('v_urusan_organisasi')
                        ->where('TA', \HelperKegiatan::getTahunPerencanaan())
                        ->where('OrgNm', 'ilike', '%' . $search['isikriteria'] . '%')
                        ->orderBy($column_order, $direction);
                    break;
            }
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        } else {
            $data = \DB::table('v_urusan_organisasi')
                ->where('TA', \HelperKegiatan::getTahunPerencanaan())
                ->orderBy($column_order, $direction)
                ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        }
        $data->setPath(route('organisasi.index'));
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

        $this->setCurrentPageInsideSession('organisasi', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.organisasi.datatable")->with(['page_active' => 'organisasi',
                                                                                'search' => $this->getControllerStateSession('organisasi', 'search'),
                                                                                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                'column_order' => $this->getControllerStateSession('organisasi.orderby', 'column_name'),
                                                                                'direction' => $this->getControllerStateSession('organisasi.orderby', 'order'),
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
            case 'kode_organisasi':
                $column_name = 'kode_organisasi';
                break;
            case 'NmOrg':
                $column_name = 'NmOrg';
                break;
            case 'Nm_Urusan':
                $column_name = 'Nm_Urusan';
                break;
            default:
                $column_name = 'kode_organisasi';
        }
        $this->putControllerStateSession('organisasi', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('organisasi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }

        $datatable = view("pages.$theme.dmaster.organisasi.datatable")->with(['page_active' => 'organisasi',
                                                                                'search' => $this->getControllerStateSession('organisasi', 'search'),
                                                                                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                'column_order' => $this->getControllerStateSession('organisasi.orderby', 'column_name'),
                                                                                'direction' => $this->getControllerStateSession('organisasi.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('organisasi', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.organisasi.datatable")->with([
            'page_active' => 'organisasi',
            'search' => $this->getControllerStateSession('organisasi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('organisasi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('organisasi.orderby', 'order'),
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
            $this->destroyControllerStateSession('organisasi', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('organisasi', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('organisasi', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.organisasi.datatable")->with(['page_active' => 'organisasi',
            'search' => $this->getControllerStateSession('organisasi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('organisasi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('organisasi.orderby', 'order'),
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

        $search = $this->getControllerStateSession('organisasi', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('organisasi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('organisasi', $data->currentPage());

        return view("pages.$theme.dmaster.organisasi.index")->with(['
            page_active' => 'organisasi',
            'search' => $this->getControllerStateSession('organisasi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('organisasi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('organisasi.orderby', 'order'),
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

        $data = OrganisasiModel::leftJoin('v_urusan_organisasi', 'v_urusan_organisasi.OrgID', 'tmOrg.OrgID')
            ->where('tmOrg.OrgID', $id)
            ->firstOrFail(['tmOrg.OrgID', 'v_urusan_organisasi.kode_organisasi', 'tmOrg.OrgNm', 'v_urusan_organisasi.Nm_Urusan', 'tmOrg.TA']);

        if (!is_null($data)) {
            return view("pages.$theme.dmaster.organisasi.show")->with(['page_active' => 'organisasi',
                'data' => $data,
            ]);
        }

    }
}
