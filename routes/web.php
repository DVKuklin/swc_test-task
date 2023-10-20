<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, EventsController, UsersController};

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
    Route::get('login','loginPage')->name('login');
    Route::post('login','login');
    Route::get('register','registerPage')->name('register');
    Route::post('register','register');
    Route::get('logout','logout');
});

Route::prefix('events')
        ->middleware('auth')
        ->controller(EventsController::class)
        ->group(function() {
    Route::get('create','createEventPage')->name('create-event');
    Route::post('create','create');
    Route::get('','getEventsList');
    Route::get('{id}','eventPage');
});

Route::prefix('users')
        ->middleware('auth')
        ->controller(UsersController::class)
        ->group(function() {
    Route::get('get','getUser');
});

