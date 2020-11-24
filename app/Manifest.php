<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    protected $table = 'manifest';
    protected $primaryKey = 'id';
    protected $fillable = [
        'branch_id','manifest_no'
    ];
}
