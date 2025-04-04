<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'email_assessor',
        'religion',
        'address',
        'village_id',
        'telp',
        'image',
        'user_id',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function village(){
        return $this->belongsTo(Village::class);
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }
}
