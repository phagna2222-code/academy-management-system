<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Academy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'code', 'owner_name', 'phone', 'email', 'website',
        'address', 'logo', 'status',
    ];

    public function campuses(): HasMany
    {
        return $this->hasMany(Campus::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function academicYears(): HasMany
    {
        return $this->hasMany(AcademicYear::class);
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }
}
