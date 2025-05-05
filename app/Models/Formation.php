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
        'village_id',
        'district_id',
        'due_date',
        'status',
        'education_level',
        'open_position',

    ];

    public function selections(){
        return $this->hasMany(Formation_Selection::class);
    }
    public function packages(){
        return $this->hasMany(Package::class);
    }
    public function village(){
        return $this->belongsTo(Village::class);
    }
    public function district(){
        return $this->belongsTo(Districts::class);
    }
}
