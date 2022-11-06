<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

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

Route::middleware('guest')->group(fn () =>
    Route::prefix('/login')->controller(LoginController::class)->group(function () {
        Route::get('/', 'create')->name('login');
        Route::post('/', 'store');
    })
);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'user']);
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

