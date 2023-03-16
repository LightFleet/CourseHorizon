<?php

namespace App\Modules\Enrollment\Application\Service;

use App\Contracts\InvalidRequestException;
use App\Modules\Enrollment\Application\Assembler\EnrollmentUpdateAssembler;
use App\Modules\Enrollment\Application\RequestMapper\EnrollmentRequestMapper;
use App\Modules\Enrollment\Domain\Entity\Enrollment;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;

class EnrollmentUpdater
{
    public function __construct(
        private EnrollmentRequestMapper   $mapper,
        private EnrollmentUpdateAssembler $assembler
    )
    {
    }

    /**
     * @throws ModelSaveFailedException
     * @throws InvalidRequestException
     */
    public function updateEnrollment(Request $request, Enrollment $enrollment): void
    {
        $enrollmentUpdateDTO = $this->mapper->enrollmentUpdate($request);
        $enrollment = $this->assembler->toEntity($enrollmentUpdateDTO, $enrollment);

        $saved = $enrollment->save();

        if (!$saved) {
            throw new ModelSaveFailedException('Course was updated, but save failed.');
        }
    }
}
