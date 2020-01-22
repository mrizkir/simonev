<?php

namespace App\Controllers\Report;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\Report\FormAMurniModel;

class FormAMurniController extends Controller 
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
        //set nama session 
        $this->SessionName=$this->getNameForSession();      
        //set nama halaman saat ini
        $this->NameOfPage = \Helper::getNameOfPage();
    }	
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function index (Request $request) 
    {  
        $RKAID = $request->input('RKAID');      
        $no_bulan = $request->input('no_bulan');

        $forma=new FormAMurniModel([],false);
        $rka = $forma->getDataRKA($RKAID,$no_bulan,\HelperKegiatan::getLevelEntriByName($this->NameOfPage));
        if (is_null($rka) )
        {
            response()->json("ID Kekegiatan ($id) tidak dikenali", 500);
        }  
        else
        {
            $tingkat = $forma->getRekeningProyek();    
            $generated_html=view('pages.forma.datatableuraian')->with([
                                                                        'rka'=>$rka,
                                                                        'tingkat'=>$tingkat,
                                                                    ])->render();
            return response()->json([
                                    'RKAID'=>$RKAID,
                                    'generated_html'=>$generated_html
                                ],200);
        }
    }
    /**
     * collect data from resources for print out to excel
     *
     * @return file  excel
     */
    public function printtoexcel (Request $request)
    {
        $RKAID=$request->RKAID;
        $no_bulan=$request->no_bulan;

        $data_report['RKAID']=$RKAID;
        $data_report['no_bulan']=$no_bulan;
        $data_report['entryLvl']=\HelperKegiatan::getLevelEntriByName($this->NameOfPage);
        
        $report= new \App\Models\Report\FormAMurniModel ($data_report);
        $generate_date=date('Y-m-d_H_m_s');
        return $report->download("forma_a_$generate_date.xlsx");
    }
}