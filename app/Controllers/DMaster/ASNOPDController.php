<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\ASNModel;
use App\Models\DMaster\RiwayatJabatanASNModel;
use Illuminate\Http\Request;

class ASNOPDController extends Controller
{
    /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth','role:superadmin|bapelitbang|opd']);        
    }
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData($currentpage = 1)
    {
        $columns = ['*'];
        if (!$this->checkStateIsExistSession('asnopd', 'orderby')) {
            $this->putControllerStateSession('asnopd', 'orderby', ['column_name' => 'NIP_ASN', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('asnopd.orderby', 'column_name');
        $direction = $this->getControllerStateSession('asnopd.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        //filter
        if (!$this->checkStateIsExistSession('asnopd','filters')) 
        {            
            $this->putControllerStateSession('asnopd','filters',[
                                                                'OrgID'=>'none',
                                                            ]);
        }        
        $OrgID= $this->getControllerStateSession('asnopd.filters','OrgID');

        $data = RiwayatJabatanASNModel::join('tmASN','trRiwayatJabatanASN.ASNID','tmASN.ASNID')
                                        ->where('trRiwayatJabatanASN.TA', \HelperKegiatan::getTahunAnggaran())            
                                        ->where('OrgID', $OrgID)            
                                        ->orderBy($column_order, $direction)
                                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);


        $data->setPath(route('asnopd.index'));
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

        $this->setCurrentPageInsideSession('asnopd', 1);
        $data = $this->populateData();


        $datatable = view("pages.$theme.dmaster.asnopd.datatable")->with(['page_active' => 'asnopd',
                                                                                    'search' => $this->getControllerStateSession('asnopd', 'search'),
                                                                                    'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                    'column_order' => $this->getControllerStateSession('asnopd.orderby', 'column_name'),
                                                                                    'direction' => $this->getControllerStateSession('asnopd.orderby', 'order'),
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
            case 'col-NIP_ASN':
                $column_name = 'NIP_ASN';
            break;           
            default:
                $column_name = 'NIP_ASN';
        }
        $this->putControllerStateSession('asnopd', 'orderby', ['column_name' => $column_name, 'order' => $orderby]);

        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('asnopd');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
        }
        $datatable = view("pages.$theme.dmaster.asnopd.datatable")->with(['page_active' => 'asnopd',
                                                                            'search' => $this->getControllerStateSession('asnopd', 'search'),
                                                                            'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                            'column_order' => $this->getControllerStateSession('asnopd.orderby', 'column_name'),
                                                                            'direction' => $this->getControllerStateSession('asnopd.orderby', 'order'),
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

        $this->setCurrentPageInsideSession('asnopd', $id);
        $data = $this->populateData($id);
        $datatable = view("pages.$theme.dmaster.asnopd.datatable")->with([
                                                                        'page_active' => 'asnopd',
                                                                        'search' => $this->getControllerStateSession('asnopd', 'search'),
                                                                        'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                        'column_order' => $this->getControllerStateSession('asnopd.orderby', 'column_name'),
                                                                        'direction' => $this->getControllerStateSession('asnopd.orderby', 'order'),
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
            $this->destroyControllerStateSession('asnopd', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('asnopd', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('asnopd', 1);
        $data = $this->populateData();

        $datatable = view("pages.$theme.dmaster.asnopd.datatable")->with(['page_active' => 'asnopd',
                                                                                'search' => $this->getControllerStateSession('asnopd', 'search'),
                                                                                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                'column_order' => $this->getControllerStateSession('asnopd.orderby', 'column_name'),
                                                                                'direction' => $this->getControllerStateSession('asnopd.orderby', 'order'),
                                                                                'data' => $data])->render();

        return response()->json(['success' => true, 'datatable' => $datatable], 200);
    }
    /**
     * filter resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request) 
    {
        $auth = \Auth::user();    
        $theme = 'dore';

        $filters=$this->getControllerStateSession('asnopd','filters');
        $json_data = [];

        //index
        if ($request->exists('OrgID'))
        {
            $OrgID = $request->input('OrgID')==''?'none':$request->input('OrgID');
            $filters['OrgID']=$OrgID;
            
            $this->putControllerStateSession('asnopd','filters',$filters);

            $data = [];

            $datatable = view("pages.$theme.dmaster.asnopd.datatable")->with(['page_active' => 'asnopd',
                                                                                'search' => $this->getControllerStateSession('asnopd', 'search'),
                                                                                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                                'column_order' => $this->getControllerStateSession('asnopd.orderby', 'column_name'),
                                                                                'direction' => $this->getControllerStateSession('asnopd.orderby', 'order'),
                                                                                'data' => $data])->render();

          
            $json_data = ['success'=>true,'datatable'=>$datatable];
        } 
        return response()->json($json_data,200);  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $theme = 'dore';
        $filters=$this->getControllerStateSession('asnopd','filters');
        $search = $this->getControllerStateSession('asnopd', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('asnopd');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) 
        {
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession('asnopd', $data->currentPage());

        $daftar_opd=\App\Models\DMaster\OrganisasiModel::getDaftarOPD(\HelperKegiatan::getTahunAnggaran(),false); 
        $daftar_opd['']=''; 

        return view("pages.$theme.dmaster.asnopd.index")->with(['page_active' => 'asnopd',
                                                                'filters'=>$filters,
                                                                'daftar_opd'=>$daftar_opd,
                                                                'search' => $this->getControllerStateSession('asnopd', 'search'),
                                                                'numberRecordPerPage' => $this->getControllerStateSession('global_controller', 'numberRecordPerPage'),
                                                                'column_order' => $this->getControllerStateSession('asnopd.orderby', 'column_name'),
                                                                'direction' => $this->getControllerStateSession('asnopd.orderby', 'order'),
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
        $filters=$this->getControllerStateSession('asnopd','filters');  
        if ($filters['OrgID'] != 'none'&&$filters['OrgID'] != ''&&$filters['OrgID'] != null)
        {
            $organisasi=\App\Models\DMaster\OrganisasiModel::find($filters['OrgID']); 

            $daftar_asn = \DB::table('tmASN')
                            ->select(\DB::raw('"ASNID",CONCAT(\'[\',"NIP_ASN",\']. \',"Nm_ASN") AS "Nm_ASN"'))
                            ->where('TA',\HelperKegiatan::getTahunAnggaran())
                            ->get()
                            ->pluck('Nm_ASN','ASNID')
                            ->prepend('','');

            return view("pages.$theme.dmaster.asnopd.create")->with(['page_active'=>'asnopd',
                                                                    'organisasi'=>$organisasi,
                                                                    'daftar_asn'=>$daftar_asn                                                                        
                                                                ]);        
        }
        else
        {
            return view("pages.$theme.dmaster.asnopd.error")->with(['page_active'=>'asnopd',
                                                                    'page_title'=>'ASN OPD',
                                                                    'errormessage'=>'Mohon OPD / SKPD untuk di pilih terlebih dahulu.'
                                                                ]);
        } 
            
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
            'ASNID'=>'required',
            'Jenis_Jabatan'=>'required',
        ]);
        
        $jns = $request->input('Jns');

        $asn = RiwayatJabatanASNModel::create ([
            'RiwayatJabatanASNID'=> uniqid ('uid'),
            'OrgID'=> $request->input('OrgID'),
            'ASNID'=> $request->input('ASNID'),
            'NIP_ASN' => $request->input('NIP_ASN'),
            'Jenis_Jabatan' => $request->input('Jenis_Jabatan'),
            'TA'=>\HelperKegiatan::getTahunAnggaran(),
        ]);        
     
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ]);
        }
        else
        {
            return redirect(route('asnopd.show',['uuid'=>$asn->RiwayatJabatanASNID]))->with('success','Data ini telah berhasil disimpan.');
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

        $data = RiwayatJabatanASNModel::join('tmASN','trRiwayatJabatanASN.ASNID','tmASN.ASNID')
                                        ->where('RiwayatJabatanASNID', $uuid)
                                        ->firstOrFail();
        if (!is_null($data)) {
            return view("pages.$theme.dmaster.asnopd.show")->with(['page_active' => 'asnopd',
                                                                'data' => $data,
                                                            ]);
        }
    }    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$uuid)
    {
        $theme = 'dore';
        
        $riwayat_asn = RiwayatJabatanASNModel::find($uuid);
        $result=$riwayat_asn->delete();
        if ($request->ajax()) 
        {
            $currentpage=$this->getCurrentPageInsideSession('asnopd'); 
            $data=$this->populateData($currentpage);
            if ($currentpage > $data->lastPage())
            {            
                $data = $this->populateData($data->lastPage());
            }
            $datatable = view("pages.$theme.dmaster.asnopd.datatable")->with(['page_active'=>'asnopd',
                                                                                        'search'=>$this->getControllerStateSession('asnopd','search'),
                                                                                        'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                                                        'column_order'=>$this->getControllerStateSession('asnopd.orderby','column_name'),
                                                                                        'direction'=>$this->getControllerStateSession('asnopd.orderby','order'),
                                                                                        'data'=>$data])->render();      
            
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('asnopd.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
}