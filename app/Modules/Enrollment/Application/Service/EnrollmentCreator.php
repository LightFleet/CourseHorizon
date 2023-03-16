<?php

namespace App\Modules\Enrollment\Application\Service;

use App\Contracts\InvalidRequestException;
use App\Modules\Enrollment\Application\Assembler\EnrollmentCreationAssembler;
use App\Modules\Enrollment\Application\RequestMapper\EnrollmentRequestMapper;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;

class EnrollmentCreator
{
    public function __construct(
        private EnrollmentRequestMapper $mapper,
        private EnrollmentCreationAssembler $assembler
    )
    {
    }

    /**
     * @throws ModelSaveFailedException
     * @throws InvalidRequestException
     */
    public function createEnrollment(Request $request): void
    {
        $enrollmentCreationDTO = $this->mapper->enrollmentCreation($request);
        $enrollment = $this->assembler->fromDTO($enrollmentCreationDTO);

        $saved = $enrollment->save();

        if (!$saved) {
            throw new ModelSaveFailedException('Enrollment was created, but not saved.');
        }
    }
}
