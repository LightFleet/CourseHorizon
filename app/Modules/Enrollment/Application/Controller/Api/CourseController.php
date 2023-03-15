<?php

namespace App\Modules\Enrollment\Application\Controller\Api;

use App\Http\Controllers\Controller;
use App\Modules\Course\Domain\Entity\Course;
use App\Modules\Enrollment\Application\Service\CourseFetcher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses(CourseFetcher $courseFetcher, Request $request)
    {
        $query = $courseFetcher->modifyQuery(Course::query(), $request);

        $courses = $query->paginate(20);

        return response()->json($courses);
    }
}
