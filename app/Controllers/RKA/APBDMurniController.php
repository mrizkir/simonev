<?php

namespace App\Controllers\RKA;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\RKA\RKAKegiatanModel;
use App\Models\RKA\RKARincianKegiatanModel;
use App\Models\RKA\RKARencanaTargetModel;
use App\Models\RKA\RKARealisasiRincianKegiatanModel;

class APBDMurniController extends Controller 
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
    private function getDataRKA ($id)
    {
        $rka = RKAKegiatanModel::select(\DB::raw('"trRKA"."RKAID",
                                            "v_rka"."kode_urusan",
                                            "v_rka"."Nm_Bidang",
                                            "v_rka"."kode_organisasi",
                                            "v_rka"."OrgNm",
                                            "v_rka"."kode_suborganisasi",
                                            "v_rka"."SOrgNm",
                                            "v_rka"."kode_program",
                                            "v_rka"."PrgNm",
                                            "v_rka"."Kd_Keg",
                                            "v_rka"."kode_kegiatan",
                                            "v_rka"."KgtNm",
                                            "v_rka"."lokasi_kegiatan1",
                                            "v_rka"."SumberDanaID",
                                            "v_rka"."Nm_SumberDana",
                                            "v_rka"."tk_capaian1",
                                            "v_rka"."capaian_program1",
                                            "v_rka"."masukan1",
                                            "v_rka"."tk_keluaran1",
                                            "v_rka"."keluaran1",
                                            "v_rka"."tk_hasil1",
                                            "v_rka"."hasil1",
                                            "v_rka"."ksk1",
                                            "v_rka"."sifat_kegiatan1",
                                            "v_rka"."waktu_pelaksanaan1",
                                            "v_rka"."PaguDana1",
                                            "v_rka"."Descr",
                                            "v_rka"."EntryLvl",
                                            "v_rka"."created_at",
                                            "v_rka"."updated_at"
                                            '))
                            ->join('v_rka','v_rka.RKAID','trRKA.RKAID')     
                            ->where('trRKA.EntryLvl',\HelperKegiatan::getLevelEntriByName($this->NameOfPage))
                            ->findOrFail($id);

        return $rka;
    }
    /**
     * collect data from resources for datauraian view
     *
     * @return resources
     */
    public function populateDataUraian ($RKAID)
    {
        $data = \DB::table('trRKARinc')
                    ->select(\DB::raw('"RKARincID","RKAID",v_rekening."kode_rek_5",v_rekening."RObyNm",nama_uraian,volume1,satuan1,harga_satuan1,pagu_uraian1,"trRKARinc"."TA","trRKARinc"."Descr","trRKARinc"."created_at","trRKARinc"."updated_at"'))
                    ->join('v_rekening','v_rekening.RObyID','trRKARinc.RObyID')
                    ->where('RKAID',$RKAID)
                    ->orderByRaw('v_rekening."Kd_Rek_1"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_2"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_3"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_4"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_5"::int ASC')                    
                    ->get();
        return $data;
    }
    /**
     * collect data from resources for datauraian view
     *
     * @return resources
     */
    public function populateDataRencanaTargetFisik($RKAID)
    {
        $data = \DB::table('trRKARinc')
                    ->select(\DB::raw('
                        "trRKARinc"."RKARincID",
                        "RKAID",
                        v_rekening."kode_rek_5",
                        nama_uraian,
                        fisik_1,
                        fisik_2,
                        fisik_3,
                        fisik_4,
                        fisik_5,
                        fisik_6,
                        fisik_7,
                        fisik_8,
                        fisik_9,
                        fisik_10,
                        fisik_11,
                        fisik_12
                    '))
                    ->join('v_rekening','v_rekening.RObyID','trRKARinc.RObyID')
                    ->join('v_rencana_fisik_anggaran_kas','v_rencana_fisik_anggaran_kas.RKARincID','trRKARinc.RKARincID')
                    ->where('RKAID',$RKAID)
                    ->orderByRaw('v_rekening."Kd_Rek_1"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_2"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_3"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_4"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_5"::int ASC')                    
                    ->get();
        return $data;
    }
    /**
     * collect data from resources for datauraian view
     *
     * @return resources
     */
    public function populateDataRencanaAnggaranKas($RKAID)
    {
        $data = \DB::table('trRKARinc')
                    ->select(\DB::raw('
                        "trRKARinc"."RKARincID",
                        "RKAID",
                        v_rekening."kode_rek_5",
                        nama_uraian,
                        anggaran_1,
                        anggaran_2,
                        anggaran_3,
                        anggaran_4,
                        anggaran_5,
                        anggaran_6,
                        anggaran_7,
                        anggaran_8,
                        anggaran_9,
                        anggaran_10,
                        anggaran_11,
                        anggaran_12
                    '))
                    ->join('v_rekening','v_rekening.RObyID','trRKARinc.RObyID')
                    ->join('v_rencana_fisik_anggaran_kas','v_rencana_fisik_anggaran_kas.RKARincID','trRKARinc.RKARincID')
                    ->where('RKAID',$RKAID)
                    ->orderByRaw('v_rekening."Kd_Rek_1"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_2"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_3"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_4"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_5"::int ASC')                    
                    ->get();
        return $data;
    }
    /**
     * collect data from resources for datauraian view
     *
     * @return resources
     */
    public function populateDataRealisasi ($RKARincID)
    {
        $data = \DB::table('trRKARealisasiRinc')
                    ->select(\DB::raw('"RKARealisasiRincID","bulan1","target1","realisasi1",fisik1,"TA","created_at","updated_at"'))
                    ->where('RKARincID',$RKARincID)
                    ->orderBy('bulan1','ASC')
                    ->get();
        return $data;
    }    
    public function getDataTotalKegiatan($OrgID,$SOrgID)
    {        
        $datatotalkegiatan['pagu_kegiatan']=0;
        $datatotalkegiatan['pagu_uraian']=0;
        $datatotalkegiatan['total_realisasi']=0;
        $datatotalkegiatan['total_fisik']=0;
        $datatotalkegiatan['pagu_opd']=0;

        return $datatotalkegiatan;
    }    
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData ($currentpage=1) 
    {        
        $columns=['*'];       
        if (!$this->checkStateIsExistSession('apbdmurni','orderby')) 
        {            
           $this->putControllerStateSession('apbdmurni','orderby',['column_name'=>'KgtNm','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('apbdmurni.orderby','column_name'); 
        $direction=$this->getControllerStateSession('apbdmurni.orderby','order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');  
        
        //filter
        if (!$this->checkStateIsExistSession($this->SessionName,'filters')) 
        {            
            $this->putControllerStateSession($this->SessionName,'filters',[
                                                                            'OrgID'=>'',
                                                                            'SOrgID'=>'',
                                                                            'changetab'=>'ringkasan-tab',
                                                                            'RKARincID'=>'',
                                                                        ]);
        }        
        $SOrgID= $this->getControllerStateSession(\Helper::getNameOfPage('filters'),'SOrgID');

        if ($this->checkStateIsExistSession('apbdmurni','search')) 
        {
            $search=$this->getControllerStateSession('apbdmurni','search');
            switch ($search['kriteria']) 
            {
                case 'KgtNm' :
                    $data = RKAKegiatanModel::where(['KgtNm'=>$search['isikriteria']])->orderBy($column_order,$direction); 
                break;                
            }           
            $data = $data->paginate($numberRecordPerPage, $columns, 'page', $currentpage);  
        }
        else
        {
            $data = \DB::table('v_rka')
                        ->select(\DB::raw('"RKAID",kode_kegiatan,"KgtNm","PaguDana1",0 AS "TotalPaguUraian1",0 AS "TotalRealisasi1",0 AS "TotalFisik1"'))
                        ->where('SOrgID',$SOrgID)                                            
                        ->where('TA', \HelperKegiatan::getTahunAnggaran())  
                        ->where('EntryLvl',1)
                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        }      
        $data->setPath(route('apbdmurni.index'));
        $data->transform(function ($item,$key){
            $item->TotalPaguUraian1=\DB::table('trRKARinc')->where('RKAID',$item->RKAID)->sum('pagu_uraian1');
            $item->TotalRealisasi1=\DB::table('trRKARealisasiRinc')->where('RKAID',$item->RKAID)->sum('realisasi1');

            $jumlah_uraian=\DB::table('trRKARinc')->where('RKAID',$item->RKAID)->count('RKARincID');
            $total_fisik=\DB::table('trRKARealisasiRinc')->where('RKAID',$item->RKAID)->sum('fisik1');
            $item->TotalFisik1=\Helper::formatPecahan($total_fisik,$jumlah_uraian);
            return $item;
        });
        return $data;
    } 
    /**
     * filter resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request) 
    {        
        $filters=$this->getControllerStateSession('apbdmurni','filters');
        $daftar_unitkerja=[];
        $json_data = [];

        //index
        if ($request->exists('OrgID'))
        {
            $OrgID = $request->input('OrgID')==''?'none':$request->input('OrgID');
            $filters['OrgID']=$OrgID;
            $filters['SOrgID']='none';
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunAnggaran(),false,$OrgID);  
            
            $this->putControllerStateSession('apbdmurni','filters',$filters);

            $data = [];

            $datatable = view("pages.$theme.rka.apbdmurni.datatable")->with(['page_active'=>'apbdmurni',   
                                                                                    'datatotalkegiatan'=>$this->getDataTotalKegiatan($filters['OrgID'],$filters['SOrgID']),    
                                                                                    'search'=>$this->getControllerStateSession('apbdmurni','search'),
                                                                                    'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                    'column_order'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'column_name'),
                                                                                    'direction'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'order'),
                                                                                    'data'=>$data])->render();

          
            $json_data = ['success'=>true,'daftar_unitkerja'=>$daftar_unitkerja,'datatable'=>$datatable];
        } 
        //index
        if ($request->exists('SOrgID'))
        {
            $SOrgID = $request->input('SOrgID')==''?'none':$request->input('SOrgID');
            $filters['SOrgID']=$SOrgID;
            $this->putControllerStateSession('apbdmurni','filters',$filters);
            $this->setCurrentPageInsideSession('apbdmurni',1);

            $data = $this->populateData();            
            $datatable = view("pages.$theme.rka.apbdmurni.datatable")->with(['page_active'=>'apbdmurni',   
                                                                                    'datatotalkegiatan'=>$this->getDataTotalKegiatan($filters['OrgID'],$filters['SOrgID']),                                                           
                                                                                    'search'=>$this->getControllerStateSession('apbdmurni','search'),
                                                                                    'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                    'column_order'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'column_name'),
                                                                                    'direction'=>$this->getControllerStateSession(\Helper::getNameOfPage('orderby'),'order'),
                                                                                    'data'=>$data])->render();                                                                                       
            
            $json_data = ['success'=>true,'datatable'=>$datatable];            
        } 

        //select prgid create 0
        if ($request->exists('PrgID') && $request->exists('create'))
        {
            $PrgID = $request->input('PrgID')==''?'none':$request->input('PrgID');   
            $r=\DB::table('v_rkpd')
                    ->select(\DB::raw('"RKPDID","kode_kegiatan","KgtNm"'))
                    ->where('TA',\HelperKegiatan::getTahunAnggaran())
                    ->where('PrgID',$PrgID)
                    ->WhereNotIn('RKPDID',function($query) use ($filters) {
                        $query->select('RKPDID')
                                ->from('trRKA')
                                ->where('TA', \HelperKegiatan::getTahunAnggaran())
                                ->where('SOrgID', $filters['SOrgID']);
                    }) 
                    ->get();
            $daftar_rkpd=[];        
            foreach ($r as $k=>$v)
            {               
                $daftar_rkpd[$v->RKPDID]='['.$v->kode_kegiatan.']. '.$v->KgtNm . ' ('.$v->RKPDID.')';
            }                        
            $json_data['daftar_rkpd']=$daftar_rkpd;

            $r=\DB::table('v_program_kegiatan')
                    ->where('TA',\HelperKegiatan::getTahunAnggaran())
                    ->where('PrgID',$PrgID)
                    ->WhereNotIn('KgtID',function($query) {
                        $SOrgID=$this->getControllerStateSession($this->SessionName,'filters.SOrgID');
                        $query->select('KgtID')
                                ->from('trRKA')
                                ->where('TA', \HelperKegiatan::getTahunAnggaran())
                                ->where('SOrgID', $SOrgID);
                    }) 
                    ->get();
            $daftar_kegiatan=[];           
            foreach ($r as $k=>$v)
            {               
                $daftar_kegiatan[$v->KgtID]='['.$v->kode_kegiatan.']. '.$v->KgtNm;
            }            
            $json_data['daftar_kegiatan']=$daftar_kegiatan;
            $json_data['success']=true;
            $json_data['PrgID']=$PrgID;
        } 
        //select RKPDID create 0
        if ($request->exists('RKPDID') && $request->exists('create'))
        {
            $RKPDID = $request->input('RKPDID')==''?'none':$request->input('RKPDID'); 
            $daftar_kegiatan=[];  
            $r=\DB::table('v_rkpd')
                    ->where('TA',\HelperKegiatan::getTahunAnggaran())
                    ->where('RKPDID',$RKPDID)
                    ->WhereNotIn('KgtID',function($query) {
                        $SOrgID=$this->getControllerStateSession($this->SessionName,'filters.SOrgID');
                        $query->select('KgtID')
                                ->from('trRKA')
                                ->where('TA', \HelperKegiatan::getTahunAnggaran())
                                ->where('SOrgID', $SOrgID);
                    }) 
                    ->get();
            foreach ($r as $k=>$v)
            {               
                $daftar_kegiatan[$v->KgtID]='['.$v->kode_kegiatan.']. '.$v->KgtNm;
            }   
            $json_data['daftar_kegiatan']=$daftar_kegiatan;
            $json_data['NilaiUsulan2']=isset($r[0])?$r[0]->NilaiUsulan2:0;
            $json_data['success']=true;
            $json_data['RKPDID']=$RKPDID;
        }
        return response()->json($json_data,200);  
    }
    /**
     * search resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search (Request $request) 
    {
        $theme = 'dore';

        $filters=$this->getControllerStateSession('apbdmurni','filters');
        $action = $request->input('action');
        if ($action == 'reset') 
        {
            $this->destroyControllerStateSession('apbdmurni','search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession('apbdmurni','search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession('apbdmurni',1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.rka.apbdmurni.datatable")->with(['page_active'=>'apbdmurni', 
                                                                                'datatotalkegiatan'=>$this->getDataTotalKegiatan($filters['OrgID'],$filters['SOrgID']),                                                           
                                                                                'search'=>$this->getControllerStateSession('apbdmurni','search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('apbdmurni.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('apbdmurni.orderby','order'),
                                                                                'data'=>$data])->render();      
        
        return response()->json(['success'=>true,'datatable'=>$datatable],200);        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {             
        $OrgID=$request->header('OrgID');   
        $SOrgID=$request->header('SOrgID');   

        $filters=$this->getControllerStateSession('apbdmurni','filters');
        $filters['OrgID']=$OrgID;
        $filters['SOrgID']=$SOrgID;
        $this->putControllerStateSession('apbdmurni','filters',$filters);

        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession('apbdmurni'); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
            $currentpage = $data->currentPage();
        }
        $this->setCurrentPageInsideSession('apbdmurni',$currentpage); 
         
        return response()->json(['page_active'=>'apbdmurni',
                                'search'=>$this->getControllerStateSession('apbdmurni','search'),
                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                'column_order'=>$this->getControllerStateSession('apbdmurni.orderby','column_name'),
                                'direction'=>$this->getControllerStateSession('apbdmurni.orderby','order'),
                                'filters'=>$this->getControllerStateSession('apbdmurni','filters'), 
                                'daftar_apbdmurni'=>$data],200);            
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $theme = 'dore';
        $filters=$this->getControllerStateSession($this->SessionName,'filters');         
        $locked=false;
        if ($filters['SOrgID'] != 'none'&&$filters['SOrgID'] != ''&&$filters['SOrgID'] != null && $locked==false)
        {
            $SOrgID=$filters['SOrgID'];            
            $OrgID=$filters['OrgID'];

            $organisasi=\App\Models\DMaster\SubOrganisasiModel::select(\DB::raw('"v_suborganisasi"."OrgID","v_suborganisasi"."OrgIDRPJMD","v_suborganisasi"."UrsID","v_suborganisasi"."OrgNm","v_suborganisasi"."SOrgNm","v_suborganisasi"."kode_organisasi","v_suborganisasi"."kode_suborganisasi"'))
                                                                ->join('v_suborganisasi','tmSOrg.OrgID','v_suborganisasi.OrgID')
                                                                ->find($SOrgID);  

            $daftar_program = \App\Models\DMaster\ProgramModel::getDaftarProgramByOPD($organisasi->OrgIDRPJMD);            
            $daftar_pa=[];
            $daftar_kpa=[];
            $daftar_ppk=[];
            $daftar_pptk=[];
            
            return view("pages.$theme.rka.apbdmurni.create")->with(['page_active'=>'apbdmurni',
                                                                            'daftar_program'=>$daftar_program,                                                                                                                                                       
                                                                            'daftar_rkpd'=>[],
                                                                            'daftar_pa'=>$daftar_pa,
                                                                            'daftar_kpa'=>$daftar_kpa,
                                                                            'daftar_ppk'=>$daftar_ppk,
                                                                            'daftar_pptk'=>$daftar_pptk,
                                                                        ]);  
        }
        else
        {
            return view("pages.$theme.rka.apbdmurni.error")->with(['page_active'=>$this->NameOfPage,
                                                                    'page_title'=>\HelperKegiatan::getPageTitle($this->NameOfPage),
                                                                    'errormessage'=>'Mohon unit kerja untuk di pilih terlebih dahulu. bila sudah terpilih ternyata tidak bisa, berarti saudara tidak diperkenankan menambah kegiatan karena telah dikunci.'
                                                                ]);  
        }  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changerekening(Request $request)
    {
        $theme = 'dore';
        
        $json_data = [];
        $pid = $request->input('pid')==''?'none':$request->input('pid');
        switch ($pid)
        {
            case 'transaksi' :
                $StrID = $request->input('StrID')==''?'none':$request->input('StrID');
                $json_data['StrID']=$StrID;
                $json_data['daftar_kelompok']=\App\Models\DMaster\KelompokModel::getDaftarKelompokByParent($StrID,false);
            break;
            case 'kelompok' :
                $KlpID = $request->input('KlpID')==''?'none':$request->input('KlpID');
                $json_data['KlpID']=$KlpID;
                $json_data['daftar_jenis']=\App\Models\DMaster\JenisModel::getDaftarJenisByParent($KlpID,false);
            break;
            case 'jenis' :
                $JnsID = $request->input('JnsID')==''?'none':$request->input('JnsID');
                $json_data['JnsID']=$JnsID;
                $json_data['daftar_rincian']=\App\Models\DMaster\RincianModel::getDaftarRincianByParent($JnsID,false);
            break;
            case 'rincian' :
                $ObyID = $request->input('ObyID')==''?'none':$request->input('ObyID');
                $json_data['ObyID']=$ObyID;
                $json_data['daftar_obyek']=\App\Models\DMaster\ObjekModel::getDaftarObyekByParent($ObyID,false);
            break;
            case 'realisasi' :
                $RKARincID = $request->input('RKARincID')==''?'none':$request->input('RKARincID');
                $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
                $filters['RKARincID']=$RKARincID;
                $this->putControllerStateSession($this->SessionName,'filters',$filters);
                
                $rka=[];
                $datarealisasi=$this->populateDataRealisasi($filters['RKARincID']);            
                if (count($datarealisasi) > 0)
                {
                    $rinciankegiatan = RKARincianKegiatanModel::find($RKARincID);
                    $rkaid=$rinciankegiatan->RKAID;
                    $rka = $this->getDataRKA($rkaid);                                        
                }
                $datatable=view("pages.$theme.rka.apbdmurni.datatablerealisasi")->with(['page_active'=>'apbdmurni',                                                                            
                                                                                            'datarealisasi'=>$datarealisasi
                                                                                        ])->render();
                $json_data['RKARincID']=$RKARincID;
                $json_data['datatable']=$datatable;
            break;
            case 'tambahrencana' :
                $RKARincID = $request->input('RKARincID')==''?'none':$request->input('RKARincID');
                $data_uraian=RKARincianKegiatanModel::select(\DB::raw('pagu_uraian1'))
                                                    ->find($RKARincID);
                if (is_null($data_uraian))
                {
                    $json_data['pagu_uraian1']=0;                
                    $json_data['total_rencana_fisik']=0;
                    $json_data['total_rencana_anggaran']=0;
                }
                else
                {
                    $jumlah_realisasi=\DB::table('trRKARealisasiRinc')
                                            ->where('RKARincID',$RKARincID)
                                            ->sum('realisasi1');

                    $pagu_uraian1=$data_uraian->pagu_uraian1;
                    $json_data['pagu_uraian1']=$pagu_uraian1;  

                    $data_target=\DB::table('trRKATargetRinc')
                                ->select(\DB::raw('COALESCE(SUM(target1),0) AS target1, COALESCE(SUM(fisik1),0) AS fisik1'))
                                ->where('RKARincID',$RKARincID)
                                ->get();

                    $json_data['total_rencana_fisik']=$data_target[0]->fisik1;
                    $json_data['total_rencana_anggaran']=$data_target[0]->target1;
                }
                
                $json_data['RKARincID']=$RKARincID;
            break;
            case 'tambahrealisasi' :
                $RKARincID = $request->input('RKARincID')==''?'none':$request->input('RKARincID');
                $data_uraian=RKARincianKegiatanModel::select(\DB::raw('pagu_uraian1'))
                                                    ->find($RKARincID);
                if (is_null($data_uraian))
                {
                    $json_data['pagu_uraian1']=0;                
                    $json_data['sisa_pagu_rincian']=0;
                }
                else
                {
                    $jumlah_realisasi=\DB::table('trRKARealisasiRinc')
                                            ->where('RKARincID',$RKARincID)
                                            ->sum('realisasi1');

                    $pagu_uraian1=$data_uraian->pagu_uraian1;
                    $json_data['pagu_uraian1']=$pagu_uraian1;           
                    $daftar_bulan = [];
                    $bulan=\Helper::getBulan();
                    
                    $b1=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('bulan1'))
                                            ->where('RKARincID',$RKARincID)
                                            ->get();

                    $bulan_realisasi = [];
                    foreach ($b1 as $item)
                    {
                        $bulan_realisasi[$item->bulan1]=\Helper::getBulan($item->bulan1);
                    }
                    $daftar_bulan = array_diff_assoc($bulan,$bulan_realisasi);

                    $json_data['bulan']=$daftar_bulan;                
                    $json_data['sisa_pagu_rincian']=$pagu_uraian1-$jumlah_realisasi;
                }
                
                $json_data['RKARincID']=$RKARincID;
            break;
        }
        $json_data['success']=true;
        return response()->json($json_data,200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1(Request $request,$id)
    {        
        $theme = 'dore';
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $locked=false;
        $rka=$this->getDataRKA($id);
        try
        {            
            if ($filters['SOrgID'] == 'none'&&$filters['SOrgID'] == ''&&$filters['SOrgID'] == null)
            {
                throw new \Exception ('Mohon unit kerja untuk di pilih terlebih dahulu.');
            }            
            if ($locked)
            {   
                throw new \Exception ('Tidak diperkenankan menambah uraian kegiatan karena telah dikunci.');
            }            
            $daftar_transaksi=\App\Models\DMaster\TransaksiModel::getDaftarTransaksi(\HelperKegiatan::getTahunAnggaran(),false);            
            $daftar_transaksi['']='';            
            return view("pages.$theme.rka.apbdmurni.create1")->with(['page_active'=>'apbdmurni',
                                                                        'filters'=>$filters,
                                                                        'rka'=>$rka,
                                                                        'daftar_transaksi'=>$daftar_transaksi
                                                                    ]);
        }
        catch (\Exception $e)
        {            
            return view("pages.$theme.rka.apbdmurni.error")->with(['page_active'=>$this->NameOfPage,
                                                                    'page_title'=>\HelperKegiatan::getPageTitle($this->NameOfPage),
                                                                    'errormessage'=>$e->getMessage()
                                                                ]);  
        }        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2(Request $request,$id)
    {        
        $theme = 'dore';
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $locked=false;
        $rka=$this->getDataRKA($id);
        try
        {   
            $data_rekening=\App\Models\DMaster\RekeningModel::find($filters['RObyID']);           
            $daftar_jenispelaksanaan=\App\Models\DMaster\JenisPelaksanaanModel::getJenisPelaksanaan(\HelperKegiatan::getTahunAnggaran());             
            return view("pages.$theme.rka.apbdmurni.create2")->with(['page_active'=>'apbdmurni',
                                                                        'filters'=>$filters,
                                                                        'daftar_jenispelaksanaan'=>$daftar_jenispelaksanaan,
                                                                        'data_rekening'=>$data_rekening,
                                                                        'RObyID'=>$filters['RObyID'],
                                                                        'rka'=>$rka,
                                                                    ]);
        }
        catch (\Exception $e)
        {            
            return view("pages.$theme.rka.apbdmurni.error")->with(['page_active'=>$this->NameOfPage,
                                                                    'page_title'=>\HelperKegiatan::getPageTitle($this->NameOfPage),
                                                                    'errormessage'=>$e->getMessage()
                                                                ]);  
        }        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create3(Request $request,$id)
    {        
        $theme = 'dore';
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $locked=false;
        $rka=$this->getDataRKA($id);
        try
        {   

            $datauraian=$this->populateDataUraian($id);
            $daftar_uraian=[''=>''];
            foreach ($datauraian as $v)
            {
                $daftar_uraian[$v->RKARincID]='['.$v->kode_rek_5.']'.$v->nama_uraian;
            }
            return view("pages.$theme.rka.apbdmurni.create3")->with(['page_active'=>'apbdmurni',
                                                                        'filters'=>$filters,
                                                                        'daftar_uraian'=>$daftar_uraian,
                                                                        'rka'=>$rka,
                                                                    ]);
        }
        catch (\Exception $e)
        {            
            return view("pages.$theme.rka.apbdmurni.error")->with(['page_active'=>$this->NameOfPage,
                                                                    'page_title'=>\HelperKegiatan::getPageTitle($this->NameOfPage),
                                                                    'errormessage'=>$e->getMessage()
                                                                ]);  
        }        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create4(Request $request,$id)
    {        
        $theme = 'dore';
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $locked=false;
        $rka=$this->getDataRKA($id);
        try
        {   
            $r=\DB::table('trRKARinc')
                    ->select(\DB::raw('"RKARincID",v_rekening."kode_rek_5",nama_uraian'))
                    ->join('v_rekening','v_rekening.RObyID','trRKARinc.RObyID')
                    ->where('RKAID',$id)
                    ->WhereNotIn('RKARincID',function($query) use ($id) {                        
                        $query->select('RKARincID')
                                ->from('trRKATargetRinc')
                                ->where('RKAID', $id);
                    }) 
                    ->orderByRaw('v_rekening."Kd_Rek_1"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_2"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_3"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_4"::int ASC')
                    ->orderByRaw('v_rekening."Kd_Rek_5"::int ASC')           
                    ->get();

            $daftar_uraian=[''=>''];
            foreach ($r as $v)
            {
                $daftar_uraian[$v->RKARincID]='['.$v->kode_rek_5.']'.$v->nama_uraian;
            }
            return view("pages.$theme.rka.apbdmurni.create4")->with(['page_active'=>'apbdmurni',
                                                                        'filters'=>$filters,
                                                                        'daftar_uraian'=>$daftar_uraian,
                                                                        'rka'=>$rka,
                                                                    ]);
        }
        catch (\Exception $e)
        {            
            return view("pages.$theme.rka.apbdmurni.error")->with(['page_active'=>$this->NameOfPage,
                                                                    'page_title'=>\HelperKegiatan::getPageTitle($this->NameOfPage),
                                                                    'errormessage'=>$e->getMessage()
                                                                ]);  
        }        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'PrgID'=>'required',
            'KgtID'=>'required',
            'PaguDana1'=>'required',
        ]);
        $filters=$this->getControllerStateSession($this->SessionName,'filters');
        $apbdmurni = RKAKegiatanModel::create([
            'RKAID' => uniqid ('uid'),
            'OrgID' => $filters['OrgID'],
            'SOrgID' => $filters['SOrgID'],
            'PrgID' => $request->input('PrgID'),
            'KgtID' => $request->input('KgtID'),
            'RKPDID' => $request->input('RKPDID'),            
            'PaguDana1' => $request->input('PaguDana1'),
            'PaguDana2' => 0,
            'nip_pa1' => $request->input('nip_pa'),
            'nip_kpa1' => $request->input('nip_kpa'),
            'nip_ppk1' => $request->input('nip_ppk'),
            'nip_pptk1' => $request->input('nip_pptk'),
            'user_id' => $theme = \Auth::user()->id,
            'Descr' => '-',
            'EntryLvl' => 1,
            'TA' => \HelperKegiatan::getTahunAnggaran(),
        ]);        
        
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
        }
        else
        {
            return redirect(route('apbdmurni.show',['uuid'=>$apbdmurni->RKAID]))->with('success','Data ini telah berhasil disimpan.');
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request,$id)
    {
        
        $this->validate($request, [
            'RObyID'=>'required',            
        ]);             
        
        $filters=$this->getControllerStateSession($this->SessionName,'filters');
        $filters['RObyID']=$request->input('RObyID');
        $this->putControllerStateSession($this->SessionName,'filters',$filters);

        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
        }
        else
        {
            return redirect(route('apbdmurni.create2',['uuid'=>$id]));
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request,$id)
    {
        
        $this->validate($request, [
            'RObyID'=>'required',
            'nama_uraian'=>'required',
            'volume'=>'required',
            'satuan'=>'required',
            'harga_satuan'=>'required',
            'pagu_uraian1'=>'required',
        ]);
        $rinciankegiatan = RKARincianKegiatanModel::create([
            'RKARincID' => uniqid ('uid'),
            'RKAID' => $id,
            'RObyID' => $request->input('RObyID'),
            'JenisPelaksanaanID' => $request->input('JenisPelaksanaanID'),
            'nama_uraian' => $request->input('nama_uraian'),
            'volume1' => $request->input('volume'),
            'satuan1' => $request->input('satuan'),            
            'harga_satuan1' => $request->input('harga_satuan'),
            'harga_satuan2' => 0,
            'pagu_uraian1' => $request->input('pagu_uraian1'),            
            'pagu_uraian2' => 0,            
            'Descr' => $request->input('Descr'),
            'EntryLvl' => 1,
            'TA' => \HelperKegiatan::getTahunAnggaran(),
        ]);        
        $this->destroyControllerStateSession('filters','RObyID');
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $filters['changetab']='data-uraian-tab';
        $this->putControllerStateSession($this->SessionName,'filters',$filters);
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
        }
        else
        {
            return redirect(route('apbdmurni.show',['uuid'=>$rinciankegiatan->RKAID]))->with('success','Data ini telah berhasil disimpan.');
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store3(Request $request,$id)
    {
        
        $this->validate($request, [
            'RKARincID'=>'required',
            'bulan'=>'required',
            'realisasi1'=>'required',
            'fisik1'=>'required',            
        ]);
        $realisasirinciankegiatan = RKARealisasiRincianKegiatanModel::create([
            'RKARealisasiRincID' => uniqid ('uid'),
            'RKAID' => $id,
            'RKARincID' => $request->input('RKARincID'),            
            'bulan1' => $request->input('bulan'),
            'bulan2' => 0,
            'target1' => 0,            
            'target2' => 0,            
            'realisasi1' => $request->input('realisasi1'),            
            'realisasi2' => 0,            
            'fisik1' => $request->input('fisik1'),           
            'fisik2' => 0,           
            'EntryLvl' => 1,
            'Descr' => $request->input('Descr'),            
            'TA' => \HelperKegiatan::getTahunAnggaran(),
        ]);        
        $this->destroyControllerStateSession('filters','RKARincID');
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $filters['changetab']='data-realisasi-tab';
        $this->putControllerStateSession($this->SessionName,'filters',$filters);
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
        }
        else
        {
            return redirect(route('apbdmurni.show',['uuid'=>$realisasirinciankegiatan->RKAID]))->with('success','Data ini telah berhasil disimpan.');
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store4(Request $request,$id)
    {                
        $this->validate($request, [
            'RKARincID'=>'required',
            'bulan_fisik.*'=>'required',
            'bulan_anggaran.*'=>'required',
        ]);
        $bulan_fisik= $request->input('bulan_fisik');      
        $bulan_anggaran= $request->input('bulan_anggaran');      
        $data = [];
        $now = \Carbon\Carbon::now('utc')->toDateTimeString();
        for ($i=0;$i < 12; $i+=1)
        {
            $data[]=[
                'RKATargetRincID'=>uniqid ('uid'),
                'RKAID'=>$id,
                'RKARincID'=>$request->input('RKARincID'),
                'bulan1'=>$i+1,
                'target1'=>$bulan_anggaran[$i],
                'target2'=>0,
                'fisik1'=>$bulan_fisik[$i],
                'fisik2'=>0,
                'EntryLvl'=>1,
                'Descr'=>$request->input('Descr'),
                'TA'=>\HelperKegiatan::getTahunAnggaran(),
                'created_at'=>$now,
                'updated_at'=>$now,
            ];
        }
        RKARencanaTargetModel::insert($data);
      
        $this->destroyControllerStateSession('filters','RKARincID');
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $filters['changetab']='data-rencana-target-fisik-tab';
        $this->putControllerStateSession($this->SessionName,'filters',$filters);
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
        }
        else
        {
            return redirect(route('apbdmurni.show',['uuid'=>$id]))->with('success','Data ini telah berhasil disimpan.');
        }

    }
    /**
     * digunakan untuk melakukan perubahan tabulasi detail rka.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changetab (Request $request)
    {
        $json_data = [];
        $tab = $request->input('tab')==''?'none':$request->input('tab');
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $filters['changetab']=$tab;
        $this->putControllerStateSession($this->SessionName,'filters',$filters);
        $json_data['success']=true;
        $json_data['changetab']=$tab;
        return response()->json($json_data,200);  
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $theme = 'dore';

        $rka = $this->getDataRKA($id);
        if (!is_null($rka) )  
        {
            $filters=$this->getControllerStateSession('apbdmurni','filters');
            $sumber_dana = \App\Models\DMaster\SumberDanaModel::getDaftarSumberDana(\HelperKegiatan::getTahunAnggaran(),false);
            $datauraian=$this->populateDataUraian($id);
            $daftar_uraian=[''=>''];
            foreach ($datauraian as $v)
            {
                $daftar_uraian[$v->RKARincID]='['.$v->kode_rek_5.']'.$v->nama_uraian;
            }
            $datarealisasi=$this->populateDataRealisasi($filters['RKARincID']); 
            $datarencanatargetfisik=$this->populateDataRencanaTargetFisik($id);
            $datarencanaanggarankas=$this->populateDataRencanaAnggaranKas($id);
            return view("pages.$theme.rka.apbdmurni.show")->with(['page_active'=>'apbdmurni',
                                                                        'filters'=>$filters,
                                                                        'rka'=>$rka,
                                                                        'sumber_dana'=>$sumber_dana,
                                                                        'datauraian'=>$datauraian,
                                                                        'datarencanatargetfisik'=>$datarencanatargetfisik,
                                                                        'datarencanaanggarankas'=>$datarencanaanggarankas,
                                                                        'daftar_uraian'=>$daftar_uraian,
                                                                        'datarealisasi'=>$datarealisasi
                                                                    ]);
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theme = 'dore';
        
        $data = RKAKegiatanModel::findOrFail($id);
        if (!is_null($data) ) 
        {
            return view("pages.$theme.rka.apbdmurni.edit")->with(['page_active'=>'apbdmurni',
                                                    'data'=>$data
                                                    ]);
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit2($id)
    {
        $theme = 'dore';
        
        $data = RKARincianKegiatanModel::join('v_rekening','v_rekening.RObyID','trRKARinc.RObyID')
                                            ->findOrFail($id);
        if (!is_null($data) ) 
        {            
            $daftar_jenispelaksanaan=\App\Models\DMaster\JenisPelaksanaanModel::getJenisPelaksanaan(\HelperKegiatan::getTahunAnggaran());
            return view("pages.$theme.rka.apbdmurni.edit2")->with(['page_active'=>'apbdmurni',
                                                                        'rka'=>$this->getDataRKA($data->RKAID),
                                                                        'daftar_jenispelaksanaan'=>$daftar_jenispelaksanaan,
                                                                        'data'=>$data
                                                                    ]);
        }        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit4($id)
    {
        $theme = 'dore';
        
        $data = RKARincianKegiatanModel::join('v_rekening','v_rekening.RObyID','trRKARinc.RObyID')
                                            ->findOrFail($id);
        if (!is_null($data) ) 
        {
            $rencana = \DB::table('v_rencana_fisik_anggaran_kas')
                                ->where('RKARincID',$data->RKARincID)
                                ->get();
            
            $data_rencana['fisik_1']=0;
            $data_rencana['fisik_2']=0;
            $data_rencana['fisik_3']=0;
            $data_rencana['fisik_4']=0;
            $data_rencana['fisik_5']=0;
            $data_rencana['fisik_6']=0;
            $data_rencana['fisik_7']=0;
            $data_rencana['fisik_8']=0;
            $data_rencana['fisik_9']=0;
            $data_rencana['fisik_10']=0;
            $data_rencana['fisik_11']=0;
            $data_rencana['fisik_12']=0;

            $data_rencana['anggaran_1']=0;
            $data_rencana['anggaran_2']=0;
            $data_rencana['anggaran_3']=0;
            $data_rencana['anggaran_4']=0;
            $data_rencana['anggaran_5']=0;
            $data_rencana['anggaran_6']=0;
            $data_rencana['anggaran_7']=0;
            $data_rencana['anggaran_8']=0;
            $data_rencana['anggaran_9']=0;
            $data_rencana['anggaran_10']=0;
            $data_rencana['anggaran_11']=0;
            $data_rencana['anggaran_12']=0;

            if (!is_null($rencana))
            {
                $data_rencana['fisik_1']=$rencana[0]->fisik_1;
                $data_rencana['fisik_2']=$rencana[0]->fisik_2;
                $data_rencana['fisik_3']=$rencana[0]->fisik_3;
                $data_rencana['fisik_4']=$rencana[0]->fisik_4;
                $data_rencana['fisik_5']=$rencana[0]->fisik_5;
                $data_rencana['fisik_6']=$rencana[0]->fisik_6;
                $data_rencana['fisik_7']=$rencana[0]->fisik_7;
                $data_rencana['fisik_8']=$rencana[0]->fisik_8;
                $data_rencana['fisik_9']=$rencana[0]->fisik_9;
                $data_rencana['fisik_10']=$rencana[0]->fisik_10;
                $data_rencana['fisik_11']=$rencana[0]->fisik_11;
                $data_rencana['fisik_12']=$rencana[0]->fisik_12;

                $data_rencana['anggaran_1']=$rencana[0]->anggaran_1;
                $data_rencana['anggaran_2']=$rencana[0]->anggaran_2;
                $data_rencana['anggaran_3']=$rencana[0]->anggaran_3;
                $data_rencana['anggaran_4']=$rencana[0]->anggaran_4;
                $data_rencana['anggaran_5']=$rencana[0]->anggaran_5;
                $data_rencana['anggaran_6']=$rencana[0]->anggaran_6;
                $data_rencana['anggaran_7']=$rencana[0]->anggaran_7;
                $data_rencana['anggaran_8']=$rencana[0]->anggaran_8;
                $data_rencana['anggaran_9']=$rencana[0]->anggaran_9;
                $data_rencana['anggaran_10']=$rencana[0]->anggaran_10;
                $data_rencana['anggaran_11']=$rencana[0]->anggaran_11;
                $data_rencana['anggaran_12']=$rencana[0]->anggaran_12;

            }
            return view("pages.$theme.rka.apbdmurni.edit4")->with(['page_active'=>'apbdmurni',
                                                                        'rka'=>$rka = $this->getDataRKA($data->RKAID),
                                                                        'data'=>$data,
                                                                        'data_rencana'=>$data_rencana,
                                                                    ]);
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $apbdmurni = RKAKegiatanModel::find($id);
        
        $this->validate($request, [
            'lokasi_kegiatan'=>'required',
            'SumberDanaID'=>'required',
            'capaian_program'=>'required',
            'tk_capaian'=>'required',
            'masukan'=>'required',
            'keluaran'=>'required',
            'tk_keluaran'=>'required',
            'hasil'=>'required',
            'tk_hasil'=>'required',
            'ksk'=>'required',
            'sifat_kegiatan'=>'required',
            'waktu_pelaksanaan'=>'required'
        ]);
        
        $apbdmurni->lokasi_kegiatan1 = $request->input('lokasi_kegiatan');
        $apbdmurni->SumberDanaID=$request->input('SumberDanaID');
        $apbdmurni->capaian_program1=$request->input('capaian_program');
        $apbdmurni->tk_capaian1=$request->input('tk_capaian');
        $apbdmurni->masukan1=$request->input('masukan');
        $apbdmurni->keluaran1=$request->input('keluaran');
        $apbdmurni->tk_keluaran1=$request->input('tk_keluaran');
        $apbdmurni->hasil1=$request->input('hasil');
        $apbdmurni->tk_hasil1=$request->input('tk_hasil');
        $apbdmurni->ksk1=$request->input('ksk');
        $apbdmurni->sifat_kegiatan1=$request->input('sifat_kegiatan');
        $apbdmurni->waktu_pelaksanaan1=$request->input('waktu_pelaksanaan');
        $apbdmurni->Descr=$request->input('Descr');
        $apbdmurni->save();

        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil diubah.'
            ],200);
        }
        else
        {
            return redirect(route('apbdmurni.show',['uuid'=>$apbdmurni->RKAID]))->with('success','Data ini telah berhasil disimpan.');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request, $id)
    {
        $rinciankegiatan = RKARincianKegiatanModel::find($id);
        
        $this->validate($request, [
            'nama_uraian'=>'required',
            'volume'=>'required',
            'satuan'=>'required',
            'harga_satuan'=>'required',
            'pagu_uraian1'=>'required',
        ]);   

        $rinciankegiatan->JenisPelaksanaanID = $request->input('JenisPelaksanaanID');
        $rinciankegiatan->nama_uraian = $request->input('nama_uraian');
        $rinciankegiatan->volume1=$request->input('volume');
        $rinciankegiatan->satuan1=$request->input('satuan');
        $rinciankegiatan->harga_satuan1=$request->input('harga_satuan');
        $rinciankegiatan->pagu_uraian1=$request->input('pagu_uraian1');
        $rinciankegiatan->Descr=$request->input('Descr');
        
        $rinciankegiatan->save();

        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $filters['changetab']='data-uraian-tab';
        $this->putControllerStateSession($this->SessionName,'filters',$filters);

        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil diubah.'
            ],200);
        }
        else
        {
            return redirect(route('apbdmurni.show',['uuid'=>$rinciankegiatan->RKAID]))->with('success','Data ini telah berhasil disimpan.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update4(Request $request, $id)
    {
        $this->validate($request, [
            'RKARincID'=>'required',
            'bulan_fisik.*'=>'required',
            'bulan_anggaran.*'=>'required',
        ]);

        \DB::table('trRKATargetRinc')->where('RKARincID',$request->input('RKARincID'))->delete();

        $bulan_fisik= $request->input('bulan_fisik');      
        $bulan_anggaran= $request->input('bulan_anggaran');      
        $data = [];
        $now = \Carbon\Carbon::now('utc')->toDateTimeString();
        for ($i=0;$i < 12; $i+=1)
        {
            $data[]=[
                'RKATargetRincID'=>uniqid ('uid'),
                'RKAID'=>$id,
                'RKARincID'=>$request->input('RKARincID'),
                'bulan1'=>$i+1,
                'target1'=>$bulan_anggaran[$i],
                'target2'=>0,
                'fisik1'=>$bulan_fisik[$i],
                'fisik2'=>0,
                'EntryLvl'=>1,
                'Descr'=>$request->input('Descr'),
                'TA'=>\HelperKegiatan::getTahunAnggaran(),
                'created_at'=>$now,
                'updated_at'=>$now,
            ];
        }
        RKARencanaTargetModel::insert($data);
      
        $this->destroyControllerStateSession('filters','RKARincID');
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $filters['changetab']='data-rencana-target-fisik-tab';
        $this->putControllerStateSession($this->SessionName,'filters',$filters);
        if ($request->ajax()) 
        {
            return response()->json([
                'success'=>true,
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
        }
        else
        {
            return redirect(route('apbdmurni.show',['uuid'=>$id]))->with('success','Data ini telah berhasil disimpan.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        
        if ($request->ajax()) 
        {
            $pid=$request->input('pid');
            switch ($pid)
            {
                case 'datakegiatan' :
                    $apbdmurni = RKAKegiatanModel::find($id);
                    $result=$apbdmurni->delete();
                    return response()->json(['message'=>"data kegiatan dengan ID ($id) Berhasil di Hapus"],200);                    
                break;
                case 'datauraian' :
                    $rinciankegiatan = RKARincianKegiatanModel::find($id);
                    $rkaid=$rinciankegiatan->RKAID;
                    $result=$rinciankegiatan->delete();

                    $rka = $this->getDataRKA($rkaid);                    
                    
                    $filters=$this->getControllerStateSession('apbdmurni','filters');
                    $sumber_dana = \App\Models\DMaster\SumberDanaModel::getDaftarSumberDana(\HelperKegiatan::getTahunAnggaran(),false);
                    $datauraian=$this->populateDataUraian($rkaid);
                    $datatable=view("pages.$theme.rka.apbdmurni.datatableuraian")->with([
                                                                                                'datauraian'=>$datauraian,
                                                                                                'rka'=>$rka
                                                                                            ])->render();
                        
                break;
                case 'datarencanafisik' :
                    $rinciankegiatan = RKARincianKegiatanModel::find($id);
                    $rkaid=$rinciankegiatan->RKAID;
                    \DB::table('trRKATargetRinc')->where('RKARincID',$id)->delete();

                    $datarencanatargetfisik=$this->populateDataRencanaTargetFisik($rkaid);
                    $datatable=view("pages.$theme.rka.apbdmurni.datatablerencanatargetfisik")->with([
                                                                                                'datarencanatargetfisik'=>$datarencanatargetfisik,
                                                                                            ])->render();
                        
                break;
                case 'datarencanaanggarankas' :
                    $rinciankegiatan = RKARincianKegiatanModel::find($id);
                    $rkaid=$rinciankegiatan->RKAID;
                    \DB::table('trRKATargetRinc')->where('RKARincID',$id)->delete();

                    $datarencanaanggarankas=$this->populateDataRencanaAnggaranKas($rkaid);
                    $datatable=view("pages.$theme.rka.apbdmurni.datatablerencanaanggarankas")->with([
                                                                                                'datarencanaanggarankas'=>$datarencanaanggarankas,
                                                                                            ])->render();
                        
                break;
                case 'datarealisasi' :
                    $realisasirinciankegiatan = RKARealisasiRincianKegiatanModel::find($id);
                    $RKARincID=$realisasirinciankegiatan->RKARincID;
                    $result=$realisasirinciankegiatan->delete();
                    
                    $filters=$this->getControllerStateSession('apbdmurni','filters');
                    $datarealisasi=$this->populateDataRealisasi($RKARincID);
                    $datatable=view("pages.$theme.rka.apbdmurni.datatablerealisasi")->with([
                                                                                                'datarealisasi'=>$datarealisasi,
                                                                                            ])->render();
                        
                break;
            }
              
            
            return response()->json(['success'=>true,'datatable'=>$datatable],200); 
        }
        else
        {
            return redirect(route('apbdmurni.index'))->with('success',"Data ini dengan ($id) telah berhasil dihapus.");
        }        
    }
}