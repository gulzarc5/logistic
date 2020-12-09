<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drs extends Model
{
    protected $table = 'drs';
    protected $fillable = ['de_name','vehicle_no','drs_no','drs_date','drs_time','status','drs_close_date_time'];
}
