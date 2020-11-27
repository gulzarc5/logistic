<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\Docate;
use App\Inbound;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Docates implements FromArray
{
    private $start_date,$end_date,$types;

    public function __construct($start_date,$end_date,$types){
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->types = $types;
      
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

        $data[] = ['CN No','Origin City','Destination City','No Of Packets','Actual Weight','Pickup Date','Pickup Time']; 
        foreach ($query as $key => $value) {
           if($this->types =="Y"){
                $data[] = [ $value->docate_id,$value->sender->cityName->name?$value->sender->cityName->name:null, $value->receiver->cityName->name?$value->receiver->cityName->name:null,$value->no_of_box,$value->actual_weight,$value->pickup_date,$value->pickup_time];
           }else{
                $data[] = [ $value->docate_no,$value->docate->sender->cityName->name?$value->docate->sender->cityName->name:null, $value->docate->receiver->cityName->name?$value->docate->receiver->cityName->name:null,$value->docate->no_of_box?$value->docate->no_of_box:null,$value->docate->actual_weight?$value->docate->actual_weight:null,$value->docate->pickup_date?$value->docate->pickup_date:null,$value->docate->pickup_time?$value->docate->pickup_time:null];
           }
        }
        return $data;
    }
}