<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
    ];

    public function selections(){
        return $this->hasMany(Formation_Selection::class);
    }
}
