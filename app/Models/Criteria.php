<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
   
    protected $fillable=[
        'name',
        'description',
        'value'
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
}
