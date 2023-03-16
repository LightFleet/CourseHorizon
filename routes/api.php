<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/course', [\App\Modules\Course\Application\Controller\Api\CourseController::class, 'createCourse']);
Route::patch('/course/:id', [\App\Modules\Course\Application\Controller\Api\CourseController::class, 'updateCourse']);
Route::delete('/course/:id', [\App\Modules\Course\Application\Controller\Api\CourseController::class, 'deleteCourse']);

Route::get('/enrollments', [\App\Modules\Enrollment\Application\Controller\Api\EnrollmentController::class, 'fetchEnrollments']);
