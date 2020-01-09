<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
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
        return view("pages.indexBackend")->with([                                                        
                                                                                                        
        ]);        
    }
}
