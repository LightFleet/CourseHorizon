<?php

namespace App\Modules\Enrollment\Infrastructure\Seeder;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $courseIds = DB::table('courses')->pluck('id')->toArray();
        $userIds = DB::table('students')->pluck('id')->toArray();

        foreach ($courseIds as $courseId) {
            $usersCount = rand(20, 40);
            $userIdsForCourse = $faker->randomElements($userIds, $usersCount);

            foreach ($userIdsForCourse as $userId) {
                DB::table('enrollments')->insert([
                    'course_id' => $courseId,
                    'student_id' => $userId,
                    'status' => rand(0, 1),
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
