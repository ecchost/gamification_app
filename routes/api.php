<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('roles', App\Http\Controllers\API\RoleAPIController::class);


Route::resource('courses', App\Http\Controllers\API\CourseAPIController::class);


Route::resource('lessons', App\Http\Controllers\API\lessonAPIController::class);


Route::resource('contents', App\Http\Controllers\API\ContentAPIController::class);


Route::resource('questions', App\Http\Controllers\API\QuestionAPIController::class);
