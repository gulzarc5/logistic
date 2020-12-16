<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    protected $table = 'freight';
    protected $primaryKey = 'id';

    protected $fillable=[
        'name'
    ];
}
