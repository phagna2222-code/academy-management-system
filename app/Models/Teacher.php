<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'academy_id', 'campus_id', 'user_id', 'teacher_code', 'name',
        'gender', 'dob', 'phone', 'email', 'address', 'qualification',
        'specialization', 'joining_date', 'salary_type', 'salary_amount',
        'status', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'dob' => 'date',
        'joining_date' => 'date',
        'salary_amount' => 'decimal:2',
    ];

    public function academy(): BelongsTo
    {
        return $this->belongsTo(Academy::class);
    }

    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject')
            ->withPivot(['campus_id', 'academic_year_id', 'status'])
            ->withTimestamps();
    }
}
