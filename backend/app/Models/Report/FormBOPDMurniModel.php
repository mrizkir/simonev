<?php

namespace App\Models\Report;

use App\Helpers\Helper;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class FormBOPDMurniModel extends ReportModel
{   
    public function __construct($dataReport,$print=true)
    {
        parent::__construct($dataReport); 
        $this->spreadsheet->getProperties()->setTitle("Laporan Form B Tahun ".$this->dataReport['tahun']);
        $this->spreadsheet->getProperties()->setSubject("Laporan Form B Tahun ".$this->dataReport['tahun']); 
        if ($print)
        {
            $this->print();             
        }        
    }    
    private function print()  
    {
        $kode_organisasi=$this->dataReport['kode_organisasi'];
        $no_bulan = $this->dataReport['no_bulan'];
        $nama_bulan = Helper::getNamaBulan($no_bulan);
        $tahun = $this->dataReport['tahun'];       

        $sheet = $this->spreadsheet->getActiveSheet();        
        $sheet->setTitle ('LAPORAN FORM B');

        $sheet->getParent()->getDefaultStyle()->applyFromArray([
            'font' => [
                'name' => 'Arial',
                'size' => '9',
            ],
        ]);
        
        $row=1;        
        $sheet->mergeCells("A$row:U$row");		
        $sheet->setCellValue("A$row",'LAPORAN FORM B');         
        $row+=1;        
        $sheet->mergeCells("A$row:U$row");		
        $sheet->setCellValue("A$row",strtoupper($this->dataReport['OrgNm']." [$kode_organisasi]"));         
        $row+=1;        
        $sheet->mergeCells("A$row:U$row");		
        $sheet->setCellValue("A$row",'KABUPATEN BINTAN');         
        
        $styleArray=array( 
            'font' => array('bold' => true,'size'=>'11'),
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                               'vertical'=>Alignment::HORIZONTAL_CENTER),								
        );   
        $sheet->getStyle("A1:A$row")->applyFromArray($styleArray);

        $row+=1;
        $sheet->setCellValue("A$row",'BULAN : '.Helper::getNamaBulan($this->dataReport['no_bulan']));                
        $row+=2;
        $row_akhir=$row+1;
        $sheet->mergeCells("A$row:A$row_akhir");
        $sheet->setCellValue("A$row",'NOMOR');                
        $sheet->mergeCells("B$row:B$row_akhir");
        $sheet->setCellValue("B$row",'KODE');
        $sheet->mergeCells("C$row:C$row_akhir");
        $sheet->setCellValue("C$row",'PROGRAM/KEGIATAN');
        $sheet->mergeCells("D$row:D$row_akhir");
        $sheet->setCellValue("D$row",'UNIT KERJA');
        $sheet->mergeCells("E$row:E$row_akhir");
        $sheet->setCellValue("E$row",'PAGU DANA (RP)');
        $sheet->mergeCells("F$row:F$row_akhir");
        $sheet->setCellValue("F$row",'BOBOT (%)');
        $sheet->mergeCells("G$row:I$row");
        $sheet->setCellValue("G$row",'FISIK');                
        $sheet->mergeCells("J$row:N$row");
        $sheet->setCellValue("J$row",'KEUANGAN'); 
        $sheet->mergeCells("O$row:O$row_akhir");
        $sheet->setCellValue("O$row",'LOKASI');
        $sheet->mergeCells("P$row:Q$row");
        $sheet->setCellValue("P$row",'SISA ANGGARAN');                 
        $sheet->mergeCells("R$row:U$row");
        $sheet->setCellValue("R$row",'INDIKATOR KINERJA KELUARAN (OUTPUT)');                 
        $row_akhir=$row+1;                
        $sheet->setCellValue("G$row_akhir",'TARGET (%)');                
        $sheet->setCellValue("H$row_akhir",'REALISASI (%)');  
        $sheet->setCellValue("I$row_akhir",'TTB (%)');
        $sheet->setCellValue("J$row_akhir",'TARGET (RP)');
        $sheet->setCellValue("K$row_akhir",'TARGET (%)');
        $sheet->setCellValue("L$row_akhir",'REALISASI (RP)');
        $sheet->setCellValue("M$row_akhir",'REALISASI (%)');
        $sheet->setCellValue("N$row_akhir",'TTB (%)');
        $sheet->setCellValue("P$row_akhir",'(RP)');
        $sheet->setCellValue("Q$row_akhir",'(%)');                
        $sheet->setCellValue("R$row_akhir",'NARASI'); 
        $sheet->setCellValue("S$row_akhir",'TARGET KINERJA'); 
        $sheet->setCellValue("T$row_akhir",'REALISASI KINERJA'); 
        $sheet->setCellValue("U$row_akhir",'(%)'); 
        $row_akhir=$row+2;
        $sheet->setCellValue("A$row_akhir",'1');                
        $sheet->setCellValue("B$row_akhir",'2');
        $sheet->setCellValue("C$row_akhir",'3');
        $sheet->setCellValue("D$row_akhir",'4');
        $sheet->setCellValue("E$row_akhir",'5');
        $sheet->setCellValue("F$row_akhir",'6');
        $sheet->setCellValue("G$row_akhir",'7');
        $sheet->setCellValue("H$row_akhir",'8');
        $sheet->setCellValue("I$row_akhir",'9');
        $sheet->setCellValue("J$row_akhir",'10');
        $sheet->setCellValue("K$row_akhir",'11');
        $sheet->setCellValue("L$row_akhir",'12');
        $sheet->setCellValue("M$row_akhir",'13');
        $sheet->setCellValue("N$row_akhir",'14');                          
        $sheet->setCellValue("O$row_akhir",'15');
        $sheet->setCellValue("P$row_akhir",'16');
        $sheet->setCellValue("Q$row_akhir",'17');
        $sheet->setCellValue("R$row_akhir",'18');
        $sheet->setCellValue("S$row_akhir",'19');            
        $sheet->setCellValue("T$row_akhir",'20'); 
        $sheet->setCellValue("U$row_akhir",'21'); 
        
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(15);                
        $sheet->getColumnDimension('C')->setWidth(50);
        $sheet->getColumnDimension('D')->setWidth(30);                
        $sheet->getColumnDimension('E')->setWidth(20);                
        $sheet->getColumnDimension('F')->setWidth(12);
        $sheet->getColumnDimension('G')->setWidth(12);    
        $sheet->getColumnDimension('H')->setWidth(17);
        $sheet->getColumnDimension('I')->setWidth(10);                
        $sheet->getColumnDimension('J')->setWidth(20);                
        $sheet->getColumnDimension('K')->setWidth(14);
        $sheet->getColumnDimension('L')->setWidth(20);
        $sheet->getColumnDimension('M')->setWidth(15); 
        $sheet->getColumnDimension('N')->setWidth(10);                
        $sheet->getColumnDimension('O')->setWidth(17);
        $sheet->getColumnDimension('P')->setWidth(20);
        $sheet->getColumnDimension('Q')->setWidth(10);
        $sheet->getColumnDimension('R')->setWidth(30);
        $sheet->getColumnDimension('S')->setWidth(11);
        $sheet->getColumnDimension('T')->setWidth(9);
        $sheet->getColumnDimension('U')->setWidth(9);
        
        $styleArray=array(
                        'font' => array('bold' => true),
                        'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                                            'vertical'=>Alignment::HORIZONTAL_CENTER),
                        'borders' => array('allBorders' => array('borderStyle' =>Border::BORDER_THIN))
                    );
        $sheet->getStyle("A$row:U$row_akhir")->applyFromArray($styleArray);
        $sheet->getStyle("A$row:U$row_akhir")->getAlignment()->setWrapText(true);
        
        
        $totalPaguUnit = (float)\DB::table('trRKA')
                                    ->where('kode_organisasi',$kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',1)
                                    ->sum('PaguDana1');        
        
        $no_huruf=ord('A');
        $total_kegiatan=0;
        $total_uraian=0;
        $totalPersenBobot=0;
        $totalPersenTargetFisik=0;
        $totalPersenRealisasiFisik=0;
        $total_ttb_fisik=0;
        $totalTargetKeuanganKeseluruhan=0;
        $totalRealisasiKeuanganKeseluruhan=0;
        $total_ttb_keuangan=0;
        $totalSisaAnggaran=0;

        $daftar_program=\DB::table('simda')
                            ->select(\DB::raw('DISTINCT kode_program,"PrgNm"'))
                            ->orderBy('kode_program','ASC')
                            ->where('kode_organisasi',$kode_organisasi)
                            ->get();
        
        $row=$row_akhir+1;
        $row_awal=$row;        
        foreach ($daftar_program as $data_program)
        {
            $kode_program = $data_program->kode_program;
            $daftar_kegiatan = \DB::table('trRKA')
                                    ->select(\DB::raw('"RKAID","kode_kegiatan","KgtNm","PaguDana1","lokasi_kegiatan1","SOrgNm"'))
                                    ->where('kode_program',$kode_program)                                            
                                    ->where('kode_organisasi',$kode_organisasi)                                            
                                    ->where('TA',$tahun)  
                                    ->where('EntryLvl',1)
                                    ->orderBy('kode_kegiatan','ASC')
                                    ->orderBy('SOrgNm','ASC')
                                    ->get();

            if(isset($daftar_kegiatan[0]))
            {
                $totalpagueachprogram=$daftar_kegiatan->sum('PaguDana1');
                $persen_bobot_program=Helper::formatPersen($totalpagueachprogram,$totalPaguUnit,4);
                
                $jumlahuraian_program = \DB::table('trRKARinc')                                        
                                        ->join('trRKA','trRKA.RKAID','trRKARinc.RKAID')
                                        ->where('kode_program',$kode_program) 
                                        ->where('kode_organisasi',$kode_organisasi)
                                        ->where('trRKA.TA',$tahun)                                            
                                        ->where('trRKA.EntryLvl',1)
                                        ->count();	
                
                $data_target_program=\DB::table('trRKATargetRinc')
                                    ->join('trRKA','trRKA.RKAID','trRKATargetRinc.RKAID')
                                    ->select(\DB::raw('COALESCE(SUM(target1),0) AS totaltarget, COALESCE(SUM(fisik1),0) AS jumlah_fisik'))
                                    ->where('kode_program',$kode_program) 
                                    ->where('kode_organisasi',$kode_organisasi)
                                    ->where('trRKA.TA',$tahun)    
                                    ->where('bulan1','<=',$no_bulan)
                                    ->where('trRKA.EntryLvl',1)
                                    ->get();

                $data_realisasi_program=\DB::table('trRKARealisasiRinc')
                                ->join('trRKA','trRKA.RKAID','trRKARealisasiRinc.RKAID')
                                ->select(\DB::raw('COALESCE(SUM(realisasi1),0) AS realisasi1, COALESCE(SUM(fisik1),0) AS fisik1'))
                                ->where('kode_program',$kode_program) 
                                ->where('kode_organisasi',$kode_organisasi)
                                ->where('trRKA.TA',$tahun)    
                                ->where('bulan1','<=',$no_bulan)
                                ->where('trRKA.EntryLvl',1)
                                ->get();

                //menghitung persen target fisik program         
                $target_fisik_program=Helper::formatPecahan($data_target_program[0]->jumlah_fisik,$jumlahuraian_program);                            
                $persen_target_fisik_program= $target_fisik_program > 100 ?'100.00':$target_fisik_program;                             
                
                //menghitung persen realisasi fisik                
                $persen_realisasi_fisik_program=Helper::formatPecahan($data_realisasi_program[0]->fisik1,$jumlahuraian_program);
                
                $persen_tertimbang_fisik_program=0.00;
                if ($persen_realisasi_fisik_program > 0 && $persen_bobot_program > 0)
                {
                    $persen_tertimbang_fisik_program=number_format(($persen_realisasi_fisik_program*$persen_bobot_program)/100,3);                            
                }							

                // menghitung total target dan realisasi keuangan                 
                $persen_target_keuangan_program=Helper::formatPersen($data_target_program[0]->totaltarget,$totalpagueachprogram); 
                $persen_realisasi_keuangan_program=Helper::formatPersen($data_realisasi_program[0]->realisasi1,$totalpagueachprogram);  

                $persen_tertimbang_keuangan_program=0.00;
                if ($persen_realisasi_keuangan_program > 0 && $persen_bobot_program > 0)
                {
                    $persen_tertimbang_keuangan_program=number_format(($persen_realisasi_keuangan_program*$persen_bobot_program)/100,3);                            
                }	

                $sisa_anggaran_program=$totalpagueachprogram-$data_realisasi_program[0]->realisasi1;
                $persen_sisa_anggaran_program=Helper::formatPersen($sisa_anggaran_program,$totalpagueachprogram);  

                $sheet->setCellValue("A$row",chr($no_huruf));                                                  
                $sheet->setCellValue("B$row",$kode_program);  
                $sheet->setCellValue("C$row",$data_program->PrgNm);  
                
                $sheet->setCellValue("E$row",Helper::formatUang($totalpagueachprogram));  
                $sheet->setCellValue("F$row",$persen_bobot_program);  
                $sheet->setCellValue("G$row",$persen_target_fisik_program);  
                $sheet->setCellValue("H$row",$persen_realisasi_fisik_program);  
                $sheet->setCellValue("I$row",$persen_tertimbang_fisik_program);  
                $sheet->setCellValue("J$row",Helper::formatUang($data_target_program[0]->totaltarget));  
                $sheet->setCellValue("K$row",$persen_target_keuangan_program);  
                $sheet->setCellValue("L$row",Helper::formatUang($data_realisasi_program[0]->realisasi1));  
                $sheet->setCellValue("M$row",$persen_realisasi_keuangan_program);  
                $sheet->setCellValue("N$row",$persen_tertimbang_keuangan_program);  
                $sheet->setCellValue("O$row",'-');  
                $sheet->setCellValue("P$row",Helper::formatUang($sisa_anggaran_program));  
                $sheet->setCellValue("Q$row",$persen_sisa_anggaran_program); 

                
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
                
                $sheet->getStyle("A$row:U$row")->applyFromArray($styleArray);

                $no=1;
                $row+=1;
                foreach ($daftar_kegiatan as $n)
                {
                    $RKAID=$n->RKAID;
                    $nilai_pagu_proyek=$n->PaguDana1;
                    $persen_bobot=Helper::formatPersen($nilai_pagu_proyek,$totalPaguUnit,4);
                    $totalPersenBobot+=$persen_bobot;

                    //jumlah baris uraian
                    $jumlahuraian = \DB::table('trRKARinc')->where('RKAID',$RKAID)->count();	
                    $total_uraian+=$jumlahuraian;

                    $data_target=\DB::table('trRKATargetRinc')
                                        ->select(\DB::raw('COALESCE(SUM(target1),0) AS totaltarget, COALESCE(SUM(fisik1),0) AS jumlah_fisik'))
                                        ->where('RKAID',$RKAID)
                                        ->where('bulan1','<=',$no_bulan)
                                        ->get();

                    $data_realisasi=\DB::table('trRKARealisasiRinc')
                                    ->select(\DB::raw('COALESCE(SUM(realisasi1),0) AS realisasi1, COALESCE(SUM(fisik1),0) AS fisik1'))
                                    ->where('RKAID',$RKAID)
                                    ->where('bulan1','<=',$no_bulan)
                                    ->get();

                    //menghitung persen target fisik         
                    $target_fisik=Helper::formatPecahan($data_target[0]->jumlah_fisik,$jumlahuraian);                            
                    $persen_target_fisik= $target_fisik > 100 ?'100.00':$target_fisik;
                    $totalPersenTargetFisik+=$persen_target_fisik;               

                    //menghitung persen realisasi fisik                
                    $persen_realisasi_fisik=Helper::formatPecahan($data_realisasi[0]->fisik1,$jumlahuraian);
                    $totalPersenRealisasiFisik+=$persen_realisasi_fisik; 
                    
                    $persen_tertimbang_fisik=0.00;
                    if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                    {
                        $persen_tertimbang_fisik=number_format(($persen_realisasi_fisik*$persen_bobot)/100,3);                            
                    }							
                    $total_ttb_fisik+=$persen_tertimbang_fisik;

                    //menghitung total target dan realisasi keuangan 
                    $totalTargetKeuangan=$data_target[0]->totaltarget;
                    $totalTargetKeuanganKeseluruhan+=$totalTargetKeuangan;
                    $persen_target_keuangan=Helper::formatPersen($totalTargetKeuangan,$nilai_pagu_proyek);                            							                                 
                    
                    $totalRealisasiKeuangan=$data_realisasi[0]->realisasi1;
                    $totalRealisasiKeuanganKeseluruhan+=$totalRealisasiKeuangan;
                    $persen_realisasi_keuangan=Helper::formatPersen($totalRealisasiKeuangan,$nilai_pagu_proyek);  
                    
                    $persen_tertimbang_keuangan=0.00;
                    if ($persen_realisasi_fisik > 0 && $persen_bobot > 0)
                    {
                        $persen_tertimbang_keuangan=number_format(($persen_realisasi_keuangan*$persen_bobot)/100,3);                            
                    }	
                    $total_ttb_keuangan += $persen_tertimbang_keuangan;

                    $sisa_anggaran=$nilai_pagu_proyek-$totalRealisasiKeuangan;
                    $totalSisaAnggaran+=$sisa_anggaran; 
                    
                    $persen_sisa_anggaran=Helper::formatPersen($sisa_anggaran,$nilai_pagu_proyek);                            

                    $sheet->setCellValue("A$row",$no);                                                  
                    $sheet->setCellValue("B$row",$n->kode_kegiatan);  
                    $sheet->setCellValue("C$row",$n->KgtNm);  
                    $sheet->setCellValue("D$row",$n->SOrgNm);  
                    $sheet->setCellValue("E$row",Helper::formatUang($nilai_pagu_proyek));  
                    $sheet->setCellValue("F$row",$persen_bobot);  
                    $sheet->setCellValue("G$row",$persen_target_fisik);  
                    $sheet->setCellValue("H$row",$persen_realisasi_fisik);  
                    $sheet->setCellValue("I$row",$persen_tertimbang_fisik);  
                    $sheet->setCellValue("J$row",Helper::formatUang($totalTargetKeuangan));  
                    $sheet->setCellValue("K$row",$persen_target_keuangan);  
                    $sheet->setCellValue("L$row",Helper::formatUang($totalRealisasiKeuangan));  
                    $sheet->setCellValue("M$row",$persen_realisasi_keuangan);  
                    $sheet->setCellValue("N$row",$persen_tertimbang_keuangan);  
                    $sheet->setCellValue("O$row",$n->lokasi_kegiatan1);  
                    $sheet->setCellValue("P$row",Helper::formatUang($sisa_anggaran));  
                    $sheet->setCellValue("Q$row",$persen_sisa_anggaran); 
                    $no+=1;
                    $total_kegiatan+=1;
                    $row+=1;
                }
            }
            $no_huruf+=1;  
            $row+=1;
        }
        
        if ($totalPersenBobot > 100) {
            $totalPersenBobot = 100.00;
        }
        $totalPersenTargetFisik = Helper::formatPecahan($totalPersenTargetFisik,$total_kegiatan);        
        $totalPersenRealisasiFisik=Helper::formatPecahan($totalPersenRealisasiFisik,$total_kegiatan); 
        $totalPersenTargetKeuangan=Helper::formatPersen($totalTargetKeuanganKeseluruhan,$totalPaguUnit);                
        $totalPersenRealisasiKeuangan=Helper::formatPersen($totalRealisasiKeuanganKeseluruhan,$totalPaguUnit);
        $totalPersenSisaAnggaran=Helper::formatPersen($totalSisaAnggaran,$totalPaguUnit);

        $sheet->mergeCells("A$row:D$row");                
        $sheet->setCellValue("A$row",'Jumlah');                                       
        $sheet->setCellValue("E$row",Helper::formatUang($totalPaguUnit));
        $sheet->setCellValue("F$row",$totalPersenBobot);

        $sheet->setCellValue("G$row",$totalPersenTargetFisik);
        $sheet->setCellValue("H$row",$totalPersenRealisasiFisik); 
        
        $sheet->setCellValue("I$row",$total_ttb_fisik); 
        
        $sheet->setCellValue("J$row",Helper::formatUang($totalTargetKeuanganKeseluruhan));
        $sheet->setCellValue("K$row",$totalPersenTargetKeuangan);
        $sheet->setCellValue("L$row",Helper::formatUang($totalRealisasiKeuanganKeseluruhan));                
        $sheet->setCellValue("M$row",$totalPersenRealisasiKeuangan);
        $sheet->setCellValue("N$row",$total_ttb_keuangan);
        $sheet->setCellValue("P$row",Helper::formatUang($totalSisaAnggaran));
        $sheet->setCellValue("Q$row",$totalPersenSisaAnggaran);

        $styleArray=array(								
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_CENTER,
                               'vertical'=>Alignment::HORIZONTAL_CENTER),
            'borders' => array('allBorders' => array('borderStyle' =>Border::BORDER_THIN))
        );   																					 
        $sheet->getStyle("A$row_awal:U$row")->applyFromArray($styleArray);
        $sheet->getStyle("A$row_awal:U$row")->getAlignment()->setWrapText(true);

        $styleArray=array(								
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_LEFT)
        );																					 
        $sheet->getStyle("B$row_awal:D$row")->applyFromArray($styleArray);
        $sheet->getStyle("O$row_awal:O$row")->applyFromArray($styleArray);
        $sheet->getStyle("R$row_awal:S$row")->applyFromArray($styleArray);

        $styleArray=array(								
            'alignment' => array('horizontal'=>Alignment::HORIZONTAL_RIGHT)
        );																					 
        $sheet->getStyle("E$row_awal:N$row")->applyFromArray($styleArray);               
        $sheet->getStyle("P$row_awal:Q$row")->applyFromArray($styleArray);

        $sheet->getStyle("A$row:Q$row")->getFont()->setBold(true);

        $row+=3;
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",'Kabupaten Bintan, '.Helper::tanggal('d F Y'));
        $row+=1;
        
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",'Pengguna Anggaran');                                          
                
        $row+=5;
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",$this->dataReport['nama_pengguna_anggaran']);
        $row+=1;                
        
        $sheet->mergeCells("L$row:N$row");
        $sheet->setCellValue("L$row",'Nip.'.Helper::formatNIP($this->dataReport['nip_pengguna_anggaran']));

    }
}