<?php

namespace App\Modules\Course\Application\Assembler;

use App\Modules\Course\Application\DTO\CourseCreationDTO;
use App\Modules\Course\Application\DTO\CourseUpdateDTO;
use App\Modules\Course\Domain\Entity\Course;

class CourseUpdateAssembler
{
    public function toEntity(CourseUpdateDTO $courseUpdateDTO, Course $course): Course
    {
        $course->setTitle($courseUpdateDTO->title);

        return $course;
    }
}
