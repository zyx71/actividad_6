<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoboticsKitController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', [TestController::class, 'create']);
Route::get('/getAll', [TestController::class, 'getAll']);
Route::get('/getOne/{id}', [TestController::class, 'getOne']);
Route::get('/update/{id}', [TestController::class, 'update']);
Route::get('/delete/{id}', [TestController::class, 'delete']);
Route::get('/test', [TestController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('robotics', RoboticsKitController::class);

    Route::resource('courses', CourseController::class);
});

require __DIR__.'/auth.php';
