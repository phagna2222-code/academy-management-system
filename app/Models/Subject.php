<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'academy_id', 'program_id', 'name', 'code', 'credit',
        'description', 'status', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'credit' => 'decimal:2',
    ];

    public function academy(): BelongsTo
    {
        return $this->belongsTo(Academy::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject')
            ->withPivot(['campus_id', 'academic_year_id', 'status'])
            ->withTimestamps();
    }
}
