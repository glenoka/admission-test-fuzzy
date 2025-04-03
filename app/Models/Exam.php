<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'participant_id',
        'package_id',
        'duration',
        'started_at',
        'finish_at',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function answers()
    {
        return $this->hasMany(Exam_Answer::class);
    }
    
}
