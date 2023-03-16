<?php

namespace App\Modules\Course\Application\Controller\Api;

use App\Contracts\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Modules\Course\Application\Service\CourseCreator;
use App\Modules\Course\Application\Service\CourseDeleter;
use App\Modules\Course\Application\Service\CourseUpdater;
use App\Modules\Course\Domain\Entity\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function createCourse(Request $request, CourseCreator $courseCreator): JsonResponse
    {
        try {
            $courseCreator->createCourse($request);
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

    public function updateCourse(Course $course, Request $request, CourseUpdater $courseUpdater): JsonResponse
    {
        try {
            $courseUpdater->updateCourse($request, $course);
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

    public function deleteCourse(Course $course, CourseDeleter $courseDeleter): JsonResponse
    {
        try {
            $courseDeleter->deleteCourse($course);
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
