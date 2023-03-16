<?php

namespace Tests\Unit\Modules\Course\Application\Service;

use App\Modules\Course\Application\Assembler\CourseCreationAssembler;
use App\Modules\Course\Application\DTO\CourseCreationDTO;
use App\Modules\Course\Application\Exception\TitleIsRequiredAndShouldBeStringException;
use App\Modules\Course\Application\RequestMapper\CourseRequestMapper;
use App\Modules\Course\Application\Service\CourseCreator;
use App\Modules\Course\Application\Service\CourseDeleter;
use App\Modules\Course\Domain\Entity\Course;
use App\SharedKernel\ModelDeletionFailedException;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;
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
