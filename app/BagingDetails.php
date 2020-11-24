<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BagingDetails extends Model
{
    protected $table = 'baging_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'docate_id','baging_id','status'
    ];
}
