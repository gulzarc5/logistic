<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use App\Docate;
use App\Drs;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Drss implements FromArray,ShouldAutoSize,WithEvents
{
    private $start_date,$end_date;

    public function __construct($start_date,$end_date){
        $this->start_date = $start_date;
        $this->end_date = $end_date;
      
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:M1'; // All headers
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style_head);
                // $event->sheet->mergeCells('A1:H1');
                $styleArray = array(
                    'font'  => array(
                        'bold'  => true,
                        'size'  => 12,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle('A1:M1')->applyFromArray($styleArray);
            },
        ];
    }

    public function array(): array
    {
        $start_date = date('Y-m-d', strtotime($this->start_date));
        $end_date = date('Y-m-d', strtotime($this->end_date));
       
        $query =Drs::whereBetween('created_at', [$start_date, $end_date ])
                ->orderBy('id','desc')
                ->get();
    

        $data[] = ['Drs No','Delivery Boy Name','Drs Date','Drs Time','Status'];
        $count = 1; 
        foreach ($query as $key => $value) {
          
            $data[] = [ $value->drs_no,$value->de_name,$value->drs_date,$value->drs_time,$value->status == 1?'Drs Prepared':'Drs Closed'];
          
           $count++;
        }
        return $data;
    }
}