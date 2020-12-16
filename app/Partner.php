<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partner';
    protected $primaryKey = 'id';

    protected $fillable=[
        'partner_type','first_name','last_name','phone','city','state','bike','special_info','email_address'
    ];

    public function partnerFreight(){
        return $this->hasMany('App\PartnerFreight','partner_id','id');
    }
}
