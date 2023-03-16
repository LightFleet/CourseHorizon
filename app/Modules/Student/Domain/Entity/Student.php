<?php

namespace App\Modules\Student\Domain\Entity;

use App\Modules\Enrollment\Domain\Entity\Enrollment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
