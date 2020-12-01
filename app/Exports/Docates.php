<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use App\Docate;
use App\Inbound;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Docates implements FromArray,ShouldAutoSize,WithEvents
{
    private $start_date,$end_date,$types;

    public function __construct($start_date,$end_date,$types){
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->types = $types;
      
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
        if($this->types =="Y"){
        $query =Docate::whereBetween('created_at', [$start_date, $end_date ])
                ->orderBy('id','desc')
                ->get();
        }else{
            $query =Inbound::whereBetween('created_at', [$start_date, $end_date])
            ->orderBy('id','desc')
            ->get();

        }

        $data[] = ['CN No','pickup_date','pickup_time','sender_name','receiver_name','No Of Packets','Actual Weight','Invoice no','Invoice value','Delivery Date','Remarks','Origin City','Destination City'];
        $count = 1; 
        foreach ($query as $key => $value) {
           if($this->types =="Y"){
                $data[] = [ $value->docate_id,$value->pickup_date,$value->pickup_time,$value->sender->name?$value->sender->name:null,$value->receiver->name?$value->receiver->name:null,$value->no_of_box,$value->actual_weight,$value->invoice_no,$value->invoice_value,$value->inbound->delivery_date?$value->inbound->delivery_date:null,$value->inbound->negative_status?$value->inbound->negative_status:null,$value->sender->cityName->name?$value->sender->cityName->name:null, $value->receiver->cityName->name?$value->receiver->cityName->name:null];
           }else{
            $data[] = [ $value->docate_no,$value->docate->pickup_date?$value->docate->pickup_date:null,$value->docate->pickup_time?$value->docate->pickup_time:null,$value->docate->sender->name?$value->docate->sender->name:null,$value->docate->receiver->name?$value->docate->receiver->name:null,$value->docate->no_of_box?$value->docate->no_of_box:null,$value->docate->actual_weight?$value->docate->actual_weight:null,$value->docate->invoice_no?$value->docate->invoice_no:null,$value->docate->invoice_value?$value->docate->invoice_value:null,$value->delivery_date,$value->negative_status,$value->docate->sender->cityName->name?$value->docate->sender->cityName->name:null, $value->docate->receiver->cityName->name?$value->docate->receiver->cityName->name:null];
           }
           $count++;
        }
        return $data;
    }
}