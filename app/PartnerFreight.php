<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerFreight extends Model
{
    protected $table = 'partner_freight';
    protected $primaryKey = 'id';

    protected $fillable=[
        'partner_id','freight_id'
    ];

    public function Freight(){
        return $this->belongsTo('App\Freight','freight_id','id');
    }
}
