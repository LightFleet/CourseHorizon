<?php

namespace App\Modules\Enrollment\Application\Controller\Api;

use App\Http\Controllers\Controller;
use App\Modules\Course\Domain\Entity\Course;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        return view('enrollments.list');
    }
}
