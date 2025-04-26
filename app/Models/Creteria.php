<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creteria extends Model
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
