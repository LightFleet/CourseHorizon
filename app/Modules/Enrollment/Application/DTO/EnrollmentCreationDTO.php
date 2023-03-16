<?php

namespace App\Modules\Enrollment\Application\DTO;

use App\Modules\Enrollment\Domain\Enum\Status;

class EnrollmentCreationDTO
{
    public int $course_id;
    public int $student_id;
    public int $status;

    private function __construct()
    {
    }

    public static function fromRequestData(array $requestData): self
    {
        $self = new self;

        $self->course_id = $requestData['course_id'];
        $self->student_id = $requestData['student_id'];
        $self->status = Status::IN_PROGRESS()->getValue();

        return $self;
    }
}
