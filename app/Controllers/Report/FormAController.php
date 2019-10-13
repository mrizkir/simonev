<?php

namespace App\Controllers\Report;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\RKA\RKAKegiatanModel;
use App\Models\RKA\RKARincianKegiatanModel;
use App\Models\RKA\RKARealisasiRincianKegiatanModel;

class FormAController extends Controller 
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
                                            "v_rka"."lokasi_kegiatan",
                                            "v_rka"."SumberDanaID",
                                            "v_rka"."Nm_SumberDana",
                                            "v_rka"."tk_capaian",
                                            "v_rka"."capaian_program",
                                            "v_rka"."masukan",
                                            "v_rka"."tk_keluaran",
                                            "v_rka"."keluaran",
                                            "v_rka"."tk_hasil",
                                            "v_rka"."hasil",
                                            "v_rka"."ksk",
                                            "v_rka"."sifat_kegiatan",
                                            "v_rka"."waktu_pelaksanaan",
                                            "v_rka"."PaguDana1",
                                            "v_rka"."Descr",
                                            "v_rka"."EntryLvl",
                                            "v_rka"."created_at",
                                            "v_rka"."updated_at"
                                            '))
                            ->join('v_rka','v_rka.RKAID','trRKA.RKAID')     
                            ->where('trRKA.EntryLvl',\HelperKegiatan::getLevelEntriByName($this->NameOfPage))
                            ->findOrFail($id);
        
        $data_rka=$rka->toArray();
        $data_rka['total_pagu']=(float)\DB::table('trRKARinc')->where('RKAID',$rka->RKAID)->sum('pagu_uraian1');
        $str = "SELECT rek1.no_rek1,rek1.nama_rek1,rek2.no_rek2,rek2.nama_rek2,rek3.no_rek3,rek3.nama_rek3,rek4.no_rek4,rek4.nama_rek4,rek5.no_rek5,rek5.nama_rek5,u.iduraian,u.nama_uraian,u.nilai,u.volume,u.satuan,u.harga_satuan,umd.idlok,umd.ket_lok,umd.rt,umd.rw,umd.nama_perusahaan,umd.nama_direktur FROM uraian_m u LEFT JOIN uraian_m_desc umd ON (umd.iduraian=u.iduraian) LEFT JOIN rek5 ON (u.rekening=rek5.no_rek5) LEFT JOIN rek4 ON (rek4.no_rek4=rek5.no_rek4) LEFT JOIN rek3 ON (rek3.no_rek3=rek4.no_rek3) LEFT JOIN rek2 ON (rek2.no_rek2=rek3.no_rek2) LEFT JOIN rek1 ON (rek1.no_rek1=rek2.no_rek1) WHERE idproyek=$idproyek ORDER BY u.rekening ASC";
        
        $this->DB->setFieldTable (array('no_rek1','nama_rek1','no_rek2','nama_rek2','no_rek3','nama_rek3','no_rek4','nama_rek4','no_rek5','nama_rek5','iduraian','nama_uraian','nilai','volume','satuan','harga_satuan','idlok','ket_lok','rt','rw','nama_perusahaan','nama_direktur'));
        $r1=$this->DB->getRecord($str);        
        $dataAkhir=[];		
        dd($data_rka);
        return $data_rka;
        
    }   
    /**
     * collect data from resources for index view
     *
     * @return resources
     */
    public function populateData ($currentpage=1) 
    {        
        $columns=['*'];       
        if (!$this->checkStateIsExistSession($this->SessionName,'orderby')) 
        {            
           $this->putControllerStateSession($this->SessionName,'orderby',['column_name'=>'KgtNm','order'=>'asc']);
        }
        $column_order=$this->getControllerStateSession('formamurni.orderby','column_name'); 
        $direction=$this->getControllerStateSession('formamurni.orderby','order'); 

        if (!$this->checkStateIsExistSession('global_controller','numberRecordPerPage')) 
        {            
            $this->putControllerStateSession('global_controller','numberRecordPerPage',10);
        }
        $numberRecordPerPage=$this->getControllerStateSession('global_controller','numberRecordPerPage');  
        
        //filter
        if (!$this->checkStateIsExistSession($this->SessionName,'filters')) 
        {            
            $this->putControllerStateSession($this->SessionName,'filters',[
                                                                            'OrgID'=>'none',
                                                                            'SOrgID'=>'none',
                                                                            'changetab'=>'data-uraian-tab',
                                                                            'bulan_realisasi'=>\HelperKegiatan::getBulanRealisasi() > 9 ? 9:HelperKegiatan::getBulanRealisasi(),
                                                                            ]);
        }        
        $SOrgID= $this->getControllerStateSession(\Helper::getNameOfPage('filters'),'SOrgID');

        if ($this->checkStateIsExistSession($this->SessionName,'search')) 
        {
            $search=$this->getControllerStateSession($this->SessionName,'search');
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
            $data = \DB::table(\HelperKegiatan::getViewName($this->NameOfPage))
                        ->where('SOrgID',$SOrgID)                                            
                        ->where('TA', \HelperKegiatan::getTahunAnggaran())  
                        ->where('EntryLvl',\HelperKegiatan::getLevelEntriByName($this->NameOfPage))
                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        }      
        $data->setPath(route('formamurni.index'));
        return $data;
    }
    /**
     * digunakan untuk mengganti jumlah record per halaman
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changenumberrecordperpage (Request $request) 
    {
        $theme = 'dore';

        $numberRecordPerPage = $request->input('numberRecordPerPage');
        $this->putControllerStateSession('global_controller','numberRecordPerPage',$numberRecordPerPage);
        
        $this->setCurrentPageInsideSession($this->SessionName,1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.report.forma.datatable")->with(['page_active'=>$this->SessionName,
                                                                                'search'=>$this->getControllerStateSession($this->SessionName,'search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('formamurni.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('formamurni.orderby','order'),
                                                                                'data'=>$data])->render();      
        return response()->json(['success'=>true,'datatable'=>$datatable],200);
    }
    /**
     * digunakan untuk mengurutkan record 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderby (Request $request) 
    {
        $theme = 'dore';

        $orderby = $request->input('orderby') == 'asc'?'desc':'asc';
        $column=$request->input('column_name');
        switch($column) 
        {
            case 'KgtNm' :
                $column_name = 'KgtNm';
            break;           
            default :
                $column_name = 'KgtNm';
        }
        $this->putControllerStateSession($this->SessionName,'orderby',['column_name'=>$column_name,'order'=>$orderby]);      

        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession($this->SessionName);         
        $data=$this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        
        $datatable = view("pages.$theme.report.forma.datatable")->with(['page_active'=>$this->SessionName,
                                                            'search'=>$this->getControllerStateSession($this->SessionName,'search'),
                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                            'column_order'=>$this->getControllerStateSession('formamurni.orderby','column_name'),
                                                            'direction'=>$this->getControllerStateSession('formamurni.orderby','order'),
                                                            'data'=>$data])->render();     

        return response()->json(['success'=>true,'datatable'=>$datatable],200);
    }
    
    /**
     * paginate resource in storage called by ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginate ($id) 
    {
        $theme = 'dore';

        $this->setCurrentPageInsideSession($this->SessionName,$id);
        $data=$this->populateData($id);
        $datatable = view("pages.$theme.report.forma.datatable")->with(['page_active'=>$this->SessionName,
                                                                            'search'=>$this->getControllerStateSession($this->SessionName,'search'),
                                                                            'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                            'column_order'=>$this->getControllerStateSession('formamurni.orderby','column_name'),
                                                                            'direction'=>$this->getControllerStateSession('formamurni.orderby','order'),
                                                                            'data'=>$data])->render(); 

        return response()->json(['success'=>true,'datatable'=>$datatable],200);        
    }
    /**
     * filter resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request) 
    {
        $auth = \Auth::user();    
        $theme = 'dore';

        $filters=$this->getControllerStateSession($this->SessionName,'filters');
        $daftar_unitkerja=[];
        $json_data = [];

        //index
        if ($request->exists('OrgID'))
        {
            $OrgID = $request->input('OrgID')==''?'none':$request->input('OrgID');
            $filters['OrgID']=$OrgID;
            $filters['SOrgID']='none';
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunAnggaran(),false,$OrgID);  
            
            $this->putControllerStateSession($this->SessionName,'filters',$filters);

            $data = [];

            $datatable = view("pages.$theme.report.forma.datatable")->with(['page_active'=>$this->SessionName,   
                                                                            'search'=>$this->getControllerStateSession($this->SessionName,'search'),
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
            $this->putControllerStateSession($this->SessionName,'filters',$filters);
            $this->setCurrentPageInsideSession($this->SessionName,1);

            $data = $this->populateData();            
            $datatable = view("pages.$theme.report.forma.datatable")->with(['page_active'=>$this->SessionName,   
                                                                                'search'=>$this->getControllerStateSession($this->SessionName,'search'),
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

        $action = $request->input('action');
        if ($action == 'reset') 
        {
            $this->destroyControllerStateSession($this->SessionName,'search');
        }
        else
        {
            $kriteria = $request->input('cmbKriteria');
            $isikriteria = $request->input('txtKriteria');
            $this->putControllerStateSession($this->SessionName,'search',['kriteria'=>$kriteria,'isikriteria'=>$isikriteria]);
        }      
        $this->setCurrentPageInsideSession($this->SessionName,1);
        $data=$this->populateData();

        $datatable = view("pages.$theme.report.forma.datatable")->with(['page_active'=>$this->SessionName,                                                            
                                                                                'search'=>$this->getControllerStateSession($this->SessionName,'search'),
                                                                                'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),
                                                                                'column_order'=>$this->getControllerStateSession('formamurni.orderby','column_name'),
                                                                                'direction'=>$this->getControllerStateSession('formamurni.orderby','order'),
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
        $theme = 'dore';

        $filters=$this->getControllerStateSession($this->SessionName,'filters');
        $search=$this->getControllerStateSession($this->SessionName,'search');
        $currentpage=$request->has('page') ? $request->get('page') : $this->getCurrentPageInsideSession($this->SessionName); 
        $data = $this->populateData($currentpage);
        if ($currentpage > $data->lastPage())
        {            
            $data = $this->populateData($data->lastPage());
        }
        $this->setCurrentPageInsideSession($this->SessionName,$data->currentPage());
        $daftar_opd=\App\Models\DMaster\OrganisasiModel::getDaftarOPD(\HelperKegiatan::getTahunAnggaran(),false);  
        $daftar_opd['']='';
        $daftar_unitkerja=[];
        if ($filters['OrgID'] != 'none'&&$filters['OrgID'] != ''&&$filters['OrgID'] != null)
        {
            $daftar_unitkerja=\App\Models\DMaster\SubOrganisasiModel::getDaftarUnitKerja(\HelperKegiatan::getTahunPerencanaan(),false,$filters['OrgID']);        
            $daftar_unitkerja['']='';
        }          
        return view("pages.$theme.report.forma.index")->with(['page_active'=>$this->SessionName,
                                                                    'daftar_opd'=>$daftar_opd,
                                                                    'daftar_unitkerja'=>$daftar_unitkerja,
                                                                    'filters'=>$filters,
                                                                    'search'=>$this->getControllerStateSession($this->SessionName,'search'),
                                                                    'numberRecordPerPage'=>$this->getControllerStateSession('global_controller','numberRecordPerPage'),                                                                    
                                                                    'column_order'=>$this->getControllerStateSession('formamurni.orderby','column_name'),
                                                                    'direction'=>$this->getControllerStateSession('formamurni.orderby','order'),
                                                                    'data'=>$data]);               
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
            
            return view("pages.$theme.report.forma.create")->with(['page_active'=>$this->SessionName,
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
            return view("pages.$theme.report.forma.error")->with(['page_active'=>$this->NameOfPage,
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
                $datatable=view("pages.$theme.report.forma.datatablerealisasi")->with(['page_active'=>$this->SessionName,                                                                            
                                                                                            'datarealisasi'=>$datarealisasi
                                                                                        ])->render();
                $json_data['RKARincID']=$RKARincID;
                $json_data['datatable']=$datatable;
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
                    $json_data['sisa_pagu_rincian']=$pagu_uraian1-$jumlah_realisasi;
                }
                
                $json_data['RKARincID']=$RKARincID;
            break;
        }
        $json_data['success']=true;
        return response()->json($json_data,200);
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
            $filters=$this->getControllerStateSession($this->SessionName,'filters');          
            return view("pages.$theme.report.forma.show")->with(['page_active'=>$this->SessionName,
                                                                        'filters'=>$filters,
                                                                        'rka'=>$rka,
                                                                    ]);
        }        
    }
 
}