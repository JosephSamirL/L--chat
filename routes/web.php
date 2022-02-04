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

Auth::routes();

Route::get('/room/{num}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/rooms', [App\Http\Controllers\RoomsController::class, 'index'])->name('rooms');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'create']);
Route::post('/roomy', [App\Http\Controllers\RoomsController::class, 'create']);
Route::get('/messages', [App\Http\Controllers\ajaxMessages::class, 'fetch']);
Route::get('/users', [App\Http\Controllers\ajaxMessages::class, 'fetchUser']);
Route::get('/roomies',[App\Http\Controllers\RoomsController::class, 'fetchRoom']);
Route::post('/destroy', [App\Http\Controllers\ajaxMessages::class, 'removeMessage']);
Route::post('/destroyRoom', [App\Http\Controllers\ajaxMessages::class, 'removeRoom']);
Route::post('/imageupload', [App\Http\Controllers\ajaxMessages::class, 'store']);
