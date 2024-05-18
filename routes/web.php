<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('qrLogin', ['uses' => 'App\Http\Controllers\QrLoginController@index']);
Route::post('qrLogin', ['uses' => 'App\Http\Controllers\QrLoginController@checkUser']);


//Route::resource('users', 'UserController');
Route::resource('users', UserController::class);

// Admin routes
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('users', UserController::class);
});

// Inside routes/web.php
//Route::resource('users', UserController::class)->middleware(['auth', 'admin']);


//show qr
// Route::get('/users/{user}', 'App\Http\Controllers\UserController@show')->name('users.show');

