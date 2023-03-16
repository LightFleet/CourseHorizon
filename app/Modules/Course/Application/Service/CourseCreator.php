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
        private CourseRequestMapper $requestMapper,
        private CourseCreationAssembler $courseAssembler
    )
    {
    }

    /**
     * @throws ModelSaveFailedException
     * @throws InvalidRequestException
     */
    public function createCourse(Request $request): void
    {
        $courseCreationDTO = $this->requestMapper->courseCreation($request);
        $course = $this->courseAssembler->fromDTO($courseCreationDTO);

        $saved = $course->save();

        if (!$saved) {
            throw new ModelSaveFailedException('Course was created, but not saved.');
        }
    }
}
