<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam_Answer extends Model
{
    use HasFactory;
    protected $table = 'exam_answers';
    protected $fillable = [
        'exam_id',
        'question_id',
        'option_id',
        'essay_answer',
        'score',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(Question_Option::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function packageQuestion()
{
    return $this->belongsTo(Package_Question::class, 'question_id'); // Pastikan foreign key benar
}
}
