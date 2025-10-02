<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\RoboticsKit;
use App\Models\Course;
use App\Models\User;

try {
    $kit = RoboticsKit::first() ?? RoboticsKit::create(['name' => 'Default Kit']);
    $course = Course::first() ?? Course::create([
        'course_key' => 'TEST101',
        'course_name' => 'Test 101',
        'robotics_kit_id' => $kit->id,
    ]);

    $user = User::where('email', 'test@example.com')->first();
    if (! $user) {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);
    }

    $user->courses()->syncWithoutDetaching([$course->id]);
    echo "Attached: ";
    echo $user->courses()->pluck('course_name')->implode(', ');
    echo PHP_EOL;

    $user->courses()->detach($course->id);
    echo "After detach: ";
    echo $user->courses()->pluck('course_name')->implode(', ');
    echo PHP_EOL;

    exit(0);
} catch (Throwable $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(1);
}
