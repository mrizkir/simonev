<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\SubOrganisasiModel;
use Illuminate\Http\Request;

class SubOrganisasiController extends Controller
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
        if (!$this->checkStateIsExistSession('suborganisasi', 'orderby')) {
            $this->putControllerStateSession('suborganisasi', 'orderby', ['column_name' => 'kode_suborganisasi', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('suborganisasi.orderby', 'column_name');
        $direction = $this->getControllerStateSession('suborganisasi.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');
        if ($this->checkStateIsExistSession('suborganisasi', 'search')) {
            $search = $this->getControllerStateSession('suborganisasi', 'search');
            switch ($search['kriteria']) {
                case 'kode_suborganisasi':
                    $data = \DB::table('v_suborganisasi')
                        ->where('TA', \HelperKegiatan::getTahunPerencanaan())
                        ->where(['kode_suborganisasi' => $search['isikriteria']])
                        ->orderBy($column_order, $direction);
                    break;
                case 'SOrgNm':
                    $data = \DB::table('v_suborganisasi')
                        ->where('TA', \HelperKegiatan::getTahunPerencanaan())
                        ->where('SOrgNm', 'ilike', '%' . $search['isikriteria'] . '%')
                        ->orderBy($column_order, $direction);
                    break;
            }
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        } else {
            $data = \DB::table('v_suborganisasi')
                ->where('TA', \HelperKegiatan::getTahunPerencanaan())
                ->orderBy($column_order, $direction)
                ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        }
        $data->setPath(route('suborganisasi.index'));
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

    $this->setCurrentPageInsideSession('suborganisasi', 1);
    $data = $this->populateData();

    $datatable = view("pages.$theme.dmaster.suborganisasi.datatable")->with(['page_active' => 'suborganisasi',
                                                                            'search' => $this->getControllerStateSession('suborganisasi', 'search'),
                                                                            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                            'column_order' => $this->getControllerStateSession('suborganisasi.orderby', 'column_name'),
                                                                            'direction' => $this->getControllerStateSession('suborganisasi.orderby', 'order'),
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
            case 'kode_suborganisasi':
                $column_name = 'kode_suborganisasi';
                break;
            case 'SOrgNm':
                $column_name = 'SOrgNm';
                break;
            case 'Nm_Urusan':
                $column_name = 'Nm_Urusan';
                break;
            default:
                $column_name = 'kode_suborganisasi';
        }
        $this->putControllerStateSession('suborganisasi', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('suborganisasi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }

        $datatable = view("pages.$theme.dmaster.suborganisasi.datatable")->with(['page_active' => 'suborganisasi',
            'search' => $this->getControllerStateSession('suborganisasi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('suborganisasi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('suborganisasi.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('suborganisasi', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.suborganisasi.datatable")->with(['page_active' => 'suborganisasi',
            'search' => $this->getControllerStateSession('suborganisasi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('suborganisasi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('suborganisasi.orderby', 'order'),
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
            $this->destroyControllerStateSession('suborganisasi', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('suborganisasi', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('suborganisasi', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.suborganisasi.datatable")->with(['page_active' => 'suborganisasi',
                            'search' => $this->getControllerStateSession('suborganisasi', 'search'),
                            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                            'column_order' => $this->getControllerStateSession('suborganisasi.orderby', 'column_name'),
                            'direction' => $this->getControllerStateSession('suborganisasi.orderby', 'order'),
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
        $search = $this->getControllerStateSession('suborganisasi', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('suborganisasi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('suborganisasi', $data->currentPage());

        return view("pages.$theme.dmaster.suborganisasi.index")->with(['page_active' => 'suborganisasi',
            'search' => $this->getControllerStateSession('suborganisasi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('suborganisasi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('suborganisasi.orderby', 'order'),
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

        $data = SubOrganisasiModel::where('KUrsID', $id)
            ->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.suborganisasi.show")->with([
                'page_active' => 'suborganisasi',
                'data' => $data,
            ]);
        }
    }
}
