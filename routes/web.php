<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

Route::middleware(['auth', 'member'])->group(function() {
    Route::get('/courses/{course_id}/signup/{option_id}', [CourseController::class, 'signup'])->name('courses.signup');
    Route::post('/courses/{course_id}/signup/{option_id}', [CourseController::class, 'order'])->name('courses.order');
});

Route::middleware(['auth', 'can:study'])->group(function() {
    Route::get('/order/success', [OrderController::class, 'success']);
    Route::get('/order/fail', [OrderController::class, 'fail']);
    Route::get('/order/{order}', [OrderController::class, 'register'])->middleware('can:view-order,order')->name('order.register');

    Route::get('/account', [AccountController::class, 'orders'])->name('account.orders');
});

Route::view('admin{any}', 'backend.app')->where('any', '.*')->middleware('auth');
