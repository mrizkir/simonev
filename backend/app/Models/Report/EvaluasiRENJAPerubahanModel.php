<?php

namespace App\Models\Report;

use App\Helpers\Helper;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class EvaluasiRENJAPerubahanModel extends ReportModel
{   
    public function __construct($dataReport,$print=true)
    {
        parent::__construct($dataReport); 
        $this->spreadsheet->getProperties()->setTitle("Laporan Evaluasi Renja Tahun ".$this->dataReport['tahun']);
        $this->spreadsheet->getProperties()->setSubject("Laporan Evaluasi Renja Tahun ".$this->dataReport['tahun']); 
        if ($print)
        {
            $this->print();             
        }        
    }    
    private function print()  
    {
        $kode_organisasi=$this->dataReport['kode_organisasi'];        
        $tahun = $this->dataReport['tahun'];       
        $tahun_akhir_renstra=2021;

        $sheet = $this->spreadsheet->getActiveSheet();        
        $sheet->setTitle ('LAPORAN EVALUASI RENJA MURNI');

        $sheet->getParent()->getDefaultStyle()->applyFromArray([
            'font' => [
                'name' => 'Arial',
                'size' => '9',
            ],
        ]);
        
        $row=1;        
        $sheet->mergeCells("A$row:Y$row");		
        $sheet->setCellValue("A$row",'Evaluasi Terhadap Hasil Renja Perangkat Daerah');         
        $row+=1;                
        $sheet->mergeCells("A$row:Y$row");		
        $sheet->setCellValue("A$row",$this->dataReport['OrgNm']. ' Kabupaten Bintan');         
        $row+=1;        
        $sheet->mergeCells("A$row:Y$row");		
        $sheet->setCellValue("A$row","Periode Pelaksanaan $tahun");         
        
        $styleArray=array( 
            'font' => array('bold' => true,'size'=>'11'),
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                               'vertical'=>Alignment::HORIZONTAL_CENTER),								
        );   
        $sheet->getStyle("A1:A$row")->applyFromArray($styleArray);


        $row+=2;        
        $sheet->mergeCells("A$row:Y$row");		
        $sheet->setCellValue("A$row","Indikator dan target kinerja yang mengacu pada sasaran RKPD :");         
        $row+=2;        
        $sheet->mergeCells("A$row:Y$row");		

        $row+=2;     
        $row_awal_header=$row;   
        $row_akhir=$row+1;
        $sheet->mergeCells("A$row:A$row_akhir");
        $sheet->setCellValue("A$row",'NO');                        
        $sheet->mergeCells("B$row:B$row_akhir");
        $sheet->setCellValue("B$row",'SASARAN');
        
        $sheet->mergeCells("C$row:C$row_akhir");
        $sheet->setCellValue("C$row",'Program/Kegiatan');
        $sheet->mergeCells("D$row:D$row_akhir");
        $sheet->setCellValue("D$row",'Indikator Kinerja Program (Outcome)/Kegiatan (Output)');
        $sheet->mergeCells("E$row:F$row_akhir");
        $sheet->setCellValue("E$row",'Target RENSTRA Tahun '.$tahun_akhir_renstra);
        $sheet->mergeCells("G$row:H$row_akhir");
        $sheet->setCellValue("G$row",'Realisasi Capaian Kinerja RENSTRA s/d Renja Tahun Lalu ('.($tahun-1).')');                
        $sheet->mergeCells("I$row:J$row_akhir");
        $sheet->setCellValue("I$row",'Target Kinerja dan Anggaran Renja Tahun Berjalan (N-1) yang Dievaluasi');                

        $sheet->mergeCells("K$row:R$row");        
        $sheet->setCellValue("K$row",'Realisasi Kinerja pada Triwulan'); 
        $sheet->mergeCells("K$row_akhir:L$row_akhir");
        $sheet->setCellValue("K$row_akhir",'I');
        $sheet->mergeCells("M$row_akhir:N$row_akhir");
        $sheet->setCellValue("M$row_akhir",'II');
        $sheet->mergeCells("O$row_akhir:P$row_akhir");
        $sheet->setCellValue("O$row_akhir",'III');
        $sheet->mergeCells("Q$row_akhir:R$row_akhir");
        $sheet->setCellValue("Q$row_akhir",'IV');

        $sheet->mergeCells("S$row:T$row_akhir");
        $sheet->setCellValue("S$row","Realisasi Capaian Kinerja dan Anggaran Renja"); 

        $sheet->mergeCells("U$row:V$row_akhir");
        $sheet->setCellValue("U$row","Realisasi Kinerja dan Anggaran Renstra s/d Tahun $tahun");                

        $sheet->mergeCells("W$row:X$row_akhir");
        $sheet->setCellValue("W$row","Tingkat Capaian Kinerja dan Realisasi Anggaran Renstra s/d Tahun $tahun");                
        $sheet->mergeCells("Y$row:Y$row_akhir");
        $sheet->setCellValue("Y$row","Perangkat Daerah Penanggung Jawab");  

        $row+=2;
        $row_akhir=$row+1;
        $sheet->mergeCells("A$row:A$row_akhir");
        $sheet->setCellValue("A$row",'1');                
        $sheet->mergeCells("B$row:B$row_akhir");
        $sheet->setCellValue("B$row",'2');                
        
        $sheet->mergeCells("C$row:C$row_akhir");
        $sheet->setCellValue("C$row",'4');                
        $sheet->mergeCells("D$row:D$row_akhir");
        $sheet->setCellValue("D$row",'5');                
        $sheet->mergeCells("E$row:F$row");
        $sheet->setCellValue("E$row",'6');                
        $sheet->mergeCells("G$row:H$row");
        $sheet->setCellValue("G$row",'7');                
        $sheet->mergeCells("I$row:J$row");
        $sheet->setCellValue("I$row",'8');                
        $sheet->mergeCells("K$row:L$row");
        $sheet->setCellValue("K$row",'9');                
        $sheet->mergeCells("M$row:N$row");
        $sheet->setCellValue("M$row",'10');                
        $sheet->mergeCells("O$row:P$row");
        $sheet->setCellValue("O$row",'11');                
        $sheet->mergeCells("Q$row:R$row");
        $sheet->setCellValue("Q$row",'12');                
        $sheet->mergeCells("S$row:T$row");
        $sheet->setCellValue("S$row",'13');                
        $sheet->mergeCells("U$row:V$row");
        $sheet->setCellValue("U$row",'14');                
        $sheet->mergeCells("W$row:X$row");
        $sheet->setCellValue("W$row",'15');                
        $sheet->mergeCells("Y$row:Y$row_akhir");
        $sheet->setCellValue("Y$row",'16');                
        $row+=1;
        $sheet->setCellValue("E$row",'K');                
        $sheet->setCellValue("F$row",'Rp');                
        $sheet->setCellValue("G$row",'K');                
        $sheet->setCellValue("H$row",'Rp');                
        $sheet->setCellValue("I$row",'K');                
        $sheet->setCellValue("J$row",'Rp');                
        $sheet->setCellValue("K$row",'K');                
        $sheet->setCellValue("L$row",'Rp');                
        $sheet->setCellValue("M$row",'K');                
        $sheet->setCellValue("N$row",'Rp');                
        $sheet->setCellValue("O$row",'K');                
        $sheet->setCellValue("P$row",'Rp');                
        $sheet->setCellValue("Q$row",'K');                
        $sheet->setCellValue("R$row",'Rp');                
        $sheet->setCellValue("S$row",'K');                
        $sheet->setCellValue("T$row",'Rp');                
        $sheet->setCellValue("U$row",'K');                
        $sheet->setCellValue("V$row",'Rp');                
        $sheet->setCellValue("W$row",'K');                
        $sheet->setCellValue("X$row",'Rp');                
        
        $sheet->getRowDimension(6)->setRowHeight(30);
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(27);                        
        $sheet->getColumnDimension('C')->setWidth(50);    
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(10);                
        $sheet->getColumnDimension('F')->setWidth(20);                
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(10); 
        $sheet->getColumnDimension('J')->setWidth(20);                
        $sheet->getColumnDimension('K')->setWidth(10);
        $sheet->getColumnDimension('L')->setWidth(20);
        $sheet->getColumnDimension('M')->setWidth(10);
        $sheet->getColumnDimension('N')->setWidth(20);
        $sheet->getColumnDimension('O')->setWidth(10);
        $sheet->getColumnDimension('P')->setWidth(20);
        $sheet->getColumnDimension('Q')->setWidth(10);
        $sheet->getColumnDimension('R')->setWidth(20);
        $sheet->getColumnDimension('S')->setWidth(10);
        $sheet->getColumnDimension('T')->setWidth(20);
        $sheet->getColumnDimension('U')->setWidth(10);
        $sheet->getColumnDimension('V')->setWidth(20);
        $sheet->getColumnDimension('W')->setWidth(10);
        $sheet->getColumnDimension('X')->setWidth(25);
        $sheet->getColumnDimension('Y')->setWidth(30);
        
        $styleArray=array(
                        'font' => array('bold' => true),
                        'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                                            'vertical'=>Alignment::HORIZONTAL_CENTER),
                        'borders' => array('allBorders' => array('borderStyle' =>Border::BORDER_THIN))
                    );
        $sheet->getStyle("A$row_awal_header:Y$row")->applyFromArray($styleArray);
        $sheet->getStyle("A$row_awal_header:Y$row")->getAlignment()->setWrapText(true);
        
        $totalPaguOPD = (float)\DB::table('trRKA')
                                    ->where('kode_organisasi',$kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',2)
                                    ->sum('PaguDana2');        

        $total_kegiatan=0;
        $total_uraian=0;
        $totalPersenTargetFisik=0;
        $totalFisikTW1=0;
        $totalKeuanganTW1=0;
        $totalFisikTW2=0;
        $totalKeuanganTW2=0;
        $totalFisikTW3=0;
        $totalKeuanganTW3=0;
        $totalFisikTW4=0;
        $totalKeuanganTW4=0;

        $daftar_program=\DB::table('simda')
                            ->select(\DB::raw('DISTINCT kode_program,"PrgNm"'))
                            ->orderBy('kode_program','ASC')
                            ->where('kode_organisasi',$kode_organisasi)
                            ->where('EntryLvl',2)
                            ->get();
        $row+=1;
        $row_awal=$row;   
        foreach ($daftar_program as $data_program)
        {
            $kode_program = $data_program->kode_program;
            $daftar_kegiatan = \DB::table('trRKA')
                                    ->select(\DB::raw('"RKAID","kode_kegiatan","KgtNm",capaian_program2,tk_capaian2,keluaran2,hasil2,tk_keluaran2,tk_hasil2,"PaguDana2","lokasi_kegiatan2"'))
                                    ->where('kode_program',$kode_program)                                            
                                    ->where('kode_organisasi',$kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',2)
                                    ->orderBy('kode_kegiatan','ASC')
                                    ->get();

            $jumlahuraian_program = \DB::table('trRKARinc')                                        
                                        ->join('trRKA','trRKA.RKAID','trRKARinc.RKAID')
                                        ->where('kode_program',$kode_program) 
                                        ->where('kode_organisasi',$kode_organisasi)
                                        ->where('trRKA.TA',$tahun)                                            
                                        ->where('trRKA.EntryLvl',2)
                                        ->count();	
                
            $data_target_program=\DB::table('trRKATargetRinc')
                                    ->join('trRKA','trRKA.RKAID','trRKATargetRinc.RKAID')
                                    ->select(\DB::raw('COALESCE(SUM(target2),0) AS totaltarget, COALESCE(SUM(fisik2),0) AS jumlah_fisik'))
                                    ->where('kode_program',$kode_program) 
                                    ->where('kode_organisasi',$kode_organisasi)
                                    ->where('trRKA.TA',$tahun)                                        
                                    ->where('trRKA.EntryLvl',2)
                                    ->get();

            //menghitung persen target fisik program         
            $target_fisik_program=Helper::formatPecahan($data_target_program[0]->jumlah_fisik,$jumlahuraian_program);                            
            $persen_target_fisik_program= $target_fisik_program > 100 ?'100.00':$target_fisik_program;

            if(isset($daftar_kegiatan[0]))
            {
                $totalpagueachprogram=$daftar_kegiatan->sum('PaguDana2');
                  
                $data_realisasi_tw1=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->join('trRKA','trRKARealisasiRinc.RKAID','trRKA.RKAID')
                                            ->where('kode_program',$kode_program) 
                                            ->where('kode_organisasi',$kode_organisasi)
                                            ->where('bulan2','>=',1)                            
                                            ->where('bulan2','<=',3)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();
                
                $fisik_tw_1=Helper::formatPecahan($data_realisasi_tw1[0]->fisik2,$jumlahuraian_program);
                $fisik_tw_1=Helper::formatPecahan($fisik_tw_1,5); 
                $keuangan_tw_1=$data_realisasi_tw1[0]->realisasi2;
                
                $data_realisasi_tw2=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->join('trRKA','trRKARealisasiRinc.RKAID','trRKA.RKAID')
                                            ->where('kode_program',$kode_program) 
                                            ->where('kode_organisasi',$kode_organisasi)
                                            ->where('bulan2','>=',4)                            
                                            ->where('bulan2','<=',6)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();
                
                $fisik_tw_2=Helper::formatPecahan($data_realisasi_tw2[0]->fisik2,$jumlahuraian_program);
                $fisik_tw_2=Helper::formatPecahan($fisik_tw_2,5); 
                $keuangan_tw_2=$data_realisasi_tw2[0]->realisasi2;

                $data_realisasi_tw3=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->join('trRKA','trRKARealisasiRinc.RKAID','trRKA.RKAID')
                                            ->where('kode_program',$kode_program) 
                                            ->where('kode_organisasi',$kode_organisasi)
                                            ->where('bulan2','>=',7)                            
                                            ->where('bulan2','<=',9)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();
                
                $fisik_tw_3=Helper::formatPecahan($data_realisasi_tw3[0]->fisik2,$jumlahuraian_program);
                $fisik_tw_3=Helper::formatPecahan($fisik_tw_3,5); 
                $keuangan_tw_3=$data_realisasi_tw3[0]->realisasi2;

                $data_realisasi_tw4=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->join('trRKA','trRKARealisasiRinc.RKAID','trRKA.RKAID')
                                            ->where('kode_program',$kode_program) 
                                            ->where('kode_organisasi',$kode_organisasi)
                                            ->where('bulan2','>=',10)                            
                                            ->where('bulan2','<=',12)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();
                
                $fisik_tw_4=Helper::formatPecahan($data_realisasi_tw4[0]->fisik2,$jumlahuraian_program);
                $fisik_tw_4=Helper::formatPecahan($fisik_tw_4,5); 
                $keuangan_tw_4=$data_realisasi_tw4[0]->realisasi2;

                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'b5d6e5',
                        ],
                    ],
                ];                
                $sheet->getStyle("A$row:Y$row")->applyFromArray($styleArray);
                                
                $sheet->setCellValue("C$row",$data_program->PrgNm);
                $indikator_kinerja=empty(trim($daftar_kegiatan[0]->capaian_program2))?'':$daftar_kegiatan[0]->capaian_program2.' ('.$daftar_kegiatan[0]->tk_capaian2.'%)';
                $sheet->setCellValue("D$row",$indikator_kinerja);

                $sheet->setCellValue("J$row",Helper::formatUang($totalpagueachprogram));
                
                $sheet->setCellValue("K$row",$fisik_tw_1);
                $sheet->setCellValue("L$row",Helper::formatUang($keuangan_tw_1));
                $sheet->setCellValue("M$row",$fisik_tw_2);
                $sheet->setCellValue("N$row",Helper::formatUang($keuangan_tw_2));
                $sheet->setCellValue("O$row",$fisik_tw_3);
                $sheet->setCellValue("P$row",Helper::formatUang($keuangan_tw_3));
                $sheet->setCellValue("Q$row",$fisik_tw_4);
                $sheet->setCellValue("R$row",Helper::formatUang($keuangan_tw_4));
                $total_w_fisik=$fisik_tw_1+$fisik_tw_2+$fisik_tw_3+$fisik_tw_4;
                $sheet->setCellValue("S$row",$total_w_fisik);
                $total_x_keuangan=$keuangan_tw_1+$keuangan_tw_2+$keuangan_tw_3+$keuangan_tw_4;
                $sheet->setCellValue("T$row",Helper::formatUang($total_x_keuangan));
                $sheet->setCellValue("Y$row",$this->dataReport['OrgNm']);

                $row+=1;  

                foreach ($daftar_kegiatan as $n)
                {
                    $RKAID=$n->RKAID;
                    $nilai_pagu_proyek=$n->PaguDana2;      

                    //jumlah baris uraian
                    $jumlahuraian = \DB::table('trRKARinc')->where('RKAID',$RKAID)->count();	
                    $total_uraian+=$jumlahuraian;

                    $data_target=\DB::table('trRKATargetRinc')
                                        ->select(\DB::raw('COALESCE(SUM(target2),0) AS totaltarget, COALESCE(SUM(fisik2),0) AS jumlah_fisik'))
                                        ->where('RKAID',$RKAID)                                    
                                        ->get();

                    $data_realisasi_tw1=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKAID',$RKAID)    
                                            ->where('bulan2','>=',1)                            
                                            ->where('bulan2','<=',3)   
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                                
                                            ->get();

                    $fisik_tw_1=Helper::formatPecahan($data_realisasi_tw1[0]->fisik2,$jumlahuraian);
                    $fisik_tw_1=Helper::formatPecahan($fisik_tw_1,5); 
                    $keuangan_tw_1=$data_realisasi_tw1[0]->realisasi2;
                    $totalFisikTW1+=$fisik_tw_1;
                    $totalKeuanganTW1+=$keuangan_tw_1;

                    $data_realisasi_tw2=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKAID',$RKAID)    
                                            ->where('bulan2','>=',4)                            
                                            ->where('bulan2','<=',6)     
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                       
                                            ->get();

                    $fisik_tw_2=Helper::formatPecahan($data_realisasi_tw2[0]->fisik2,$jumlahuraian);
                    $fisik_tw_2=Helper::formatPecahan($fisik_tw_2,5); 
                    $keuangan_tw_2=$data_realisasi_tw2[0]->realisasi2;
                    $totalFisikTW2+=$fisik_tw_2;
                    $totalKeuanganTW2+=$keuangan_tw_2;

                    $data_realisasi_tw3=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKAID',$RKAID)    
                                            ->where('bulan2','>=',7)                            
                                            ->where('bulan2','<=',9)    
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                               
                                            ->get();

                    $fisik_tw_3=Helper::formatPecahan($data_realisasi_tw3[0]->fisik2,$jumlahuraian);
                    $fisik_tw_3=Helper::formatPecahan($fisik_tw_3,5); 
                    $keuangan_tw_3=$data_realisasi_tw3[0]->realisasi2;
                    $totalFisikTW3+=$fisik_tw_3;
                    $totalKeuanganTW3+=$keuangan_tw_3;

                    $data_realisasi_tw4=\DB::table('trRKARealisasiRinc')
                                            ->select(\DB::raw('COALESCE(SUM(realisasi2),0) AS realisasi2, COALESCE(SUM(fisik2),0) AS fisik2'))
                                            ->where('RKAID',$RKAID)    
                                            ->where('bulan2','>=',10)                            
                                            ->where('bulan2','<=',12)      
                                            ->where('trRKARealisasiRinc.EntryLvl',2)                                             
                                            ->get();
                    $fisik_tw_4=Helper::formatPecahan($data_realisasi_tw4[0]->fisik2,$jumlahuraian);
                    $fisik_tw_4=Helper::formatPecahan($fisik_tw_4,5); 
                    $keuangan_tw_4=$data_realisasi_tw4[0]->realisasi2;
                    $totalFisikTW4+=$fisik_tw_4;
                    $totalKeuanganTW4+=$keuangan_tw_4;

                    //menghitung persen target fisik         
                    $target_fisik=Helper::formatPecahan($data_target[0]->jumlah_fisik,$jumlahuraian);                            
                    $persen_target_fisik= $target_fisik > 100 ?'100.00':$target_fisik;
                    $totalPersenTargetFisik+=$persen_target_fisik;               

                    $indikator_kinerja=empty(trim($n->hasil2))?'':$n->hasil2.' ('.$n->tk_hasil2.')';
                    $sheet->setCellValue("B$row",$indikator_kinerja);
                    $rekening=explode('.',$n->kode_kegiatan);                    
                    $sheet->setCellValue("C$row",$n->KgtNm);
                    $indikator_kinerja=empty(trim($n->keluaran2))?'':$n->keluaran2.' ('.$n->tk_keluaran2.')';
                    $sheet->setCellValue("D$row",$indikator_kinerja);
                    $sheet->setCellValue("J$row",Helper::formatUang($nilai_pagu_proyek));

                    $sheet->setCellValue("K$row",$fisik_tw_1);
                    $sheet->setCellValue("L$row",Helper::formatUang($keuangan_tw_1));
                    $sheet->setCellValue("M$row",$fisik_tw_2);
                    $sheet->setCellValue("N$row",Helper::formatUang($keuangan_tw_2));
                    $sheet->setCellValue("O$row",$fisik_tw_3);
                    $sheet->setCellValue("P$row",Helper::formatUang($keuangan_tw_3));
                    $sheet->setCellValue("Q$row",$fisik_tw_4);
                    $sheet->setCellValue("R$row",Helper::formatUang($keuangan_tw_4));
                    $total_w_fisik=$fisik_tw_1+$fisik_tw_2+$fisik_tw_3+$fisik_tw_4;
                    $sheet->setCellValue("S$row",$total_w_fisik);
                    $total_x_keuangan=$keuangan_tw_1+$keuangan_tw_2+$keuangan_tw_3+$keuangan_tw_4;
                    $sheet->setCellValue("T$row",Helper::formatUang($total_x_keuangan));
                    $sheet->setCellValue("Y$row",$this->dataReport['OrgNm']);

                    $total_kegiatan+=1;
                    $row+=1;
                }            
            }
        }
        $totalPersenTargetFisik = Helper::formatPecahan($totalPersenTargetFisik,$total_kegiatan); 
        $totalFisikTW1 = Helper::formatPecahan($totalFisikTW1,$total_kegiatan);         
        $totalFisikTW2 = Helper::formatPecahan($totalFisikTW2,$total_kegiatan);         
        $totalFisikTW3 = Helper::formatPecahan($totalFisikTW3,$total_kegiatan);         
        $totalFisikTW4 = Helper::formatPecahan($totalFisikTW4,$total_kegiatan); 

        $sheet->mergeCells("A$row:D$row");                
        $sheet->setCellValue("A$row",'Jumlah');                                       
        $sheet->setCellValue("J$row",Helper::formatUang($totalPaguOPD));
        
        $sheet->setCellValue("K$row",$totalFisikTW1);                                       
        $sheet->setCellValue("L$row",Helper::formatUang($totalKeuanganTW1));                                       
        $sheet->setCellValue("M$row",$totalFisikTW2);                                       
        $sheet->setCellValue("N$row",Helper::formatUang($totalKeuanganTW2));                                       
        $sheet->setCellValue("O$row",$totalFisikTW3);                                       
        $sheet->setCellValue("P$row",Helper::formatUang($totalKeuanganTW3));                                       
        $sheet->setCellValue("Q$row",$totalFisikTW4);                                       
        $sheet->setCellValue("R$row",Helper::formatUang($totalKeuanganTW4));                                       
        $total_w_fisik=$totalFisikTW1+$totalFisikTW2+$totalFisikTW3+$totalFisikTW4;
        $sheet->setCellValue("S$row",$total_w_fisik);
        $total_x_keuangan=$totalKeuanganTW1+$totalKeuanganTW2+$totalKeuanganTW3+$totalKeuanganTW4;
        $sheet->setCellValue("T$row",Helper::formatUang($total_x_keuangan));

        $styleArray=array(								
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                               'vertical'=>Alignment::HORIZONTAL_CENTER),
            'borders' => array('allBorders' => array('borderStyle' =>Border::BORDER_THIN))
        );   																					 
        $sheet->getStyle("A$row_awal:Y$row")->applyFromArray($styleArray);
        $sheet->getStyle("A$row_awal:Y$row")->getAlignment()->setWrapText(true);

        $styleArray=array(								
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_LEFT)
        );																					 
        $sheet->getStyle("B$row_awal:B$row")->applyFromArray($styleArray);
        $sheet->getStyle("C$row_awal:D$row")->applyFromArray($styleArray);
        $sheet->getStyle("Y$row_awal:Y$row")->applyFromArray($styleArray);
        // $sheet->getStyle("N$row_awal:O$row")->applyFromArray($styleArray);

        $styleArray=array(								
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_RIGHT)
        );																					 
        $sheet->getStyle("E$row_awal:V$row")->applyFromArray($styleArray);               
        // $sheet->getStyle("L$row_awal:M$row")->applyFromArray($styleArray);
    }
}