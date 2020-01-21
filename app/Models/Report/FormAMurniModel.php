<?php

namespace App\Models\Report;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FormAMurniModel extends ReportModel
{   
    public function __construct($dataReport,$print=true)
    {
        parent::__construct($dataReport); 
        $this->spreadsheet->getProperties()->setTitle("Laporan Form A Tahun ".\HelperKegiatan::getTahunPerencanaan());
        $this->spreadsheet->getProperties()->setSubject("Laporan Form A Tahun ".\HelperKegiatan::getTahunPerencanaan()); 
        if ($print)
        {
            $this->print();             
        }        
    }    
    private function  print()  
    {
        $no_bulan = $this->dataReport['no_bulan'];
        $nama_bulan = \Helper::getBulan($no_bulan);
        $tahun = \HelperKegiatan::getTahunAnggaran();
        $datakegiatan = $this->dataReport['datakegiatan'];

        $sheet = $this->spreadsheet->getActiveSheet();        
        $sheet->setTitle ('LAPORAN FORM A');

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
        $sheet->mergeCells("T$row:U$row");
        $sheet->getStyle("T$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->setCellValue("T$row","POSISI S.D $nama_bulan $tahun");
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

    }
}