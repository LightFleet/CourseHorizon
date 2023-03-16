<?php

namespace App\Modules\Enrollment\Domain\Entity;

use App\Modules\Course\Domain\Entity\Course;
use App\Modules\Enrollment\Domain\Enum\Status;
use App\Modules\Student\Domain\Entity\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    protected $fillable = [
        'status',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): Status
    {
        return new Status($this->status);
    }

    public function setStatus(Status $status): self
    {
        $this->status = $status->getValue();

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $this->created_at);
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $this->updated_at);
    }

    public function isCompleted()
    {
        return $this->getStatus()->isCompleted();
    }
}
