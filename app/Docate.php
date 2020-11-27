<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docate extends Model
{
    protected $table = 'docate';
    protected $primaryKey = 'id';
    protected $fillable = [
        'docate_id','cn_no','pickup_date','invoice_no','payment_option','collecting_amount','baging_id','sector_id','origin','send_mode','no_of_box','actual_weight','sender_id','receiver_id','chargeable_weight','manifest_id','invoice_value','status'
    ];

    public function sender(){
        return $this->belongsTo('App\DocateDetails','sender_id','id');
    }

    public function receiver(){
        return $this->belongsTo('App\DocateDetails','receiver_id','id');
    }

    
}
