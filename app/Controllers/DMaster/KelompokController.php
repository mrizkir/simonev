<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\KelompokModel;
use Illuminate\Http\Request;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;

class KelompokController extends Controller
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
        if (!$this->checkStateIsExistSession('kelompok', 'orderby')) {
            $this->putControllerStateSession('kelompok', 'orderby', ['column_name' => 'KlpID', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('kelompok.orderby', 'column_name');
        $direction = $this->getControllerStateSession('kelompok.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = KelompokModel::select(\DB::raw('
                                                "tmKlp"."KlpID",
                                                "tmKlp"."StrID",
                                                "tmKlp"."Kd_Rek_2",
                                                CONCAT("tmStr"."Kd_Rek_1",\'.\',"tmKlp"."Kd_Rek_2") AS "kode_rek2",
                                                "tmKlp"."KlpNm",                                                
                                                "tmKlp"."Descr",
                                                "tmKlp"."TA",
                                                "tmKlp"."created_at",
                                                "tmKlp"."updated_at"
                                            '))
            ->join('tmStr', 'tmStr.StrID', 'tmKlp.StrID')
            ->where('tmKlp.TA', \HelperKegiatan::getTahunAnggaran())
            ->orderBy('tmStr.Kd_Rek_1', 'ASC')
            ->orderBy('tmKlp.Kd_Rek_2', 'ASC')
            ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('kelompok.index'));
        return $data;
    }      
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $this->getControllerStateSession('kelompok', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('kelompok');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('kelompok', $currentpage);


        return response()->json(['page_active'=>'kelompok',
                                'search'=>$this->getControllerStateSession('kelompok','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('kelompok.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('kelompok.orderby','order'),
                                'daftar_kelompok'=>$data],200);   
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $daftar_transaksi=\App\Models\DMaster\TransaksiModel::getDaftarTransaksi(\HelperKegiatan::getTahunAnggaran(),false);
        return response()->json($daftar_transaksi,200);  
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
            'Kd_Rek_2' => [
                new CheckRecordIsExistValidation('tmKlp', ['where' => ['StrID', '=', $request->input('StrID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'KlpNm' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
            $kelompok = KelompokModel::create([
                'KlpID' => uniqid('uid'),
                'StrID' => $request->input('StrID'),
                'Kd_Rek_2' => $request->input('Kd_Rek_2'),
                'KlpNm' => $request->input('KlpNm'),
                'Descr' => $request->input('Descr'),
                'TA' => \HelperKegiatan::getTahunAnggaran(),
            ]);

            return response()->json([            
                'message'=>'Data kelompok telah berhasil disimpan.'
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
        $kelompok = KelompokModel::findOrFail($uuid);
        $validator = \Validator::make($request->all(),[
            'Kd_Rek_2' => [
                new IgnoreIfDataIsEqualValidation('tmKlp', $kelompok->Kd_Rek_2, ['where' => ['StrID', '=', $request->input('StrID')]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'KlpNm' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
            $kelompok->StrID = $request->input('StrID');
            $kelompok->Kd_Rek_2 = $request->input('Kd_Rek_2');
            $kelompok->KlpNm = $request->input('KlpNm');
            $kelompok->Descr = $request->input('Descr ');
            $kelompok->save();

            return response()->json([            
                'message'=>'Data kelompok telah berhasil diubah.'
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
        $kelompok = KelompokModel::find($uuid);
        $result = $kelompok->delete();
        return response()->json(['message'=>"data kelompok dengan ID ($uuid) Berhasil di Hapus"],200);
    }
}
