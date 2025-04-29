<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation_Selection extends Model
{
    use HasFactory;
    public $table='formation_selections';
    protected $fillable = [
        'formation_id',
        'participant_id',
        'status'
    ];

    public function formation(){
        return $this->belongsTo(Formation::class);
    }
    public function participant(){
        return $this->belongsTo(Participant::class, 'participant_id');
    }
    public function ranking()
    {
        return $this->belongsTo(Ranking::class,'participant_id','participant_id');
    }

    protected static function boot()
{
    parent::boot();

    static::saving(function ($model) {
        if (static::where('formation_id', $model->formation_id)
            ->where('participant_id', $model->participant_id)
            ->exists()
        ) {
            throw new \Exception('Participant sudah terdaftar di formasi ini');
        }
    });
}
        
}
