<?php

namespace App\Modules\Enrollment\Application\Controller\Web;

use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function list()
    {
        return view('enrollments.list');
    }
}
