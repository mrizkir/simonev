<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\TransaksiModel;
use Illuminate\Http\Request;
use App\Rules\CheckRecordIsExistValidation;
use App\Rules\IgnoreIfDataIsEqualValidation;


class TransaksiController extends Controller
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
        if (!$this->checkStateIsExistSession('transaksi', 'orderby')) {
            $this->putControllerStateSession('transaksi', 'orderby', ['column_name' => 'Kd_Rek_1', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('transaksi.orderby', 'column_name');
        $direction = $this->getControllerStateSession('transaksi.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = TransaksiModel::where('TA', \HelperKegiatan::getTahunAnggaran())
                            ->orderBy('Kd_Rek_1', 'ASC')
                            ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('transaksi.index'));
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $this->getControllerStateSession('transaksi', 'search');
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('transaksi');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('transaksi', $currentpage);

        return response()->json(['page_active'=>'transaksi',
                                'search'=>$this->getControllerStateSession('transaksi','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('transaksi.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('transaksi.orderby','order'),
                                'daftar_transaksi'=>$data],200);   
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
            'Kd_Rek_1' => [
                new CheckRecordIsExistValidation('tmStr', ['where' => ['TA', '=', \HelperKegiatan::getTahunAnggaran()]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'StrNm' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
            $transaksi = TransaksiModel::create([
                'StrID' => uniqid('uid'),
                'Kd_Rek_1' => $request->input('Kd_Rek_1'),
                'StrNm' => $request->input('StrNm'),
                'Descr' => $request->input('Descr'),
                'TA' => \HelperKegiatan::getTahunAnggaran(),
            ]);

            return response()->json([            
                'message'=>'Data transaksi telah berhasil disimpan.'
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
        $transaksi = TransaksiModel::find($uuid);
        $validator = \Validator::make($request->all(),[
            'Kd_Rek_1' => [
                new IgnoreIfDataIsEqualValidation('tmStr', $transaksi->Kd_Rek_1, ['where' => ['TA', '=', \HelperKegiatan::getTahunAnggaran()]]),
                'required',
                'min:1',
                'regex:/^[0-9]+$/'
            ],
            'StrNm' => 'required',
        ]);
        
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
            $transaksi->Kd_Rek_1 = $request->input('Kd_Rek_1');
            $transaksi->StrNm = $request->input('StrNm');
            $transaksi->Descr = $request->input('Descr');
            $transaksi->save();

            return response()->json([            
                'message'=>'Data transaksi telah berhasil diubah.'
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
        $transaksi = TransaksiModel::find($uuid);
        $result = $transaksi->delete();
        return response()->json(['message'=>"data transaksi dengan ID ($uuid) Berhasil di Hapus"],200);
    }
}
