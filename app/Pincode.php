<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $fillable = [
        'pincode',
        'area',
        'status',
    ];
}
