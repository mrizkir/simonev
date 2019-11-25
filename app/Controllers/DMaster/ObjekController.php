<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\ObjekModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;
use Illuminate\Http\Request;

class ObjekController extends Controller
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
        if (!$this->checkStateIsExistSession('objek', 'orderby')) {
            $this->putControllerStateSession('objek', 'orderby', ['column_name' => 'ObyID', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('objek.orderby', 'column_name');
        $direction = $this->getControllerStateSession('objek.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');
        
        if ($this->checkStateIsExistSession('objek','search')) 
        {
            $search=$this->getControllerStateSession('objek','search');
            switch ($search['kriteria']) 
            {
                case 'kode_rek5' :
                    $data = ObjekModel::select(\DB::raw('
                                                "tmROby"."RObyID",
                                                "tmROby"."ObyID",                                            
                                                "tmROby"."Kd_Rek_5",
                                                CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4",\'.\',"tmROby"."Kd_Rek_5") AS "kode_rek5",
                                                "tmROby"."RObyNm",                                                
                                                "tmROby"."Descr",
                                                "tmROby"."TA",
                                                "tmROby"."created_at",
                                                "tmROby"."updated_at"
                                            '))
                    ->join('tmOby', 'tmOby.ObyID', 'tmROby.ObyID')
                    ->join('tmJns', 'tmJns.JnsID', 'tmOby.JnsID')
                    ->join('tmKlp', 'tmKlp.KlpID', 'tmJns.KlpID')
                    ->join('tmStr', 'tmKlp.StrID', 'tmStr.StrID')
                    ->where('tmROby.TA', \HelperKegiatan::getTahunAnggaran())
                    ->whereRaw('CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4",\'.\',"tmROby"."Kd_Rek_5")=\''.$search['isikriteria'].'\'')
                    ->orderBy('tmStr.Kd_Rek_1', 'ASC')
                    ->orderBy('tmKlp.Kd_Rek_2', 'ASC')
                    ->orderBy('tmJns.Kd_Rek_3', 'ASC')
                    ->orderBy('tmOby.Kd_Rek_4', 'ASC')
                    ->orderBy('tmROby.Kd_Rek_5', 'ASC');
                break;
                case 'RObyNm' : 
                    $data = ObjekModel::select(\DB::raw('
                                                "tmROby"."RObyID",
                                                "tmROby"."ObyID",                                            
                                                "tmROby"."Kd_Rek_5",
                                                CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4",\'.\',"tmROby"."Kd_Rek_5") AS "kode_rek5",
                                                "tmROby"."RObyNm",                                                
                                                "tmROby"."Descr",
                                                "tmROby"."TA",
                                                "tmROby"."created_at",
                                                "tmROby"."updated_at"
                                            '))
                    ->join('tmOby', 'tmOby.ObyID', 'tmROby.ObyID')
                    ->join('tmJns', 'tmJns.JnsID', 'tmOby.JnsID')
                    ->join('tmKlp', 'tmKlp.KlpID', 'tmJns.KlpID')
                    ->join('tmStr', 'tmKlp.StrID', 'tmStr.StrID')
                    ->where('tmROby.TA', \HelperKegiatan::getTahunAnggaran())
                    ->where('RObyNm', 'ilike', '%' . $search['isikriteria'] . '%')
                    ->orderBy('tmStr.Kd_Rek_1', 'ASC')
                    ->orderBy('tmKlp.Kd_Rek_2', 'ASC')
                    ->orderBy('tmJns.Kd_Rek_3', 'ASC')
                    ->orderBy('tmOby.Kd_Rek_4', 'ASC')
                    ->orderBy('tmROby.Kd_Rek_5', 'ASC');
                break;
            }
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = ObjekModel::select(\DB::raw('
                                                "tmROby"."RObyID",
                                                "tmROby"."ObyID",                                            
                                                "tmROby"."Kd_Rek_5",
                                                CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3",\'.\',"tmOby"."Kd_Rek_4",\'.\',"tmROby"."Kd_Rek_5") AS "kode_rek5",
                                                "tmROby"."RObyNm",                                                
                                                "tmROby"."Descr",
                                                "tmROby"."TA",
                                                "tmROby"."created_at",
                                                "tmROby"."updated_at"
                                            '))
                    ->join('tmOby', 'tmOby.ObyID', 'tmROby.ObyID')
                    ->join('tmJns', 'tmJns.JnsID', 'tmOby.JnsID')
                    ->join('tmKlp', 'tmKlp.KlpID', 'tmJns.KlpID')
                    ->join('tmStr', 'tmKlp.StrID', 'tmStr.StrID')
                    ->where('tmROby.TA', \HelperKegiatan::getTahunAnggaran())
                    ->orderBy('tmStr.Kd_Rek_1', 'ASC')
                    ->orderBy('tmKlp.Kd_Rek_2', 'ASC')
                    ->orderBy('tmJns.Kd_Rek_3', 'ASC')
                    ->orderBy('tmOby.Kd_Rek_4', 'ASC')
                    ->orderBy('tmROby.Kd_Rek_5', 'ASC')
                    ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);
        }
        $data->setPath(route('objek.index'));
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
            $this->destroyControllerStateSession('objek', 'search');
        } else {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('objek', 'search', ['kriteria' => $kriteria, 'isikriteria' => $isikriteria]);
        }
        $this->setCurrentPageInsideSession('objek', 1);
        $data = $this->populateData();

        return response()->json(['page_active'=>'objek',
                                'search'=>$this->getControllerStateSession('objek','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('objek.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('objek.orderby','order'),
                                'daftar_objek'=>$data],200);   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('objek');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('objek', $currentpage);

        return response()->json(['page_active'=>'objek',
                                'search'=>$this->getControllerStateSession('objek','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('objek.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('objek.orderby','order'),
                                'daftar_objek'=>$data],200);  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftar_rincian=\App\Models\DMaster\RincianModel::getDaftarRincian(\HelperKegiatan::getTahunAnggaran(),false);
        return response()->json($daftar_rincian,200);
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
            'Kd_Rek_5' => [
                new CheckRecordIsExistValidation('tmROby', ['where' => ['ObyID', '=', $request->input('ObyID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'RObyNm' => 'required',
        ]);
        
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
            $objek = ObjekModel::create([
                'RObyID' => uniqid('uid'),
                'ObyID' => $request->input('ObyID'),
                'Kd_Rek_5' => $request->input('Kd_Rek_5'),
                'RObyNm' => $request->input('RObyNm'),
                'Descr' => $request->input('Descr'),
                'TA' => \HelperKegiatan::getTahunAnggaran(),
            ]);

            return response()->json([            
                'message'=>'Data objek telah berhasil disimpan.'
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
        $objek = ObjekModel::find($uuid);

        $validator = \Validator::make($request->all(),[
            'Kd_Rek_5' => [
                new IgnoreIfDataIsEqualValidation('tmOby', $objek->Kd_Rek_5, ['where' => ['ObyID', '=', $request->input('ObyID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'RObyNm' => 'required',
        ]);
        
        if ($validator->fails())
		{
			return response()->json([            
                'message'=>$validator->errors(),
            ],422);			
		}
		else
		{
            $objek->ObyID = $request->input('ObyID');
            $objek->Kd_Rek_5 = $request->input('Kd_Rek_5');
            $objek->RObyNm = $request->input('RObyNm');
            $objek->Descr = $request->input('Descr');
            $objek->save();

            return response()->json([            
                'message'=>'Data objek telah berhasil diubah.',
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
        $objek = ObjekModel::find($uuid);
        $result = $objek->delete();
        return response()->json(['message'=>"data rincian dengan ID ($uuid) Berhasil di Hapus"],200);
    }
}
