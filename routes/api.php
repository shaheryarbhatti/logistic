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

///// TEACHER ROUTES //////

Route::middleware('auth:sanctum')->post('/save-teacher',['uses' =>'App\Http\Controllers\TeacherController@store','as' => 'teacher.store']);
Route::middleware('auth:sanctum')->get('/get-all-teachers',['uses' =>'App\Http\Controllers\TeacherController@getAllTeachers','as' => 'teacher.getallteacher']);
Route::middleware('auth:sanctum')->post('/update-teacher',['uses' =>'App\Http\Controllers\TeacherController@update','as' => 'teacher.update']);
Route::middleware('auth:sanctum')->get('/delete-teacher/{id}',['uses' =>'App\Http\Controllers\TeacherController@destroy','as' => 'teacher.delete']);
Route::middleware('auth:sanctum')->get('/get-teachers',['uses' =>'App\Http\Controllers\TeacherController@getTeachers','as' => 'teacher.getteachers']);
Route::middleware('auth:sanctum')->get('/teacher-detail/{id}',['uses' =>'App\Http\Controllers\ScheduleController@show','as' => 'teacher.schedule']);


//// SCHEDULE ROUTES ////

Route::middleware('auth:sanctum')->post('/save-schedule',['uses' =>'App\Http\Controllers\ScheduleController@store','as' => 'schedule.store']);
Route::middleware('auth:sanctum')->get('/get-all-schedules',['uses' =>'App\Http\Controllers\ScheduleController@getAllSchedules','as' => 'schedule.getallschedule']);
Route::middleware('auth:sanctum')->post('/update-schedule',['uses' =>'App\Http\Controllers\ScheduleController@update','as' => 'schedule.update']);
Route::middleware('auth:sanctum')->get('/delete-schedule/{id}',['uses' =>'App\Http\Controllers\ScheduleController@destroy','as' => 'schedule.delete']);
