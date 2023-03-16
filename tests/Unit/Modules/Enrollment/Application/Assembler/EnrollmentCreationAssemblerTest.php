<?php

namespace Tests\Unit\Modules\Enrollment\Application\Assembler;

use App\Modules\Enrollment\Application\Assembler\EnrollmentCreationAssembler;
use App\Modules\Enrollment\Application\DTO\EnrollmentCreationDTO;
use PHPUnit\Framework\TestCase;

class EnrollmentCreationAssemblerTest extends TestCase
{
    public function testFromDTO()
    {
        $assembler = new EnrollmentCreationAssembler();

        $course_id = 1;
        $student_id = 2;
        $status = 0;

        $dto = EnrollmentCreationDTO::fromRequestData([
            'course_id' => $course_id,
            'student_id' => $student_id,
            'status' => $status,
        ]);

        $enrollment = $assembler->fromDTO($dto);

        self::assertSame($enrollment->course_id, $course_id);
        self::assertSame($enrollment->student_id, $student_id);
        self::assertSame($enrollment->status, $status);
    }
}
