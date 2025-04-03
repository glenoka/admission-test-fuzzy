<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
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
}
