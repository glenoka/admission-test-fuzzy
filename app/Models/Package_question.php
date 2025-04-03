<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package_question extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'question_id', 
    ];
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
}
