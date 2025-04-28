<?php

namespace App\Models;

use App\Models\Criteria;
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
        'formation_id',
        'criteria_id',
        'score_max',

    ];


    public function package_questions(): HasMany
{
    return $this->hasMany(Package_question::class);
}
public function criteria(): BelongsTo
{
    return $this->belongsTo(Criteria::class);
}
public function formation(): BelongsTo
{
    return $this->belongsTo(Formation::class);
}
public function exam(): HasMany
{
    return $this->hasMany(Exam::class);
}
}