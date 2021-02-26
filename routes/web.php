<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class);
Route::get('/courses/{course_id}', [CourseController::class, 'show'])->name('courses.show');

Route::middleware(['auth', 'member', 'can:study'])->group(function() {
    Route::get('/courses/{course}/signup/{option_id}', [CourseController::class, 'signup'])->name('courses.signup');
    Route::post('/courses/{course}/signup/{option_id}', [CourseController::class, 'order'])->name('courses.order');
});

Route::view('admin{any}', 'backend.app')->where('any', '.*')->middleware('auth');
