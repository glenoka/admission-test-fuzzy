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
    public function evaluation_details()
    {
        return $this->hasMany(Evaluation_details::class);
    }
    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }
}
