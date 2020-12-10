<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drs extends Model
{
    protected $table = 'drs';
    protected $fillable = ['de_name','vehicle_no','branch_id','drs_no','drs_date','drs_time','status','drs_close_date_time'];

    public function docatesCount(){
        return $this->hasMany('App\Inbound','drs_id','id')->count();

    }

    
}
