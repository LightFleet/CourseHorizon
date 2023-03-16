<?php

namespace App\Modules\Enrollment\Application\Controller\Api;

use App\Contracts\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Modules\Enrollment\Application\DataTransformer\EnrollmentsDataTransformer;
use App\Modules\Enrollment\Application\Service\EnrollmentCreator;
use App\Modules\Enrollment\Application\Service\EnrollmentDeleter;
use App\Modules\Enrollment\Application\Service\EnrollmentsFetcher;
use App\Modules\Enrollment\Application\Service\EnrollmentUpdater;
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

    public function createEnrollment(Request $request, EnrollmentCreator $enrollmentCreator): JsonResponse
    {
        try {
            $enrollmentCreator->createEnrollment($request);
        } catch (InvalidRequestException $e) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Request is invalid. ' . $e->getMessage()
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        return new JsonResponse([
            'success' => true,
        ]);
    }

    public function updateEnrollment(Enrollment $enrollment, Request $request, EnrollmentUpdater $enrollmentUpdater): JsonResponse
    {
        try {
            $enrollmentUpdater->updateEnrollment($request, $enrollment);
        } catch (InvalidRequestException $e) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Request is invalid. ' . $e->getMessage()
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        return new JsonResponse([
            'success' => true,
        ]);
    }

    public function deleteEnrollment(Enrollment $enrollment, EnrollmentDeleter $enrollmentDeleter): JsonResponse
    {
        try {
            $enrollmentDeleter->deleteEnrollment($enrollment);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        return new JsonResponse([
            'success' => true,
        ]);
    }
}
