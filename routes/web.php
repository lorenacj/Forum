<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Auth;


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


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/', [App\Http\Controllers\ForumController::class, 'index'])->name('index');

//Route::get('/forums', [App\Http\Controllers\ForumController::class, 'index'])->name('index');

Route::resource('forums',ForumController::class);

Route::resource('posts', PostController::class);

Route::resource('replys', ReplyController::class);
//Route::post('/forums', 'ForumController@store');