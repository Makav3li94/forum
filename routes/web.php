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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/threads', '\App\Http\Controllers\ThreadController', ['except' => [
    'show'
]]);

Route::get('/threads/{channel}/{thread}', [\App\Http\Controllers\ThreadController::class, 'show'])->name('threads.show');
Route::post('/threads/{channel}/{thread}/replies', [\App\Http\Controllers\ReplyController::class, 'store'])->name("add_reply");


Route::get('/threads/{channel}',[\App\Http\Controllers\ThreadController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
