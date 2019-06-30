<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Controllers\Controller;

class FrontendController extends Controller {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {           
        if (\Auth::check()) {
            return redirect(route('dashboard.index'));
        }else{
            return view("welcome");            
        }                       
    }         
}