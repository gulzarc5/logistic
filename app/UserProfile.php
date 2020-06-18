<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    protected $fillable = [
        'user_id','state_id', 'city_id', 'pin', 'address', 'gender'
    ];

    public function city()
    {
        return $this->hasOne('App\City','id','city_id');
    }

    public function state()
    {
        return $this->hasOne('App\State','id','state_id');
    }
}
