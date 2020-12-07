<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    protected $table = 'manifest';
    protected $primaryKey = 'id';
    protected $fillable = [
        'branch_id','manifest_no','origin','destination'
    ];

    public function originName(){
        return $this->belongsTo('App\City','origin');
    }

    public function destinationName(){
        return $this->belongsTo('App\City','destination');
    }

    public function totalDocateCount(){
        return $this->hasMany('App\Docate','manifest_id','id');
    }

    public function branch(){
        return $this->belongsTo('App\User','branch_id','id');
    }

    public function manifestBagedCount(){
        return $this->hasMany('App\ManifestDetails','manifest_id','id')->where('status',2)->count();
    }

    
}
