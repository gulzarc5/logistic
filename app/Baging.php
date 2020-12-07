<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baging extends Model
{
    protected $table = 'baging';
    protected $primaryKey = 'id';
    protected $fillable = [
        'manifest_id','lock_no','branch_id','origin','destination'
    ];

    public function sectorBookedCount(){
        return $this->hasMany('App\BagingDetails','baging_id','id')->where('status',2)->count();
    }

    public function manifest(){
        return $this->belongsTo('App\Manifest','manifest_id','id');
    }

    public function originName(){
        return $this->belongsTo('App\City','origin','id');
    }

    public function destinationName(){
        return $this->belongsTo('App\City','destination','id');
    }

    public function branch(){
        return $this->belongsTo('App\User','branch_id','id');
    }
}
