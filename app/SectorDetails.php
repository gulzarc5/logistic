<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorDetails extends Model
{
    protected $table = 'sector_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sector_id','baging_id','docate_id','status_tab',
    ];

    public function docate(){
        return $this->belongsTo('App\Docate','docate_id','id');
    }

    public function baging(){
        return $this->belongsTo('App\Baging','baging_id','id');
    }

    public function sector(){
        return $this->belongsTo('App\SectorBooking','sector_id','id');
    }
}
