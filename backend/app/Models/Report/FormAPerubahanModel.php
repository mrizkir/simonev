<?php

namespace App\Models\Report;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;

use App\Helpers\Helper;
class FormAPerubahanModel extends ReportModel
{   
    public function __construct($dataReport,$print=true)
    {
        parent::__construct($dataReport);         
        if ($print)
        {
            $tahun=$this->dataReport['tahun'];
            $this->spreadsheet->getProperties()->setTitle("Laporan Form A Tahun $tahun");
            $this->spreadsheet->getProperties()->setSubject("Laporan Form A Tahun $tahun"); 
            $this->print();             
        }        
    }    
    private function print()  
    {
        $RKAID = $this->dataReport['RKAID'];
        $no_bulan = $this->dataReport['no_bulan'];
        $nama_bulan = Helper::getNamaBulan($no_bulan);
        $tahun=$this->dataReport['tahun'];

        $rka=$this->getDataRKA($RKAID,$no_bulan,2);
        $datakegiatan = $this->dataKegiatan;
        $tingkat = $this->getRekeningProyek();    

        $sheet = $this->spreadsheet->getActiveSheet();        
        $sheet->setTitle ('LAPORAN FORM A PERUBAHAN');

        $sheet->getParent()->getDefaultStyle()->applyFromArray([
            'font' => [
                'name' => 'Arial',
                'size' => '9',
            ],
        ]);

        $row=2;
        $sheet->mergeCells("A$row:X$row");				                
        $sheet->setCellValue("A$row",'LAPORAN FORM.A RINCIAN');

        $row+=1;
        $sheet->mergeCells("A$row:X$row");		
        $sheet->setCellValue("A$row",'FISIK DAN KEUANGAN DOKUMEN PELAKSANAAN ANGGARAN'); 
        
        $styleArray=array( 
            'font' => array('bold' => true,'size'=>'11'),
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                               'vertical'=>Alignment::HORIZONTAL_CENTER),								
        );                
        
        $sheet->getStyle("A1:A$row")->applyFromArray($styleArray);
        $sheet->getRowDimension(26)->setRowHeight(22);
        $sheet->getColumnDimension('A')->setWidth(3);
        $sheet->getColumnDimension('B')->setWidth(3);
        $sheet->getColumnDimension('C')->setWidth(3);
        $sheet->getColumnDimension('D')->setWidth(3);
        $sheet->getColumnDimension('E')->setWidth(3);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(14);
        $sheet->getColumnDimension('I')->setWidth(11);
        $sheet->getColumnDimension('J')->setWidth(10);
        $sheet->getColumnDimension('K')->setWidth(18);
        $sheet->getColumnDimension('L')->setWidth(15);
        $sheet->getColumnDimension('M')->setWidth(8);
        $sheet->getColumnDimension('N')->setWidth(12);
        $sheet->getColumnDimension('O')->setWidth(15);
        $sheet->getColumnDimension('P')->setWidth(15);
        $sheet->getColumnDimension('Q')->setWidth(10);
        $sheet->getColumnDimension('R')->setWidth(15);
        $sheet->getColumnDimension('S')->setWidth(10);
        $sheet->getColumnDimension('T')->setWidth(12);
        $sheet->getColumnDimension('U')->setWidth(15);                
        $sheet->getColumnDimension('V')->setWidth(35);
        $sheet->getColumnDimension('W')->setWidth(17);
        $sheet->getColumnDimension('X')->setWidth(25);

        $row+=2;
        $sheet->mergeCells("X$row:Y$row");
        $sheet->getStyle("X$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->setCellValue("X$row","POSISI S.D $nama_bulan $tahun");
        $row+=2;                
        $row_awal=$row;
        $row_awal_sekali=$row;
        $sheet->setCellValue("A$row",'I.');
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'DATA UMUM');
        $sheet->getStyle("A$row:B$row")->getFont()->setBold(true);
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'URUSAN PEMERINTAHAN');
        $sheet->setCellValue("G$row",': ' . $datakegiatan['kode_urusan']);                
        $sheet->mergeCells("H$row:T$row");
        $sheet->setCellValue("H$row",$datakegiatan['Nm_Bidang']);
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'ORGANISASI');
        $sheet->setCellValue("G$row",': '.$datakegiatan['kode_organisasi']);                
        $sheet->mergeCells("H$row:T$row");
        $sheet->setCellValue("H$row",$datakegiatan['OrgNm']);
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'UNIT KERJA');
        $sheet->setCellValue("G$row",': '.$datakegiatan['kode_suborganisasi']);                
        $sheet->mergeCells("H$row:T$row");
        $sheet->setCellValue("H$row",$datakegiatan['SOrgNm']);
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'PROGRAM');
        $sheet->setCellValue("G$row",': '.$datakegiatan['kode_program']);                
        $sheet->mergeCells("H$row:T$row");
        $sheet->setCellValue("H$row",$datakegiatan['PrgNm']);
        $row+=1;                                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'KEGIATAN');
        $sheet->setCellValue("G$row",': '.$datakegiatan['kode_kegiatan']);                
        $sheet->mergeCells("H$row:T$row");
        $sheet->setCellValue("H$row",$datakegiatan['KgtNm']);
        $row+=1;                                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'LOKASI KEGIATAN');
        $sheet->mergeCells("G$row:J$row");
        $sheet->setCellValue("G$row",': ' .$datakegiatan['lokasi_kegiatan2']);                
        $row+=1;  
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'SUMBER DANA');
        $sheet->setCellValue("G$row",': '.$datakegiatan['Nm_SumberDana']);   
        $row+=1;                                
        $sheet->setCellValue("A$row",'II.');
        $sheet->mergeCells("B$row:H$row");
        $sheet->setCellValue("B$row",'INDIKATOR DAN TOLOK UKUR KINERJA BELANJA LANGSUNG');
        $sheet->getStyle("A$row:B$row")->getFont()->setBold(true); 
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'INDIKATOR');
        $sheet->mergeCells("G$row:K$row");
        $sheet->setCellValue("G$row",'TOLAK UKUR KINERJA');
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",'TARGET KINERJA');
        $row+=1;                                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'CAPAIAN PROGRAM');
        $sheet->mergeCells("G$row:K$row");
        $sheet->setCellValue("G$row",$datakegiatan['capaian_program2']);
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",$datakegiatan['tk_capaian2'] . "%");    
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'MASUKAN');
        $sheet->mergeCells("G$row:K$row");
        $sheet->setCellValue("G$row",$datakegiatan['masukan2']);
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",Helper::formatUang($datakegiatan['PaguDana2']));
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'KELUARAN');
        $sheet->mergeCells("G$row:K$row");
        $sheet->setCellValue("G$row",$datakegiatan['keluaran2']);
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",$datakegiatan['tk_keluaran2']);
        $row+=1;                                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'HASIL');
        $sheet->mergeCells("G$row:K$row");
        $sheet->setCellValue("G$row",$datakegiatan['hasil2']);
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",$datakegiatan['tk_hasil2']);
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'KELOMPOK SASARAN KEGIATAN');                                
        $sheet->mergeCells("G$row:J$row");
        $sheet->setCellValue("G$row",$datakegiatan['ksk2']);
        $row+=1;                                
        $sheet->setCellValue("A$row",'III.');
        $sheet->mergeCells("B$row:H$row");
        $sheet->setCellValue("B$row",'REALISASI FISIK DAN KEUANGAN');
        $sheet->getStyle("A$row:B$row")->getFont()->setBold(true);
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'Bulan');                                
        $sheet->mergeCells("G$row:J$row");
        
        $sheet->setCellValue("G$row",": $nama_bulan");
        $row+=1;                
        $sheet->mergeCells("B$row:F$row");
        $sheet->setCellValue("B$row",'Tahun');                                
        $sheet->mergeCells("G$row:J$row");                
        $sheet->setCellValue("G$row",": $tahun");

        $styleArray=array(								                                
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_LEFT,
                               'vertical'=>Alignment::HORIZONTAL_CENTER),								
        );
        $sheet->getStyle("A$row_awal:T$row")->applyFromArray($styleArray);                
        $row+=1;                             
        for ($i=$row_awal_sekali;$i <= $row;$i++) {                    
            $sheet->getRowDimension($i)->setRowHeight(20);
        }
        $styleArray=array(								
                    'font' => array('bold' => true),
                    );
        $sheet->getStyle("F$row_awal_sekali:F$row")->applyFromArray($styleArray);
        $sheet->getStyle("F$row_awal_sekali:T$row")->getAlignment()->setWrapText(true);

        $row+=1;
        $row_akhir=$row+2;                            
        $sheet->mergeCells("A$row:E$row_akhir");		
        $sheet->setCellValue("A$row",'KODE REKENING');
        
        $row_akhir=$row+2;                                     
        $sheet->mergeCells("F$row:H$row_akhir");
        $sheet->setCellValue("F$row",'URAIAN');                
        
        $row_akhir=$row+1;                                     
        $sheet->mergeCells("I$row:K$row");
        $sheet->setCellValue("I$row",'RINCIAN PERHITUNGAN');
        $row_awal=$row+1;                     
        $row_akhir=$row+2;                 
        $sheet->setCellValue("I$row_awal",'VOLUME');
        $sheet->setCellValue("J$row_awal",'SATUAN');
        $sheet->setCellValue("K$row_awal",'HARGA SATUAN');
        
        $sheet->mergeCells("L$row:L$row_akhir");
        $sheet->setCellValue("L$row",'JUMLAH (Rp.)');

        $row_akhir=$row+1;                               
        $sheet->mergeCells("M$row:M$row_akhir");
        $sheet->setCellValue("M$row",'% BOBOT');                
        
        $row_akhir=$row+1;                               
        $sheet->mergeCells("N$row:O$row_akhir");                
        $sheet->setCellValue("N$row",'REALISASI FISIK');
        $row_akhir=$row+2;                                                            
        $sheet->setCellValue("N$row_akhir",'% REALISASI');
        $sheet->setCellValue("O$row_akhir",'% Tertimbang');
                        
        $row_akhir=$row+1;                               
        $sheet->mergeCells("P$row:T$row");
        $sheet->setCellValue("P$row",'KEUANGAN');
        
        $row_akhir=$row+1;                               
        $sheet->mergeCells("P$row_akhir:Q$row_akhir");
        $sheet->setCellValue("P$row_akhir",'TARGET (ANGGARAN KAS) KOMULATIF');
        $sheet->mergeCells("R$row_akhir:T$row_akhir");
        $sheet->setCellValue("R$row_akhir",'REALISASI (SPJ) SAMPAI DENGAN BULAN INI');               
        $row_akhir=$row+2;                                            
        $sheet->setCellValue("P$row_akhir",'Rp.');
        $sheet->setCellValue("Q$row_akhir",'% Target');
        $sheet->setCellValue("R$row_akhir",'Rp.');
        $sheet->setCellValue("S$row_akhir",'% Realisasi');
        $sheet->setCellValue("T$row_akhir",'% Tertimbang');
        
        $row_akhir=$row+2;               
        $sheet->mergeCells("U$row:U$row_akhir");                
        $sheet->setCellValue("U$row",'SISA ANGGARAN');                
        $row_akhir=$row+2;                               
        $sheet->mergeCells("V$row:V$row_akhir");
        $sheet->setCellValue("V$row",'REKANAN');
        $row_akhir=$row+2;                               
        $sheet->mergeCells("W$row:W$row_akhir");
        $sheet->setCellValue("W$row",'MASA PELAKSANAAN');
        $row_akhir=$row+2;                               
        $sheet->mergeCells("X$row:X$row_akhir");
        $sheet->setCellValue("X$row",'LOKASI');                
        
        $row_akhir=$row+3;
        $sheet->mergeCells("A$row_akhir:E$row_akhir");
        $sheet->setCellValue("A$row_akhir",'1');
        $sheet->mergeCells("F$row_akhir:H$row_akhir");
        $sheet->setCellValue("F$row_akhir",'2');
        $sheet->setCellValue("I$row_akhir",'4');
        $sheet->setCellValue("J$row_akhir",'5');
        $sheet->setCellValue("K$row_akhir",'6');
        $sheet->setCellValue("L$row_akhir",'7');
        $sheet->setCellValue("M$row_akhir",'8');
        $sheet->setCellValue("N$row_akhir",'9');
        $sheet->setCellValue("O$row_akhir",'10');
        $sheet->setCellValue("P$row_akhir",'11');
        $sheet->setCellValue("Q$row_akhir",'12');                
        $sheet->setCellValue("R$row_akhir",'13');
        $sheet->setCellValue("S$row_akhir",'14');
        $sheet->setCellValue("T$row_akhir",'15');
        $sheet->setCellValue("U$row_akhir",'16');                               
        $sheet->setCellValue("V$row_akhir",'17');                               
        $sheet->setCellValue("W$row_akhir",'18');                               
        $sheet->setCellValue("X$row_akhir",'25');                                                                            
        $styleArray=array(
                        'font' => array('bold' => true),
                        'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                                            'vertical'=>Alignment::HORIZONTAL_CENTER),
                        'borders' => array('allBorders' => array('borderStyle' =>Border::BORDER_THIN))
                    );
        $sheet->getStyle("A$row:X$row_akhir")->applyFromArray($styleArray);
        $sheet->getStyle("A$row:X$row_akhir")->getAlignment()->setWrapText(true);
        
        $sheet->getRowDimension(23)->setRowHeight(24);
        $sheet->getRowDimension(24)->setRowHeight(24);

        $totalPaguDana=0;
        $totalTargetSatuKegiatan=0;
        $totalRealisasiSatuKegiatan=0;
        $totalPersenBobotSatuKegiatan=0;
        $totalPersenFisikSatuKegiatan=0;
        $totalUraian=0;
        $totalPersenTertimbangFisikSatuKegiatan=0;
        $totalPersenTargetSatuKegiatan=0;
        $totalPersenRealisasiSatuKegiatan=0;

        if (isset($tingkat[1])) {                                        
            $tingkat_1=$tingkat[1];            
            $tingkat_2=$tingkat[2];
            $tingkat_3=$tingkat[3];
            $tingkat_4=$tingkat[4];
            $tingkat_5=$tingkat[5];
            $row+=4;               
            $row_awal=$row;
            foreach ($tingkat_1 as $k1=>$v1)
            {
                foreach ($tingkat_5 as $k5=>$v5) {
                    $rek1=substr($k5,0,1);
                    if ($rek1 == $k1) {
                        //tingkat i
                        $totalPaguDana_Rek1=$this->calculateEachLevel($rka,$k1,'Kd_Rek1'); 
                        $totalPaguDana=$totalPaguDana_Rek1['totalpagu'];
                        $rp_total_pagu_dana_rek1=Helper::formatUang($totalPaguDana);
                        $sheet->setCellValueExplicit("A$row",$k1,DataType::TYPE_STRING);
                        $sheet->mergeCells("F$row:H$row");
                        $sheet->setCellValue("F$row",$v1);	                                
                        $sheet->setCellValue("L$row",$rp_total_pagu_dana_rek1);
                        $sheet->getStyle("A$row:L$row")->getFont()->setBold(true);
                        $row+=1;
                        //tingkat ii
                        foreach ($tingkat_2 as $k2=>$v2) 
                        {
                            $rek2_tampil=[];
                            foreach ($tingkat_5 as $k5_level2=>$v5_level2) {
                                $rek2=substr($k5_level2,0,3);								
                                if ($rek2 == $k2) {
                                    if (!array_key_exists($k2,$rek2_tampil)){															
                                        $rek2_tampil[$rek2]=$v2;
                                    }							
                                }
                            }
                            foreach ($rek2_tampil as $a=>$b) 
                            {
                                $totalPaguDana_Rek2=$this->calculateEachLevel($rka,$a,'Kd_Rek2'); 
                                $no_=explode ('.',$a);
                                $rp_total_pagu_dana_rek2=Helper::formatUang($totalPaguDana_Rek2['totalpagu']);                                                                            
                                $sheet->setCellValueExplicit("A$row",$no_[0],DataType::TYPE_STRING);
                                $sheet->setCellValueExplicit("B$row",$no_[1],DataType::TYPE_STRING);
                                $sheet->mergeCells("F$row:H$row");
                                $sheet->setCellValue("F$row",$b);	
                                $sheet->setCellValue("L$row",$rp_total_pagu_dana_rek2);
                                $sheet->getStyle("A$row:L$row")->getFont()->setBold(true);
                                $row+=1;
                                //tingkat iii      
                                foreach ($tingkat_3 as $k3=>$v3) 
                                {
                                    $rek3=substr($k3,0,3);
                                    if ($a==$rek3) 
                                    {
                                        $totalPaguDana_Rek3=$this->calculateEachLevel($rka,$k3,'Kd_Rek3');                                        
                                        $no_=explode (".",$k3);
                                        $rp_total_pagu_dana_rek3=Helper::formatUang($totalPaguDana_Rek3['totalpagu']);
                                        $persen_bobot_rek3=$totalPaguDana_Rek3['totalpersenbobot'];
                                        $rp_total_target_rek3=Helper::formatUang($totalPaguDana_Rek3['totaltarget']);
                                        $persen_target_rek3=$totalPaguDana_Rek3['totalpersentarget'];
                                        $rp_total_realisasi_rek3=Helper::formatUang($totalPaguDana_Rek3['totalrealisasi']);
                                        $persen_realisasi_rek3=$totalPaguDana_Rek3['totalpersenrealisasi'];
                                        $persen_tertimbang_realisasi_rek3=$totalPaguDana_Rek3['totalpersentertimbangrealisasi'];                                        
                                        $persen_rata2_fisik_rek3=Helper::formatPecahan($totalPaguDana_Rek3['totalfisik'],$totalPaguDana_Rek3['totalbaris']);                                        
                                        $persen_tertimbang_fisik_rek3=$totalPaguDana_Rek3['totalpersentertimbangfisik'];
                                        $dalamDpa_rek3=Helper::formatUang($totalPaguDana_Rek3['totalpagu']-$totalPaguDana_Rek3['totalrealisasi']);

                                        $sheet->setCellValueExplicit("A$row",$no_[0],DataType::TYPE_STRING);								
                                        $sheet->setCellValueExplicit("B$row",$no_[1],DataType::TYPE_STRING);								
                                        $sheet->setCellValueExplicit("C$row",$no_[2],DataType::TYPE_STRING);								                                            
                                        $sheet->mergeCells("F$row:H$row");
                                        $sheet->setCellValue("F$row",$v3);
                                        $sheet->setCellValueExplicit("L$row",$rp_total_pagu_dana_rek3,DataType::TYPE_STRING);
                                        $sheet->setCellValueExplicit("M$row",$persen_bobot_rek3,DataType::TYPE_STRING);
                                        $sheet->setCellValueExplicit("N$row",$persen_rata2_fisik_rek3,DataType::TYPE_STRING);
                                        $sheet->setCellValueExplicit("O$row",$persen_tertimbang_fisik_rek3,DataType::TYPE_STRING);
                                        $sheet->setCellValueExplicit("P$row",$rp_total_target_rek3,DataType::TYPE_STRING);
                                        $sheet->setCellValueExplicit("Q$row",$persen_target_rek3,DataType::TYPE_STRING);
                                        $sheet->setCellValueExplicit("R$row",$rp_total_realisasi_rek3,DataType::TYPE_STRING);
                                        $sheet->setCellValueExplicit("S$row",$persen_realisasi_rek3,DataType::TYPE_STRING);
                                        $sheet->setCellValueExplicit("T$row",$persen_tertimbang_realisasi_rek3,DataType::TYPE_STRING);                                                
                                        $sheet->setCellValueExplicit("U$row",$dalamDpa_rek3,DataType::TYPE_STRING);
                                        
                                        $sheet->getStyle("A$row:V$row")->getFont()->setBold(true);
                                        $row+=1;                                              
                                        //tingkat iv
                                        foreach ($tingkat_4 as $k4=>$v4) 
                                        {
                                            if (preg_match("/^$k3/", $k4)) 
                                            {
                                                $totalPaguDana_Rek4=\App\Models\Report\FormAPerubahanModel::calculateEachLevel($rka,$k4,'Kd_Rek4');
                                                $rp_total_pagu_dana_rek4=Helper::formatUang($totalPaguDana_Rek4['totalpagu']);
                                                $no_=explode (".",$k4);
                                                $persen_bobot_rek4=$totalPaguDana_Rek4['totalpersenbobot'];
                                                $rp_total_target_rek4=Helper::formatUang($totalPaguDana_Rek4['totaltarget']);
                                                $persen_target_rek4=$totalPaguDana_Rek4['totalpersentarget'];
                                                $rp_total_realisasi_rek4=Helper::formatUang($totalPaguDana_Rek4['totalrealisasi']);
                                                $persen_realisasi_rek4=$totalPaguDana_Rek4['totalpersenrealisasi'];
                                                $persen_tertimbang_realisasi_rek4=$totalPaguDana_Rek4['totalpersentertimbangrealisasi'];                                                
                                                $persen_rata2_fisik_rek4=Helper::formatPecahan($totalPaguDana_Rek4['totalfisik'],$totalPaguDana_Rek4['totalbaris']);
                                                $persen_tertimbang_fisik_rek4=$totalPaguDana_Rek4['totalpersentertimbangfisik'];                                                
                                                $dalamDpa_rek4=Helper::formatUang($totalPaguDana_Rek4['totalpagu']-$totalPaguDana_Rek4['totalrealisasi']);  
                                                
                                                $sheet->setCellValueExplicit("A$row",$no_[0],DataType::TYPE_STRING);								
                                                $sheet->setCellValueExplicit("B$row",$no_[1],DataType::TYPE_STRING);								
                                                $sheet->setCellValueExplicit("C$row",$no_[2],DataType::TYPE_STRING);								                                            
                                                $sheet->setCellValueExplicit("D$row",$no_[3],DataType::TYPE_STRING);
                                                $sheet->mergeCells("F$row:H$row");
                                                $sheet->setCellValue("F$row",$v4);
                                                $sheet->setCellValueExplicit("L$row",$rp_total_pagu_dana_rek4,DataType::TYPE_STRING);
                                                $sheet->setCellValueExplicit("M$row",$persen_bobot_rek4,DataType::TYPE_STRING);
                                                $sheet->setCellValueExplicit("N$row",$persen_rata2_fisik_rek4,DataType::TYPE_STRING);
                                                $sheet->setCellValueExplicit("O$row",$persen_tertimbang_fisik_rek4,DataType::TYPE_STRING);
                                                $sheet->setCellValueExplicit("P$row",$rp_total_target_rek4,DataType::TYPE_STRING);
                                                $sheet->setCellValueExplicit("Q$row",$persen_target_rek4,DataType::TYPE_STRING);
                                                $sheet->setCellValueExplicit("R$row",$rp_total_realisasi_rek4,DataType::TYPE_STRING);
                                                $sheet->setCellValueExplicit("S$row",$persen_realisasi_rek4,DataType::TYPE_STRING);
                                                $sheet->setCellValueExplicit("T$row",$persen_tertimbang_realisasi_rek4,DataType::TYPE_STRING);                                                        
                                                $sheet->setCellValueExplicit("U$row",$dalamDpa_rek4,DataType::TYPE_STRING);                                                        
                                                $sheet->getStyle("A$row:V$row")->getFont()->setBold(true);
                                                $row+=1;
                                                //tingkat v
                                                foreach ($tingkat_5 as $k5=>$v5) 
                                                {
                                                    if (preg_match("/^$k4/", $k5)) 
                                                    {      
                                                        $totalUraian+=1;
                                                        $totalPaguDana_Rek5=$this->calculateEachLevel($rka,$k5,'Kd_Rek5');													
                                                        $rp_total_pagu_dana_rek5=Helper::formatUang($totalPaguDana_Rek5['totalpagu']); 
                                                        $RKARincID=$rka[$k5]['RKARincID'];
                                                        $nama_uraian=$rka[$k5]['nama_uraian']; 
                                                        $no_=explode (".",$k5);    
                                                        $persen_bobot_rek5=$totalPaguDana_Rek5['totalpersenbobot'];
                                                        $rp_total_target_rek5=Helper::formatUang($totalPaguDana_Rek5['totaltarget']);
                                                        $persen_target_rek5=$totalPaguDana_Rek5['totalpersentarget'];
                                                        $rp_total_realisasi_rek5=Helper::formatUang($totalPaguDana_Rek5['totalrealisasi']);
                                                        $persen_realisasi_rek5=$totalPaguDana_Rek5['totalpersenrealisasi'];
                                                        $persen_tertimbang_realisasi_rek5=$totalPaguDana_Rek5['totalpersentertimbangrealisasi'];                                                        
                                                        $persen_rata2_fisik_rek5=Helper::formatPecahan($totalPaguDana_Rek5['totalfisik'],$totalPaguDana_Rek5['totalbaris']);
                                                        $persen_tertimbang_fisik_rek5=$totalPaguDana_Rek5['totalpersentertimbangfisik'];
                                                        $dalamDpa_rek5=Helper::formatUang($totalPaguDana_Rek5['totalpagu']-$totalPaguDana_Rek5['totalrealisasi']);

                                                        $sheet->setCellValueExplicit("A$row",$no_[0],DataType::TYPE_STRING);								
                                                        $sheet->setCellValueExplicit("B$row",$no_[1],DataType::TYPE_STRING);								
                                                        $sheet->setCellValueExplicit("C$row",$no_[2],DataType::TYPE_STRING);								                                            
                                                        $sheet->setCellValueExplicit("D$row",$no_[3],DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("E$row",$no_[4],DataType::TYPE_STRING);                                                                
                                                        $sheet->mergeCells("F$row:H$row");
                                                        $sheet->setCellValue("F$row",$v5);                                                                
                                                        $sheet->setCellValueExplicit("L$row",$rp_total_pagu_dana_rek5,DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("M$row",$persen_bobot_rek5,DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("N$row",$persen_rata2_fisik_rek5,DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("O$row",$persen_tertimbang_fisik_rek5,DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("P$row",$rp_total_target_rek5,DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("Q$row",$persen_target_rek5,DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("R$row",$rp_total_realisasi_rek5,DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("S$row",$persen_realisasi_rek5,DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("T$row",$persen_tertimbang_realisasi_rek5,DataType::TYPE_STRING);                                                                
                                                        $sheet->setCellValueExplicit("U$row",$dalamDpa_rek5,DataType::TYPE_STRING);       

                                                        $nilaiuraian=$rka[$k5]['pagu_uraian']; 
                                                        $target=$rka[$k5]['target'];                                                         
                                                        $totalTargetSatuKegiatan+=$target;
                                                        $realisasi=$rka[$k5]['realisasi'];                                                  
                                                        $totalRealisasiSatuKegiatan+=$realisasi;
                                                        $fisik=$rka[$k5]['fisik'];                                                        
                                                        $volume=$rka[$k5]['volume'];                                                        
                                                        $satuan=$rka[$k5]['satuan'];                                                        
                                                        $harga_satuan=$rka[$k5]['harga_satuan'];                                                        
                                                        $persen_bobot=$rka[$k5]['persen_bobot'];
                                                        $totalPersenBobotSatuKegiatan+=$persen_bobot;
                                                        $persen_target=$rka[$k5]['persen_target'];   
                                                        $totalPersenTargetSatuKegiatan+=$persen_target;   
                                                        $persen_realisasi=$rka[$k5]['persen_realisasi'];
                                                        $totalPersenRealisasiSatuKegiatan+=$persen_realisasi;
                                                        $persen_tertimbang_realisasi=$rka[$k5]['persen_tertimbang_realisasi'];                                                        
                                                        $persen_fisik=$rka[$k5]['persen_fisik'];
                                                        $totalPersenFisikSatuKegiatan+=$persen_fisik;
                                                        $persen_tertimbang_fisik=$rka[$k5]['persen_tertimbang_fisik'];
                                                        $totalPersenTertimbangFisikSatuKegiatan+=$persen_tertimbang_fisik;
                                                        $dalamDpa=$nilaiuraian-$realisasi;                                                                                                                                                                   
                                                        
                                                        $rp_nilai_uraian=Helper::formatUang($nilaiuraian); 
                                                        $rp_target=Helper::formatUang($target);
                                                        $rp_realisasi=Helper::formatUang($realisasi);
                                                        $rp_dalam_dpa=Helper::formatUang($dalamDpa); 

                                                        $row+=1;
                                                        $sheet->mergeCells("A$row:E$row");
                                                        $sheet->mergeCells("F$row:H$row");
                                                        $sheet->setCellValue("F$row",$nama_uraian);                                                                                                                                        
                                                        $sheet->setCellValue("I$row",$volume);
                                                        $sheet->setCellValue("J$row",$satuan);
                                                        $sheet->setCellValueExplicit("K$row",Helper::formatUang($harga_satuan),DataType::TYPE_STRING);
                                                        $sheet->setCellValueExplicit("L$row",$rp_nilai_uraian,DataType::TYPE_STRING);
                                                        $sheet->setCellValue("M$row",$persen_bobot);
                                                        $sheet->setCellValue("N$row",$persen_fisik);
                                                        $sheet->setCellValue("O$row",$persen_tertimbang_fisik);
                                                        $sheet->setCellValueExplicit("P$row",$rp_target,DataType::TYPE_STRING);
                                                        $sheet->setCellValue("Q$row",$persen_target);
                                                        $sheet->setCellValueExplicit("R$row",$rp_realisasi,DataType::TYPE_STRING);
                                                        $sheet->setCellValue("S$row",$persen_realisasi);
                                                        $sheet->setCellValue("T$row",$persen_tertimbang_realisasi);                                                                
                                                        $sheet->setCellValueExplicit("U$row",$rp_dalam_dpa,DataType::TYPE_STRING);                                                                
                                                        // $nama_perusahaan=$rka[$k5]['nama_perusahaan'] == '' ?'':$rka[$k5]['nama_perusahaan'] . ' / '.$rka[$k5]['nama_direktur'];
                                                        $nama_perusahaan='';
                                                        $sheet->setCellValue("V$row",$nama_perusahaan);
                                                        // $lokasi=$rka[$k5]['lokasi'];
                                                        $lokasi='';
                                                        $sheet->setCellValue("X$row",$lokasi);
                                                        if (isset($dataproyek[$k5]['child'][0])) 
                                                        {                    
                                                            $row+=1;                                                                             
                                                            $child=$dataproyek[$k5]['child'];  
                                                            foreach ($child as $n) {
                                                                $totalUraian+=1;
                                                                $iduraian=$n['iduraian'];                                                                
                                                                $nama_uraian=$n['nama_uraian'];
                                                                $nilaiuraian=$n['nilai']; 
                                                                $target=$n['target'];                                                                 
                                                                $totalTargetSatuKegiatan+=$target;
                                                                $realisasi=$n['realisasi'];    
                                                                $totalRealisasiSatuKegiatan+=$realisasi;
                                                                $fisik=$n['fisik'];                                                                
                                                                $volume=$n['volume'];
                                                                $satuan=$n['satuan'];
                                                                $harga_satuan=Helper::formatUang($n['harga_satuan']);
                                                                $persen_bobot=$n['persen_bobot'];
                                                                $totalPersenBobotSatuKegiatan+=$persen_bobot;   
                                                                $persen_target=$n['persen_target'];                                                                           
                                                                $persen_realisasi=$n['persen_realisasi'];                                                                        
                                                                $persen_tertimbang_realisasi=$n['persen_tertimbang_realisasi'];                                                                        
                                                                $persen_fisik=$n['persen_fisik'];
                                                                $totalPersenFisikSatuKegiatan+=$persen_fisik;
                                                                $persen_tertimbang_fisik=$n['persen_tertimbang_fisik'];
                                                                $totalPersenTertimbangFisikSatuKegiatan+=$persen_tertimbang_fisik;
                                                                $dalamDpa=$nilaiuraian-$realisasi;                                                                                                                                                                                                   

                                                                $rp_nilai_uraian=Helper::formatUang($nilaiuraian); 
                                                                $rp_target=Helper::formatUang($target);
                                                                $rp_realisasi=Helper::formatUang($realisasi);
                                                                $rp_dalam_dpa=Helper::formatUang($dalamDpa);                                                                        
                                                                
                                                                $sheet->mergeCells("A$row:E$row");
                                                                $sheet->mergeCells("F$row:H$row");
                                                                $sheet->setCellValue("F$row",$nama_uraian);                                                                        
                                                                $sheet->setCellValue("I$row",$volume);
                                                                $sheet->setCellValue("J$row",$satuan);
                                                                $sheet->setCellValueExplicit("K$row",$harga_satuan,DataType::TYPE_STRING);
                                                                $sheet->setCellValueExplicit("L$row",$rp_nilai_uraian,DataType::TYPE_STRING);                                                                        
                                                                $sheet->setCellValue("M$row",$persen_bobot);
                                                                $sheet->setCellValue("N$row",$persen_fisik);
                                                                $sheet->setCellValue("O$row",$persen_tertimbang_fisik);
                                                                $sheet->setCellValueExplicit("P$row",$rp_target,DataType::TYPE_STRING);
                                                                $sheet->setCellValue("Q$row",$persen_target);
                                                                $sheet->setCellValueExplicit("R$row",$rp_realisasi,DataType::TYPE_STRING);
                                                                $sheet->setCellValue("S$row",$persen_realisasi);
                                                                $sheet->setCellValue("T$row",$persen_tertimbang_realisasi);                                                                        
                                                                $sheet->setCellValueExplicit("U$row",$rp_dalam_dpa,DataType::TYPE_STRING);                                                                                                                                                
                                                                // $nama_perusahaan=$rka[$k5]['nama_perusahaan'] == '' ?'':$rka[$k5]['nama_perusahaan'] . ' / '.$rka[$k5]['nama_direktur'];
                                                                $nama_perusahaan='';
                                                                $sheet->setCellValue("V$row",$nama_perusahaan);
                                                                // $lokasi=$rka[$k5]['lokasi'];
                                                                $lokasi='';
                                                                $sheet->setCellValue("X$row",$lokasi);
                                                                $row+=1;                                                                        
                                                            }
                                                            $row-=1;
                                                        }
                                                        $row+=1;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }                         
                            }
                        }
                        break;
                    }
                    continue;
                }
            }

        }

        $styleArray=array(								
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                               'vertical'=>Alignment::HORIZONTAL_CENTER),
            'borders' => array('allBorders' => array('borderStyle' =>Border::BORDER_THIN))
        );   																					 
        $sheet->getStyle("A$row_awal:X$row")->applyFromArray($styleArray);
        $sheet->getStyle("A$row_awal:X$row")->getAlignment()->setWrapText(true);
        
        $styleArray=array(								
                            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_LEFT)
                        );																					 
        $sheet->getStyle("F$row_awal:F$row")->applyFromArray($styleArray);
        $sheet->getStyle("V$row_awal:X$row")->applyFromArray($styleArray);
        $styleArray=array(								
                            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_RIGHT)
                        );																					 
        $sheet->getStyle("K$row_awal:L$row")->applyFromArray($styleArray);
        $sheet->getStyle("P$row_awal:P$row")->applyFromArray($styleArray);
        $sheet->getStyle("R$row_awal:R$row")->applyFromArray($styleArray);                
        $sheet->getStyle("U$row_awal:V$row")->applyFromArray($styleArray);
        
        $rp_total_pagu_dana=Helper::formatUang($totalPaguDana);	
        $rp_total_target=Helper::formatUang ($totalTargetSatuKegiatan);			
        $rp_total_realisasi=Helper::formatUang ($totalRealisasiSatuKegiatan);            
        $rp_total_dalam_dpa=Helper::formatUang($totalPaguDana-$totalRealisasiSatuKegiatan);                
        
        $sheet->mergeCells("A$row:J$row");
        $sheet->setCellValue("A$row",'Jumlah');                
        $sheet->setCellValueExplicit("L$row",$rp_total_pagu_dana,DataType::TYPE_STRING);
        $totalPersenBobotSatuKegiatan=$totalPersenBobotSatuKegiatan > 100 ? 100:$totalPersenBobotSatuKegiatan;
        $sheet->setCellValue("M$row",number_format($totalPersenBobotSatuKegiatan,2));
        $sheet->setCellValue("N$row",number_format($totalPersenFisikSatuKegiatan/$totalUraian,2));                
        $sheet->setCellValue("O$row",$totalPersenTertimbangFisikSatuKegiatan);
        $sheet->setCellValueExplicit("P$row",$rp_total_target,DataType::TYPE_STRING);        
        $total_persen_target=Helper::formatPersen($totalTargetSatuKegiatan,$totalPaguDana);
        $sheet->setCellValue("Q$row",$total_persen_target);
        $sheet->setCellValueExplicit("R$row",$rp_total_realisasi,DataType::TYPE_STRING);                
        $total_persen_rata2_realisasi=Helper::formatPersen($totalRealisasiSatuKegiatan,$totalPaguDana);
        $sheet->setCellValue("S$row",$total_persen_rata2_realisasi);
        $totalPersenTertimbangRealisasiSatuKegiatan=number_format(($total_persen_rata2_realisasi*$totalPersenBobotSatuKegiatan)/100,2);
        $sheet->setCellValue("T$row",$totalPersenTertimbangRealisasiSatuKegiatan);                                
        $sheet->setCellValueExplicit("U$row",$rp_total_dalam_dpa,DataType::TYPE_STRING);                
        $sheet->getStyle("A$row:W$row")->getFont()->setBold(true);
        for ($i=$row_awal;$i <= $row;$i++) {                    
            $sheet->getRowDimension($i)->setRowHeight(24);
        }
        $row+=3;               
        $sheet->setCellValue("F$row",'RENCANA ANGGARAN KAS');
        $sheet->mergeCells("T$row:V$row");
        $sheet->setCellValue("T$row",'Kabupaten Bintan, '.Helper::tanggal('d F Y'));

        $row+=1;
        $data = \DB::table('trRKATargetRinc')
                    ->select(\DB::raw('bulan1,SUM(target1) AS target'))
                    ->where('RKAID',$RKAID)
                    ->groupBy('bulan1')
                    ->orderBy('bulan1','ASC')
                    ->get();
                    
        $triwulan1=0;
        $triwulan2=0;
        $triwulan3=0;
        $triwulan4=0;
        
        foreach ($data as $v) {
            switch ($v->bulan1) {
                case 1 :
                case 2 :
                case 3 :                        
                    $triwulan1+=$v->target;
                break;
                case 4 :
                case 5 :
                case 6 :                        
                    $triwulan2+=$v->target;
                break;
                case 7 :
                case 8 :
                case 9 :
                    $triwulan3+=$v->target;
                break;
                case 10 :
                case 11 :
                case 12 :
                    $triwulan4+=$v->target;
                break;
            }
        }
        $row_awal=$row;
        $sheet->setCellValue("F$row",'TRIWULAN I');
        $sheet->mergeCells("G$row:H$row");
        $sheet->setCellValue("G$row",Helper::formatUang($triwulan1));
        
        $sheet->mergeCells("N$row:P$row");
        $sheet->setCellValue("N$row",'Pengguna Anggaran');
        
        $sheet->mergeCells("T$row:V$row");
        $sheet->setCellValue("T$row",'Pejabat Pelaksana Teknis Kegiatan');                
        $row+=1;               
        $sheet->setCellValue("F$row",'TRIWULAN II');
        $sheet->mergeCells("G$row:H$row");
        $sheet->setCellValue("G$row",Helper::formatUang($triwulan2));
        $row+=1;               
        $sheet->setCellValue("F$row",'TRIWULAN III');
        $sheet->mergeCells("G$row:H$row");
        $sheet->setCellValue("G$row",Helper::formatUang($triwulan3));
        $row+=1;               
        $sheet->setCellValue("F$row",'TRIWULAN IV');
        $sheet->mergeCells("G$row:H$row");
        $sheet->setCellValue("G$row",Helper::formatUang($triwulan4));
        $styleArray=array(  
                            'borders' => array('bottom' => array('style' => Border::BORDER_THIN))
                        );																					 
        $sheet->getStyle("F$row:H$row")->applyFromArray($styleArray);
        $row+=1;               
        $totalalltriwulan=$triwulan1+$triwulan2+$triwulan3+$triwulan4;
        $sheet->setCellValue("F$row",'TOTAL');
        $sheet->mergeCells("G$row:H$row");
        $sheet->setCellValue("G$row",Helper::formatUang($totalalltriwulan));
        
        $styleArray=array(								
                            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_RIGHT)
                        );																					 
        $sheet->getStyle("G$row_awal:G$row")->applyFromArray($styleArray);
        
        
        $row+=2;
        $sheet->mergeCells("N$row:P$row");
        $sheet->setCellValue("N$row",$datakegiatan['nama_pa']);           
        
        $sheet->mergeCells("T$row:V$row");
        $sheet->setCellValue("T$row",$datakegiatan['nama_pptk']);
        $row+=1;
        $sheet->mergeCells("N$row:P$row");
        $sheet->setCellValue("N$row",'Nip.'.Helper::formatNIP($datakegiatan['nip_pa']));
        
        $sheet->mergeCells("T$row:V$row");
        $sheet->setCellValue("T$row",'Nip.'.Helper::formatNIP($datakegiatan['nip_pptk']));
    }
}