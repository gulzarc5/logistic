<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    protected $table = 'freight';
    protected $primaryKey = 'id';

    protected $fillable=[
        'warehousing_services','road_transportation','air_transportation','sea_transportaion','logistic_planning'
    ];
}
