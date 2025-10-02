<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\RoboticsKit;

class CourseSeeder extends Seeder
{
public function run(): void
{
    // Supón que los kits ya existen y quieres asignar por ID
    // Puedes obtener los IDs de los kits por orden o por nombre
    $starterKitId = RoboticsKit::where('name', 'StarterKit')->value('id');
    $educationalKitId = RoboticsKit::where('name', 'Educational Robotics Kit')->value('id');
    $kit5Id = RoboticsKit::where('name', 'Kit5')->value('id');

    $courses = [
        [
            'course_key' => 'Rob101',
            'course_name' => 'Introduction to Robotics',
            'robotics_kit_id' => $starterKitId,
        ],
        [
            'course_key' => 'Rob102',
            'course_name' => 'Introduction to Automation',
            'robotics_kit_id' => $starterKitId,
        ],
        [
            'course_key' => 'Rob103',
            'course_name' => 'Programming for Robotics',
            'robotics_kit_id' => $educationalKitId,
        ],
        [
            'course_key' => 'Rob104',
            'course_name' => 'Characteristics of a Robot',
            'robotics_kit_id' => $kit5Id,
        ],
    ];

    foreach ($courses as $course) {
        Course::create($course);
    }
}
}