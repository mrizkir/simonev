<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\KelompokModel;
use Illuminate\Http\Request;

class KelompokController extends Controller
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
        if (!$this->checkStateIsExistSession('kelompok', 'orderby')) {
            $this->putControllerStateSession('kelompok', 'orderby', ['column_name' => 'KlpID', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('kelompok.orderby', 'column_name');
        $direction = $this->getControllerStateSession('kelompok.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = KelompokModel::where('TA', \HelperKegiatan::getTahunPenyerapan())
            ->orderBy($column_order, $direction)
            ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('kelompok.index'));
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

        $this->setCurrentPageInsideSession('kelompok', 1);
        $data = $this->populateData();


        $datatable = view("pages.$theme.dmaster.kelompok.datatable")->with([
            'page_active' => 'kelompok',
            'search' => $this->getControllerStateSession('kelompok', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompok.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompok.orderby', 'order'),
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
                $column_name = 'KlpID';
                break;
            case 'col-KlpNm':
                $column_name = 'KlpNm';
                break;
            default:
                $column_name = 'KlpID';
        }
        $this->putControllerStateSession('kelompok', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('kelompok');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.kelompok.datatable")->with([
            'page_active' => 'kelompok',
            'search' => $this->getControllerStateSession('kelompok', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompok.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompok.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('kelompok', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.kelompok.datatable")->with([
            'page_active' => 'kelompok',
            'search' => $this->getControllerStateSession('kelompok', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompok.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompok.orderby', 'order'),
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
            $this->destroyControllerStateSession('kelompok', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('kelompok', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('kelompok', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.kelompok.datatable")->with([
            'page_active' => 'kelompok',
            'search' => $this->getControllerStateSession('kelompok', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompok.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompok.orderby', 'order'),
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

        $search = $this->getControllerStateSession('kelompok', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('kelompok');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('kelompok', $data->currentPage());

        return view("pages.$theme.dmaster.kelompok.index")->with([
            'page_active' => 'kelompok',
            'search' => $this->getControllerStateSession('kelompok', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('kelompok.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('kelompok.orderby', 'order'),
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
        return view("pages.$theme.dmaster.kelompok.create")->with([
            'page_active' => 'kelompok',

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
            'Kd_Rek_2' => 'required|min:2',
            'KlpNm' => 'required|min:5',
        ]);

        $kelompok = KelompokModel::create([
            'KlpID' => uniqid('uid'),
            'StrID' => $request->input('StrID'),
            'Kd_Rek_2' => $request->input('Kd_Rek_2'),
            'KlpNm' => $request->input('KlpNm'),
            'Descr' => $request->input('Descr'),
            'TA' => \HelperKegiatan::getTahunPenyerapan(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('kelompok.show', ['uuid' => $kelompok->KlpID]))->with('success', 'Data ini telah berhasil disimpan.');
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

        $data = KelompokModel::where('KlpID', $uuid)->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.kelompok.show")->with([
                'page_active' => 'kelompok',
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

        $data = KelompokModel::findOrFail($uuid);
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.kelompok.edit")->with([
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
        $kelompok = KelompokModel::findOrFail($uuid);
        $this->validate($request, [
            'Kd_Rek_2' => 'required|min:2',
            'KlpNm' => 'required|min:5',
        ]);

        $kelompok->StrID = $request->input('StrID');
        $kelompok->Kd_Rek_2 = $request->input('Kd_Rek_2 ');
        $kelompok->KlpNm = $request->input('KlpNm');
        $kelompok->Descr = $request->input('Descr ');
        $kelompok->TA = \HelperKegiatan::getTahunPenyerapan();
        $kelompok->StrID = $request->input('StrID');
        $kelompok->save();


        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('kelompok.show', ['uuid' => $kelompok->KlpID]))->with('success', 'Data ini telah berhasil disimpan.');
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
        $kelompok = KelompokModel::find($uuid);

        $result = $kelompok->delete();
        if ($request->ajax()) {
            $currentpage = $this->getCurrentPageInsideSession('kelompok');
            $data = $this->populateData($currentpage);
            if ($currentpage > $data->lastPage()) {
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.kelompok.datatable")->with([
                'page_active' => 'kelompok',
                'search' => $this->getControllerStateSession('kelompok', 'search'),
                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                'column_order' => $this->getControllerStateSession('kelompok.orderby', 'column_name'),
                'direction' => $this->getControllerStateSession('kelompok.orderby', 'order'),
                'data' => $data
            ])->render();

            return response()->json(['success' => true, 'datatable' => $datatable], 200);
        } else {
            return redirect(route('kelompok.index'))->with('success', "Data ini dengan ($uuid) telah berhasil dihapus.");
        }
    }
}
