<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baging extends Model
{
    protected $table = 'baging';
    protected $primaryKey = 'id';
    protected $fillable = [
        'manifest_id','lock_no'
    ];
}
