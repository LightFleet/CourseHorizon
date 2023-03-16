<?php

namespace Tests\Unit\Modules\Course\Application\Service;

use App\Modules\Course\Application\Service\CourseDeleter;
use App\Modules\Course\Domain\Entity\Course;
use App\SharedKernel\ModelDeletionFailedException;
use PHPUnit\Framework\TestCase;

class CourseDeleterTest extends TestCase
{
    public function testDeleteCourseThrowsError(): void
    {
        $deleter = new CourseDeleter();

        self::expectException(ModelDeletionFailedException::class);

        $deleter->deleteCourse(new Course());
    }
}
