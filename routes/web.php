<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfielController;
use App\Http\Controllers\EventAanmeldController;

Route::get('/', function () {
    return view('dashboardLogin');
});
Route::get('/login', function () {
    return view('dashboardLogin');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get('/home', [HomeController::class, 'GetHomeData']);
Route::post('/home', [HomeController::class, 'zoekEvent']);

Route::get('/registreer', function () {
    return view('registratie');
});
Route::post('/registreer', [SignUpController::class, 'signup']);

Route::post('/uitloggen', [AuthController::class, 'logout']);

Route::get('/aangemeldenEvent', [EventAanmeldController::class, 'zieAangelemdeEvents']);
Route::post('/aangemeldenEvent', [EventAanmeldController::class, 'aanmeldEvent']);

Route::get('/profiel', [ProfielController::class, 'ProfielRead']);

Route::post('/profiel/update-email', [ProfielController::class, 'ProfielUpdateEmail']);
Route::post('/profiel/update-location', [ProfielController::class, 'ProfielUpdateLocation']);
Route::post('/profiel/update-password', [ProfielController::class, 'ProfielUpdatePassword']);
Route::post('/profiel/Delete', [ProfielController::class, 'ProfielDelete']);
