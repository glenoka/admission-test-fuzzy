<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation_Selection extends Model
{
    use HasFactory;
    protected $fillable = [
        'formation_id',
        'participant_id',
    ];

    public function formation(){
        return $this->belongsTo(Formation::class);
    }
    public function participant(){
        return $this->belongsTo(Participant::class);
    }
        
}
