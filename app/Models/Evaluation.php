<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'assessor_id',
        'formation_selection_id',
        'date',
    ];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function formation_selection()
    {
        return $this->belongsTo(Formation_selection::class);
    }
    public function evaluationDetails()
    {
        return $this->hasMany(Evaluation_details::class, 'evaluation_id'); // Tambahkan foreign key
    }
    public function assessor()
    {
        return $this->belongsTo(Assessor::class, 'assessor_id');
    }
}
