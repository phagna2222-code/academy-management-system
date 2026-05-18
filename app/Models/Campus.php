<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'academy_id', 'name', 'code', 'phone', 'email', 'address',
        'manager_id', 'is_main', 'status',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    public function academy(): BelongsTo
    {
        return $this->belongsTo(Academy::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function classRooms(): HasMany
    {
        return $this->hasMany(ClassRoom::class);
    }
}
