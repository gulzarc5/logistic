<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbound extends Model
{
    protected $table = 'inbound';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cd_no','docate_id','docate_no','status','received_by','drs_id','delivery_date','delivery_time','negative_status','negative_status_data_time'
    ];

    public function docateData(){
        return $this->belongsTo('App\Docate','docate_id','id');
    }

    public function drs(){
        return $this->belongsTo('App\Drs','drs_id','id');
    }

}
