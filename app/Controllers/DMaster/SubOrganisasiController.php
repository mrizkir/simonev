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
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
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
        

        return response()->json(['page_active'=>'suborganisasi',
                                'search'=>$this->getControllerStateSession('suborganisasi','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('suborganisasi.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('suborganisasi.orderby','order'),
                                'daftar_unitkerja'=>$data],200); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('suborganisasi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('suborganisasi', $data->currentPage());

        return response()->json(['page_active'=>'suborganisasi',
                                'search'=>$this->getControllerStateSession('suborganisasi','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('suborganisasi.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('suborganisasi.orderby','order'),
                                'daftar_unitkerja'=>$data],200);  

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SubOrganisasiModel::find($id)
                                    ->firstOrFail();
        return response()->json($data,200);
    }
    /**
     * digunakan untuk mendapatkan daftar unitkerja berdasarkan OrgID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getdaftarunitkerja ($id)
    {
        $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunPerencanaan(),false,$id);        
        return response()->json($daftar_unitkerja,200); 
    }
}
