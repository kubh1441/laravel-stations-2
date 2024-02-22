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

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminController;
//use App\Practice;

// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);
Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/sheets', [MovieController::class, 'sheets']);

Route::get('admin/movies', [AdminController::class, 'index']);
Route::get('admin/movies/create', [AdminController::class, 'create']);
Route::post('admin/movies/store', [AdminController::class, 'store']);
Route::get('admin/movies/{id}/edit', [AdminController::class, 'edit']);
Route::patch('admin/movies/{id}/update', [AdminController::class, 'update']);
Route::delete('admin/movies/{id}/destroy', [AdminController::class, 'delete']);


/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/practice', function() {
    return response('practice');
});

Route::get('/practice2', function() {
    $test = 'practice2';
    return response($test);
});

Route::get('/practice3', function() {
    $test = 'test';
    return response($test);
});
*/