<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManifestDetails extends Model
{
    protected $table = 'manifest_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'manifest_id','status'
    ];
}
