<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth')->name('home')->get('/', function () {
    return view('home');
});

Route::controller(AuthController::class)->group(function() {
    Route::post('login','login');
    Route::post('register','register');
    Route::get('logout','logout');
});

Route::name('login')->get('/login', function () {
    return view('login');
});

Route::name('register')->get('/register', function () {
    return view('register');
});

