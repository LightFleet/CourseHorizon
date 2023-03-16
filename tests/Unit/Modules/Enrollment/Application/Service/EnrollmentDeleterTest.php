<?php

namespace Tests\Unit\Modules\Enrollment\Application\Service;

use App\Modules\Enrollment\Application\Service\EnrollmentDeleter;
use App\Modules\Enrollment\Domain\Entity\Enrollment;
use App\SharedKernel\ModelDeletionFailedException;
use PHPUnit\Framework\TestCase;

class EnrollmentDeleterTest extends TestCase
{
    public function testDeleteCourseThrowsError(): void
    {
        $deleter = new EnrollmentDeleter();

        self::expectException(ModelDeletionFailedException::class);

        $deleter->deleteEnrollment(new Enrollment());
    }
}
