<?php

namespace App\Modules\Course\Application\Controller\Api;

use App\Contracts\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Modules\Course\Application\Service\CourseCreator;
use App\Modules\Course\Domain\Entity\Course;
use App\Modules\Course\Application\Service\CourseFetcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function fetchCourses(CourseFetcher $courseFetcher, Request $request): JsonResponse
    {
        $query = $courseFetcher->modifyQuery(Course::query(), $request);

        $courses = $query->paginate(20);

        return response()->json($courses);
    }

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
}
