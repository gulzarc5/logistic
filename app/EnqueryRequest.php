<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnqueryRequest extends Model
{
    protected $fillable = [
        'source_state',
        'source_city',
        'source_pin',
        'source_area',
        'source_address',
        'destination_state',
        'destination_city',
        'destination_pin',
        'destination_area',
        'destination_address',
        'description',
    ];
    public function sourceState()
    {
        return $this->belongsTo('App\State','source_state','id');
    }
    public function destinationState()
    {
        return $this->belongsTo('App\State','destination_state','id');
    }
    public function sourceCity()
    {
        return $this->belongsTo('App\City','source_city','id');
    }
    public function destinationCity()
    {
        return $this->belongsTo('App\City','destination_city','id');
    }
}
