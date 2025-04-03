<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'question',
        'description',
        'question_type',
        'essay_answer_key',
       
    ];

    public function options()
    {
        return $this->hasMany(Question_Option::class);
    }
}
