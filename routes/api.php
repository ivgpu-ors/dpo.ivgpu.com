<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\OptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('can:admin')->group(function () {
    Route::get('employees/suggest', [EmployeeController::class, 'suggest']);
    Route::get('employees/get', [EmployeeController::class, 'get']);
    Route::resource('employees', EmployeeController::class)->except(['create', 'edit']);

    Route::post('courses/{course}/toggle', [CourseController::class, 'toggle']);
    Route::resource('courses', CourseController::class)->except(['create', 'edit']);

    Route::resource('options', OptionController::class)->except(['create', 'edit']);
});
