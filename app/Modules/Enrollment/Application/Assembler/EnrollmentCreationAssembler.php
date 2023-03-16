<?php

namespace App\Modules\Enrollment\Application\Assembler;

use App\Modules\Enrollment\Application\DTO\EnrollmentCreationDTO;
use App\Modules\Enrollment\Domain\Entity\Enrollment;

class EnrollmentCreationAssembler
{
    public function fromDTO(EnrollmentCreationDTO $dto): Enrollment
    {
        $enrollment = new Enrollment();

        $enrollment->course_id = $dto->course_id;
        $enrollment->student_id = $dto->student_id;
        $enrollment->status = $dto->status;

        return $enrollment;
    }
}
