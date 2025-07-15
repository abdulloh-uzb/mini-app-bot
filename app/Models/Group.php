<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        "duration",
        "start_date",
        'level',
        'price',
        'lesson_days',
        'status'
    ];

    public function teachers(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'student_id');
    }
    
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'group_id');
    }

    protected function startTime(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('H:i', strtotime($value)),
        );
    }

    protected function endTime(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('H:i', strtotime($value)),
        );
    }

}
