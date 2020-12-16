<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

use App\Inbound;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Pickup implements FromArray,ShouldAutoSize,WithEvents
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
       
        $query =Inbound::whereBetween('created_at', [$start_date, $end_date ])
                ->orderBy('id','desc')
                ->get();
    

        $data[] = ['CN No','CD No','Status'];
        $count = 1; 
        foreach ($query as $key => $value) {
          $data[] = [ $value->docate_no,$value->cd_no,'Picked Up'];
          $count++;
        }
        return $data;
    }
}