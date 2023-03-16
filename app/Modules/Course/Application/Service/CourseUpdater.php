<?php

namespace App\Modules\Course\Application\Service;

use App\Contracts\InvalidRequestException;
use App\Modules\Course\Application\Assembler\CourseUpdateAssembler;
use App\Modules\Course\Application\RequestMapper\CourseRequestMapper;
use App\Modules\Course\Domain\Entity\Course;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;

class CourseUpdater
{
    public function __construct(
        private CourseRequestMapper   $mapper,
        private CourseUpdateAssembler $assembler
    )
    {
    }

    /**
     * @throws ModelSaveFailedException
     * @throws InvalidRequestException
     */
    public function updateCourse(Request $request, Course $course): void
    {
        $courseUpdateDTO = $this->mapper->courseUpdate($request);
        $course = $this->assembler->toEntity($courseUpdateDTO, $course);

        $saved = $course->save();

        if (!$saved) {
            throw new ModelSaveFailedException('Course was updated, but save failed.');
        }
    }
}
