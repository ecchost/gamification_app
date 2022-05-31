<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, "index"])->name("home");

Route::prefix('api')->middleware('api')->as('api.');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get("/", [App\Http\Controllers\Admin\DashboardController::class, "index"])->name("dashboard");
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);
    Route::resource('lessons', App\Http\Controllers\Admin\lessonController::class);
    Route::resource('contents', App\Http\Controllers\Admin\ContentController::class);
    Route::resource('questions', App\Http\Controllers\Admin\QuestionController::class);
});

Route::group(['middleware' => ["auth"]], function(){
    Route::get("/courses/my_course", [\App\Http\Controllers\StudentCourseController::class, "index"])->name("student_course.my_course");
    Route::post("/take_course", [\App\Http\Controllers\StudentCourseController::class, "takeCourse"])->name("student_course.take");
    Route::get("/courses/my_course/{course_id}", [\App\Http\Controllers\StudentCourseController::class, "my_course"])->name("student_course.my_course.detail");
});

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');
