<?php
namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;
use App\Models\RKA\RKAKegiatanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportModel extends Model
{   
    /**
    * data report
    */
    protected $dataReport = [];
   /**
    * object spreadsheet
    */
    protected $spreadsheet;
    /**
     * digunakan untuk menyimpan data satu skegiatan
     */
    protected $dataKegiatan = [];
    /**
     * digunakan untuk menyimpan data RKA atau uraian
     */
    protected $dataRKA = [];

    public function __construct($dataReport)
    {
        $this->dataReport = $dataReport;
        $this->spreadsheet = new Spreadsheet();         
    }
   /**
     * digunakan untuk mengeset data report dan inisialisasi object spreadsheet
     */
    public function setObjReport($dataReport)
    {   
        $this->dataReport = $dataReport;
        $this->spreadsheet = new Spreadsheet();         
    }
    public function download(string $filename)
    {
        $pathToFile = config('simonev.local_path').DIRECTORY_SEPARATOR.$filename;
        $this->spreadsheet->getProperties()->setCreator(config('simonev.nama_institusi'));
        $this->spreadsheet->getProperties()->setLastModifiedBy(config('simonev.nama_institusi'));         
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($pathToFile);        
        return response()->download($pathToFile)->deleteFileAfterSend(true);
    }
    /**
	* digunakan untuk mendapatkan data RKA
	*/
    public function getDataRKA ($id,$no_bulan,$entryLvl)
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
                                            "A"."NIP_ASN" AS nip_pa,
                                            "A"."Nm_ASN" AS nama_pa,
                                            "B"."NIP_ASN" AS nip_pptk,
                                            "B"."Nm_ASN" AS nama_pptk,
                                            "v_rka"."created_at",
                                            "v_rka"."updated_at"
                                            '))
                            ->join('v_rka','v_rka.RKAID','trRKA.RKAID')     
                            ->leftJoin('tmASN AS A','A.ASNID','v_rka.nip_pa1')     
                            ->leftJoin('tmASN AS B','B.ASNID','v_rka.nip_pptk1')     
                            ->where('trRKA.EntryLvl',$entryLvl)
                            ->find($id);
        
        $dataAkhir=[];
        if (!is_null($rka))
        {
            $this->dataKegiatan=$rka->toArray();        
            $totalPaguUraian = (float)\DB::table('trRKARinc')->where('RKAID',$rka->RKAID)->sum('pagu_uraian1');
            $this->dataKegiatan['total_pagu_uraian']=$totalPaguUraian;
            $data_akhir = \DB::table('trRKARinc')
                            ->select(\DB::raw('"trRKARinc"."RKARincID",
                                    "trRKARinc"."RKAID",
                                    v_rekening."Kd_Rek_1",
                                    v_rekening."StrNm",
                                    v_rekening."kode_rek_2",
                                    v_rekening."KlpNm",
                                    v_rekening."kode_rek_3",
                                    v_rekening."JnsNm",
                                    v_rekening."kode_rek_4",
                                    v_rekening."ObyNm",
                                    v_rekening."kode_rek_5",
                                    v_rekening."RObyNm",
                                    "trRKARinc"."nama_uraian",
                                    "trRKARinc"."pagu_uraian1",
                                    "trRKARinc"."volume1",
                                    "trRKARinc"."satuan1",
                                    "trRKARinc"."harga_satuan1",
                                    "trRKARinc"."pagu_uraian1"
                            '))
                            ->where('RKAID',$rka->RKAID)
                            ->join('v_rekening','v_rekening.RObyID','trRKARinc.RObyID')
                            ->get();   
            	
            foreach ($data_akhir as $k=>$v)
            {
                $RKARincID=$v->RKARincID;                      
                $nama_uraian=$v->nama_uraian;
                $target=(float)\DB::table('trRKATargetRinc')
                                    ->where('RKARincID',$RKARincID)
                                    ->where('bulan1','<=',$no_bulan)
                                    ->sum('target1');                                
                $data_realisasi=\DB::table('trRKARealisasiRinc')
                                    ->select(\DB::raw('COALESCE(SUM(realisasi1),0) AS realisasi1, COALESCE(SUM(fisik1),0) AS fisik1'))
                                    ->where('RKARincID',$RKARincID)
                                    ->where('bulan1','<=',$no_bulan)
                                    ->get();

                $realisasi=(float)$data_realisasi[0]->realisasi1;
                $fisik=(float)$data_realisasi[0]->fisik1;            
                $persen_fisik=number_format((($fisik > 100) ? 100:$fisik),2);
                $no_rek5=$v->kode_rek_5;            
                if (array_key_exists ($no_rek5,$dataAkhir)) 
                {
                    $persenbobot=\Helper::formatPersen($v->pagu_uraian1,$totalPaguUraian); 
                    $persen_target=\Helper::formatPersen($target,$totalPaguUraian);   
                    $persen_realisasi=\Helper::formatPersen($realisasi,$totalPaguUraian);
                    $persen_tertimbang_realisasi=number_format(($persen_realisasi*$persenbobot)/100,2);   
                    $persen_tertimbang_fisik=number_format(($persen_fisik*$persenbobot)/100,2);
                    $dataAkhir[$no_rek5]['child'][]=[
                                            'RKARincID'=>$v->RKARincID,
                                            'Kd_Rek_1'=>$v->Kd_Rek_1,
                                            'StrNm'=>$v->StrNm,
                                            'kode_rek_2'=>$v->kode_rek_2,
                                            'KlpNm'=>$v->KlpNm,
                                            'kode_rek_3'=>$v->kode_rek_3,
                                            'JnsNm'=>$v->JnsNm,
                                            'kode_rek_4'=>$v->kode_rek_4,
                                            'ObyNm'=>$v->ObyNm,
                                            'kode_rek_5'=>$v->kode_rek_5,
                                            'RObyNm'=>$v->RObyNm,
                                            'nama_uraian'=>$nama_uraian,                                        
                                            'pagu_uraian'=>$v->pagu_uraian1,
                                            'persen_bobot'=>$persenbobot,
                                            'target'=>$target,
                                            'persen_target'=>$persen_target,
                                            'realisasi'=>$realisasi,
                                            'persen_realisasi'=>$persen_realisasi,
                                            'persen_tertimbang_realisasi'=>$persen_tertimbang_realisasi,
                                            'fisik'=>$fisik,
                                            'persen_fisik'=>$persen_fisik,
                                            'persen_tertimbang_fisik'=>$persen_tertimbang_fisik,
                                            'volume'=>$v->volume1,
                                            'harga_satuan'=>(float)$v->harga_satuan1,
                                            'satuan'=>$v->satuan1
                                        ];
                }
                else
                {
                    $persenbobot=\Helper::formatPersen($v->pagu_uraian1,$totalPaguUraian); 
                    $persen_target=\Helper::formatPersen($target,$totalPaguUraian);   
                    $persen_realisasi=\Helper::formatPersen($realisasi,$totalPaguUraian);
                    $persen_tertimbang_realisasi=number_format(($persen_realisasi*$persenbobot)/100,2);   
                    $persen_tertimbang_fisik=number_format(($persen_fisik*$persenbobot)/100,2);
                    $dataAkhir[$no_rek5]=[
                                            'RKARincID'=>$v->RKARincID,
                                            'Kd_Rek_1'=>$v->Kd_Rek_1,
                                            'StrNm'=>$v->StrNm,
                                            'kode_rek_2'=>$v->kode_rek_2,
                                            'KlpNm'=>$v->KlpNm,
                                            'kode_rek_3'=>$v->kode_rek_3,
                                            'JnsNm'=>$v->JnsNm,
                                            'kode_rek_4'=>$v->kode_rek_4,
                                            'ObyNm'=>$v->ObyNm,
                                            'kode_rek_5'=>$v->kode_rek_5,
                                            'RObyNm'=>$v->RObyNm,
                                            'nama_uraian'=>$nama_uraian,                                        
                                            'pagu_uraian'=>$v->pagu_uraian1,
                                            'persen_bobot'=>$persenbobot,
                                            'target'=>$target,
                                            'persen_target'=>$persen_target,
                                            'realisasi'=>$realisasi,
                                            'persen_realisasi'=>$persen_realisasi,
                                            'persen_tertimbang_realisasi'=>$persen_tertimbang_realisasi,
                                            'fisik'=>$fisik,
                                            'persen_fisik'=>$persen_fisik,
                                            'persen_tertimbang_fisik'=>$persen_tertimbang_fisik,
                                            'volume'=>$v->volume1,
                                            'harga_satuan'=>(float)$v->harga_satuan1,
                                            'satuan'=>$v->satuan1
                                        ];
                }

            }       	
        }
        $this->dataRKA=$dataAkhir;
        return $dataAkhir;
    }   
    /**
	* digunakan untuk mendapatkan tingkat rekening Form A	
	*/
	public function getRekeningProyek () {		 
		$a=$this->dataRKA;
        $tingkat=[];
		foreach ($a as $v) {					
			$tingkat[1][$v['Kd_Rek_1']]=$v['StrNm'];
			$tingkat[2][$v['kode_rek_2']]=$v['KlpNm'];
			$tingkat[3][$v['kode_rek_3']]=$v['JnsNm'];
			$tingkat[4][$v['kode_rek_4']]=$v['ObyNm'];
			$tingkat[5][$v['kode_rek_5']]=$v['RObyNm'];				
		}
		return $tingkat;
    }
    /**
	* digunakan untuk menghitung jumlah setiap level rekening Form A 
	*/
    public static function calculateEachLevel ($dataproyek,$k,$no_rek) {        
        $totalpagu=0;
        $totaltarget=0;
        $totalrealisasi=0;        
        $totalfisik=0;
        $totalpersenbobot='0.00';
        $totalpersentarget=0;
        $totalpersenrealisasi=0;
        $totalpersentertimbangrealisasi=0;
        $totalpersentertimbangfisik=0;
        $totalbaris=0;        
        foreach ($dataproyek as $de) {                        
            if ($k==$de[$no_rek]) {                                               
                $totalpagu+=$de['pagu_uraian'];
                $totaltarget+=$de['target'];
                $totalrealisasi+=$de['realisasi'];
                $totalfisik+=$de['persen_fisik'];
                $totalpersenbobot+=$de['persen_bobot'];
                $totalpersentarget+=$de['persen_target'];
                $totalpersenrealisasi+=$de['persen_realisasi'];
                $totalpersentertimbangrealisasi+=$de['persen_tertimbang_realisasi'];
                $totalpersentertimbangfisik+=$de['persen_tertimbang_fisik'];
                $totalbaris+=1;
                if (isset($dataproyek[$de['kode_rek_5']]['child'][0])) {                    
                    $child=$dataproyek[$de['kode_rek_5']]['child'];                    
                    foreach ($child as $n) {                       
                        $totalbaris+=1;
                        $totalpagu+=$n['pagu_uraian'];
                        $totaltarget+=$n['target'];
                        $totalrealisasi+=$n['realisasi'];
                        $totalfisik+=$n['persen_fisik'];
                        $totalpersenbobot+=$n['persen_bobot'];                                                        
                        $totalpersentertimbangfisik+=$n['persen_tertimbang_fisik'];
                    }
                }
            }
        }         
        $totalpersentarget=\Helper::formatPersen($totaltarget,$totalpagu);                
        $totalpersenrealisasi=\Helper::formatPersen($totalrealisasi,$totalpagu);            
        $totalpersentertimbangrealisasi=number_format(($totalpersenrealisasi*$totalpersenbobot)/100,2);
        $result=['totalpagu'=>$totalpagu,
                'totaltarget'=>$totaltarget,
                'totalrealisasi'=>$totalrealisasi,
                'totalfisik'=>$totalfisik,
                'totalpersenbobot'=>$totalpersenbobot,
                'totalpersentarget'=>$totalpersentarget,
                'totalpersenrealisasi'=>$totalpersenrealisasi,
                'totalpersentertimbangrealisasi'=>$totalpersentertimbangrealisasi,
                'totalpersentertimbangfisik'=>$totalpersentertimbangfisik,
                'totalbaris'=>$totalbaris];        
        return $result;
    }
}