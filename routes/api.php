<?php

use App\Http\Controllers\GenerateTokenController;
use App\Http\Controllers\LoanPackageController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Auth
Route::post('/login', GenerateTokenController::class . '@login');
Route::post('/register', RegistrationController::class . '@register');

// Verifications
Route::group(['prefix' => 'verify', 'as' => 'verify.'], function() {
    Route::post('nin', VerificationController::class . '@nin');
    Route::post('phone', VerificationController::class . '@phone');
    Route::post('email', VerificationController::class . '@email');
});

// Send OTP
Route::group(['prefix' => 'otp', 'as' => 'otp.'], function() {
    Route::post('email', OtpController::class . '@email');
    Route::post('phone', OtpController::class . '@phone');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', UserController::class . '@index');
    Route::get('/loan-packages', LoanPackageController::class . '@index');
    Route::post('/logout', GenerateTokenController::class . '@logout');
});
