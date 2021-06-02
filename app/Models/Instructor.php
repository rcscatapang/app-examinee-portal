<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'first_name',
        'last_name',
        'middle_name',
        'contact_number',
        'institution',
        'photo',
        'user_id'
    ];

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
