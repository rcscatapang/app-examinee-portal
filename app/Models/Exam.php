<?php

namespace App\Models;

use App\Enums\ExamStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'type',
        'link',
        'description',
        'total_questions',
        'start_date',
        'end_date',
        'finish_in_minutes',
        'additional_points',
        'published_date',
        'completed_date',
        'status',
        'course_id',
        'instructor_id'
    ];

    public function getStatusDescriptionAttribute(): string
    {
        return ExamStatus::getDescription($this->status);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function examDetails(): HasMany
    {
        return $this->hasMany(ExamDetail::class);
    }
}
