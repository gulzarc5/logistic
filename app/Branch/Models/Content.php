<?php

namespace App\Branch\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    protected $primaryKey = 'id';
    protected $fillable = [
        'length','breadth','height','content'
    ];
}
