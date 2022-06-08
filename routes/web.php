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

// Test mailables
Route::get('/mail', function () {
    return new App\Mail\OTPEmail('128288', 15);
});

Route::get('/', function () {
    return view('welcome');
});
