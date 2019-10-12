<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\ObjekModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;
use Illuminate\Http\Request;

class ObjekController extends Controller
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
        if (!$this->checkStateIsExistSession('objek', 'orderby')) {
            $this->putControllerStateSession('objek', 'orderby', ['column_name' => 'ObyID', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('objek.orderby', 'column_name');
        $direction = $this->getControllerStateSession('objek.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = ObjekModel::where('TA', \HelperKegiatan::getTahunAnggaran())
            ->orderBy($column_order, $direction)
            ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('objek.index'));
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
        $this->setCurrentPageInsideSession('objek', 1);
        $data = $this->populateData();


        $datatable = view("pages.$theme.dmaster.objek.datatable")->with([
            'page_active' => 'objek',
            'search' => $this->getControllerStateSession('objek', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('objek.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('objek.orderby', 'order'),
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
            case 'col-RObyID':
                $column_name = 'RObyID';
                break;
            case 'col-RObyNm':
                $column_name = 'RObyNm';
                break;
            default:
                $column_name = 'RObyID';
        }
        $this->putControllerStateSession('objek', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('objek');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.objek.datatable")->with([
            'page_active' => 'objek',
            'search' => $this->getControllerStateSession('objek', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('objek.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('objek.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('objek', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.objek.datatable")->with([
            'page_active' => 'objek',
            'search' => $this->getControllerStateSession('objek', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('objek.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('objek.orderby', 'order'),
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
            $this->destroyControllerStateSession('objek', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('objek', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('objek', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.objek.datatable")->with([
            'page_active' => 'objek',
            'search' => $this->getControllerStateSession('objek', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('objek.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('objek.orderby', 'order'),
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

        $search = $this->getControllerStateSession('objek', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('objek');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('objek', $data->currentPage());

        return view("pages.$theme.dmaster.objek.index")->with([
            'page_active' => 'objek',
            'search' => $this->getControllerStateSession('objek', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('objek.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('objek.orderby', 'order'),
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
        return view("pages.$theme.dmaster.objek.create")->with([
            'page_active' => 'objek',
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
            'Kd_Rek_5' => [
                new CheckRecordIsExistValidation('tmROby', ['where' => ['ObyID', '=', $request->input('ObyID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'RObyNm' => 'required|min:5',
        ]);

        $objek = ObjekModel::create([
            'RObyID' => uniqid('uid'),
            'ObyID' => $request->input('ObyID'),
            'Kd_Rek_5' => $request->input('Kd_Rek_5'),
            'RObyNm' => $request->input('RObyNm'),
            'Descr' => $request->input('Descr'),
            'TA' => \HelperKegiatan::getTahunAnggaran(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('objek.show', ['uuid' => $objek->RObyID]))->with('success', 'Data ini telah berhasil disimpan.');
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

        $data = ObjekModel::where('RObyID', $uuid)->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.objek.show")->with([
                'page_active' => 'objek',
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

        $data = ObjekModel::findOrFail($uuid);
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.objek.edit")->with([
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
        $objek = ObjekModel::find($uuid);

        $this->validate($request, [
            'Kd_Rek_5' => [
                new IgnoreIfDataIsEqualValidation('tmOby', $objek->Kd_Rek_5, ['where' => ['ObyID', '=', $request->input('ObyID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'RObyNm' => 'required|min:5',
        ]);

        $objek->ObyID = $request->input('ObyID');
        $objek->Kd_Rek_5 = $request->input('Kd_Rek_5');
        $objek->RObyNm = $request->input('RObyNm');
        $objek->Descr = $request->input('Descr');
        $objek->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('objek.show', ['uuid' => $objek->JnsID]))->with('success', 'Data ini telah berhasil disimpan.');
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
        $objek = ObjekModel::find($uuid);

        $result = $objek->delete();
        if ($request->ajax()) {
            $currentpage = $this->getCurrentPageInsideSession('objek');
            $data = $this->populateData($currentpage);
            if ($currentpage > $data->lastPage()) {
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.objek.datatable")->with([
                'page_active' => 'objek',
                'search' => $this->getControllerStateSession('objek', 'search'),
                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                'column_order' => $this->getControllerStateSession('objek.orderby', 'column_name'),
                'direction' => $this->getControllerStateSession('objek.orderby', 'order'),
                'data' => $data
            ])->render();

            return response()->json(['success' => true, 'datatable' => $datatable], 200);
        } else {
            return redirect(route('objek.index'))->with('success', "Data ini dengan ($uuid) telah berhasil dihapus.");
        }
    }
}
