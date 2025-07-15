<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = ["status", "session_id", "student_id"];

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, "student_id");
    }


    protected function statusText(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => match($attributes['status']) {
                'present' => 'Keldi',
                'absent' => 'Kelmadi',
                'late' => 'Kechqoldi',
                default => 'Nomaʼlum',
            },
        );
    }


}
