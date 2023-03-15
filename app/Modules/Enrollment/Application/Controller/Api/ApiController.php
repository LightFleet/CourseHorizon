<?php

namespace App\Modules\Enrollment\Application\Controller\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        return view('enrollments.list');
    }
}
