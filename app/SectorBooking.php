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
}
