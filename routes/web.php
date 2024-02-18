<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/save_student', [StudentController::class, 'save_student']);
Route::get('/all_student', [StudentController::class, 'all_student']);
Route::get('/edit_student/{id}', [StudentController::class, 'edit_student']);
Route::put('/update_student', [StudentController::class, 'update_student']);
Route::delete('/delete_student/{id}', [StudentController::class, 'delete_student']);