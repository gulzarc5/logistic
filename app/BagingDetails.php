<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BagingDetails extends Model
{
    protected $table = 'baging_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'docate_id','baging_id','status'
    ];

    public function docate(){
        return $this->belongsTo('App\Docate','docate_id','id');
    }

    public function baging(){
        return $this->belongsTo('App\Baging','baging_id','id');
    }
}
