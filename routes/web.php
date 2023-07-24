<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;

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

Route::controller(PostController::class)->group(function () {
    Route::get('posts', 'index');
    Route::get('posts/update', 'update');
    Route::get('posts/store', 'store');
    Route::get('posts/delete', 'delete');
});

Route::get('users', [UserController::class, 'index']);
Route::get('todos', [TodoController::class, 'index']);
