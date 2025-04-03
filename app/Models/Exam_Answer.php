<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam_Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'question_id',
        'option_id',
        'essay_answer',
        'score',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Question_Option::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
