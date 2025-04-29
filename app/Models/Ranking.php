<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Formation_Selection;

class Ranking extends Model
{
    use HasFactory;
    protected $fillable = [
        'participant_id',
        'formation_id',
        'total_score',
        'rank',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function formationSelection()
    {
        return $this->hasMany(Formation_Selection::class);
    }

}
