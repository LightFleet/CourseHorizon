<?php

namespace App\Modules\Enrollment\Application\Service;

use App\Modules\Enrollment\Domain\Entity\Enrollment;
use App\SharedKernel\ModelDeletionFailedException;

class EnrollmentDeleter
{
    /**
     * @throws ModelDeletionFailedException
     */
    public function deleteEnrollment(Enrollment $enrollment): void
    {
        $deleted = $enrollment->delete();

        if (!$deleted) {
            throw new ModelDeletionFailedException('Enrollment deletion failed.');
        }
    }
}
