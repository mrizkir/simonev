<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\TransaksiModel;
use Illuminate\Http\Request;

class TransaksiController extends Controller
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
        if (!$this->checkStateIsExistSession('transaksi', 'orderby')) {
            $this->putControllerStateSession('transaksi', 'orderby', ['column_name' => 'StrID', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('transaksi.orderby', 'column_name');
        $direction = $this->getControllerStateSession('transaksi.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = TransaksiModel::where('TA', \HelperKegiatan::getTahunPenyerapan())
            ->orderBy($column_order, $direction)
            ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('transaksi.index'));
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

        $this->setCurrentPageInsideSession('transaksi', 1);
        $data = $this->populateData();


        $datatable = view("pages.$theme.dmaster.transaksi.datatable")->with([
            'page_active' => 'transaksi',
            'search' => $this->getControllerStateSession('transaksi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('transaksi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('transaksi.orderby', 'order'),
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
            case 'col-StrID':
                $column_name = 'StrID';
                break;
            case 'col-Nm_Urusan':
                $column_name = 'Str_Nm';
                break;
            default:
                $column_name = 'StrID';
        }
        $this->putControllerStateSession('transaksi', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('transaksi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.transaksi.datatable")->with([
            'page_active' => 'transaksi',
            'search' => $this->getControllerStateSession('transaksi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('transaksi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('transaksi.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('transaksi', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.transaksi.datatable")->with([
            'page_active' => 'transaksi',
            'search' => $this->getControllerStateSession('transaksi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('transaksi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('transaksi.orderby', 'order'),
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
            $this->destroyControllerStateSession('transaksi', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('transaksi', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('transaksi', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.transaksi.datatable")->with([
            'page_active' => 'transaksi',
            'search' => $this->getControllerStateSession('transaksi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('transaksi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('transaksi.orderby', 'order'),
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

        $search = $this->getControllerStateSession('transaksi', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('transaksi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('transaksi', $data->currentPage());

        return view("pages.$theme.dmaster.transaksi.index")->with([
            'page_active' => 'transaksi',
            'search' => $this->getControllerStateSession('transaksi', 'search'),
            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
            'column_order' => $this->getControllerStateSession('transaksi.orderby', 'column_name'),
            'direction' => $this->getControllerStateSession('transaksi.orderby', 'order'),
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
        return view("pages.$theme.dmaster.transaksi.create")->with([
            'page_active' => 'transaksi',

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
            'Kd_Rek_1' => 'required|min:1',
            'StrNm' => 'required|min:5',
        ]);

        $transaksi = TransaksiModel::create([
            'StrID' => uniqid('uid'),
            'Kd_Rek_1' => $request->input('Kd_Rek_1'),
            'StrNm' => $request->input('StrNm'),
            'Descr' => $request->input('Descr'),
            'TA' => \HelperKegiatan::getTahunPenyerapan(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('transaksi.show', ['uuid' => $transaksi->StrID]))->with('success', 'Data ini telah berhasil disimpan.');
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

        $data = TransaksiModel::where('StrID', $uuid)->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.transaksi.show")->with([
                'page_active' => 'transaksi',
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
        $data = TransaksiModel::findOrFail($uuid);
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.transaksi.edit")->with([
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
        $transaksi = TransaksiModel::find($uuid);
        $this->validate($request, [
            'Kd_Rek_1' => 'required|min:1',
            'StrNm' => 'required|min:5',
        ]);

        $transaksi->Kd_Rek_1 = $request->input('Kd_Rek_1');
        $transaksi->StrNm = $request->input('StrNm');
        $transaksi->Descr = $request->input('Descr');
        $transaksi->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data ini telah berhasil disimpan.'
            ]);
        } else {
            return redirect(route('transaksi.show', ['uuid' => $transaksi->ASNID]))->with('success', 'Data ini telah berhasil disimpan.');
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
        $transaksi = TransaksiModel::find($uuid);

        $result = $transaksi->delete();
        if ($request->ajax()) {
            $currentpage = $this->getCurrentPageInsideSession('transaksi');
            $data = $this->populateData($currentpage);
            if ($currentpage > $data->lastPage()) {
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.transaksi.datatable")->with([
                'page_active' => 'transaksi',
                'search' => $this->getControllerStateSession('transaksi', 'search'),
                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                'column_order' => $this->getControllerStateSession('transaksi.orderby', 'column_name'),
                'direction' => $this->getControllerStateSession('transaksi.orderby', 'order'),
                'data' => $data
            ])->render();

            return response()->json(['success' => true, 'datatable' => $datatable], 200);
        } else {
            return redirect(route('transaksi.index'))->with('success', "Data ini dengan ($uuid) telah berhasil dihapus.");
        }
    }
}
