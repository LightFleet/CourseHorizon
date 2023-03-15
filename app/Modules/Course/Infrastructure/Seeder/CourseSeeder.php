<?php

namespace App\Modules\Course\Infrastructure\Seeder;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('courses')->insert([
                'title' => $faker->sentence,
            ]);
        }
    }
}
