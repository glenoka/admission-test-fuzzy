<?php

namespace App\Models;

use App\Models\Creteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'duration',
        'type_package',
        'kategory',

    ];


    public function package_questions(): HasMany
{
    return $this->hasMany(Package_question::class);
}
public function creteria(): BelongsTo
{
    return $this->belongsTo(Creteria::class);
}
}
