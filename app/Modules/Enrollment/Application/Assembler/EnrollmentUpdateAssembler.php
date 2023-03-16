<?php

namespace App\Modules\Enrollment\Application\Assembler;

use App\Modules\Enrollment\Application\DTO\EnrollmentUpdateDTO;
use App\Modules\Enrollment\Domain\Entity\Enrollment;
use App\Modules\Enrollment\Domain\Enum\Status;

class EnrollmentUpdateAssembler
{
    public function toEntity(EnrollmentUpdateDTO $enrollmentUpdateDTO, Enrollment $enrollment): Enrollment
    {
        $enrollment->setStatus(Status::from($enrollmentUpdateDTO->status));

        return $enrollment;
    }
}
