<?php
namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Helpers\Helper;

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
        $pathToFile = Helper::exported_path().$filename;
        $this->spreadsheet->getProperties()->setCreator(config('simonev.nama_institusi'));
        $this->spreadsheet->getProperties()->setLastModifiedBy(config('simonev.nama_institusi'));         
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($pathToFile);        
        return response()->download($pathToFile)->deleteFileAfterSend(false);
    }    
    /**
	* digunakan untuk mendapatkan data RKA
	*/
    public function getDataRKA ($id,$no_bulan,$entryLvl)
    {      
        $dataAkhir=[];
        switch ($entryLvl)
        {
            case 1 :
                $sql = \DB::raw('"trRKA"."RKAID",
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
                                "C"."Nm_SumberDana",
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
                                "A"."NIP_ASN" AS nip_pa,
                                "A"."Nm_ASN" AS nama_pa,
                                "B"."NIP_ASN" AS nip_pptk,
                                "B"."Nm_ASN" AS nama_pptk,
                                "trRKA"."created_at",
                                "trRKA"."updated_at"
                            ');

                $rka = \App\Models\Belanja\RKAModel::select($sql)                              
                            ->leftJoin('tmASN AS A','A.ASNID','trRKA.nip_pa1')     
                            ->leftJoin('tmASN AS B','B.ASNID','trRKA.nip_pptk1')     
                            ->leftJoin('tmSumberDana AS C','C.SumberDanaID','trRKA.SumberDanaID')                                 
                            ->where('trRKA.EntryLvl',$entryLvl)
                            ->find($id);

                if (!is_null($rka))
                {
                    $this->dataKegiatan=$rka->toArray();        
                    $totalPaguUraian = $rka->PaguDana1;
                    $this->dataKegiatan['total_pagu_uraian']=$totalPaguUraian;
                    $data_akhir = \DB::table('trRKARinc')
                                    ->select(\DB::raw('"trRKARinc"."RKARincID",
                                            "trRKARinc"."RKAID",
                                            simda."Kd_Rek1",
                                            simda."Nm_Rek1",
                                            CONCAT(simda."Kd_Rek1",\'.\',simda."Kd_Rek2") AS "Kd_Rek2",
                                            simda."Nm_Rek2",
                                            CONCAT(simda."Kd_Rek1",\'.\',simda."Kd_Rek2",\'.\',simda."Kd_Rek3") AS "Kd_Rek3",
                                            simda."Nm_Rek3",
                                            CONCAT(simda."Kd_Rek1",\'.\',simda."Kd_Rek2",\'.\',simda."Kd_Rek3",\'.\',simda."Kd_Rek4") AS "Kd_Rek4",
                                            simda."Nm_Rek4",
                                            CONCAT(simda."Kd_Rek1",\'.\',simda."Kd_Rek2",\'.\',simda."Kd_Rek3",\'.\',simda."Kd_Rek4",\'.\',simda."Kd_Rek5") AS "Kd_Rek5",
                                            simda."Nm_Rek5",
                                            simda."nama_uraian",
                                            simda."PaguUraian1",
                                            "trRKARinc"."volume1",
                                            "trRKARinc"."satuan1",
                                            "trRKARinc"."harga_satuan1"                                    
                                    '))
                                    ->where('RKAID',$rka->RKAID)
                                    ->join('simda','simda.TepraID','trRKARinc.RKARincID')
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
                        $no_rek5=$v->Kd_Rek5;            
                        if (array_key_exists ($no_rek5,$dataAkhir)) 
                        {
                            $persenbobot=Helper::formatPersen($v->PaguUraian1,$totalPaguUraian); 
                            $persen_target=Helper::formatPersen($target,$totalPaguUraian);   
                            $persen_realisasi=Helper::formatPersen($realisasi,$totalPaguUraian);
                            $persen_tertimbang_realisasi=number_format(($persen_realisasi*$persenbobot)/100,2);   
                            $persen_tertimbang_fisik=number_format(($persen_fisik*$persenbobot)/100,2);
                            $dataAkhir[$no_rek5]['child'][]=[
                                                    'RKARincID'=>$v->RKARincID,
                                                    'Kd_Rek1'=>$v->Kd_Rek1,
                                                    'Nm_Rek1'=>$v->Nm_Rek1,
                                                    'Kd_Rek2'=>$v->Kd_Rek2,
                                                    'Nm_Rek2'=>$v->Nm_Rek2,
                                                    'Kd_Rek3'=>$v->Kd_Rek3,
                                                    'Nm_Rek3'=>$v->Nm_Rek3,
                                                    'Kd_Rek4'=>$v->Kd_Rek4,
                                                    'Nm_Rek4'=>$v->Nm_Rek4,
                                                    'Kd_Rek5'=>$v->Kd_Rek5,
                                                    'Nm_Rek5'=>$v->Nm_Rek5,
                                                    'nama_uraian'=>$nama_uraian,                                        
                                                    'pagu_uraian'=>$v->PaguUraian1,
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
                            $persenbobot=Helper::formatPersen($v->PaguUraian1,$totalPaguUraian); 
                            $persen_target=Helper::formatPersen($target,$totalPaguUraian);   
                            $persen_realisasi=Helper::formatPersen($realisasi,$totalPaguUraian);
                            $persen_tertimbang_realisasi=number_format(($persen_realisasi*$persenbobot)/100,2);   
                            $persen_tertimbang_fisik=number_format(($persen_fisik*$persenbobot)/100,2);
                            $dataAkhir[$no_rek5]=[
                                                    'RKARincID'=>$v->RKARincID,
                                                    'Kd_Rek1'=>$v->Kd_Rek1,
                                                    'Nm_Rek1'=>$v->Nm_Rek1,
                                                    'Kd_Rek2'=>$v->Kd_Rek2,
                                                    'Nm_Rek2'=>$v->Nm_Rek2,
                                                    'Kd_Rek3'=>$v->Kd_Rek3,
                                                    'Nm_Rek3'=>$v->Nm_Rek3,
                                                    'Kd_Rek4'=>$v->Kd_Rek4,
                                                    'Nm_Rek4'=>$v->Nm_Rek4,
                                                    'Kd_Rek5'=>$v->Kd_Rek5,
                                                    'Nm_Rek5'=>$v->Nm_Rek5,
                                                    'nama_uraian'=>$nama_uraian,                                        
                                                    'pagu_uraian'=>$v->PaguUraian1,
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
            break;
            case 2 :
                $sql = \DB::raw('"trRKA"."RKAID",
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
                                "C"."Nm_SumberDana",
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
                                "A"."NIP_ASN" AS nip_pa,
                                "A"."Nm_ASN" AS nama_pa,
                                "B"."NIP_ASN" AS nip_pptk,
                                "B"."Nm_ASN" AS nama_pptk,
                                "trRKA"."created_at",
                                "trRKA"."updated_at"
                            ');

                $rka = \App\Models\Belanja\RKAModel::select($sql)                              
                            ->leftJoin('tmASN AS A','A.ASNID','trRKA.nip_pa2')     
                            ->leftJoin('tmASN AS B','B.ASNID','trRKA.nip_pptk2')     
                            ->leftJoin('tmSumberDana AS C','C.SumberDanaID','trRKA.SumberDanaID')                                 
                            ->where('trRKA.EntryLvl',$entryLvl)
                            ->find($id);
                
                if (!is_null($rka))
                {
                    $this->dataKegiatan=$rka->toArray();        
                    $totalPaguUraian = $rka->PaguDana2;
                    $this->dataKegiatan['total_pagu_uraian']=$totalPaguUraian;
                    $data_akhir = \DB::table('trRKARinc')
                                    ->select(\DB::raw('"trRKARinc"."RKARincID",
                                            "trRKARinc"."RKAID",
                                            simda."Kd_Rek1",
                                            simda."Nm_Rek1",
                                            CONCAT(simda."Kd_Rek1",\'.\',simda."Kd_Rek2") AS "Kd_Rek2",
                                            simda."Nm_Rek2",
                                            CONCAT(simda."Kd_Rek1",\'.\',simda."Kd_Rek2",\'.\',simda."Kd_Rek3") AS "Kd_Rek3",
                                            simda."Nm_Rek3",
                                            CONCAT(simda."Kd_Rek1",\'.\',simda."Kd_Rek2",\'.\',simda."Kd_Rek3",\'.\',simda."Kd_Rek4") AS "Kd_Rek4",
                                            simda."Nm_Rek4",
                                            CONCAT(simda."Kd_Rek1",\'.\',simda."Kd_Rek2",\'.\',simda."Kd_Rek3",\'.\',simda."Kd_Rek4",\'.\',simda."Kd_Rek5") AS "Kd_Rek5",
                                            simda."Nm_Rek5",
                                            simda."nama_uraian",
                                            simda."PaguUraian2",
                                            "trRKARinc"."volume2",
                                            "trRKARinc"."satuan2",
                                            "trRKARinc"."harga_satuan2"                                    
                                    '))
                                    ->where('RKAID',$rka->RKAID)
                                    ->join('simda','simda.TepraID','trRKARinc.RKARincID')
                                    ->get();   
                                                
                    foreach ($data_akhir as $k=>$v)
                    {
                        $RKARincID=$v->RKARincID;                      
                        $nama_uraian=$v->nama_uraian;
                        $target=(float)\DB::table('trRKATargetRinc')
                                            ->where('RKARincID',$RKARincID)
                                            ->where('bulan2','<=',$no_bulan)
                                            ->sum('target2');                                
                        $data_realisasi=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKARincID',$RKARincID)
                                            ->where('bulan2','<=',$no_bulan)
                                            ->get();

                        $realisasi=(float)$data_realisasi[0]->realisasi2;
                        $fisik=(float)$data_realisasi[0]->fisik2;            
                        $persen_fisik=number_format((($fisik > 100) ? 100:$fisik),2);
                        $no_rek5=$v->Kd_Rek5;            
                        if (array_key_exists ($no_rek5,$dataAkhir)) 
                        {
                            $persenbobot=Helper::formatPersen($v->PaguUraian2,$totalPaguUraian); 
                            $persen_target=Helper::formatPersen($target,$totalPaguUraian);   
                            $persen_realisasi=Helper::formatPersen($realisasi,$totalPaguUraian);
                            $persen_tertimbang_realisasi=number_format(($persen_realisasi*$persenbobot)/100,2);   
                            $persen_tertimbang_fisik=number_format(($persen_fisik*$persenbobot)/100,2);
                            $dataAkhir[$no_rek5]['child'][]=[
                                                    'RKARincID'=>$v->RKARincID,
                                                    'Kd_Rek1'=>$v->Kd_Rek1,
                                                    'Nm_Rek1'=>$v->Nm_Rek1,
                                                    'Kd_Rek2'=>$v->Kd_Rek2,
                                                    'Nm_Rek2'=>$v->Nm_Rek2,
                                                    'Kd_Rek3'=>$v->Kd_Rek3,
                                                    'Nm_Rek3'=>$v->Nm_Rek3,
                                                    'Kd_Rek4'=>$v->Kd_Rek4,
                                                    'Nm_Rek4'=>$v->Nm_Rek4,
                                                    'Kd_Rek5'=>$v->Kd_Rek5,
                                                    'Nm_Rek5'=>$v->Nm_Rek5,
                                                    'nama_uraian'=>$nama_uraian,                                        
                                                    'pagu_uraian'=>$v->PaguUraian2,
                                                    'persen_bobot'=>$persenbobot,
                                                    'target'=>$target,
                                                    'persen_target'=>$persen_target,
                                                    'realisasi'=>$realisasi,
                                                    'persen_realisasi'=>$persen_realisasi,
                                                    'persen_tertimbang_realisasi'=>$persen_tertimbang_realisasi,
                                                    'fisik'=>$fisik,
                                                    'persen_fisik'=>$persen_fisik,
                                                    'persen_tertimbang_fisik'=>$persen_tertimbang_fisik,
                                                    'volume'=>$v->volume2,
                                                    'harga_satuan'=>(float)$v->harga_satuan2,
                                                    'satuan'=>$v->satuan2
                                                ];
                        }
                        else
                        {
                            $persenbobot=Helper::formatPersen($v->PaguUraian2,$totalPaguUraian); 
                            $persen_target=Helper::formatPersen($target,$totalPaguUraian);   
                            $persen_realisasi=Helper::formatPersen($realisasi,$totalPaguUraian);
                            $persen_tertimbang_realisasi=number_format(($persen_realisasi*$persenbobot)/100,2);   
                            $persen_tertimbang_fisik=number_format(($persen_fisik*$persenbobot)/100,2);
                            $dataAkhir[$no_rek5]=[
                                                    'RKARincID'=>$v->RKARincID,
                                                    'Kd_Rek1'=>$v->Kd_Rek1,
                                                    'Nm_Rek1'=>$v->Nm_Rek1,
                                                    'Kd_Rek2'=>$v->Kd_Rek2,
                                                    'Nm_Rek2'=>$v->Nm_Rek2,
                                                    'Kd_Rek3'=>$v->Kd_Rek3,
                                                    'Nm_Rek3'=>$v->Nm_Rek3,
                                                    'Kd_Rek4'=>$v->Kd_Rek4,
                                                    'Nm_Rek4'=>$v->Nm_Rek4,
                                                    'Kd_Rek5'=>$v->Kd_Rek5,
                                                    'Nm_Rek5'=>$v->Nm_Rek5,
                                                    'nama_uraian'=>$nama_uraian,                                        
                                                    'pagu_uraian'=>$v->PaguUraian2,
                                                    'persen_bobot'=>$persenbobot,
                                                    'target'=>$target,
                                                    'persen_target'=>$persen_target,
                                                    'realisasi'=>$realisasi,
                                                    'persen_realisasi'=>$persen_realisasi,
                                                    'persen_tertimbang_realisasi'=>$persen_tertimbang_realisasi,
                                                    'fisik'=>$fisik,
                                                    'persen_fisik'=>$persen_fisik,
                                                    'persen_tertimbang_fisik'=>$persen_tertimbang_fisik,
                                                    'volume'=>$v->volume2,
                                                    'harga_satuan'=>(float)$v->harga_satuan2,
                                                    'satuan'=>$v->satuan2
                                                ];
                        }

                    }       	
                }
            break;
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
			$tingkat[1][$v['Kd_Rek1']]=$v['Nm_Rek1'];
			$tingkat[2][$v['Kd_Rek2']]=$v['Nm_Rek2'];
			$tingkat[3][$v['Kd_Rek3']]=$v['Nm_Rek3'];
			$tingkat[4][$v['Kd_Rek4']]=$v['Nm_Rek4'];
			$tingkat[5][$v['Kd_Rek5']]=$v['Nm_Rek5'];				
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
                if (isset($dataproyek[$de['Kd_Rek5']]['child'][0])) {                    
                    $child=$dataproyek[$de['Kd_Rek5']]['child'];                    
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
        $totalpersentarget=Helper::formatPersen($totaltarget,$totalpagu);                
        $totalpersenrealisasi=Helper::formatPersen($totalrealisasi,$totalpagu);            
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