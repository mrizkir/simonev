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
            $this->putControllerStateSession('rincian', 'orderby', ['column_name' => 'ObyNm', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('rincian.orderby', 'column_name');
        $direction = $this->getControllerStateSession('rincian.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        if ($this->checkStateIsExistSession('rincian','search')) 
        {
            $search=$this->getControllerStateSession('rincian','search');
            switch ($search['kriteria']) 
            {
                case 'kode_rek4' :              
                    $data = RincianModel::select(\DB::raw('
                                                    "tmOby"."ObyID",
                                                    "tmOby"."JnsID",                                            
                                                    "tmOby"."Kd_Rek_4",
                                                    CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4") AS "kode_rek4",
                                                    "tmOby"."ObyNm",                                                
                                                    "tmOby"."Descr",
                                                    "tmOby"."TA",
                                                    "tmOby"."created_at",
                                                    "tmOby"."updated_at"
                                                '))
                        ->join('tmJns', 'tmJns.JnsID', 'tmOby.JnsID')
                        ->join('tmKlp', 'tmKlp.KlpID', 'tmJns.KlpID')
                        ->join('tmStr', 'tmKlp.StrID', 'tmStr.StrID')
                        ->where('tmOby.TA', \HelperKegiatan::getTahunAnggaran())
                        ->whereRaw('CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4")=\''.$search['isikriteria'].'\'')
                        ->orderBy('tmStr.Kd_Rek_1', 'ASC')
                        ->orderBy('tmKlp.Kd_Rek_2', 'ASC')
                        ->orderBy('tmJns.Kd_Rek_3', 'ASC')
                        ->orderBy('tmOby.Kd_Rek_4', 'ASC');
                break;
                case 'ObyNm' :                  
                    $data = RincianModel::select(\DB::raw('
                                                "tmOby"."ObyID",
                                                "tmOby"."JnsID",                                            
                                                "tmOby"."Kd_Rek_4",
                                                CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4") AS "kode_rek4",
                                                "tmOby"."ObyNm",                                                
                                                "tmOby"."Descr",
                                                "tmOby"."TA",
                                                "tmOby"."created_at",
                                                "tmOby"."updated_at"
                                            '))
                    ->join('tmJns', 'tmJns.JnsID', 'tmOby.JnsID')
                    ->join('tmKlp', 'tmKlp.KlpID', 'tmJns.KlpID')
                    ->join('tmStr', 'tmKlp.StrID', 'tmStr.StrID')
                    ->where('tmOby.TA', \HelperKegiatan::getTahunAnggaran())
                    ->where('ObyNm', 'ilike', '%' . $search['isikriteria'] . '%')
                    ->orderBy('tmStr.Kd_Rek_1', 'ASC')
                    ->orderBy('tmKlp.Kd_Rek_2', 'ASC')
                    ->orderBy('tmJns.Kd_Rek_3', 'ASC')
                    ->orderBy('tmOby.Kd_Rek_4', 'ASC');
                break;
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = RincianModel::select(\DB::raw('
                                                "tmOby"."ObyID",
                                                "tmOby"."JnsID",                                            
                                                "tmOby"."Kd_Rek_4",
                                                CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4") AS "kode_rek4",
                                                "tmOby"."ObyNm",                                                
                                                "tmOby"."Descr",
                                                "tmOby"."TA",
                                                "tmOby"."created_at",
                                                "tmOby"."updated_at"
                                            '))
                    ->join('tmJns', 'tmJns.JnsID', 'tmOby.JnsID')
                    ->join('tmKlp', 'tmKlp.KlpID', 'tmJns.KlpID')
                    ->join('tmStr', 'tmKlp.StrID', 'tmStr.StrID')
                    ->where('tmOby.TA', \HelperKegiatan::getTahunAnggaran())
                    ->orderBy('tmStr.Kd_Rek_1', 'ASC')
                    ->orderBy('tmKlp.Kd_Rek_2', 'ASC')
                    ->orderBy('tmJns.Kd_Rek_3', 'ASC')
                    ->orderBy('tmOby.Kd_Rek_4', 'ASC')
                    ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        }
        $data->setPath(route('rincian.index'));
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
            $this->destroyControllerStateSession('rincian','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('rincian','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('rincian',1);
        $data=$this->populateData();
        
        return response()->json(['page_active'=>'rincian',
                                'search'=>$this->getControllerStateSession('rincian','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('rincian.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('rincian.orderby','order'),
                                'daftar_rincian'=>$data],200);   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('rincian');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('rincian', $currentpage);

        return response()->json(['page_active'=>'rincian',
                                'search'=>$this->getControllerStateSession('rincian','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('rincian.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('rincian.orderby','order'),
                                'daftar_rincian'=>$data],200);  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftar_jenis=\App\Models\DMaster\JenisModel::getDaftarJenis(\HelperKegiatan::getTahunAnggaran(),false);
        return response()->json($daftar_jenis,200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'Kd_Rek_4' => [
                new CheckRecordIsExistValidation('tmOby', [['where','JnsID', '=', $request->input('JnsID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'ObyNm' => 'required',
        ]);
        
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
            $rincian = RincianModel::create([
                'ObyID' => uniqid('uid'),
                'JnsID' =>  $request->input('JnsID'),
                'Kd_Rek_4' => $request->input('Kd_Rek_4'),
                'ObyNm' => $request->input('ObyNm'),
                'Descr' => $request->input('Descr'),
                'TA' => \HelperKegiatan::getTahunAnggaran(),
            ]);

            return response()->json([            
                'message'=>'Data rincian telah berhasil disimpan.'
            ],200);
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

        $validator = \Validator::make($request->all(),[
            'Kd_Rek_4' => [
                new IgnoreIfDataIsEqualValidation('tmOby', $rincian->Kd_Rek_4, [['where','JnsID', '=', $request->input('JnsID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'ObyNm' => 'required',
        ]);
        
        if ($validator->fails())
		{
			return response()->json([            
                'message'=>$validator->errors(),
            ],422);			
		}
		else
		{
            $rincian->JnsID = $request->input('JnsID');
            $rincian->Kd_Rek_4 = $request->input('Kd_Rek_4');
            $rincian->ObyNm = $request->input('ObyNm');
            $rincian->Descr = $request->input('Descr');
            $rincian->save();

            return response()->json([            
                'message'=>'Data rincian telah berhasil diubah.',
            ],200);
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
        $rincian = RincianModel::find($uuid);
        $result = $rincian->delete();
        return response()->json(['message'=>"data rincian dengan ID ($uuid) Berhasil di Hapus"],200);
    }
}