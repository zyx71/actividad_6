<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'course_key' => 'Rob101',
                'course_name' => 'Introduction to Robotics',
                'robotics_kit' => 'StarterKit',
            ],
            [
                'course_key' => 'Rob102',
                'course_name' => 'Introduction to Automation',
                'robotics_kit' => 'StarterKit',
            ],
            [
                'course_key' => 'Rob103',
                'course_name' => 'Programming for Robotics',
                'robotics_kit' => 'Educational Robotics Kit',
            ],
            [
                'course_key' => 'Rob104',
                'course_name' => 'Characteristics of a Robot',
                'robotics_kit' => 'Kit5',
            ],
        ]);
    }
}
