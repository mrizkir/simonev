<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\ASNModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;
use Illuminate\Http\Request;

class ASNController extends Controller
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
        if (!$this->checkStateIsExistSession('asn', 'orderby')) {
            $this->putControllerStateSession('asn', 'orderby', ['column_name' => 'NIP_ASN', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('asn.orderby', 'column_name');
        $direction = $this->getControllerStateSession('asn.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        if ($this->checkStateIsExistSession('asn','search')) 
        {
            $search=$this->getControllerStateSession('asn','search');
            switch ($search['kriteria']) 
            {
                case 'NIP_ASN' :                
                    $data = ASNModel::where('TA', \HelperKegiatan::getTahunAnggaran())
                                    ->where('NIP_ASN', $search['isikriteria'])
                                    ->orderBy($column_order, $direction);
                break;
                case 'Nm_ASN' :
                    $data = ASNModel::where('TA', \HelperKegiatan::getTahunAnggaran())
                                    ->where('Nm_ASN', $search['isikriteria'])
                                    ->orderBy($column_order, $direction);
                break;
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = ASNModel::where('TA', \HelperKegiatan::getTahunAnggaran())
                                    ->orderBy($column_order, $direction)
                                    ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        }
        $data->setPath(route('asn.index'));
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
            $this->destroyControllerStateSession('asn', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('asn', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('asn', 1);
        $data = $this->populateData();

        return response()->json(['page_active'=>'asn',
                                'search'=>$this->getControllerStateSession('asn','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('asn.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('asn.orderby','order'),
                                'daftar_asn'=>$data],200);        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $this->getControllerStateSession('asn', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('asn');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) 
        {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('asn', $currentpage);

        return response()->json(['page_active'=>'asn',
                                'search'=>$this->getControllerStateSession('asn','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('asn.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('asn.orderby','order'),
                                'daftar_asn'=>$data],200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $ta = \HelperKegiatan::getTahunAnggaran();
        $validator=\Validator::make($request->all(), [
            'NIP_ASN'=> [new CheckRecordIsExistValidation('tmASN',['where'=>['TA','=',$ta]]),
                        'required',
                        'regex:/^[0-9]+$/'],
            'Nm_ASN'=>'required',
        ]);
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {        
            $asn = ASNModel::create ([
                'ASNID'=> uniqid ('uid'),
                'NIP_ASN' => $request->input('NIP_ASN'),
                'Nm_ASN' => $request->input('Nm_ASN'),
                'Descr' => $request->input('Descr'),
                'TA'=>$ta,
            ]);  
            
            return response()->json([            
                'message'=>'Data ini telah berhasil disimpan.'
            ],200); 
        }
        
    }  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$uuid)
    {        
        $asn = ASNModel::find($uuid);
        
        $validator=\Validator::make($request->all(), [    
            'NIP_ASN'=>'required|regex:/^[0-9]+$/',
            'Nm_ASN'=>'required',
        ]);
        
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>"Data ini gagal disimpan karena NIP sudah tersedia pada tahun $ta."
            ],500);
        }
        else
        {   
            $asn->NIP_ASN = $request->input('NIP_ASN');
            $asn->Nm_ASN = $request->input('Nm_ASN');
            $asn->Descr = $request->input('Descr');
            $asn->save();

            return response()->json([            
                'message'=>'Data ini telah berhasil diubah.'
            ],200); 
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
        $asn = ASNModel::find($uuid);
        $result=$asn->delete();
        return response()->json(['message'=>"data asn dengan ID ($uuid) Berhasil di Hapus"],200);                
    }
}
