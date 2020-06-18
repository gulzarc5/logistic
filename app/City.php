<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $fillable = [
        'name','state_id', 'status'
    ];

    public function state()
    {
        return $this->belongsTo('App\State','state_id','id');
    }
}
