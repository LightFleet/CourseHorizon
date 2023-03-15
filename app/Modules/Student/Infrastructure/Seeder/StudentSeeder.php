<?php

namespace App\Modules\Student\Infrastructure\Seeder;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('students')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
            ]);
        }
    }
}
