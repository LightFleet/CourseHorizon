<?php

namespace App\Modules\Course\Application\Service;

use App\Contracts\InvalidRequestException;
use App\Modules\Course\Application\Assembler\CourseCreationAssembler;
use App\Modules\Course\Application\RequestMapper\CourseRequestMapper;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;

class CourseCreator
{
    public function __construct(
        private CourseRequestMapper $mapper,
        private CourseCreationAssembler $assembler
    )
    {
    }

    /**
     * @throws ModelSaveFailedException
     * @throws InvalidRequestException
     */
    public function createCourse(Request $request): void
    {
        $courseCreationDTO = $this->mapper->courseCreation($request);
        $course = $this->assembler->fromDTO($courseCreationDTO);

        $saved = $course->save();

        if (!$saved) {
            throw new ModelSaveFailedException('Course was created, but not saved.');
        }
    }
}
