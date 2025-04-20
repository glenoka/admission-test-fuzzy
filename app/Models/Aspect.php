<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspect extends Model
{
    protected $fillable = [
        'section_id',
        'task',
        'max_score',
    ];

    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function evaluation_details()
    {
        return $this->hasMany(Evaluation_details::class);
    }
}
