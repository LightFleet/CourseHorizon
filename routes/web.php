<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Modules\Enrollment\Application\Controller\Web\CourseController::class, 'list']);
