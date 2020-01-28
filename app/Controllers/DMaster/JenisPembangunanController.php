<?php

namespace App\Controllers\DMaster;

use App\Controllers\Controller;
use App\Models\DMaster\JenisPembangunanModel;
use Illuminate\Http\Request;

class JenisPembangunanController extends Controller
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
        if (!$this->checkStateIsExistSession('jenispembangunan', 'orderby')) {
            $this->putControllerStateSession('jenispembangunan', 'orderby', ['column_name' => 'NamaJenis', 'order' => 'asc']);
        }
        $column_order = $this->getControllerStateSession('jenispembangunan.orderby', 'column_name');
        $direction = $this->getControllerStateSession('jenispembangunan.orderby', 'order');

        if (!$this->checkStateIsExistSession('global_controller', 'numberRecordPerPage')) {
            $this->putControllerStateSession('global_controller', 'numberRecordPerPage', 10);
        }
        $numberRecordPerPage = $this->getControllerStateSession('global_controller', 'numberRecordPerPage');

        $data = JenisPembangunanModel::where('TA', \HelperKegiatan::getTahunAnggaran())
                        ->orderBy($column_order, $direction)
                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage);

        $data->setPath(route('jenispembangunan.index'));
        return $data;
    }  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentpage = $request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('jenispembangunan');
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage()) 
        {
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('jenispembangunan', $currentpage);

        return response()->json(['page_active'=>'jenispembangunan',
                                'search'=>$this->getControllerStateSession('jenispembangunan','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('jenispembangunan.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('jenispembangunan.orderby','order'),
                                'daftar_jenispembangunan'=>$data],200);   
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
            'NamaJenis'=>'required',
        ]);
        
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
            $jenispembangunan = JenisPembangunanModel::create ([
                'JenisPembangunanID'=> uniqid ('uid'),
                'NamaJenis' => $request->input('NamaJenis'),
                'Descr' => $request->input('Descr'),
                'TA'=>\HelperKegiatan::getTahunAnggaran(),
            ]);     
            
            return response()->json([            
                'message'=>'Data jenis pelaksanaan telah berhasil disimpan.'
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
        $jenispembangunan = JenisPembangunanModel::find($uuid);
        
        $validator = \Validator::make($request->all(),[          
            'NamaJenis'=>'required',
        ]);
        
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {

            $jenispembangunan->NamaJenis = $request->input('NamaJenis');
            $jenispembangunan->Descr = $request->input('Descr');
            $jenispembangunan->save();

            return response()->json([            
                'message'=>'Data jenis pelaksanaan telah berhasil diubah.'
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
        
        $jenispembangunan = JenisPembangunanModel::find($uuid);
        $result=$jenispembangunan->delete();
        return response()->json(['message'=>"data jenis pelaksanaan dengan ID ($uuid) Berhasil di Hapus"],200);  
    }
}
