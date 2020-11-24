<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocateDetails extends Model
{
    protected $table = 'docate_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'docate_id','name','state','city','pin','address'
    ];

   
}
