<?php

namespace App\Http\Controllers\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\DMaster\SubOrganisasiModel;
use App\Models\DMaster\SIMDAModel;
use App\Models\Belanja\RKAModel;
use App\Models\Belanja\RKARincianModel;
use App\Models\Belanja\RKARencanaTargetModel;
use App\Models\Belanja\RKARealisasiModel;
use Illuminate\Validation\Rule;

class RKAPerubahanController extends Controller 
{
    private function recalculate($RKAID)
    {
        $jumlah_uraian = \DB::table('trRKARinc')                            
                            ->where('RKAID',$RKAID)
                            ->count('RKARincID');

        $data_realisasi = \DB::table('trRKARealisasiRinc')
                            ->select(\DB::raw('
                                COALESCE(SUM(realisasi2),0) AS jumlah_realisasi,
                                COALESCE(SUM(fisik2),0) AS jumlah_fisik
                            '))
                            ->where('RKAID',$RKAID)
                            ->get();
        
        $rka = RKAModel::find($RKAID);
        $rka->RealisasiKeuangan2=$data_realisasi[0]->jumlah_realisasi;
        $rka->RealisasiFisik2=Helper::formatPecahan($data_realisasi[0]->jumlah_fisik,$jumlah_uraian);
        $rka->save();  
    }
    private function getDataRKA ($id)
    {
        $rka = RKAModel::select(\DB::raw('"RKAID",
                                            "trRKA"."kode_urusan",
                                            "trRKA"."Nm_Bidang",
                                            "trRKA"."kode_organisasi",
                                            "trRKA"."OrgNm",
                                            "trRKA"."kode_suborganisasi",
                                            "trRKA"."SOrgNm",
                                            "trRKA"."kode_program",
                                            "trRKA"."PrgNm",
                                            "trRKA"."kode_kegiatan",
                                            "trRKA"."KgtNm",
                                            "trRKA"."lokasi_kegiatan2",
                                            "trRKA"."SumberDanaID",
                                            "tmSumberDana"."Nm_SumberDana",
                                            "trRKA"."tk_capaian2",
                                            "trRKA"."capaian_program2",
                                            "trRKA"."masukan2",
                                            "trRKA"."tk_keluaran2",
                                            "trRKA"."keluaran2",
                                            "trRKA"."tk_hasil2",
                                            "trRKA"."hasil2",
                                            "trRKA"."ksk2",
                                            "trRKA"."sifat_kegiatan2",
                                            "trRKA"."waktu_pelaksanaan2",
                                            "trRKA"."PaguDana2",
                                            "trRKA"."Descr",
                                            "trRKA"."EntryLvl",
                                            "trRKA"."Locked",
                                            "trRKA"."RKAID_Src",
                                            "trRKA"."created_at",
                                            "trRKA"."updated_at"
                                            '))
                            ->leftJoin('tmSumberDana','tmSumberDana.SumberDanaID','trRKA.SumberDanaID')
                            ->where('trRKA.EntryLvl',2)
                            ->find($id);

        return $rka;
    }

    /**
     * collect data from resources for datauraian view
     *
     * @return resources
     */
    public function populateDataRealisasi ($RKARincID)
    {
        $datauraian = SIMDAModel::find($RKARincID);

        $data=[
            'datarealisasi'=>[],
            'totalanggarankas'=>0,
            'totalrealisasi'=>0,
            'totaltargetfisik'=>0,
            'totalfisik'=>0,
            'sisa_anggaran'=>0,
        ];
        if (!is_null($datauraian))        
        {
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

                $sisa_anggaran=$datauraian->PaguUraian2-$sum_realisasi;            
                $daftar_realisasi[]=[
                    'RKARealisasiRincID'=>$item->RKARealisasiRincID,
                    'bulan2'=>$item->bulan2,
                    'NamaBulan'=>Helper::getNamaBulan($item->bulan2),
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
            $data['totaltargetfisik']=round($totaltargetfisik,2);
            $data['totalfisik']=round($totalfisik,2);
            $data['sisa_anggaran']=$datauraian->PaguUraian2-$totalrealisasi;
        }

        return $data;
    }    

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loaddatakegiatanFirsttime(Request $request)
    {   
        $user_id=$this->getUserid();
        
        $tahun=$request->input('tahun');
        $this->validate($request, [            
            'tahun'=>'required',
            'SOrgID'=>'required|exists:tmSOrg,SOrgID',
        ]); 
        
        $SOrgID=$request->input('SOrgID');
        $unitkerja = SubOrganisasiModel::find($SOrgID);

        $str_insert = '
        INSERT INTO "trRKA" (
            "RKAID",
            kode_kegiatan,
            kode_urusan,
            kode_bidang,
            kode_organisasi,
            "kode_suborganisasi",
            kode_program,
            "Nm_Urusan",
            "Nm_Bidang",
            "OrgNm",
            "SOrgNm",
            "PrgNm",
            "KgtNm",
            "PaguDana1",
            "PaguDana2",
            "RealisasiKeuangan1",
            "RealisasiKeuangan2",
            "user_id",
            "EntryLvl",
            "TA",
            "Locked",
            created_at,
            updated_at
        )
        SELECT
            REPLACE(SUBSTRING(CONCAT(\'uid\',uuid_in(md5(random()::text || clock_timestamp()::text)::cstring)) from 1 for 16),\'-\',\'\') AS "RKAID",
            * 
        FROM
        (
            SELECT 
                DISTINCT(kode_kegiatan),
                CASE 
                    WHEN "Kd_Urusan" IS NULL THEN
                            SPLIT_PART(kode_organisasi, \'.\', 1)
                    ELSE
                            "Kd_Urusan"
                END AS kode_urusan,
                CASE 
                    WHEN "Kd_Bidang" IS NULL THEN
                            CONCAT(SPLIT_PART(kode_organisasi, \'.\', 1),\'.\',SPLIT_PART(kode_organisasi, \'.\', 2))
                    ELSE
                            CONCAT("Kd_Urusan",\'.\',"Kd_Bidang")
                END AS kode_bidang,	
                "kode_organisasi",
                "kode_suborganisasi",
                kode_program,		
                CASE 
                    WHEN "Kd_Urusan" IS NULL THEN
                            \'Non-Urusan\'
                    ELSE
                        "Nm_Urusan"
                END AS "Nm_Urusan",
                CASE 
                    WHEN "Kd_Bidang" IS NULL THEN
                            \'Non-Urusan\'
                    ELSE
                        "Nm_Bidang"
                END AS "Nm_Bidang",
                "OrgNm",
                "SOrgNm",
                "PrgNm",
                "KgtNm",	
                0 AS "PaguDana1",
                0 AS "PaguDana2",
                0 AS "RealisasiKeuangan1",
                0 AS "RealisasiKeuangan2",
                '.$user_id.' AS "user_id",
                "EntryLvl",
                "TA",
                false AS "Locked",
                NOW() AS created_at,
                NOW() AS updated_at
            FROM simda WHERE kode_suborganisasi=\''.$unitkerja->kode_suborganisasi.'\' AND 
                            "TA"='.$tahun.' AND      
                            "EntryLvl"=2
        ) AS temp
        ';
        \DB::statement($str_insert); 
        
        $data = RKAModel::where('kode_suborganisasi',$unitkerja->kode_suborganisasi)
                            ->where('EntryLvl',2)
                            ->where('TA',$tahun)
                            ->get();
                            
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'unitkerja'=>$unitkerja,
                                'rka'=>$data,
                                'message'=>'Fetch data rka perubahan berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);    
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loaddatauraianFirsttime(Request $request)
    {   
        $tahun=$request->input('tahun');
        $this->validate($request, [            
            'RKAID'=>'required|exists:trRKA,RKAID',
        ]); 
        
        $RKAID=$request->input('RKAID');
        $rka = RKAModel::find($RKAID);

        $str_insert = '
            INSERT INTO "trRKARinc" (
                "RKARincID",
                "RKAID",
                volume1,
                satuan1,
                volume2,
                satuan2,
                harga_satuan1,
                harga_satuan2,
                "EntryLvl",
                "TA",
                created_at,
                updated_at
            )
            SELECT 
                "TepraID" AS "RKARincID",
                \''.$rka->RKAID.'\' AS "RKAID",
                1 AS volume1,
                \'Kegiatan\' AS satuan1,
                1 AS volume2,
                \'Kegiatan\' AS satuan2,
                "PaguUraian1" AS "harga_satuan1",
                "PaguUraian2" AS "harga_satuan2",
                2 AS "EntryLvl",
                '.$rka->TA.' AS "TA",
                NOW () AS created_at,
                NOW () AS updated_at
            FROM simda A
            LEFT JOIN "trRKARinc" B ON B."RKARincID"=A."TepraID"
                WHERE kode_kegiatan=\''.$rka->kode_kegiatan.'\' AND 
                kode_suborganisasi=\''.$rka->kode_suborganisasi.'\' AND 
                A."EntryLvl"=2 AND 
                A."TA"='.$rka->TA.' AND 
                "RKARincID" IS NULL
        ';
        \DB::statement($str_insert); 
        
        $data = RKARincianModel::select(\DB::raw('
                                    "trRKARinc"."RKARincID",
                                    simda.kode_uraian,
                                    simda.nama_uraian,
                                    CONCAT("trRKARinc".volume2,\' \',"trRKARinc".satuan2) AS volume,
                                    "trRKARinc"."volume2",
                                    "trRKARinc"."satuan2",
                                    "trRKARinc"."harga_satuan2",
                                    "simda"."PaguUraian2",
                                    0 AS "realisasi2",
                                    0 AS "fisik2",
                                    "trRKARinc"."JenisPelaksanaanID",
                                    "trRKARinc"."TA",
                                    "trRKARinc".created_at,
                                    "trRKARinc".updated_at
                                '))
                                ->join('simda','simda.TepraID','trRKARinc.RKARincID')
                                ->where('RKAID',$rka->RKAID)
                                ->get();
        
        $rka->PaguDana1 = $data->sum('PaguUraian1');
        $rka->PaguDana2 = $data->sum('PaguUraian2');

        $rka->save();

        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'rka'=>$rka,
                                'uraian'=>$data,
                                'message'=>'Fetch data uraian rka perubahan berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {             
        $this->hasPermissionTo('RKA PERUBAHAN_BROWSE');
        
        $this->validate($request, [            
            'tahun'=>'required',            
            'SOrgID'=>'required|exists:tmSOrg,SOrgID',            
        ]);
        $tahun = $request->input('tahun');
        $SOrgID = $request->input('SOrgID');
        $unitkerja = SubOrganisasiModel::find($SOrgID);
     
        $data = RKAModel::select(\DB::raw('
                            "RKAID",
                            "SumberDanaID",
                            kode_urusan,
                            kode_bidang,
                            kode_organisasi,
                            kode_suborganisasi,
                            kode_program,
                            kode_kegiatan,
                            "Nm_Urusan",
                            "Nm_Bidang",
                            "OrgNm",
                            "SOrgNm",
                            "PrgNm",
                            "KgtNm",
                            keluaran2,
                            tk_keluaran2,                            
                            hasil2,                            
                            tk_hasil2,                            
                            capaian_program2,                            
                            tk_capaian2,                            
                            masukan2,                            
                            ksk2,                            
                            sifat_kegiatan1,                            
                            waktu_pelaksanaan2,                            
                            lokasi_kegiatan2,                            
                            "PaguDana2",                            
                            "RealisasiKeuangan2",                            
                            "RealisasiFisik2", 
                            0 AS persen_keuangan2,                           
                            nip_pa2,                            
                            nip_kpa2,
                            nip_ppk2,
                            nip_pptk2,
                            "Descr",
                            "TA",
                            "Locked",
                            "RKAID_Src",
                            created_at,
                            updated_at
                        '))
                        ->where('kode_suborganisasi',$unitkerja->kode_suborganisasi)
                        ->where('TA',$tahun)
                        ->where('EntryLvl',2)
                        ->orderBy('kode_kegiatan','ASC')
                        ->get();        
                    
        $data->transform(function ($item,$key){                            
            $item->persen_keuangan2=Helper::formatPersen($item->RealisasiKeuangan2,$item->PaguDana2);
            return $item;
        });
        $unitkerja->RealisasiKeuangan2=$data->sum('RealisasiKeuangan2');
        $jumlah_realisasi_fisik=$data->sum('RealisasiFisik2');
        $unitkerja->RealisasiFisik2=Helper::formatPecahan($jumlah_realisasi_fisik,$unitkerja->JumlahKegiatan2);
        $unitkerja->save();
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'unitkerja'=>$unitkerja,
                                'rka'=>$data,
                                'message'=>'Fetch data rka perubahan berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);              
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatekegiatan(Request $request,$id)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');

        $kegiatan = RKAModel::find($id);
        
        $this->validate($request, [
                'SumberDanaID'=>'required',                
                'keluaran2'=>'required',                
                'tk_keluaran2'=>'required',                
                'hasil2'=>'required',                
                'tk_hasil2'=>'required',                
                'capaian_program2'=>'required',                
                'tk_capaian2'=>'required',                
                'masukan2'=>'required',                
                'ksk2'=>'required',                
                'sifat_kegiatan2'=>'required',                
                'waktu_pelaksanaan2'=>'required',                
                'lokasi_kegiatan2'=>'required',                                
                'nip_pa2'=>'required',                
                'nip_kpa2'=>'required',                
                'nip_ppk2'=>'required',                
                'nip_pptk2'=>'required', 
        ]);
        
        $kegiatan->SumberDanaID=$request->input('SumberDanaID');                
        $kegiatan->keluaran2=$request->input('keluaran2');                
        $kegiatan->tk_keluaran2=$request->input('tk_keluaran2');                
        $kegiatan->hasil2=$request->input('hasil2');                
        $kegiatan->tk_hasil2=$request->input('tk_hasil2');                
        $kegiatan->capaian_program2=$request->input('capaian_program2');                
        $kegiatan->tk_capaian2=$request->input('tk_capaian2');                
        $kegiatan->masukan2=$request->input('masukan2');                
        $kegiatan->ksk2=$request->input('ksk2');                
        $kegiatan->sifat_kegiatan2=$request->input('sifat_kegiatan2');                
        $kegiatan->waktu_pelaksanaan2=$request->input('waktu_pelaksanaan2');                
        $kegiatan->lokasi_kegiatan2=$request->input('lokasi_kegiatan2');                                
        $kegiatan->nip_pa2=$request->input('nip_pa2');                
        $kegiatan->nip_kpa2=$request->input('nip_kpa2');                
        $kegiatan->nip_ppk2=$request->input('nip_ppk2');                
        $kegiatan->nip_pptk2=$request->input('nip_pptk2'); 
        $kegiatan->Descr=$request->input('Descr'); 
        $kegiatan->save();

        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'message'=>'Update RKA berhasil disimpan.'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateuraian(Request $request,$id)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');

        $rinciankegiatan = RKARincianModel::find($id);
        if (is_null($rinciankegiatan))
        {
            return Response()->json([
                                        'status'=>0,
                                        'pid'=>'update',                
                                        'message'=>'Update uraian gagal disimpan.'
                                    ],422); 
        }
        else
        {
            $this->validate($request, [ 
                'volume2'=>'required',
                'satuan2'=>'required',
                'harga_satuan2'=>'required',
                'PaguUraian2'=>'required',
            ]);

            $rka = \DB::transaction(function () use ($request,$rinciankegiatan) {
                $rinciankegiatan->volume2=$request->input('volume2');
                $rinciankegiatan->satuan2=$request->input('satuan2');
                $rinciankegiatan->harga_satuan2=$request->input('harga_satuan2');        
                $rinciankegiatan->JenisPelaksanaanID = $request->input('JenisPelaksanaanID');                   
                $rinciankegiatan->save();
                
                \DB::table('simda')
                    ->where('TepraID',$rinciankegiatan->RKARincID)
                    ->update(['PaguUraian2'=>$request->input('PaguUraian2')]);                

                $paguuraian=RKARincianModel::select(\DB::raw('
                                                SUM("PaguUraian2") AS "PaguUraian2"                                               
                                            '))
                                            ->join('simda','simda.TepraID','trRKARinc.RKARincID')
                                            ->where('RKAID',$rinciankegiatan->RKAID)                                 
                                            ->first();

                $rka=$this->getDataRKA($rinciankegiatan->RKAID);
                if (!is_null($paguuraian))                {
                    $rka->PaguDana2=$paguuraian->PaguUraian2;
                    $rka->save();
                }
                return $rka;
            });

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'rka'=>$rka,
                                    'message'=>'Update uraian berhasil disimpan.'
                                ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatedetailuraian(Request $request,$id)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');

        $rinciankegiatan = RKARincianModel::find($id);
        
        $this->validate($request, [
            'SumberDanaID'=>'required',            
        ]);
        
        $rinciankegiatan->JenisPelaksanaanID= $request->input('JenisPelaksanaanID');
        $rinciankegiatan->SumberDanaID= $request->input('SumberDanaID');
        $rinciankegiatan->JenisPembangunanID= $request->input('JenisPembangunanID');                        
        $rinciankegiatan->idlok= $request->input('idlok');                
        $rinciankegiatan->ket_lok= $request->input('ket_lok');                
        $rinciankegiatan->rw= $request->input('rw');                
        $rinciankegiatan->rt= $request->input('rt');                
        $rinciankegiatan->nama_perusahaan= $request->input('nama_perusahaan');                
        $rinciankegiatan->alamat_perusahaan= $request->input('alamat_perusahaan');                
        $rinciankegiatan->no_telepon= $request->input('no_telepon');                                                                              
        $rinciankegiatan->nama_direktur= $request->input('nama_direktur');                
        $rinciankegiatan->npwp= $request->input('npwp');                
        $rinciankegiatan->no_kontrak= $request->input('no_kontrak');                
        $rinciankegiatan->tgl_kontrak= $request->input('tgl_kontrak');                                        
        $rinciankegiatan->tgl_mulai_pelaksanaan= $request->input('tgl_mulai_pelaksanaan');                
        $rinciankegiatan->tgl_selesai_pelaksanaan= $request->input('tgl_selesai_pelaksanaan');                
        $rinciankegiatan->status_lelang= $request->input('status_lelang');             
        $rinciankegiatan->Descr= $request->input('Descr');      
        $rinciankegiatan->save();

        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'message'=>'Update detail uraian berhasil disimpan.'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
    }
    /**
     * Show the form for creating a new resource. [menambah realisasi uraian]
     *
     * @return \Illuminate\Http\Response
     */
    public function bulanrealisasi(Request $request,$id)
    { 
        $this->hasPermissionTo('RKA PERUBAHAN_BROWSE');

        $bulan=Helper::getNamaBulan();
        $bulan_realisasi=RKARealisasiModel::select('bulan2')
                                                    ->where('RKARincID',$id)
                                                    ->get()
                                                    ->pluck('bulan2','bulan2')
                                                    ->toArray();
        $data = [];
        foreach($bulan as $k=>$v)
        {
            if (!array_key_exists($k,$bulan_realisasi))
            {
                $data[$k]=['value'=>$k,'text'=>$v];
            }
        }
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'bulan'=>$data,
                                'message'=>'Fetch data bulan realisasi berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    
    /**
     * Store a newly created resource in storage. [simpan rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savetargetfisik(Request $request)
    {            
        $this->hasPermissionTo('RKA PERUBAHAN_STORE');

        $this->validate($request, [
            'RKARincID'=>'required|exists:trRKARinc,RKARincID',            
            'bulan_fisik.*'=>'required',
        ]);

        
        $bulan_fisik= $request->input('bulan_fisik');      
        $data = [];
        $now = \Carbon\Carbon::now('utc')->toDateTimeString();
        for ($i=0;$i < 12; $i+=1)
        {
            $data[]=[
                'RKATargetRincID'=>uniqid ('uid'),
                'RKAID'=>$request->input('RKAID'),
                'RKARincID'=>$request->input('RKARincID'),
                'bulan1'=>$i+1,
                'bulan2'=>$i+1,
                'target1'=>0,                
                'target2'=>0,                
                'fisik1'=>0,                
                'fisik2'=>$bulan_fisik[$i],                
                'EntryLvl'=>2,
                'Descr'=>$request->input('Descr'),
                'TA'=>$request->input('tahun'),
                'created_at'=>$now,
                'updated_at'=>$now,
            ];
        }
        RKARencanaTargetModel::insert($data);

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'message'=>'Rencana target fisik uraian berhasil disimpan.'
                                ],200); 
        
            
    }   
    /**
     * Store a newly created resource in storage. [simpan rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatetargetfisik(Request $request)
    {                
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');

        $this->validate($request, [
            'RKARincID'=>'required|exists:trRKARinc,RKARincID',            
            'bulan_fisik.*'=>'required',
        ]);

        $bulan_fisik= $request->input('bulan_fisik');      
        $data = [];
        $now = \Carbon\Carbon::now('utc')->toDateTimeString();
        for ($i=0;$i < 12; $i+=1)
        {
            \DB::table('trRKATargetRinc')
                ->where('RKARincID',$request->input('RKARincID'))
                ->where('bulan2',$i+1)
                ->update(['fisik2'=>$bulan_fisik[$i]]);
        }
        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'message'=>'Rencana target fisik uraian berhasil diubah.'
                            ],200); 
        
            
    }  
    /**
     * Store a newly created resource in storage. [simpan rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savetargetanggarankas(Request $request)
    {                
        $this->hasPermissionTo('RKA PERUBAHAN_STORE');

        $this->validate($request, [
            'RKARincID'=>'required|exists:trRKARinc,RKARincID',            
            'bulan_fisik.*'=>'required',
        ]);

        $bulan_anggaran= $request->input('bulan_anggaran');      
        $data = [];
        $now = \Carbon\Carbon::now('utc')->toDateTimeString();
        for ($i=0;$i < 12; $i+=1)
        {
            $data[]=[
                'RKATargetRincID'=>uniqid ('uid'),
                'RKAID'=>$request->input('RKAID'),
                'RKARincID'=>$request->input('RKARincID'),
                'bulan1'=>$i+1,                
                'bulan2'=>$i+1,                
                'fisik1'=>0,
                'fisik2'=>0,
                'target1'=>0,                
                'target2'=>$bulan_anggaran[$i],                
                'EntryLvl'=>2,
                'Descr'=>$request->input('Descr'),
                'TA'=>$request->input('tahun'),
                'created_at'=>$now,
                'updated_at'=>$now,
            ];
        }
        RKARencanaTargetModel::insert($data);

        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'message'=>'Rencana target anggaran kas uraian berhasil disimpan.'
                            ],200); 
        
            
    } 
    /**
     * Store a newly created resource in storage. [simpan rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatetargetanggarankas(Request $request)
    {                
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');

        $this->validate($request, [
            'RKARincID'=>'required|exists:trRKARinc,RKARincID',            
            'bulan_fisik.*'=>'required',
        ]);

        $bulan_anggaran= $request->input('bulan_anggaran');      
        $data = [];
        $now = \Carbon\Carbon::now('utc')->toDateTimeString();
        for ($i=0;$i < 12; $i+=1)
        {
            \DB::table('trRKATargetRinc')
                ->where('RKARincID',$request->input('RKARincID'))
                ->where('bulan2',$i+1)
                ->update(['target2'=>$bulan_anggaran[$i]]);
        }

        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'message'=>'Rencana target anggaran kas uraian berhasil diubah.'
                            ],200); 
        
            
    }      
    /**
     * Store a newly created resource in storage. [simpan realisasi rincian kegiatan]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saverealisasi(Request $request)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_STORE');

        $this->validate($request, [
            'RKARincID'=>'required',
            'RKAID'=>'required',
            'bulan2'=>'required',            
            'target2'=>'required',
            'realisasi2'=>'required',
            'target_fisik2'=>'required',
            'fisik2'=>'required',      
        ]);
        $RKAID=$request->input('RKAID');
        $realisasi = RKARealisasiModel::create([
            'RKARealisasiRincID' => uniqid ('uid'),
            'RKAID' => $RKAID,
            'RKARincID' => $request->input('RKARincID'),            
            'bulan1' => 0,            
            'bulan2' => $request->input('bulan2'),            
            'target1' => 0,            
            'target2' => $request->input('target2'),                        
            'realisasi1' => 0,            
            'realisasi2' => $request->input('realisasi2'),                             
            'target_fisik1' => 0,                       
            'target_fisik2' => $request->input('target_fisik2'),                       
            'fisik1' => 0,                                
            'fisik2' => $request->input('fisik2'),                                
            'EntryLvl' => 2,
            'Descr' => $request->input('Descr'),            
            'TA' => $request->input('TA'),
        ]);      
        
        $this->recalculate($RKAID);

        return Response()->json([
                                'status'=>1,
                                'pid'=>'store',
                                'realisasi'=>$realisasi,                                    
                                'message'=>'Data realisasi berhasil disimpan.'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
        
    }    
    /**
     * Store a newly created resource in storage. [update realisasi rincian kegiatan]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updaterealisasi(Request $request, $id)
    {    
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');
        
        $this->validate($request, [                    
            'target2'=>'required',
            'realisasi2'=>'required',
            'target_fisik2'=>'required',
            'fisik2'=>'required',      
        ]);

        $realisasi = RKARealisasiModel::find($id);    
        $realisasi->target2 = $request->input('target2');
        $realisasi->realisasi2 = $request->input('realisasi2');
        $realisasi->target_fisik2 = $request->input('target_fisik2');
        $realisasi->fisik2 = $request->input('fisik2');        
        $realisasi->Descr = $request->input('Descr');
        $realisasi->save();                     

        $this->recalculate($realisasi->RKAID);

        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'realisasi'=>$realisasi,                                    
                                'message'=>'Data realisasi berhasil diubah.'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
        
        

    }  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_SHOW');

        $rka = $this->getDataRKA($id);

        if (is_null($rka))
        {
            return Response()->json([
                'status'=>1,
                'pid'=>'fetchdata',                
                'message'=>'Fetch data kegiatan gagal diperoleh'
            ],422); 
        }
        else
        {
            $data = RKARincianModel::select(\DB::raw('
                                    "trRKARinc"."RKARincID",
                                    "trRKARinc"."RKAID",
                                    "trRKARinc"."JenisPelaksanaanID",
                                    "trRKARinc"."SumberDanaID",
                                    "trRKARinc"."JenisPembangunanID",
                                    simda.kode_uraian,
                                    simda.nama_uraian,
                                    "trRKARinc"."volume2",
                                    "trRKARinc"."satuan2",
                                    CONCAT("trRKARinc".volume2,\' \',"trRKARinc".satuan2) AS volume,
                                    "trRKARinc"."harga_satuan2",
                                    "simda"."PaguUraian2",
                                    0 AS "realisasi2",
                                    0 AS "persen_keuangan2",
                                    0 AS "fisik2",                                                                        
                                    \'\' AS "PMProvID",
                                    \'\' AS "PmKotaID",
                                    \'\' AS "PmKecamatanID",                                    
                                    \'\' AS "PmDesaID",                                    
                                    "trRKARinc"."idlok",
                                    "trRKARinc"."ket_lok",
                                    "trRKARinc"."rw",
                                    "trRKARinc"."rt",
                                    "trRKARinc"."nama_perusahaan",
                                    "trRKARinc"."alamat_perusahaan",
                                    "trRKARinc"."no_telepon",
                                    "trRKARinc"."nama_direktur",
                                    "trRKARinc"."npwp",
                                    "trRKARinc"."no_kontrak",
                                    "trRKARinc"."tgl_mulai_pelaksanaan",
                                    "trRKARinc"."tgl_selesai_pelaksanaan",
                                    "trRKARinc"."status_lelang",
                                    "trRKARinc"."Descr",                                    
                                    "trRKARinc"."TA",
                                    "trRKARinc"."Locked",
                                    "trRKARinc"."RKARincID_Src",
                                    "trRKARinc".created_at,
                                    "trRKARinc".updated_at
                                '))
                                ->join('simda','simda.TepraID','trRKARinc.RKARincID')
                                ->where('RKAID',$rka->RKAID)
                                ->orderBy('simda.kode_uraian','ASC')
                                ->get();
            
            $data->transform(function ($item,$key){
                $item->realisasi2=\DB::table('trRKARealisasiRinc')->where('RKARincID',$item->RKARincID)->sum('realisasi2');    
                $item->fisik2=\DB::table('trRKARealisasiRinc')->where('RKARincID',$item->RKARincID)->sum('fisik2');
                $item->persen_keuangan2=Helper::formatPersen($item->realisasi2,$item->PaguUraian2);
                switch($item->ket_lok)
                {
                    case 'desa' :
                        $lokasi=\App\Models\DMaster\DesaModel::select(\DB::raw('"tmPmDesa"."PmDesaID","tmPmKecamatan"."PmKecamatanID","tmPmKota"."PmKotaID","tmPMProv"."PMProvID"'))
                                                            ->join('tmPmKecamatan','tmPmKecamatan.PmKecamatanID','tmPmDesa.PmKecamatanID')
                                                            ->join('tmPmKota','tmPmKecamatan.PmKotaID','tmPmKota.PmKotaID')
                                                            ->join('tmPMProv','tmPMProv.PMProvID','tmPmKota.PMProvID')                                                            
                                                            ->find($item->idlok);
                        
                        if (!is_null($lokasi))
                        {
                            $item->PmDesaID=$lokasi->PmDesaID;
                            $item->PmKecamatanID=$lokasi->PmKecamatanID;
                            $item->PmKotaID=$lokasi->PmKotaID;
                            $item->PMProvID=$lokasi->PMProvID;                            
                        }
                    break;
                    case 'kecamatan' :
                        $lokasi=\App\Models\DMaster\KecamatanModel::select(\DB::raw('"tmPmKecamatan"."PmKecamatanID","tmPmKota"."PmKotaID","tmPMProv"."PMProvID"'))                                                            
                                                            ->join('tmPmKota','tmPmKecamatan.PmKotaID','tmPmKota.PmKotaID')
                                                            ->join('tmPMProv','tmPMProv.PMProvID','tmPmKota.PMProvID')                                                            
                                                            ->find($item->idlok);

                        if (!is_null($lokasi))
                        {
                            $item->PmKecamatanID=$lokasi->PmKecamatanID;
                            $item->PmKotaID=$lokasi->PmKotaID;
                            $item->PMProvID=$lokasi->PMProvID;
                        }
                    break;
                    case 'kota' :
                        $lokasi=\App\Models\DMaster\KotaModel::select(\DB::raw('"tmPmKota"."PmKotaID","tmPMProv"."PMProvID"'))                                                                                                                        
                                                            ->join('tmPMProv','tmPMProv.PMProvID','tmPmKota.PMProvID')                                                            
                                                            ->find($item->idlok);

                        if (!is_null($lokasi))
                        {
                            $item->PmKotaID=$lokasi->PmKotaID;
                            $item->PMProvID=$lokasi->PMProvID;
                        }
                    break;
                    case 'provinsi' :
                        $lokasi=\App\Models\DMaster\ProvinsiModel::select(\DB::raw('"tmPMProv"."PMProvID"'))                                                                                                                                                                                                                                            
                                                            ->find($item->idlok);

                        if (!is_null($lokasi))
                        {
                            $item->PMProvID=$lokasi->PMProvID;
                        }
                    break;
                    case 'kota' :
                        $lokasi=\App\Models\DMaster\KotaModel::select(\DB::raw('"tmPmKecamatan"."PmKecamatanID","tmPmKota"."PmKotaID","tmPMProv"."PMProvID"'))                                                                                                                        
                                                            ->join('tmPMProv','tmPMProv.PMProvID','tmPmKota.PMProvID')                                                            
                                                            ->find($item->idlok);

                        if (!is_null($lokasi))
                        {
                            $item->PmKotaID=$lokasi->PmKotaID;
                            $item->PMProvID=$lokasi->PMProvID;
                        }
                    break;
                }
                return $item;
            });

            return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'datakegiatan'=>$rka,
                                'uraian'=>$data,
                                'message'=>'Fetch data kegiatan berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
        }            
    }
    public function copykegiatanmurni (Request $request,$id)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');

        $rka_perubahan = RKAModel::where('EntryLvl',2)
                                    ->find($id);

        if (is_null($rka_perubahan))
        {
            return Response()->json([
                'status'=>0,
                'pid'=>'fetchdata',                
                'message'=>['Fetch data kegiatan gagal diperoleh']
            ],422); 
        }
        else
        {
            $this->validate($request, [            
                'RKAID'=>'required|exists:trRKA,RKAID',
            ]); 
            $copy = \DB::transaction(function () use ($request,$rka_perubahan) {
                $RKAID=$request->input('RKAID');
                $rka_murni = RKAModel::find($RKAID);
                
                $rka_perubahan->SumberDanaID=$rka_murni->SumberDanaID;                
                $rka_perubahan->PaguDana1=$rka_murni->PaguDana1;                                                    
                $rka_perubahan->RealisasiKeuangan1=$rka_murni->RealisasiKeuangan1;                                                    
                $rka_perubahan->RealisasiFisik1=$rka_murni->RealisasiFisik1;                                                    
                $rka_perubahan->keluaran1=$rka_murni->keluaran1;                
                $rka_perubahan->keluaran2=$rka_murni->keluaran1;                
                $rka_perubahan->tk_keluaran1=$rka_murni->tk_keluaran1;                
                $rka_perubahan->tk_keluaran2=$rka_murni->tk_keluaran1;                
                $rka_perubahan->hasil1=$rka_murni->hasil1;                
                $rka_perubahan->hasil2=$rka_murni->hasil1;                
                $rka_perubahan->tk_hasil1=$rka_murni->tk_hasil1;                
                $rka_perubahan->tk_hasil2=$rka_murni->tk_hasil1;                
                $rka_perubahan->capaian_program1=$rka_murni->capaian_program1;                
                $rka_perubahan->capaian_program2=$rka_murni->capaian_program1;                
                $rka_perubahan->tk_capaian1=$rka_murni->tk_capaian1;                
                $rka_perubahan->tk_capaian2=$rka_murni->tk_capaian1;                
                $rka_perubahan->masukan1=$rka_murni->masukan1;                
                $rka_perubahan->masukan2=$rka_murni->masukan1;                
                $rka_perubahan->ksk1=$rka_murni->ksk1;                
                $rka_perubahan->ksk2=$rka_murni->ksk1;                
                $rka_perubahan->sifat_kegiatan1=$rka_murni->sifat_kegiatan1;                
                $rka_perubahan->sifat_kegiatan2=$rka_murni->sifat_kegiatan1;                
                $rka_perubahan->waktu_pelaksanaan1=$rka_murni->waktu_pelaksanaan1;                
                $rka_perubahan->waktu_pelaksanaan2=$rka_murni->waktu_pelaksanaan1;                
                $rka_perubahan->lokasi_kegiatan1=$rka_murni->lokasi_kegiatan1;                                
                $rka_perubahan->lokasi_kegiatan2=$rka_murni->lokasi_kegiatan1;                                
                $rka_perubahan->nip_pa1=$rka_murni->nip_pa1;                
                $rka_perubahan->nip_pa2=$rka_murni->nip_pa1;                
                $rka_perubahan->nip_kpa1=$rka_murni->nip_kpa1;                
                $rka_perubahan->nip_kpa2=$rka_murni->nip_kpa1;                
                $rka_perubahan->nip_ppk1=$rka_murni->nip_ppk1;                
                $rka_perubahan->nip_ppk2=$rka_murni->nip_ppk1;                
                $rka_perubahan->nip_pptk1=$rka_murni->nip_pptk1; 
                $rka_perubahan->nip_pptk2=$rka_murni->nip_pptk1; 
                $rka_perubahan->Descr=$rka_murni->Descr; 
                $rka_perubahan->RKAID_Src=$rka_murni->RKAID; 
                $rka_perubahan->save();
                
                $rka_murni->Locked=true;
                $rka_murni->save();

                return true;
            });
            
            return Response()->json([
                                        'status'=>1,
                                        'pid'=>'update',                                        
                                        'rka'=>$rka_perubahan,                
                                        'message'=>'Salin data kegiatan rka murni berhasil diperoleh'
                                    ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
        }
    }
    public function copytarget (Request $request,$id)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');

        $rka_perubahan = RKAModel::where('EntryLvl',2)
                                    ->find($id);

        if (is_null($rka_perubahan))
        {
            return Response()->json([
                'status'=>0,
                'pid'=>'fetchdata',                
                'message'=>['Fetch data kegiatan gagal diperoleh']
            ],422); 
        }
        else
        {
            $this->validate($request, [            
                'RKAID'=>[
                    'required',
                    Rule::exists('trRKA')->where(function($query){
                        $query->where('EntryLvl',1);
                    }),
                ]
            ]); 

            $RKAID_murni=$request->input('RKAID');
            
            $copy = \DB::transaction(function () use ($request,$rka_perubahan) {
                $RKAID_murni=$request->input('RKAID');

                $rincian_perubahan=\DB::table('trRKARinc')
                                    ->select(\DB::raw('
                                        "trRKARinc"."RKARincID",
                                        master_kode
                                    '))
                                    ->join('simda','trRKARinc.RKARincID','simda.TepraID')
                                    ->where('RKAID',$rka_perubahan->RKAID)
                                    ->get();

                \DB::table('trRKATargetRinc')
                        ->where('RKAID',$rka_perubahan->RKAID)
                        ->delete();

                foreach ($rincian_perubahan as $v)
                {
                    $str_insert = '
                    INSERT INTO "trRKATargetRinc" (
                        "RKATargetRincID", 
                        "RKAID", 
                        "RKARincID", 
                        bulan1,
                        bulan2,
                        target1,
                        target2,
                        fisik1,
                        fisik2,
                        "EntryLvl",
                        "TA",
                        "RKATargetRincID_Src",
                        created_at, 
                        updated_at 
                    ) 
                    SELECT 
                        REPLACE(SUBSTRING(CONCAT(\'uid\',uuid_in(md5(random()::text || clock_timestamp()::text)::cstring)) from 1 for 16),\'-\',\'\') AS "RKATargetRincID",
                        \''.$rka_perubahan->RKAID.'\' AS "RKAID",
                        \''.$v->RKARincID.'\' AS "RKARincID",
                        bulan1,
                        bulan2,
                        target1,
                        target1 AS target2,
                        fisik1,
                        fisik1 AS fisik2,
                        2 AS "EntryLvl",
                        '.$rka_perubahan->TA.' AS "TA", 
                        "trRKATargetRinc"."RKATargetRincID" AS "RKATargetRincID_Src",
                        NOW() AS created_at, 
                        NOW() AS updated_at 
                    FROM 
                        simda 
                    JOIN "trRKATargetRinc" ON "trRKATargetRinc"."RKARincID"=simda."TepraID" 
                    WHERE 
                        master_kode=\''.$v->master_kode.'\' 
                        AND simda."EntryLvl"=1 
                        AND simda."TA"='.$rka_perubahan->TA.'  
                        AND "RKAID"=\''.$RKAID_murni.'\'
                    ';
                    \DB::statement($str_insert);
                }

                \DB::table('trRKATargetRinc')
                    ->where('RKAID',$RKAID_murni)
                    ->where('EntryLvl',1)
                    ->update(['Locked'=>true]);

                return true;
            });
            return Response()->json([
                                        'status'=>1,
                                        'pid'=>'update',                                        
                                        'rka'=>$rka_perubahan,                
                                        'message'=>'Salin data target fisik kegiatan dari rka murni berhasil'
                                    ],200);
        }
    }
    public function copyrealisasi (Request $request,$id)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_UPDATE');

        $rincian_perubahan = RKARincianModel::select(\DB::raw('
                                            "trRKARinc".*,                                            
                                            simda.kode_uraian
                                        '))
                                        ->join('simda','trRKARinc.RKARincID','simda.TepraID')
                                        ->where('trRKARinc.EntryLvl',2)
                                        ->find($id);

        if (is_null($rincian_perubahan))
        {
            return Response()->json([
                'status'=>0,
                'pid'=>'fetchdata',                
                'message'=>['Fetch data rincian kegiatan gagal diperoleh']
            ],422); 
        }
        else
        {
            $this->validate($request, [            
                'RKAID'=>[
                    'required',
                    Rule::exists('trRKA')->where(function($query){
                        $query->where('EntryLvl',1);
                    }),
                ]
            ]); 
            $rincian_perubahan=\DB::transaction(function () use ($request,$rincian_perubahan) {
                $RKAID_murni=$request->input('RKAID');  
                $data=\DB::table('simda')
                        ->select(\DB::raw('
                            "trRKARinc"."RKARincID"
                        '))
                        ->join('trRKARinc','trRKARinc.RKARincID','simda.TepraID')                    
                        ->where('trRKARinc.RKAID',$RKAID_murni)
                        ->where('simda.kode_uraian',$rincian_perubahan->kode_uraian)
                        ->first();
                if (!is_null($data))
                {
                    \DB::table('trRKARealisasiRinc')
                        ->where('RKARincID',$rincian_perubahan->RKARincID)
                        ->delete();

                    $rincian_murni=RKARincianModel::find($data->RKARincID);

                    $rincian_perubahan->JenisPelaksanaanID=$rincian_murni->JenisPelaksanaanID;
                    $rincian_perubahan->SumberDanaID=$rincian_murni->SumberDanaID;
                    $rincian_perubahan->volume1=$rincian_murni->volume1;
                    $rincian_perubahan->volume2=$rincian_murni->volume1;
                    $rincian_perubahan->satuan1=$rincian_murni->satuan1;
                    $rincian_perubahan->satuan2=$rincian_murni->satuan1;
                    $rincian_perubahan->harga_satuan1=$rincian_murni->harga_satuan1;
                    $rincian_perubahan->harga_satuan2=$rincian_murni->harga_satuan1;
                    $rincian_perubahan->idlok=$rincian_murni->idlok;
                    $rincian_perubahan->ket_lok=$rincian_murni->ket_lok;
                    $rincian_perubahan->rw=$rincian_murni->rw;
                    $rincian_perubahan->rt=$rincian_murni->rt;
                    $rincian_perubahan->nama_perusahaan=$rincian_murni->nama_perusahaan;
                    $rincian_perubahan->alamat_perusahaan=$rincian_murni->alamat_perusahaan;
                    $rincian_perubahan->no_telepon=$rincian_murni->no_telepon;
                    $rincian_perubahan->nama_direktur=$rincian_murni->nama_direktur;
                    $rincian_perubahan->npwp=$rincian_murni->npwp;
                    $rincian_perubahan->no_kontrak=$rincian_murni->no_kontrak;
                    $rincian_perubahan->tgl_kontrak=$rincian_murni->tgl_kontrak;
                    $rincian_perubahan->tgl_mulai_pelaksanaan=$rincian_murni->tgl_mulai_pelaksanaan;
                    $rincian_perubahan->tgl_selesai_pelaksanaan=$rincian_murni->tgl_selesai_pelaksanaan;
                    $rincian_perubahan->status_lelang=$rincian_murni->status_lelang;
                    $rincian_perubahan->Descr=$rincian_murni->Descr;
                    $rincian_perubahan->RKARincID_Src=$rincian_murni->RKARincID;
                    $rincian_perubahan->Locked=true;

                    $rincian_perubahan->save();

                    $str_insert = '
                    INSERT INTO "trRKARealisasiRinc" (
                        "RKARealisasiRincID", 
                        "RKAID", 
                        "RKARincID", 
                        bulan1,
                        bulan2,
                        target1,
                        target2,
                        realisasi1,
                        realisasi2,
                        target_fisik1,
                        target_fisik2,
                        fisik1,
                        fisik2,
                        "EntryLvl",
                        "Descr",
                        "TA",
                        "RKARealisasiRincID_Src",                        
                        created_at, 
                        updated_at 
                    ) 
                    SELECT 
                        REPLACE(SUBSTRING(CONCAT(\'uid\',uuid_in(md5(random()::text || clock_timestamp()::text)::cstring)) from 1 for 16),\'-\',\'\') AS "RKARealisasiRincID",
                        \''.$rincian_perubahan->RKAID.'\' AS "RKAID",
                        \''.$rincian_perubahan->RKARincID.'\' AS "RKARincID",
                        bulan1,
                        bulan1 AS bulan2,
                        target1,
                        target1 AS target2,
                        realisasi1,
                        realisasi1 AS realisasi2,
                        target_fisik1,
                        target_fisik1 AS target_fisik2,
                        fisik1,
                        fisik1 AS fisik2,
                        2 AS "EntryLvl",
                        "Descr",
                        '.$rincian_perubahan->TA.' AS "TA", 
                        "trRKARealisasiRinc"."RKARealisasiRincID" AS "RKARealisasiRincID_Src",
                        NOW() AS created_at, 
                        NOW() AS updated_at 
                    FROM 
                        "trRKARealisasiRinc"
                    WHERE                        
                        "RKARincID"=\''.$rincian_murni->RKARincID.'\'
                    ';
                    \DB::statement($str_insert);                    

                    \DB::table('trRKARealisasiRinc')
                        ->where('RKARincID',$rincian_murni->RKARincID)
                        ->update(['Locked'=>true]);

                    $rincian_murni->Locked=true;
                    $rincian_murni->save();
                    
                    $this->recalculate($rincian_perubahan->RKAID);
                }
                return $rincian_perubahan;
            });
            $data=$this->populateDataRealisasi($rincian_perubahan->RKARincID); 

            return Response()->json([
                                        'status'=>1,
                                        'pid'=>'update',    
                                        'rincian_perubahan'=>$rincian_perubahan,                                    
                                        'realisasi'=>$data['datarealisasi'],
                                        'totalanggarankas'=>$data['totalanggarankas'],
                                        'totalrealisasi'=>$data['totalrealisasi'],
                                        'totaltargetfisik'=>$data['totaltargetfisik'],
                                        'totalfisik'=>$data['totalfisik'],
                                        'sisa_anggaran'=>$data['sisa_anggaran'],               
                                        'message'=>'Salin data realisasi rincian kegiatan dari yang murni berhasil'
                                    ],200);
        }
    }
    /**
     * Display the specified resource. [rencanatarget]
     *
     * @return \Illuminate\Http\Response
     */
    public function rencanatarget(Request $request)
    {
        $this->hasPermissionTo('RKA PERUBAHAN_SHOW');

        $this->validate($request, [            
            'mode'=>'required',            
            'RKARincID'=>'required|exists:trRKARinc,RKARincID',            
        ]);
        $mode = $request->input('mode');
        $RKARincID = $request->input('RKARincID');
        
        $data_uraian = SIMDAModel::select(\DB::raw('"TepraID",kode_uraian,nama_uraian,"PaguUraian2"'))
                                    ->find($RKARincID);
        
        $data_realisasi = \DB::table('trRKARealisasiRinc')
                    ->select(\DB::raw('
                        COALESCE(SUM(target2),0) AS jumlah_targetanggarankas,
                        COALESCE(SUM(realisasi2),0) AS jumlah_realisasi,
                        COALESCE(SUM(target_fisik2),0) AS jumlah_targetfisik,
                        COALESCE(SUM(fisik2),0) AS jumlah_fisik
                    '))
                    ->where('RKARincID',$RKARincID)
                    ->get();

        if ($mode == 'targetfisik')
        {
            $data = \DB::table('v_rencana_fisik_anggaran_kas2')
                    ->select(\DB::raw('
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
                    ->where('RKARincID',$RKARincID)
                    ->get();
            $target=isset($data[0])?$data[0]:[];
        }
        else if ($mode == 'targetanggarankas')
        {
            $data = \DB::table('v_rencana_fisik_anggaran_kas2')
                    ->select(\DB::raw('
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
                    ->where('RKARincID',$RKARincID)
                    ->get();
            $target=isset($data[0])?$data[0]:[];
        }
        else if ($mode == 'bulan' && $request->has('bulan2'))
        {
            $bulan2 = $request->input('bulan2');
            
            $data = \DB::table('v_rencana_fisik_anggaran_kas2')
                    ->select(\DB::raw("
                        fisik_$bulan2 AS fisik,                        
                        anggaran_$bulan2 AS anggaran                       
                    "))
                    ->where('RKARincID',$RKARincID)
                    ->get();
            $target=isset($data[0])?$data[0]:['fisik'=>0,'anggaran'=>0];
        }
        
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'mode'=>$mode,
                                'datauraian'=>$data_uraian,
                                'target'=>$target,
                                'datarealisasi'=>$data_realisasi[0],
                                'message'=>"Fetch data target $mode berhasil diperoleh"
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  

    }
    /**
     * Display the specified resource. [daftar realisasi]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function realisasi(Request $request)
    {  
        $this->hasPermissionTo('RKA PERUBAHAN_SHOW');

        $this->validate($request, [            
            'RKARincID'=>'required|exists:trRKARinc,RKARincID',            
        ]);
        
        $RKARincID=$request->input('RKARincID');
        $data=$this->populateDataRealisasi($RKARincID); 

        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'realisasi'=>$data['datarealisasi'],
                                'totalanggarankas'=>$data['totalanggarankas'],
                                'totalrealisasi'=>$data['totalrealisasi'],
                                'totaltargetfisik'=>$data['totaltargetfisik'],
                                'totalfisik'=>$data['totalfisik'],
                                'sisa_anggaran'=>$data['sisa_anggaran'],
                                'message'=>"Fetch data realisasi berhasil diperoleh"
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    { 
        $this->hasPermissionTo('RKA PERUBAHAN_DESTROY');

        $pid=$request->input('pid');
        switch ($pid)
        {            
            case 'datarka' :
                $rka = RKAModel::find($id);
                $rka->delete();
                $message="data rka perubahan dengan ID ($id) Berhasil di Hapus";                 
            break;
            case 'datarealisasi' :
                $realisasi = RKARealisasiModel::find($id);
                $RKAID=$realisasi->RKAID;
                $result=$realisasi->delete();
                $message="data realisasi uraian kegiatan dengan ID ($id) Berhasil di Hapus";      
                
                $this->recalculate($RKAID);
            break;
        }            
        
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>$message
                                ],200);  
              
    }
}