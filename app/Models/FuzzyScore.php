<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyScore extends Model
{
    protected $table='fuzzy_scores';
    protected $fillable = [
        'source_type',
        'source_id',
        'participant_id',
        'criteria_id',
        'formation_id',
        'score',
        'score_fuzzy',
        'score_fuzzy_normalized',
        'score_final',
       
    ];
}
