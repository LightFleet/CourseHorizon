<?php

namespace Database\Seeders;

use App\Modules\Course\Infrastructure\Seeder\CourseSeeder;
use App\Modules\Enrollment\Infrastructure\Seeder\EnrollmentSeeder;
use App\Modules\Student\Infrastructure\Seeder\StudentSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(StudentSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(EnrollmentSeeder::class);
    }
}
