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

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/sheets', [MovieController::class, 'sheets']);

Route::get('admin/movies', [AdminController::class, 'index']);
Route::get('admin/movies/create', [AdminController::class, 'create']);
Route::post('admin/movies/store', [AdminController::class, 'store']);
Route::get('admin/movies/{id}/edit', [AdminController::class, 'edit']);
Route::patch('admin/movies/{id}/update', [AdminController::class, 'update']);
Route::delete('admin/movies/{id}/destroy', [AdminController::class, 'delete']);