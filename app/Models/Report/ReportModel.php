<?php
namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportModel extends Model
{   
    /* data report
    */
   protected $dataReport = [];
   /**
    * object spreadsheet
    */
   protected $spreadsheet;

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
}