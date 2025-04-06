<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'participant_id',
        'package_id',
        'duration',
        'started_at',
        'finish_at',
        'assessor_id',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
    public function assessor()
    {
        return $this->belongsTo(Assessor::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function answers()
    {
        return $this->hasMany(Exam_Answer::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $model->slug = Str::random(10);
            } while (static::where('slug', $model->slug)->exists());
        });
    }

}
