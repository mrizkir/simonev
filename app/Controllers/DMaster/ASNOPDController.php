<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\ASNModel;
use App\Models\DMaster\RiwayatJabatanASNModel;
use App\Rules\CheckRecordIsExistValidation;
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
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
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
  
        $OrgID = $request->input('OrgID')==''?'none':$request->input('OrgID');
        $filters['OrgID']=$OrgID;
        
        $this->putControllerStateSession('asnopd','filters',$filters);
        $this->setCurrentPageInsideSession('asnopd',1);

        $data = $this->populateData();
   
        return response()->json(['page_active'=>'asnopd',
                                'search'=>$this->getControllerStateSession('asnopd','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('asnopd.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('asnopd.orderby','order'),
                                'filters'=>$this->getControllerStateSession('asnopd','filters'), 
                                'daftar_asnopd'=>$data],200); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $this->getControllerStateSession('asnopd', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('asnopd');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) 
        {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('asnopd', $currentpage);

        return response()->json(['page_active'=>'asnopd',
                                'search'=>$this->getControllerStateSession('asnopd','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('asnopd.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('asnopd.orderby','order'),
                                'filters'=>$this->getControllerStateSession('asnopd','filters'), 
                                'daftar_asnopd'=>$data],200);  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
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

            return response()->json(['organisasi'=>$organisasi,
                                    'daftar_asn'=>$daftar_asn],200);        
        }
        else
        {
            return response()->json('Mohon dipilih OPD / SKPD',500);  
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
        $OrgID=$request->input('OrgID');
        $Jenis_Jabatan=$request->input('Jenis_Jabatan');
        $validator=\Validator::make($request->all(), [  
            'ASNID'=> [new CheckRecordIsExistValidation('trRiwayatJabatanASN',['where'=>['OrgID','=',$OrgID],
                                                                                'where'=>['Jenis_Jabatan','=',$Jenis_Jabatan]]),
                        'required'],
            'Jenis_Jabatan'=>'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {
            $asn = RiwayatJabatanASNModel::create ([
                'RiwayatJabatanASNID'=> uniqid ('uid'),
                'OrgID'=> $OrgID,
                'ASNID'=> $request->input('ASNID'),
                'Jenis_Jabatan' => $Jenis_Jabatan,
                'TA'=>\HelperKegiatan::getTahunAnggaran(),
            ]);   

            return response()->json([            
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
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
        $riwayat_asn = RiwayatJabatanASNModel::find($uuid);
        $result=$riwayat_asn->delete();
        return response()->json(['message'=>"data asn opd dengan ID ($uuid) Berhasil di Hapus"],200); 
    }
}