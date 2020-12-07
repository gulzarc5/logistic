<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbound extends Model
{
    protected $table = 'inbound';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cd_no','docate_no','status','de_name','vehicle_no','drs_date','drs_time','received_by','delivery_date','delivery_time','negative_status','negative_status_data_time'
    ];

    public function docate(){
        return $this->belongsTo('App\Docate','docate_no','docate_id');
    }

}
