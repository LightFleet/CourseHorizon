<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Modules\Course\Application\Controller\Web\CourseController::class, 'list']);
