<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation_details extends Model
{
    protected $table = 'evaluation_details';
    protected $fillable = [
        'evaluation_id',
        'aspect_id',
        'score',
    ];

    public function evaluation()
{
    return $this->belongsTo(Evaluation::class, 'evaluation_id'); // ✅
}

    public function aspect()
    {
        return $this->belongsTo(Aspect::class);
    }
}
