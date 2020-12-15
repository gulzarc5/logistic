<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table="contact";
    protected $primarykey = "id";
    protected $fillable = [
        'name','phone','email','subhject','message'
    ];
}
