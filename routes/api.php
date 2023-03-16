<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/courses', [\App\Modules\Course\Application\Controller\Api\CourseController::class, 'fetchCourses']);
Route::put('/course', [\App\Modules\Course\Application\Controller\Api\CourseController::class, 'createCourse']);

