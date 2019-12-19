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
                                            "v_rka"."PaguDana2",
                                            "v_rka"."Descr",
                                            "v_rka"."EntryLvl",
                                            "v_rka"."created_at",
                                            "v_rka"."updated_at"
                                            '))
                            ->join('v_rka','v_rka.RKAID','trRKA.RKAID')     
                            ->where('trRKA.EntryLvl',2)
                            ->find($id);

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
                    ->select(\DB::raw('"RKARincID","RKAID",v_rekening."kode_rek_5",v_rekening."RObyNm",nama_uraian,volume2,satuan2,harga_satuan2,pagu_uraian2,0 AS "realisasi2",0 AS "fisik2","trRKARinc"."JenisPelaksanaanID","trRKARinc"."TA","trRKARinc"."Descr","trRKARinc"."created_at","trRKARinc"."updated_at"'))
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
                        pagu_uraian2,
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
                        pagu_uraian2,
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
        $datauraian = RKARincianKegiatanModel::find($RKARincID);

        $r = \DB::table('trRKARealisasiRinc')
                    ->select(\DB::raw('"RKARealisasiRincID","bulan2","target2","realisasi2",target_fisik2,fisik2,"TA","Descr","created_at","updated_at"'))
                    ->where('RKARincID',$RKARincID)
                    ->orderBy('bulan2','ASC')
                    ->get();
        
        $daftar_realisasi = [];
        $totalanggarankas=0;
        $totalrealisasi=0;
        $totaltargetfisik=0;
        $totalfisik=0;
        foreach ($r as $item)
        {
            $sum_realisasi = \DB::table('trRKARealisasiRinc')
                            ->where('RKARincID',$RKARincID)
                            ->where('bulan2','<=',$item->bulan2)
                            ->sum('realisasi2');

            $sisa_anggaran=$datauraian->pagu_uraian2-$sum_realisasi;            
            $daftar_realisasi[]=[
                'RKARealisasiRincID'=>$item->RKARealisasiRincID,
                'bulan2'=>$item->bulan2,
                'NamaBulan'=>\Helper::getBulan($item->bulan2),
                'target2'=>$item->target2,
                'realisasi2'=>$item->realisasi2,
                'target_fisik2'=>$item->target_fisik2,
                'fisik2'=>$item->fisik2,
                'sisa_anggaran'=>$sisa_anggaran,
                'Descr'=>$item->Descr,
                'TA'=>$item->TA,
                'created_at'=>$item->created_at,
                'updated_at'=>$item->updated_at,
            ];
            
            $totalanggarankas+=$item->target2;
            $totalrealisasi+=$item->realisasi2;
            $totaltargetfisik+=$item->target_fisik2;
            $totalfisik+=$item->fisik2;
        }
        $data['datarealisasi']=$daftar_realisasi;
        $data['totalanggarankas']=$totalanggarankas;
        $data['totalrealisasi']=$totalrealisasi;
        $data['totaltargetfisik']=$totaltargetfisik;
        $data['totalfisik']=$totalfisik;
        $data['sisa_anggaran']=$datauraian->pagu_uraian2-$totalrealisasi;
        
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
                        ->select(\DB::raw('"RKAID",
                                            "RKPDID",
                                            kode_program,
                                            "PrgNm",
                                            kode_kegiatan,
                                            "KgtNm",
                                            "PaguDana2",
                                            0 AS "TotalPaguUraian1",
                                            0 AS "TotalRealisasi1",
                                            0 AS "TotalFisik1",
                                            nip_pa1,
                                            nip_kpa1,
                                            nip_ppk1,
                                            nip_pptk1
                                        '))
                        ->where('SOrgID',$SOrgID)                                            
                        ->where('TA', \HelperKegiatan::getTahunAnggaran())  
                        ->where('EntryLvl',2)
                        ->paginate($numberRecordPerPage, $columns, 'page', $currentpage); 
        }      
        $data->setPath(route('apbdmurni.index'));
        $data->transform(function ($item,$key){
            $item->TotalPaguUraian1=\DB::table('trRKARinc')->where('RKAID',$item->RKAID)->sum('pagu_uraian2');
            $item->TotalRealisasi1=\DB::table('trRKARealisasiRinc')->where('RKAID',$item->RKAID)->sum('realisasi2');

            $jumlah_uraian=\DB::table('trRKARinc')->where('RKAID',$item->RKAID)->count('RKARincID');
            $total_fisik=\DB::table('trRKARealisasiRinc')->where('RKAID',$item->RKAID)->sum('fisik2');
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
        $json_data = [];
        
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
     * Show the form for creating a new resource. [tambah kegiatan]
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $filters=$this->getControllerStateSession($this->SessionName,'filters');         
        $locked=false;
        if ($filters['SOrgID'] != 'none'&&$filters['SOrgID'] != ''&&$filters['SOrgID'] != null && $locked==false)
        {
            $SOrgID=$filters['SOrgID'];            
            $OrgID=$filters['OrgID'];

            $organisasi=\App\Models\DMaster\SubOrganisasiModel::select(\DB::raw('"v_suborganisasi"."OrgID","v_suborganisasi"."OrgIDRPJMD","v_suborganisasi"."UrsID","v_suborganisasi"."OrgNm","v_suborganisasi"."SOrgNm","v_suborganisasi"."kode_organisasi","v_suborganisasi"."kode_suborganisasi"'))
                                                                ->join('v_suborganisasi','tmSOrg.OrgID','v_suborganisasi.OrgID')
                                                                ->find($SOrgID);  

            $daftar_program = \App\Models\DMaster\ProgramModel::getDaftarProgramByOPD($organisasi->OrgIDRPJMD,false);            
            $daftar_pa=\App\Models\DMaster\ASNModel::getDaftarASNByOPD('pa',$OrgID,false);
            $daftar_kpa=\App\Models\DMaster\ASNModel::getDaftarASNByOPD('kpa',$OrgID,false);;
            $daftar_ppk=\App\Models\DMaster\ASNModel::getDaftarASNByOPD('ppk',$OrgID,false);;
            $daftar_pptk=\App\Models\DMaster\ASNModel::getDaftarASNByOPD('pptk',$OrgID,false);;
            
            return response()->json([
                'daftar_program'=>$daftar_program,                                                                                                                                                       
                'daftar_rkpd'=>[],
                'daftar_pa'=>$daftar_pa,
                'daftar_kpa'=>$daftar_kpa,
                'daftar_ppk'=>$daftar_ppk,
                'daftar_pptk'=>$daftar_pptk,
            ],200);            
        }
        else
        {
            return response()->json('Mohon unit kerja untuk di pilih terlebih dahulu. bila sudah terpilih ternyata tidak bisa, berarti saudara tidak diperkenankan menambah kegiatan karena telah dikunci.',500);  
        }  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changerekening(Request $request)
    {        
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
                $RKARincID = $request->input('RKARincID')==''?'':$request->input('RKARincID');
                $data_uraian=RKARincianKegiatanModel::select(\DB::raw('pagu_uraian2'))
                                                    ->find($RKARincID);
                if (is_null($data_uraian))
                {
                    $json_data['pagu_uraian2']=0;                
                    $json_data['total_rencana_fisik']=0;
                    $json_data['total_rencana_anggaran']=0;
                }
                else
                {
                    $jumlah_realisasi=\DB::table('trRKARealisasiRinc')
                                            ->where('RKARincID',$RKARincID)
                                            ->sum('realisasi2');

                    $pagu_uraian2=$data_uraian->pagu_uraian2;
                    $json_data['pagu_uraian2']=$pagu_uraian2;  

                    $data_target=\DB::table('trRKATargetRinc')
                                ->select(\DB::raw('COALESCE(SUM(target2),0) AS target2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                ->where('RKARincID',$RKARincID)
                                ->get();

                    $json_data['total_rencana_fisik']=$data_target[0]->fisik2;
                    $json_data['total_rencana_anggaran']=$data_target[0]->target2;
                }
                
                $json_data['RKARincID']=$RKARincID;
            break;
            case 'tambahrealisasi' :
                $RKARincID = $request->input('RKARincID')==''?'none':$request->input('RKARincID');
                $data_uraian=RKARincianKegiatanModel::select(\DB::raw('pagu_uraian2'))
                                                    ->find($RKARincID);
                if (is_null($data_uraian))
                {
                    $json_data['pagu_uraian2']=0;                
                    $json_data['sisa_pagu_rincian']=0;
                }
                else
                {
                    $jumlah_realisasi=\DB::table('trRKARealisasiRinc')
                                            ->where('RKARincID',$RKARincID)
                                            ->sum('realisasi2');

                    $pagu_uraian2=$data_uraian->pagu_uraian2;
                    $json_data['pagu_uraian2']=$pagu_uraian2;           
                    $daftar_bulan = [];
                    $bulan=\Helper::getBulan();
                    
                    $b1=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('bulan2'))
                                            ->where('RKARincID',$RKARincID)
                                            ->get();

                    $bulan_realisasi = [];
                    foreach ($b1 as $item)
                    {
                        $bulan_realisasi[$item->bulan2]=\Helper::getBulan($item->bulan2);
                    }
                    $daftar_bulan = array_diff_assoc($bulan,$bulan_realisasi);

                    $json_data['bulan']=$daftar_bulan;                
                    $json_data['sisa_pagu_rincian']=$pagu_uraian2-$jumlah_realisasi;
                }
                
                $json_data['RKARincID']=$RKARincID;
            break;
        }
        return response()->json($json_data,200);
    }
    /**
     * Show the form for creating a new resource. [pilih rekening]
     *
     * @return \Illuminate\Http\Response
     */
    public function create1(Request $request)
    {        
        $filters=$this->getControllerStateSession($this->SessionName,'filters'); 
        $locked=false;
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
            return response()->json(['daftar_transaksi'=>$daftar_transaksi],200);
        }
        catch (\Exception $e)
        {            
            return response()->json($e->getMessage(),500);
        }        
    }
    /**
     * Show the form for creating a new resource [tambah uraian]
     *
     * @return \Illuminate\Http\Response
     */
    public function create2(Request $request)
    {                
        $daftar_jenispelaksanaan=\App\Models\DMaster\JenisPelaksanaanModel::getJenisPelaksanaan(\HelperKegiatan::getTahunAnggaran());             
        return response()->json($daftar_jenispelaksanaan,200);              
    }
    /**
     * Show the form for creating a new resource. [tambah rincian target fisik]
     *
     * @return \Illuminate\Http\Response
     */
    public function create3(Request $request,$id)
    {  
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
                    
            $daftar_uraian=[];
            foreach ($r as $v)
            {
                $daftar_uraian[$v->RKARincID]='['.$v->kode_rek_5.'] '.$v->nama_uraian;
            }
            return response()->json($daftar_uraian,200);
        }
        catch (\Exception $e)
        {            
            return response()->json($e->getMessage(),500);
        }              
        
    }
    /**
     * Show the form for creating a new resource. [menambah realisasi uraian]
     *
     * @return \Illuminate\Http\Response
     */
    public function create4(Request $request,$id)
    { 
        $bulan=\Helper::getBulan();
        $bulan_realisasi=RKARealisasiRincianKegiatanModel::select('bulan2')
                                                    ->where('RKARincID',$id)
                                                    ->get()
                                                    ->pluck('bulan2','bulan2')
                                                    ->toArray();
        $data = [];
        foreach($bulan as $k=>$v)
        {
            if (!array_key_exists($k,$bulan_realisasi))
            {
                $data[$k]=$v;
            }
        }
        return response()->json($data,200);       
    
    }
    /**
     * Store a newly created resource in storage. [simpan kegiatan]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = \Validator::make($request->all(),[
            'PrgID'=>'required',
            'KgtID'=>'required',
            'PaguDana2'=>'required',
        ]);
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],422);
        }
        else
        {
            $data=[
                'RKAID' => uniqid ('uid'),
                'OrgID' =>$request->input('OrgID'),
                'SOrgID' => $request->input('SOrgID'),
                'PrgID' => $request->input('PrgID'),
                'KgtID' => $request->input('KgtID'),
                'RKPDID' => $request->input('RKPDID'),            
                'PaguDana2' => $request->input('PaguDana2'),
                'sifat_kegiatan1' => 'baru',
                'nip_pa1' => $request->input('nip_pa'),
                'nip_kpa1' => $request->input('nip_kpa'),
                'nip_ppk1' => $request->input('nip_ppk'),
                'nip_pptk1' => $request->input('nip_pptk'),
                'user_id' => \Auth::user()->id,
                'Descr' => '-',
                'EntryLvl`' => 2,
                'TA' => \HelperKegiatan::getTahunAnggaran(),
            ];
            $apbdmurni = RKAKegiatanModel::create($data);     
            
            return response()->json([            
                'message'=>'Data rincian telah berhasil disimpan.',
            ],200);
        }
    }
    /**
     * Store a newly created resource in storage. [simpan rincian[uraian] kegiatan]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request)
    {
        $validator=\Validator::make($request->all(), [
            'RObyID'=>'required',
            'nama_uraian'=>'required',
            'volume'=>'required',
            'satuan'=>'required',
            'harga_satuan'=>'required',
            'pagu_uraian2'=>'required',
        ]);
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {
            $rinciankegiatan = RKARincianKegiatanModel::create([
                'RKARincID' => uniqid ('uid'),
                'RKAID' => $request->input('RKAID'),
                'RObyID' => $request->input('RObyID'),
                'JenisPelaksanaanID' => $request->input('JenisPelaksanaanID'),
                'nama_uraian' => $request->input('nama_uraian'),
                'volume2' => $request->input('volume'),
                'satuan2' => $request->input('satuan'),            
                'harga_satuan2' => $request->input('harga_satuan'),
                'pagu_uraian2' => $request->input('pagu_uraian2'),            
                'Descr' => $request->input('Descr'),
                'EntryLvl' => 2,
                'TA' => \HelperKegiatan::getTahunAnggaran(),
            ]);        
            return response()->json([            
                'message'=>'Data ini telah berhasil disimpan.'
            ],200); 
        }
    }
    /**
     * Store a newly created resource in storage. [simpan rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store3(Request $request)
    {                
        $validator=\Validator::make($request->all(), [
            'RKARincID'=>'required',
            'bulan_fisik.*'=>'required',
            'bulan_anggaran.*'=>'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {
            $bulan_fisik= $request->input('bulan_fisik');      
            $bulan_anggaran= $request->input('bulan_anggaran');      
            $data = [];
            $now = \Carbon\Carbon::now('utc')->toDateTimeString();
            for ($i=0;$i < 12; $i+=1)
            {
                $data[]=[
                    'RKATargetRincID'=>uniqid ('uid'),
                    'RKAID'=>$request->input('RKAID'),
                    'RKARincID'=>$request->input('RKARincID'),
                    'bulan2'=>$i+1,
                    'target2'=>$bulan_anggaran[$i],
                    'fisik2'=>$bulan_fisik[$i],
                    'EntryLvl'=>2,
                    'Descr'=>$request->input('Descr'),
                    'TA'=>\HelperKegiatan::getTahunAnggaran(),
                    'created_at'=>$now,
                    'updated_at'=>$now,
                ];
            }
            RKARencanaTargetModel::insert($data);

            return response()->json([            
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
        }
            
    }   
    /**
     * Store a newly created resource in storage. [simpan realisasi rincian kegiatan]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store4(Request $request)
    {
        
        $validator=\Validator::make($request->all(), [
            'RKARincID'=>'required',
            'RKAID'=>'required',
            'bulan2'=>'required',            
            'target2'=>'required',
            'realisasi2'=>'required',
            'target_fisik2'=>'required',
            'fisik2'=>'required',            
        ]);
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {
            $realisasirinciankegiatan = RKARealisasiRincianKegiatanModel::create([
                'RKARealisasiRincID' => uniqid ('uid'),
                'RKAID' => $request->input('RKAID'),
                'RKARincID' => $request->input('RKARincID'),            
                'bulan2' => $request->input('bulan2'),                
                'target2' => $request->input('target2'),                            
                'realisasi2' => $request->input('realisasi2'),                            
                'target_fisik2' => $request->input('target_fisik2'),           
                'fisik2' => $request->input('fisik2'),           
                'EntryLvl' => 2,
                'Descr' => $request->input('Descr'),            
                'TA' => \HelperKegiatan::getTahunAnggaran(),
            ]);       

            return response()->json([            
                'message'=>'Data ini telah berhasil disimpan.'
            ],200);
            
        }

    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $rka = $this->getDataRKA($uuid);
        if (is_null($rka) )  
        {
            return response()->json("Data RKA dengan ID ($uuid) tidak ditemukan",500);                                                           
        }
        else
        {           
            // $sumber_dana = \App\Models\DMaster\SumberDanaModel::getDaftarSumberDana(\HelperKegiatan::getTahunAnggaran(),false);
            $datauraian=$this->populateDataUraian($uuid);
            $datauraian->transform(function ($item,$key){
                $item->realisasi2=\DB::table('trRKARealisasiRinc')->where('RKARincID',$item->RKARincID)->sum('realisasi2');    
                $item->fisik2=\DB::table('trRKARealisasiRinc')->where('RKARincID',$item->RKARincID)->sum('fisik2');
                return $item;
            });
            $daftar_uraian=[];
            $totalpaguuraian=0;
            $totalrealisasi=0;
            $totalfisik=0;
            foreach ($datauraian as $v)
            {
                $daftar_uraian[]=$v;
                $totalpaguuraian+=$v->pagu_uraian2;
                $totalrealisasi+=$v->realisasi2;
                $totalfisik+=$v->fisik2;
            }
            return response()->json([
                                        'rka'=>$rka,
                                        'daftar_uraian'=>$daftar_uraian,
                                        'totalpaguuraian'=>$totalpaguuraian,
                                        'totalrealisasi'=>$totalrealisasi,
                                        'totalfisik'=>$totalfisik,
                                    ],
                                    200);
                
        }        
    }
    /**
     * Show the form for creating a new resource. [mendapatkan data uraian berdasarkan RKARincID]
     *
     * @return \Illuminate\Http\Response
     */
    public function infouraian(Request $request,$id)
    { 
        $data = \DB::table('trRKARinc')
                        ->select(\DB::raw('
                            "trRKARinc"."RKARincID",
                            "RKAID",
                            v_rekening."kode_rek_5",
                            nama_uraian,
                            pagu_uraian2,
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
                            fisik_12,
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
                        ->where('trRKARinc.RKARincID',$id)                
                        ->get();            

        if (is_null($data) )  
        {
            return response()->json("Data Uraian dengan ID ($id) tidak ditemukan",500);                                                           
        }
        else
        {    
            $datauraian=[
                            'RKARincID'=>$data[0]->RKARincID,
                            'RKAID'=>$data[0]->RKAID,
                            'kode_rek_5'=>$data[0]->kode_rek_5,
                            'nama_uraian'=>$data[0]->nama_uraian,
                            'pagu_uraian2'=>$data[0]->pagu_uraian2,
                            'targetfisik'=>[
                                1=>$data[0]->fisik_1,
                                2=>$data[0]->fisik_2,
                                3=>$data[0]->fisik_3,
                                4=>$data[0]->fisik_4,
                                5=>$data[0]->fisik_5,
                                6=>$data[0]->fisik_6,
                                7=>$data[0]->fisik_7,
                                8=>$data[0]->fisik_8,
                                9=>$data[0]->fisik_9,
                                10=>$data[0]->fisik_10,
                                11=>$data[0]->fisik_11,
                                12=>$data[0]->fisik_12,
                            ],
                            'anggarankas'=>[
                                1=>$data[0]->anggaran_1,
                                2=>$data[0]->anggaran_2,
                                3=>$data[0]->anggaran_3,
                                4=>$data[0]->anggaran_4,
                                5=>$data[0]->anggaran_5,
                                6=>$data[0]->anggaran_6,
                                7=>$data[0]->anggaran_7,
                                8=>$data[0]->anggaran_8,
                                9=>$data[0]->anggaran_9,
                                10=>$data[0]->anggaran_10,
                                11=>$data[0]->anggaran_11,
                                12=>$data[0]->anggaran_12,
                            ]
                        ];
            return response()->json($datauraian,200);       
        }
    }
    /**
     * Display the specified resource. [rencanatarget]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rencanatarget($uuid)
    {
        $datarencanatargetfisik=$this->populateDataRencanaTargetFisik($uuid);
        $datarencanaanggarankas=$this->populateDataRencanaAnggaranKas($uuid);
        return response()->json(['targetfisik'=>$datarencanatargetfisik,
                                'anggarankas'=>$datarencanaanggarankas
                                ],200);
    }
    /**
     * Display the specified resource. [daftar realisasi]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function realisasi($uuid)
    {   
        $data=$this->populateDataRealisasi($uuid); 
        return response()->json([
                                    'daftar_realisasi'=>$data['datarealisasi'],
                                    'totalanggarankas'=>$data['totalanggarankas'],
                                    'totalrealisasi'=>$data['totalrealisasi'],
                                    'totaltargetfisik'=>$data['totaltargetfisik'],
                                    'totalfisik'=>$data['totalfisik'],
                                    'sisa_anggaran'=>$data['sisa_anggaran'],
                                ],200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function edit3($id)
    {
        $data = RKARincianKegiatanModel::join('v_rekening','v_rekening.RObyID','trRKARinc.RObyID')
                                            ->find($id);
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
            return response()->json($data_rencana,200);
        }       
        else
        {
            return response()->json(['message'=>"Gagal mendapatkan Rencana target fisik dengan RKARincID=$id"],500);
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
        
        $validator=\Validator::make($request->all(), [
            'PaguDana2'=>'required',
            'nip_pa' => 'required',
            'nip_kpa' => 'required',
            'nip_ppk' => 'required',
            'nip_pptk' => 'required'
            // 'lokasi_kegiatan'=>'required',
            // 'SumberDanaID'=>'required',
            // 'capaian_program'=>'required',
            // 'tk_capaian'=>'required',
            // 'masukan'=>'required',
            // 'keluaran'=>'required',
            // 'tk_keluaran'=>'required',
            // 'hasil'=>'required',
            // 'tk_hasil'=>'required',
            // 'ksk'=>'required',
            // 'sifat_kegiatan'=>'required',
            // 'waktu_pelaksanaan'=>'required'
        ]);
        
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {      
            $apbdmurni->PaguDana2 = $request->input('PaguDana2');          
            $apbdmurni->nip_pa1 = $request->input('nip_pa');          
            $apbdmurni->nip_kpa1 = $request->input('nip_kpa');          
            $apbdmurni->nip_ppk1 = $request->input('nip_ppk');          
            $apbdmurni->nip_pptk1 = $request->input('nip_pptk');          
            // $apbdmurni->lokasi_kegiatan1 = $request->input('lokasi_kegiatan');
            // $apbdmurni->SumberDanaID=$request->input('SumberDanaID');
            // $apbdmurni->capaian_program1=$request->input('capaian_program');
            // $apbdmurni->tk_capaian1=$request->input('tk_capaian');
            // $apbdmurni->masukan1=$request->input('masukan');
            // $apbdmurni->keluaran1=$request->input('keluaran');
            // $apbdmurni->tk_keluaran1=$request->input('tk_keluaran');
            // $apbdmurni->hasil1=$request->input('hasil');
            // $apbdmurni->tk_hasil1=$request->input('tk_hasil');
            // $apbdmurni->ksk1=$request->input('ksk');
            // $apbdmurni->sifat_kegiatan1=$request->input('sifat_kegiatan');
            // $apbdmurni->waktu_pelaksanaan1=$request->input('waktu_pelaksanaan');
            // $apbdmurni->Descr=$request->input('Descr');
            $apbdmurni->save();

            return response()->json([       
                'request'=>$request->all(),     
                'message'=>'Data ini telah berhasil di ubah.'
            ],200);
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
        
        $validator=\Validator::make($request->all(), [
            'nama_uraian'=>'required',
            'volume'=>'required',
            'satuan'=>'required',
            'harga_satuan'=>'required',
            'pagu_uraian2'=>'required',
        ]);   
        
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {            
            $rinciankegiatan->nama_uraian = $request->input('nama_uraian');
            $rinciankegiatan->volume2=$request->input('volume');
            $rinciankegiatan->satuan2=$request->input('satuan');
            $rinciankegiatan->harga_satuan2=$request->input('harga_satuan');
            $rinciankegiatan->pagu_uraian2=$request->input('pagu_uraian2');
            $rinciankegiatan->JenisPelaksanaanID = $request->input('JenisPelaksanaanID');
            $rinciankegiatan->Descr=$request->input('Descr');            
            $rinciankegiatan->save();

            return response()->json([            
                'message'=>'Data ini telah berhasil di ubah.'
            ],200);
        }
    }

    /**
     * Update the specified resource in storage. [update rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update3(Request $request)
    {
        
        $validator=\Validator::make($request->all(), [
            'RKARincID'=>'required',
            'bulan_fisik.*'=>'required',
            'bulan_anggaran.*'=>'required',
        ]);
            
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {
            \DB::table('trRKATargetRinc')->where('RKARincID',$request->input('RKARincID'))->delete();
            
            $bulan_fisik= $request->input('bulan_fisik');      
            $bulan_anggaran= $request->input('bulan_anggaran');      
            $data = [];
            $now = \Carbon\Carbon::now('utc')->toDateTimeString();
            
            for ($i=0;$i < 12; $i+=1)
            {
                $data[]=[
                    'RKATargetRincID'=>uniqid ('uid'),
                    'RKAID'=>$request->input('RKAID'),
                    'RKARincID'=>$request->input('RKARincID'),
                    'bulan2'=>$i+1,
                    'target2'=>$bulan_anggaran[$i],
                    'fisik2'=>$bulan_fisik[$i],
                    'EntryLvl'=>2,
                    'Descr'=>$request->input('Descr'),
                    'TA'=>\HelperKegiatan::getTahunAnggaran(),
                    'created_at'=>$now,
                    'updated_at'=>$now,
                ];
            }
            RKARencanaTargetModel::insert($data);

            return response()->json([            
                'message'=>'Data ini telah berhasil di ubah.'
            ],200);
        }       
        
    }

    /**
     * Store a newly created resource in storage. [update realisasi rincian kegiatan]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update4(Request $request, $id)
    {    
        $realisasi = RKARealisasiRincianKegiatanModel::find($id);    

        $validator=\Validator::make($request->all(), [            
            'realisasi2'=>'required',
            'fisik2'=>'required',            
        ]);
        if ($validator->fails())
        {
            return response()->json([            
                'message'=>$validator->errors(),
            ],500);
        }
        else
        {
            $realisasi->fisik2 = $request->input('fisik2');
            $realisasi->realisasi2 = $request->input('realisasi2');
            $realisasi->Descr = $request->input('Descr');
            $realisasi->save();             

            return response()->json([            
                'message'=>'Data ini telah berhasil diubah.'
            ],200);
            
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
                    $result=$rinciankegiatan->delete();
                    return response()->json(['message'=>"data rincian kegiatan dengan ID ($id) Berhasil di Hapus"],200);  
                break;
                case 'datarencana' :
                    $rinciankegiatan = RKARincianKegiatanModel::find($id);
                    $result=\DB::table('trRKATargetRinc')->where('RKARincID',$id)->delete();
                    return response()->json(['message'=>"data rencana target fisik dan anggaran kas dengan ID ($id) Berhasil di Hapus"],200);      
                break;
                case 'datarealisasi' :
                    $realisasirinciankegiatan = RKARealisasiRincianKegiatanModel::find($id);
                    $result=$realisasirinciankegiatan->delete();
                    return response()->json(['message'=>"data realisasi uraian kegiatan dengan ID ($id) Berhasil di Hapus"],200);                                                  
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