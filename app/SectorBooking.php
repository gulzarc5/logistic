<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorBooking extends Model
{
    protected $table = 'sector_booking';
    protected $primaryKey = 'id';
    protected $fillable = [
        'manifest_id','branch_id','booked_by','co_loader_name','date','time','mode','vehicle_no','cd_no','dep_date','dep_time','arr_date','arr_time','auto_generate_no'
    ];

    public function sectorBookedCount(){
        return $this->hasMany('App\SectorDetails','sector_id','id')->where('status',2)->count();
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
