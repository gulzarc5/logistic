<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManifestDetails extends Model
{
    protected $table = 'manifest_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'manifest_id','status'
    ];

    public function docate(){
        return $this->belongsTo('App\Docate','docate_id','id');
    }

    public function manifest(){
        return $this->belongsTo('App\Manifest','manifest_id','id');
    }
}
