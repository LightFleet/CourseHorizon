<?php

namespace App\Modules\Course\Application\Service;

use App\Modules\Course\Domain\Entity\Course;
use App\SharedKernel\ModelDeletionFailedException;

class CourseDeleter
{
    /**
     * @throws ModelDeletionFailedException
     */
    public function deleteCourse(Course $course): void
    {
        $deleted = $course->delete();

        if (!$deleted) {
            throw new ModelDeletionFailedException('Course deletion failed.');
        }
    }
}
