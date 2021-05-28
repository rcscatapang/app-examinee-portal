<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'academic_year',
        'description',
        'instructor_id',
    ];

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function courseInvites(): HasMany
    {
        return $this->hasMany(CourseInvite::class);
    }
}
