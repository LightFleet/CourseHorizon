<?php

namespace Tests\Unit\Modules\Enrollment\Application\Assembler;

use App\Modules\Enrollment\Application\Assembler\EnrollmentUpdateAssembler;
use App\Modules\Enrollment\Application\DTO\EnrollmentUpdateDTO;
use App\Modules\Enrollment\Domain\Entity\Enrollment;
use App\Modules\Enrollment\Domain\Enum\Status;
use PHPUnit\Framework\TestCase;

class EnrollmentUpdateAssemblerTest extends TestCase
{
    public function testToEntity()
    {
        $assembler = new EnrollmentUpdateAssembler();
        $status = Status::IN_PROGRESS();

        $dto = EnrollmentUpdateDTO::fromRequestData(['status' => $status->getValue()]);

        $updatedEnrollment = $assembler->toEntity($dto, new Enrollment());

        self::assertSame($updatedEnrollment->getStatus()->getValue(), $status->getValue());
    }
}
