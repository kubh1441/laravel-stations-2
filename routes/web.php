<?php

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

use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'detail']);
Route::get('/sheets', [MovieController::class, 'sheets']);

Route::get('admin/movies', [AdminController::class, 'index']);
Route::get('admin/movies/create', [AdminController::class, 'create']);
Route::post('admin/movies/store', [AdminController::class, 'store']);
Route::get('admin/movies/{id}/edit', [AdminController::class, 'edit']);
Route::patch('admin/movies/{id}/update', [AdminController::class, 'update']);
Route::delete('admin/movies/{id}/destroy', [AdminController::class, 'delete']);
Route::get('admin/movies/{id}', [AdminController::class, 'detail']);

Route::get('admin/schedules', [ScheduleController::class, 'index']);
Route::get('admin/schedules/{scheduleId}/edit', [ScheduleController::class, 'edit']);
Route::get('/admin/movies/{id}/schedules/create', [ScheduleController::class, 'create']);
Route::post('/admin/movies/{id}/schedules/store', [ScheduleController::class, 'store']);
Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'update']);
Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class, 'delete']);
Route::get('admin/schedules/{id}', [ScheduleController::class, 'detail']);
