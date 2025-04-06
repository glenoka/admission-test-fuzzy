<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Tables\Columns\ImageColumn;

class Participant extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'nik',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'email',
        'religion',
        'address',
        'village_id',
        'telp',
        'image',
        'user_id',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function village(){
        return $this->belongsTo(Village::class);
    }

    public function exams(){
        return $this->hasMany(Exam::class);
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
