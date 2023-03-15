<?php

namespace App\Modules\Course\Application\Service;

use App\Modules\Course\Application\Assembler\CourseAssembler;
use App\Modules\Course\Application\Exception\TitleIsRequiredAndShouldBeStringException;
use App\Modules\Course\Application\RequestMapper\CourseRequestMapper;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;

class CourseCreator
{
    public function __construct(
        private CourseRequestMapper $requestMapper,
        private CourseAssembler $courseAssembler
    )
    {
    }

    /**
     * @throws ModelSaveFailedException
     * @throws TitleIsRequiredAndShouldBeStringException
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
