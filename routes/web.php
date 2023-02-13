<?php

use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
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

Route::get('/', fn() => redirect('/posts'));

Route::post('change', DatabaseController::class)->name('change');

Route::resource('posts', PostController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('tasks', TaskController::class)->only(['index', 'store', 'update', 'destroy']);

