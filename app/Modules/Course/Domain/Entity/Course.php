<?php

namespace App\Modules\Course\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
    ];
}
