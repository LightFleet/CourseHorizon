<?php

namespace App\Modules\Enrollment\Application\Controller\Api;

use App\Http\Controllers\Controller;
use App\Modules\Enrollment\Application\DataTransformer\EnrollmentsDataTransformer;
use App\Modules\Enrollment\Application\Service\EnrollmentsFetcher;
use App\Modules\Enrollment\Domain\Entity\Enrollment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function fetchEnrollments(
        EnrollmentsFetcher $enrollmentsFetcher,
        EnrollmentsDataTransformer $transformer,
        Request $request
    ): JsonResponse
    {
        $query = $enrollmentsFetcher->modifyQuery(Enrollment::query(), $request);

        $enrollments = $query->paginate(20);

        return new JsonResponse(
            [
                'success' => true,
                'enrollments' => $transformer->transform($enrollments)
            ]
        );
    }
}
