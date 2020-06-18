<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
    protected $table = 'service_area';
    protected $fillable = [
        'area_name', 'state_id','city_id','pin','status',
    ];

    
    public function state()
    {
        return $this->belongsTo('App\State','state_id','id');
    }

    
    public function city()
    {
        return $this->belongsTo('App\City','city_id','id');
    }
}
