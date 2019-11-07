<?php

namespace App\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;
use App\Models\DMaster\PaguAnggaranOPDModel;
use App\Models\DMaster\OrganisasiModel;
use Illuminate\Support\Facades\Validator;

class PaguAnggaranOPDController extends Controller {
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
    public function populateData ($currentpage=1) 
    {        
        $columns=['*'];       
        if (!$this->checkStateIsExistSession('paguanggaranopd','orderby')) 
        {            
           $this->putControllerStateSession('paguanggaranopd','orderby',['column_name'=>'v_urusan_organisasi.kode_organisasi','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('paguanggaranopd.orderby','column_name'); 
        $direction=$this->getControllerStateSession('paguanggaranopd.orderby','order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');        
        if ($this->checkStateIsExistSession('paguanggaranopd','search')) 
        {
            $search=$this->getControllerStateSession('paguanggaranopd','search');
            switch ($search['kriteria']) 
            {
                case 'kode_organisasi' :
                    $data = PaguAnggaranOPDModel::join('v_urusan_organisasi','tmPaguAnggaranOPD.OrgID','v_urusan_organisasi.OrgID')
                                                ->where('kode_organisasi', $search['isikriteria'])
                                                ->where('tmPaguAnggaranOPD.TA',\HelperKegiatan::getTahunPerencanaan())
                                                ->orderBy($column_order,$direction);                                        
                break;
                case 'OrgNm' :
                    $data = PaguAnggaranOPDModel::join('v_urusan_organisasi','tmPaguAnggaranOPD.OrgID','v_urusan_organisasi.OrgID')
                                                ->where('OrgNm', 'ilike', '%' . $search['isikriteria'] . '%')
                                                ->where('tmPaguAnggaranOPD.TA',\HelperKegiatan::getTahunPerencanaan())
                                                ->orderBy($column_order,$direction);                                        
                break;
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = PaguAnggaranOPDModel::join('v_urusan_organisasi','tmPaguAnggaranOPD.OrgID','v_urusan_organisasi.OrgID')
                                        ->where('tmPaguAnggaranOPD.TA',\HelperKegiatan::getTahunPerencanaan())
                                        ->orderBy($column_order,$direction)
                                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        } 

        return $data;
    }    
    /**
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search (Request $request) 
    {
        $action = $request->input('action');
        if ($action == 'reset') 
        {
            $this->destroyControllerStateSession('paguanggaranopd','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('paguanggaranopd','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('paguanggaranopd',1);
        $data=$this->populateData();
        
        return response()->json(['page_active'=>'paguanggaranopd',
                                'search'=>$this->getControllerStateSession('paguanggaranopd','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('paguanggaranopd.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('paguanggaranopd.orderby','order'),
                                'daftar_paguanggaran'=>$data],200);   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $search=$this->getControllerStateSession('paguanggaranopd','search');
        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('paguanggaranopd'); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('paguanggaranopd',$currentpage);        
        return response()->json(['page_active'=>'paguanggaranopd',
                                'search'=>$this->getControllerStateSession('paguanggaranopd','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('paguanggaranopd.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('paguanggaranopd.orderby','order'),
                                'daftar_paguanggaran'=>$data],200);   
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $q=\DB::table('v_urusan_organisasi')
                                ->select(\DB::raw('"v_urusan_organisasi"."OrgID","v_urusan_organisasi"."kode_organisasi","v_urusan_organisasi"."OrgNm"'))
                                ->leftJoin('tmPaguAnggaranOPD','tmPaguAnggaranOPD.OrgID','v_urusan_organisasi.OrgID')
                                ->whereNull('tmPaguAnggaranOPD.OrgID')
                                ->where('v_urusan_organisasi.TA',\HelperKegiatan::getTahunPerencanaan())
                                ->orderBy('kode_organisasi')
                                ->get();
        $daftar_organisasi=[];        
        foreach ($q as $k=>$v)
        {
            $daftar_organisasi[$v->OrgID]=$v->kode_organisasi.'. '.$v->OrgNm;
        } 
        return response()->json($daftar_organisasi,200);  
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'OrgID'=> [new CheckRecordIsExistValidation('tmPaguAnggaranOPD',['where'=>['TA','=',\HelperKegiatan::getTahunPerencanaan()]]),
                        'required'],
            'Jumlah1'=>'required|numeric',
            'Jumlah2'=>'required|numeric',
        ]);
        $ta = \HelperKegiatan::getTahunPerencanaan();
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>"Data ini gagal disimpan karena OrgID sudah tersedia pada tahun $ta."
            ],500);
        }
        else
        {
            $paguanggaranopd = PaguAnggaranOPDModel::create([
                'PaguAnggaranOPDID' => uniqid ('uid'),
                'OrgID' => $request->input('OrgID'),
                'Jumlah1' => $request->input('Jumlah1'),
                'Jumlah2' => $request->input('Jumlah2'),
                'Descr' => $request->input('Descr'),
                'TA' => \HelperKegiatan::getTahunPerencanaan()
            ]);        
            return response()->json([            
                'message'=>'Data ini telah berhasil disimpan.'
            ],200); 
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = PaguAnggaranOPDModel::join('v_urusan_organisasi','tmPaguAnggaranOPD.OrgID','v_urusan_organisasi.OrgID')
                                    ->find($id);

        return response()->json($data,200);   
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paguanggaranopd = PaguAnggaranOPDModel::find($id);
        
        $validator=Validator::make($request->all(), [            
            'Jumlah1'=>'required|numeric',
            'Jumlah2'=>'required|numeric',
        ]);
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>"Data ini gagal diubah."
            ],500);
        }
        else
        {
            $paguanggaranopd->Jumlah1 = $request->input('Jumlah1');
            $paguanggaranopd->Jumlah2 = $request->input('Jumlah2');
            $paguanggaranopd->Descr = $request->input('Descr');       
            
            $paguanggaranopd->save();

            return response()->json([            
                'message'=>'Data ini telah berhasil diubah.'
            ],200); 
        }        
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {        
        $paguanggaranopd = PaguAnggaranOPDModel::find($id);
        $paguanggaranopd->delete();
        return response()->json(['message'=>"data pagu anggaran opd dengan ID ($id) Berhasil di Hapus"],200);         
    }
}