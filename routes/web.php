<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
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
})->middleware('auth');

// Route::get('/login',[AuthController::class, 'login']);
Route::view('/login','login')->name('login');
Route::post('/login',[AuthController::class, 'login']);
// Route::get('/register',[AuthController::class, 'register'])->name('register.view');
Route::view('/register','register')->name('register.view');
Route::post('/register',[AuthController::class, 'Register'])->name('register');
Route::post('/verify',[AuthController::class, 'VerifyEmail'])->name('verify');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

