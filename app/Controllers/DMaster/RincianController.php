<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\RincianModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;
use Illuminate\Http\Request;

class RincianController extends Controller
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
        if (!$this->checkStateIsExistSession('rincian', 'orderby')) {
            $this->putControllerStateSession('rincian', 'orderby', ['column_name' => 'ObyID', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('rincian.orderby', 'column_name');
        $direction = $this->getControllerStateSession('rincian.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = RincianModel::where('TA', \HelperKegiatan::getTahunPenyerapan())
            ->orderBy($column_order, $direction)
            ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('rincian.index'));
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
        $this->setCurrentPageInsideSession('rincian', 1);
        $data = $this->populateData();


        $datatable = view("pages.$theme.dmaster.rincian.datatable")->with([
            'page_active' => 'rincian',
            'search' => $this->getControllerStateSession('rincian', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('rincian.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('rincian.orderby', 'order'),
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
            case 'col-ObyID':
                $column_name = 'ObyID';
                break;
            case 'col-ObyNm':
                $column_name = 'ObyNm';
                break;
            default:
                $column_name = 'ObyID';
        }
        $this->putControllerStateSession('rincian', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('rincian');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.rincian.datatable")->with([
            'page_active' => 'rincian',
            'search' => $this->getControllerStateSession('rincian', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('rincian.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('rincian.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('rincian', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.rincian.datatable")->with([
            'page_active' => 'rincian',
            'search' => $this->getControllerStateSession('rincian', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('rincian.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('rincian.orderby', 'order'),
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
            $this->destroyControllerStateSession('rincian', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('rincian', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('rincian', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.rincian.datatable")->with([
            'page_active' => 'rincian',
            'search' => $this->getControllerStateSession('rincian', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('rincian.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('rincian.orderby', 'order'),
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

        $search = $this->getControllerStateSession('rincian', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('rincian');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('rincian', $data->currentPage());

        return view("pages.$theme.dmaster.rincian.index")->with([
            'page_active' => 'rincian',
            'search' => $this->getControllerStateSession('rincian', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('rincian.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('rincian.orderby', 'order'),
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
        return view("pages.$theme.dmaster.rincian.create")->with([
            'page_active' => 'rincian',

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
            'Kd_Rek_4' => [
                new CheckRecordIsExistValidation('tmOby', ['where' => ['JnsID', '=', $request->input('JnsID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'ObyNm' => 'required|min:5',
        ]);

        $rincian = RincianModel::create([
            'ObyID' => uniqid('uid'),
            'JnsID' =>  $request->input('JnsID'),
            'Kd_Rek_4' => $request->input('Kd_Rek_4'),
            'ObyNm' => $request->input('ObyNm'),
            'Descr' => $request->input('Descr'),
            'TA' => \HelperKegiatan::getTahunPenyerapan(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('rincian.show', ['uuid' => $rincian->ObyID]))->with('success', 'Data ini telah berhasil disimpan.');
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

        $data = RincianModel::where('ObyID', $uuid)->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.rincian.show")->with([
                'page_active' => 'rincian',
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

        $data = RincianModel::findOrFail($uuid);
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.rincian.edit")->with([
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
        $rincian = RincianModel::find($uuid);

        $this->validate($request, [
            'Kd_Rek_4' => [
                new IgnoreIfDataIsEqualValidation('tmOby', $rincian->Kd_Rek_4, ['where' => ['JnsID', '=', $request->input('JnsID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'ObyNm' => 'required|min:5',
        ]);

        $rincian->JnsID = $request->input('JnsID');
        $rincian->Kd_Rek_4 = $request->input('Kd_Rek_4');
        $rincian->ObyNm = $request->input('ObyNm');
        $rincian->Descr = $request->input('Descr');
        $rincian->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('rincian.show', ['uuid' => $rincian->JnsID]))->with('success', 'Data ini telah berhasil disimpan.');
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
        $rincian = RincianModel::find($uuid);

        $result = $rincian->delete();
        if ($request->ajax()) {
            $currentpage = $this->getCurrentPageInsideSession('rincian');
            $data = $this->populateData($currentpage);
            if ($currentpage > $data->lastPage()) {
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.rincian.datatable")->with([
                'page_active' => 'rincian',
                'search' => $this->getControllerStateSession('rincian', 'search'),
                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                'column_order' => $this->getControllerStateSession('rincian.orderby', 'column_name'),
                'direction' => $this->getControllerStateSession('rincian.orderby', 'order'),
                'data' => $data
            ])->render();

            return response()->json(['success' => true, 'datatable' => $datatable], 200);
        } else {
            return redirect(route('rincian.index'))->with('success', "Data ini dengan ($uuid) telah berhasil dihapus.");
        }
    }
}
