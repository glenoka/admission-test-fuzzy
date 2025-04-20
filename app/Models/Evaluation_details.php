<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation_details extends Model
{
    protected $fillable = [
        'evaluation_id',
        'aspect_id',
        'score',
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function aspect()
    {
        return $this->belongsTo(Aspect::class);
    }
}
