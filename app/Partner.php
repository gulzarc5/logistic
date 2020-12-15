<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partner';
    protected $primaryKey = 'id';

    protected $fillable=[
        'partnere_type','first_name','last_name','phone','city','state','bike','special_info','freight_id','email_address'
    ];
}
