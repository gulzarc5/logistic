<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorDetails extends Model
{
    protected $table = 'sector_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sector_id','baging_id','status',
    ];
}
