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
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
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

        return response()->json(['page_active'=>'organisasi',
                                'search'=>$this->getControllerStateSession('organisasi','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('organisasi.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('organisasi.orderby','order'),
                                'daftar_organisasi'=>$data],200);  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $this->getControllerStateSession('organisasi', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('organisasi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('organisasi', $data->currentPage());
   
        return response()->json(['page_active'=>'organisasi',
                                'search'=>$this->getControllerStateSession('organisasi','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('organisasi.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('organisasi.orderby','order'),
                                'daftar_organisasi'=>$data],200);  
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = OrganisasiModel::leftJoin('v_urusan_organisasi', 'v_urusan_organisasi.OrgID', 'tmOrg.OrgID')
                                ->where('tmOrg.OrgID', $id)
                                ->firstOrFail(['tmOrg.OrgID', 'v_urusan_organisasi.kode_organisasi', 'tmOrg.OrgNm', 'v_urusan_organisasi.Nm_Urusan', 'tmOrg.TA']);

        return response()->json($data,200);
    }
}
