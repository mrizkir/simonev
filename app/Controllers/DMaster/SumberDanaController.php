<?php

namespace App\Controllers\DMaster;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\DMaster\SumberDanaModel;

class SumberDanaController extends Controller {
     /**
     * Membuat sebuah objek
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $data = SumberDanaModel::where ('TA',\HelperKegiatan::getTahunPerencanaan())
                                ->orderBy('Nm_SumberDana','ASC')
                                ->get();               
        
        return response()->json($data,200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SumberDanaModel::findOrFail($id);
        return response()->json($data,200);    
    }
}
