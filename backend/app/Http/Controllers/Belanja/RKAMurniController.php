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

class RKAMurniController extends Controller 
{
    private function recalculate($RKAID)
    {
        $jumlah_uraian = \DB::table('trRKARinc')                            
                            ->where('RKAID',$RKAID)
                            ->count('RKARincID');

        $data_realisasi = \DB::table('trRKARealisasiRinc')
                            ->select(\DB::raw('
                                COALESCE(SUM(realisasi1),0) AS jumlah_realisasi,
                                COALESCE(SUM(fisik1),0) AS jumlah_fisik
                            '))
                            ->where('RKAID',$RKAID)
                            ->get();
        
        $rka = RKAModel::find($RKAID);
        $rka->RealisasiKeuangan1=$data_realisasi[0]->jumlah_realisasi;
        $rka->RealisasiFisik1=Helper::formatPecahan($data_realisasi[0]->jumlah_fisik,$jumlah_uraian);
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
                                            "trRKA"."lokasi_kegiatan1",
                                            "trRKA"."SumberDanaID",
                                            "tmSumberDana"."Nm_SumberDana",
                                            "trRKA"."tk_capaian1",
                                            "trRKA"."capaian_program1",
                                            "trRKA"."masukan1",
                                            "trRKA"."tk_keluaran1",
                                            "trRKA"."keluaran1",
                                            "trRKA"."tk_hasil1",
                                            "trRKA"."hasil1",
                                            "trRKA"."ksk1",
                                            "trRKA"."sifat_kegiatan1",
                                            "trRKA"."waktu_pelaksanaan1",
                                            "trRKA"."PaguDana1",
                                            "trRKA"."Descr",
                                            "trRKA"."EntryLvl",
                                            "trRKA"."Locked",
                                            "trRKA"."created_at",
                                            "trRKA"."updated_at"
                                            '))
                            ->leftJoin('tmSumberDana','tmSumberDana.SumberDanaID','trRKA.SumberDanaID')
                            ->where('trRKA.EntryLvl',1)
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
                            ->select(\DB::raw('
                                                "RKARealisasiRincID",
                                                "bulan1",
                                                "target1",
                                                "realisasi1",
                                                target_fisik1,
                                                fisik1,
                                                "TA",
                                                "Descr",
                                                "created_at",
                                                "updated_at"
                                            '))
                            ->where('RKARincID',$RKARincID)
                            ->orderBy('bulan1','ASC')
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
                                ->where('bulan1','<=',$item->bulan1)
                                ->sum('realisasi1');

                $sisa_anggaran=$datauraian->PaguUraian1-$sum_realisasi;            
                $daftar_realisasi[]=[
                    'RKARealisasiRincID'=>$item->RKARealisasiRincID,
                    'bulan1'=>$item->bulan1,
                    'NamaBulan'=>Helper::getNamaBulan($item->bulan1),
                    'target1'=>$item->target1,
                    'realisasi1'=>$item->realisasi1,
                    'target_fisik1'=>$item->target_fisik1,
                    'fisik1'=>$item->fisik1,
                    'sisa_anggaran'=>$sisa_anggaran,
                    'Descr'=>$item->Descr,
                    'TA'=>$item->TA,
                    'created_at'=>$item->created_at,
                    'updated_at'=>$item->updated_at,
                ];
                
                $totalanggarankas+=$item->target1;
                $totalrealisasi+=$item->realisasi1;
                $totaltargetfisik+=$item->target_fisik1;
                $totalfisik+=$item->fisik1;
            }
            
            $data['datarealisasi']=$daftar_realisasi;
            $data['totalanggarankas']=$totalanggarankas;
            $data['totalrealisasi']=$totalrealisasi;
            $data['totaltargetfisik']=round($totaltargetfisik,2);
            $data['totalfisik']=round($totalfisik,2);
            $data['sisa_anggaran']=$datauraian->PaguUraian1-$totalrealisasi;
            
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
                0 AS "RealisasiKeuangan1",
                0 AS "RealisasiKeuangan2",
                '.$this->getUserid().' AS "user_id",
                1 AS "EntryLvl",
                '.$tahun.' AS "TA",
                false AS "Locked",
                NOW() AS created_at,
                NOW() AS updated_at
            FROM simda WHERE kode_suborganisasi=\''.$unitkerja->kode_suborganisasi.'\' AND 
                            "TA"='.$tahun.' AND 
                            "EntryLvl"=1
        ) AS temp
        ';
        \DB::statement($str_insert); 
        
        $data = RKAModel::where('kode_suborganisasi',$unitkerja->kode_suborganisasi)
                            ->where('TA',$tahun)
                            ->where('EntryLvl',1)
                            ->get();
                            
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'unitkerja'=>$unitkerja,
                                'rka'=>$data,
                                'message'=>'Fetch data rka murni berhasil diperoleh'
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
                1 AS "EntryLvl",
                '.$rka->TA.' AS "TA",
                NOW () AS created_at,
                NOW () AS updated_at
            FROM simda A
            LEFT JOIN "trRKARinc" B ON B."RKARincID"=A."TepraID"
                WHERE kode_kegiatan=\''.$rka->kode_kegiatan.'\' AND 
                kode_suborganisasi=\''.$rka->kode_suborganisasi.'\' AND 
                A."EntryLvl"=1 AND 
                A."TA"='.$rka->TA.' AND 
                "RKARincID" IS NULL
        ';
        \DB::statement($str_insert); 
        
        $data = RKARincianModel::select(\DB::raw('
                                    "trRKARinc"."RKARincID",
                                    simda.kode_uraian,
                                    simda.nama_uraian,
                                    CONCAT("trRKARinc".volume1,\' \',"trRKARinc".satuan1) AS volume,
                                    "trRKARinc"."volume1",
                                    "trRKARinc"."satuan1",
                                    "trRKARinc"."harga_satuan1",
                                    "simda"."PaguUraian1",
                                    0 AS "realisasi1",
                                    0 AS "fisik1",
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
                                'message'=>'Fetch data uraian rka murni berhasil diperoleh'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK);  
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {             
        $this->hasPermissionTo('RKA MURNI_BROWSE');
        
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
                            keluaran1,
                            tk_keluaran1,                            
                            hasil1,                            
                            tk_hasil1,                            
                            capaian_program1,                            
                            tk_capaian1,                            
                            masukan1,                            
                            ksk1,                            
                            sifat_kegiatan1,                            
                            waktu_pelaksanaan1,                            
                            lokasi_kegiatan1,                            
                            "PaguDana1",                            
                            "RealisasiKeuangan1",                            
                            "RealisasiFisik1",   
                            0 AS persen_keuangan1,
                            nip_pa1,                            
                            nip_kpa1,
                            nip_ppk1,
                            nip_pptk1,
                            "Descr",
                            "TA",
                            "Locked",
                            created_at,
                            updated_at
                        '))
                        ->where('kode_suborganisasi',$unitkerja->kode_suborganisasi)
                        ->where('TA',$tahun)
                        ->where('EntryLvl',1)
                        ->orderBy('kode_kegiatan','ASC')
                        ->get();        
                    
                        $data->transform(function ($item,$key){                            
                            $item->persen_keuangan1=Helper::formatPersen($item->RealisasiKeuangan1,$item->PaguDana1);
                            return $item;
                        });
        $unitkerja->RealisasiKeuangan1=$data->sum('RealisasiKeuangan1');
        $jumlah_realisasi_fisik=$data->sum('RealisasiFisik1');
        $unitkerja->RealisasiFisik1=Helper::formatPecahan($jumlah_realisasi_fisik,$unitkerja->JumlahKegiatan1);
        $unitkerja->save();

        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'unitkerja'=>$unitkerja,
                                'rka'=>$data,
                                'message'=>'Fetch data rka murni berhasil diperoleh'
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
        $this->hasPermissionTo('RKA MURNI_UPDATE');

        $kegiatan = RKAModel::find($id);
        
        if (is_null($kegiatan) )
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'fetchdata',                
                                    'message'=>["Kegiatan dengan dengan ($id) gagal diperoleh"]
                                ],422); 
        }
        else if ($kegiatan->Locked)
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'fetchdata',                
                                    'message'=>["Kegiatan dengan dengan ($id) tidak bisa diubah karena sudah dikunci, saat copy data ke Perubahan."]
                                ],422); 
        }
        else
        {
            $this->validate($request, [
                    'SumberDanaID'=>'required',                
                    'keluaran1'=>'required',                
                    'tk_keluaran1'=>'required',                
                    'hasil1'=>'required',                
                    'tk_hasil1'=>'required',                
                    'capaian_program1'=>'required',                
                    'tk_capaian1'=>'required',                
                    'masukan1'=>'required',                
                    'ksk1'=>'required',                
                    'sifat_kegiatan1'=>'required',                
                    'waktu_pelaksanaan1'=>'required',                
                    'lokasi_kegiatan1'=>'required',                                
                    'nip_pa1'=>'required',                
                    'nip_kpa1'=>'required',                
                    'nip_ppk1'=>'required',                
                    'nip_pptk1'=>'required', 
            ]);
            
            $kegiatan->SumberDanaID=$request->input('SumberDanaID');                
            $kegiatan->keluaran1=$request->input('keluaran1');                
            $kegiatan->tk_keluaran1=$request->input('tk_keluaran1');                
            $kegiatan->hasil1=$request->input('hasil1');                
            $kegiatan->tk_hasil1=$request->input('tk_hasil1');                
            $kegiatan->capaian_program1=$request->input('capaian_program1');                
            $kegiatan->tk_capaian1=$request->input('tk_capaian1');                
            $kegiatan->masukan1=$request->input('masukan1');                
            $kegiatan->ksk1=$request->input('ksk1');                
            $kegiatan->sifat_kegiatan1=$request->input('sifat_kegiatan1');                
            $kegiatan->waktu_pelaksanaan1=$request->input('waktu_pelaksanaan1');                
            $kegiatan->lokasi_kegiatan1=$request->input('lokasi_kegiatan1');                                
            $kegiatan->nip_pa1=$request->input('nip_pa1');                
            $kegiatan->nip_kpa1=$request->input('nip_kpa1');                
            $kegiatan->nip_ppk1=$request->input('nip_ppk1');                
            $kegiatan->nip_pptk1=$request->input('nip_pptk1'); 
            $kegiatan->Descr=$request->input('Descr'); 
            $kegiatan->save();

            
            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'message'=>'Update RKA berhasil disimpan.'
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
    public function updateuraian(Request $request,$id)
    {
        $this->hasPermissionTo('RKA MURNI_UPDATE');

        $rinciankegiatan = RKARincianModel::find($id);
        if (is_null($rinciankegiatan) )
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'fetchdata',                
                                    'message'=>["Rincian Kegiatan dengan dengan ($id) gagal diperoleh"]
                                ],422); 
        }
        else if ($rinciankegiatan->Locked)
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'fetchdata',                
                                    'message'=>["Rincian Kegiatan dengan dengan ($id) tidak bisa diubah karena sudah dikunci, saat copy data ke Perubahan."]
                                ],422); 
        }
        else
        {
            $this->validate($request, [
                'volume1'=>'required',
                'satuan1'=>'required',
                'harga_satuan1'=>'required',
            ]);

            $rinciankegiatan->volume1=$request->input('volume1');
            $rinciankegiatan->satuan1=$request->input('satuan1');
            $rinciankegiatan->harga_satuan1=$request->input('harga_satuan1');
            $rinciankegiatan->JenisPelaksanaanID = $request->input('JenisPelaksanaanID');                   
            $rinciankegiatan->save();

            
            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'message'=>'Update uraian berhasil disimpan.'
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
    public function updatedetailuraian(Request $request,$id)
    {
        $this->hasPermissionTo('RKA MURNI_UPDATE');

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
                            ],200); 
    }
    /**
     * Show the form for creating a new resource. [menambah realisasi uraian]
     *
     * @return \Illuminate\Http\Response
     */
    public function bulanrealisasi(Request $request,$id)
    { 
        $this->hasPermissionTo('RKA MURNI_BROWSE');

        $bulan=Helper::getNamaBulan();
        $bulan_realisasi=RKARealisasiModel::select('bulan1')
                                                    ->where('RKARincID',$id)
                                                    ->get()
                                                    ->pluck('bulan1','bulan1')
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
        $this->hasPermissionTo('RKA MURNI_STORE');

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
                'fisik1'=>$bulan_fisik[$i],
                'fisik2'=>0,
                'EntryLvl'=>1,
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
                                ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
        
            
    }   
    /**
     * Store a newly created resource in storage. [simpan rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatetargetfisik(Request $request)
    {                
        $this->hasPermissionTo('RKA MURNI_UPDATE');

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
                ->where('bulan1',$i+1)
                ->update(['fisik1'=>$bulan_fisik[$i]]);
        }
        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'message'=>'Rencana target fisik uraian berhasil diubah.'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
        
            
    }  
    /**
     * Store a newly created resource in storage. [simpan rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savetargetanggarankas(Request $request)
    {                
        $this->hasPermissionTo('RKA MURNI_STORE');

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
                'target1'=>$bulan_anggaran[$i],
                'target2'=>0,
                'EntryLvl'=>1,
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
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
        
            
    } 
    /**
     * Store a newly created resource in storage. [simpan rencana target fisik dan anggaran kas]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatetargetanggarankas(Request $request)
    {                
        $this->hasPermissionTo('RKA MURNI_UPDATE');

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
                ->where('bulan1',$i+1)
                ->update(['target1'=>$bulan_anggaran[$i]]);
        }

        return Response()->json([
                                'status'=>1,
                                'pid'=>'update',
                                'message'=>'Rencana target anggaran kas uraian berhasil diubah.'
                            ],200)->setEncodingOptions(JSON_NUMERIC_CHECK); 
        
            
    }      
    /**
     * Store a newly created resource in storage. [simpan realisasi rincian kegiatan]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saverealisasi(Request $request)
    {
        $this->hasPermissionTo('RKA MURNI_STORE');

        $this->validate($request, [
            'RKARincID'=>'required',
            'RKAID'=>'required',
            'bulan1'=>'required',            
            'target1'=>'required',
            'realisasi1'=>'required',
            'target_fisik1'=>'required',
            'fisik1'=>'required',      
        ]);
        $RKAID=$request->input('RKAID');
        $realisasi = RKARealisasiModel::create([
            'RKARealisasiRincID' => uniqid ('uid'),
            'RKAID' => $RKAID,
            'RKARincID' => $request->input('RKARincID'),            
            'bulan1' => $request->input('bulan1'),
            'bulan2' => 0,
            'target1' => $request->input('target1'),            
            'target2' => 0,            
            'realisasi1' => $request->input('realisasi1'),            
            'realisasi2' => 0,            
            'target_fisik1' => $request->input('target_fisik1'),           
            'target_fisik2' => 0,           
            'fisik1' => $request->input('fisik1'),           
            'fisik2' => 0,           
            'EntryLvl' => 1,
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
        $this->hasPermissionTo('RKA MURNI_UPDATE');
        
        $this->validate($request, [                    
            'target1'=>'required',
            'realisasi1'=>'required',
            'target_fisik1'=>'required',
            'fisik1'=>'required',      
        ]);

        $realisasi = RKARealisasiModel::find($id);    
        $realisasi->target1 = $request->input('target1');
        $realisasi->realisasi1 = $request->input('realisasi1');
        $realisasi->target_fisik1 = $request->input('target_fisik1');
        $realisasi->fisik1 = $request->input('fisik1');        
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
        $this->hasPermissionTo('RKA MURNI_SHOW');

        $rka = $this->getDataRKA($id);

        if (is_null($rka))
        {
            return Response()->json([
                'status'=>1,
                'pid'=>'fetchdata',                
                'message'=>"Fetch data kegiatan murni dengan id ($id) gagal diperoleh"
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
                                    "trRKARinc"."volume1",
                                    "trRKARinc"."satuan1",
                                    CONCAT("trRKARinc".volume1,\' \',"trRKARinc".satuan1) AS volume,
                                    "trRKARinc"."harga_satuan1",
                                    "simda"."PaguUraian1",
                                    0 AS "realisasi1",
                                    0 AS "persen_keuangan1",
                                    0 AS "fisik1",                                                                        
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
                                    "trRKARinc".created_at,
                                    "trRKARinc".updated_at
                                '))
                                ->join('simda','simda.TepraID','trRKARinc.RKARincID')
                                ->where('RKAID',$rka->RKAID)
                                ->orderBy('simda.kode_uraian','ASC')
                                ->get();
            
            $data->transform(function ($item,$key){
                $item->realisasi1=\DB::table('trRKARealisasiRinc')->where('RKARincID',$item->RKARincID)->sum('realisasi1');    
                $item->fisik1=\DB::table('trRKARealisasiRinc')->where('RKARincID',$item->RKARincID)->sum('fisik1');
                $item->persen_keuangan1=Helper::formatPersen($item->realisasi1,$item->PaguUraian1);
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
    /**
     * Display the specified resource. [rencanatarget]
     *
     * @return \Illuminate\Http\Response
     */
    public function rencanatarget(Request $request)
    {
        $this->hasPermissionTo('RKA MURNI_SHOW');

        $this->validate($request, [            
            'mode'=>'required',            
            'RKARincID'=>'required|exists:trRKARinc,RKARincID',            
        ]);
        $mode = $request->input('mode');
        $RKARincID = $request->input('RKARincID');
        
        $data_uraian = SIMDAModel::select(\DB::raw('"TepraID",kode_uraian,nama_uraian,"PaguUraian1"'))
                                    ->find($RKARincID);
        
        $data_realisasi = \DB::table('trRKARealisasiRinc')
                    ->select(\DB::raw('
                        COALESCE(SUM(target1),0) AS jumlah_targetanggarankas,
                        COALESCE(SUM(realisasi1),0) AS jumlah_realisasi,
                        COALESCE(SUM(target_fisik1),0) AS jumlah_targetfisik,
                        COALESCE(SUM(fisik1),0) AS jumlah_fisik
                    '))
                    ->where('RKARincID',$RKARincID)
                    ->get();

        if ($mode == 'targetfisik')
        {
            $data = \DB::table('v_rencana_fisik_anggaran_kas')
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
            $data = \DB::table('v_rencana_fisik_anggaran_kas')
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
        else if ($mode == 'bulan' && $request->has('bulan1'))
        {
            $bulan1 = $request->input('bulan1');
            
            $data = \DB::table('v_rencana_fisik_anggaran_kas')
                    ->select(\DB::raw("
                        fisik_$bulan1 AS fisik,                        
                        anggaran_$bulan1 AS anggaran                       
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
        $this->hasPermissionTo('RKA MURNI_SHOW');

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
        $this->hasPermissionTo('RKA MURNI_DESTROY');

        $pid=$request->input('pid');
        switch ($pid)
        {          
            case 'datarka' :
                $rka = RKAModel::find($id);
                $rka->delete();
                $message="data rka murni dengan ID ($id) Berhasil di Hapus";                 
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