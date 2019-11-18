<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\JenisModel;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;
use Illuminate\Http\Request;

class JenisController extends Controller
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
        if (!$this->checkStateIsExistSession('jenis', 'orderby')) {
            $this->putControllerStateSession('jenis', 'orderby', ['column_name' => 'JnsID', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('jenis.orderby', 'column_name');
        $direction = $this->getControllerStateSession('jenis.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = JenisModel::where('TA', \HelperKegiatan::getTahunAnggaran())
                            ->orderBy($column_order, $direction)
                            ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data = JenisModel::select(\DB::raw('
                                            "tmJns"."JnsID",
                                            "tmJns"."KlpID",                                            
                                            "tmJns"."Kd_Rek_3",
                                            CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2",\'.\',"tmJns"."Kd_Rek_3") AS "kode_rek3",
                                            "tmJns"."JnsNm",                                                
                                            "tmJns"."Descr",
                                            "tmJns"."TA",
                                            "tmJns"."created_at",
                                            "tmJns"."updated_at"
                                        '))
                ->join('tmKlp', 'tmKlp.KlpID', 'tmJns.KlpID')
                ->join('tmStr', 'tmKlp.StrID', 'tmStr.StrID')
                ->where('tmJns.TA', \HelperKegiatan::getTahunAnggaran())
                ->orderBy('tmStr.Kd_Rek_1', 'ASC')
                ->orderBy('tmKlp.Kd_Rek_2', 'ASC')
                ->orderBy('tmJns.Kd_Rek_3', 'ASC')
                ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('jenis.index'));
        return $data;
    }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $this->getControllerStateSession('jenis', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('jenis');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('jenis', $currentpage);

        return response()->json(['page_active'=>'jenis',
                                'search'=>$this->getControllerStateSession('jenis','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('jenis.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('jenis.orderby','order'),
                                'daftar_jenis'=>$data],200);   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftar_kelompok=\App\Models\DMaster\KelompokModel::getDaftarKelompok(\HelperKegiatan::getTahunAnggaran(),false);
        return response()->json($daftar_kelompok,200);  
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
            'Kd_Rek_3' => [
                new CheckRecordIsExistValidation('tmJns', ['where' => ['KlpID', '=', $request->input('KlpID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'JnsNm' => 'required',
        ]);
		
		if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
			$jenis = JenisModel::create([
				'JnsID' => uniqid('uid'),
				'KlpID' => $request->input('KlpID'),
				'Kd_Rek_3' => $request->input('Kd_Rek_3'),
				'JnsNm' => $request->input('JnsNm'),
				'Descr' => $request->input('Descr'),
				'TA' => \HelperKegiatan::getTahunAnggaran(),
			]);

			return response()->json([            
                'message'=>'Data jenis telah berhasil disimpan.'
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
        $jenis = JenisModel::find($uuid);
        $validator = \Validator::make($request->all(),[
            'Kd_Rek_3' => [
                new IgnoreIfDataIsEqualValidation('tmJns', $jenis->Kd_Rek_3, ['where' => ['KlpID', '=', $request->input('KlpID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'JnsNm' => 'required',
        ]);
		
		if ($validator->fails())
		{
			return response()->json([            
                'message'=>$validator->errors(),
            ],422);			

		}
		else
		{
			$jenis->KlpID = $request->input('KlpID');
			$jenis->Kd_Rek_3 = $request->input('Kd_Rek_3');
			$jenis->JnsNm = $request->input('JnsNm');
			$jenis->Descr = $request->input('Descr');
			$jenis->TA = \HelperKegiatan::getTahunAnggaran();
            $jenis->save();
            
            return response()->json([            
                'message'=>'Data jenis telah berhasil diubah.'
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
        $jenis = JenisModel::find($uuid);
        $result = $jenis->delete();
        return response()->json(['message'=>"data jenis dengan ID ($uuid) Berhasil di Hapus"],200);
    }
}
