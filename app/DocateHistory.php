<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocateHistory extends Model
{
    protected $table = 'docate_history';
    protected $primaryKey = 'id';
    protected $fillable = [
        'docate_id','type','data_id','comments'
    ];

    public function docate(){
        return $this->belongsTo('App\Docate','data_id','id');
    }


}
