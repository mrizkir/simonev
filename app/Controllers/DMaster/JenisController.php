<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\JenisModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;
use Illuminate\Http\Request;

class JenisController extends Controller
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
        if (!$this->checkStateIsExistSession('jenis', 'orderby')) {
            $this->putControllerStateSession('jenis', 'orderby', ['column_name' => 'JnsID', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('jenis.orderby', 'column_name');
        $direction = $this->getControllerStateSession('jenis.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = JenisModel::where('TA', \HelperKegiatan::getTahunAnggaran())
            ->orderBy($column_order, $direction)
            ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('jenis.index'));
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

        $this->setCurrentPageInsideSession('jenis', 1);
        $data = $this->populateData();


        $datatable = view("pages.$theme.dmaster.jenis.datatable")->with([
            'page_active' => 'jenis',
            'search' => $this->getControllerStateSession('jenis', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('jenis.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('jenis.orderby', 'order'),
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
            case 'col-KlpID':
                $column_name = 'JnsID';
                break;
            case 'col-KlpNm':
                $column_name = 'JnsNm';
                break;
            default:
                $column_name = 'JnsID';
        }
        $this->putControllerStateSession('jenis', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('jenis');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.jenis.datatable")->with([
            'page_active' => 'jenis',
            'search' => $this->getControllerStateSession('jenis', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('jenis.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('jenis.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('jenis', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.jenis.datatable")->with([
            'page_active' => 'jenis',
            'search' => $this->getControllerStateSession('jenis', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('jenis.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('jenis.orderby', 'order'),
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
            $this->destroyControllerStateSession('jenis', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('jenis', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('jenis', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.jenis.datatable")->with([
            'page_active' => 'jenis',
            'search' => $this->getControllerStateSession('jenis', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('jenis.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('jenis.orderby', 'order'),
            'data' => $data
        ])->render();

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

        $search = $this->getControllerStateSession('jenis', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('jenis');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('jenis', $data->currentPage());

        return view("pages.$theme.dmaster.jenis.index")->with([
            'page_active' => 'jenis',
            'search' => $this->getControllerStateSession('jenis', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('jenis.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('jenis.orderby', 'order'),
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
        return view("pages.$theme.dmaster.jenis.create")->with([
            'page_active' => 'jenis',

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
            'Kd_Rek_3' => [
                new CheckRecordIsExistValidation('tmJns', ['where' => ['KlpID', '=', $request->input('KlpID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'JnsNm' => 'required|min:5',
        ]);

        $jenis = JenisModel::create([
            'JnsID' => uniqid('uid'),
            'KlpID' => $request->input('KlpID'),
            'Kd_Rek_3' => $request->input('Kd_Rek_3'),
            'JnsNm' => $request->input('JnsNm'),
            'Descr' => $request->input('Descr'),
            'TA' => \HelperKegiatan::getTahunAnggaran(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('jenis.show', ['uuid' => $jenis->JnsID]))->with('success', 'Data ini telah berhasil disimpan.');
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

        $data = JenisModel::where('JnsID', $uuid)->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.jenis.show")->with([
                'page_active' => 'jenis',
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

        $data = JenisModel::findOrFail($uuid);
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.jenis.edit")->with([
                'page_active' => 'rkakegiatanmurni',
                'data' => $data
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $jenis = JenisModel::find($uuid);
        $this->validate($request, [
            'Kd_Rek_3' => [
                new IgnoreIfDataIsEqualValidation('tmJns', $jenis->Kd_Rek_3, ['where' => ['KlpID', '=', $request->input('KlpID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'JnsNm' => 'required|min:5',
        ]);

        $jenis->KlpID = $request->input('KlpID');
        $jenis->Kd_Rek_3 = $request->input('Kd_Rek_3');
        $jenis->JnsNm = $request->input('JnsNm');
        $jenis->Descr = $request->input('Descr');
        $jenis->TA = \HelperKegiatan::getTahunAnggaran();
        $jenis->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('jenis.show', ['uuid' => $jenis->JnsID]))->with('success', 'Data ini telah berhasil disimpan.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $uuid)
    {
        $theme = 'dore';
        $jenis = JenisModel::find($uuid);

        $result = $jenis->delete();
        if ($request->ajax()) {
            $currentpage = $this->getCurrentPageInsideSession('jenis');
            $data = $this->populateData($currentpage);
            if ($currentpage > $data->lastPage()) {
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.jenis.datatable")->with([
                'page_active' => 'jenis',
                'search' => $this->getControllerStateSession('jenis', 'search'),
                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                'column_order' => $this->getControllerStateSession('jenis.orderby', 'column_name'),
                'direction' => $this->getControllerStateSession('jenis.orderby', 'order'),
                'data' => $data
            ])->render();

            return response()->json(['success' => true, 'datatable' => $datatable], 200);
        } else {
            return redirect(route('jenis.index'))->with('success', "Data ini dengan ($uuid) telah berhasil dihapus.");
        }
    }
}
