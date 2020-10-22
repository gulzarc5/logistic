<?php

namespace App\Branch\Models;

use Illuminate\Database\Eloquent\Model;

class Docate extends Model
{
    protected $table = 'docate';
    protected $primaryKey = 'id';
    protected $fillable = [
        'docate_id','payment_option','collecting_amount','origin','send_mode','no_of_box','actual_weight','sender_id','receiver_id','chargeable_weight','invoice_value','status'
    ];

    
}
