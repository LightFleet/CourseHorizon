<?php

use App\Modules\Course\Application\Controller\Api\CourseController;
use App\Modules\Enrollment\Application\Controller\Api\EnrollmentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/course', [CourseController::class, 'createCourse']);
Route::patch('/course/{course}', [CourseController::class, 'updateCourse']);
Route::delete('/course/{course}', [CourseController::class, 'deleteCourse']);

Route::post('/enrollment', [EnrollmentController::class, 'createEnrollment']);
Route::patch('/enrollment/{enrollment}', [EnrollmentController::class, 'updateEnrollment']);
Route::delete('/enrollment/{enrollment}', [EnrollmentController::class, 'deleteEnrollment']);

Route::get('/enrollments', [EnrollmentController::class, 'fetchEnrollments']);
