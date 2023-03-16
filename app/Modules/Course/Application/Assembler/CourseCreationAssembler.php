<?php

namespace App\Modules\Course\Application\Assembler;

use App\Modules\Course\Application\DTO\CourseCreationDTO;
use App\Modules\Course\Domain\Entity\Course;

class CourseCreationAssembler
{
    public function fromDTO(CourseCreationDTO $dto): Course
    {
        $course = new Course();

        $course->setTitle($dto->title);

        return $course;
    }
}
