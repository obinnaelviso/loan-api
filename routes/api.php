<?php

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\GenerateTokenController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanPackageController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
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

// Handle paystack webhook
Route::post('card/webhook', CardController::class . '@webhook');

// Send OTP
Route::group(['prefix' => 'otp', 'as' => 'otp.'], function() {
    Route::post('email', OtpController::class . '@email');
    Route::post('phone', OtpController::class . '@phone');
});

Route::middleware(['auth:sanctum', 'user.status'])->group(function () {
    Route::get('/me', UserController::class . '@index');
    Route::post('profile/update', UserController::class . '@update');
    Route::put('profile/update-kin', UserController::class . '@updateKin');
    Route::get('/loan-packages', LoanPackageController::class . '@index');
    Route::post('/logout', GenerateTokenController::class . '@logout');

    // Bank Accounts
    Route::group(['prefix' => 'bank-accounts', 'as' => 'bank-accounts.', 'middleware' => 'user'], function() {
        Route::get('/', BankAccountController::class . '@index');
        Route::post('/', BankAccountController::class . '@store');
        Route::delete('/{id}', BankAccountController::class . '@destroy');
        Route::put('/{id}', BankAccountController::class . '@update');
    });

    // Loans
    Route::group(['prefix' => 'loan', 'as' => 'loan.'], function() {
        // Admin
        Route::get('/', LoanController::class . '@index')->middleware('admin');
        Route::get('/current', LoanController::class . '@currentLoan');
        Route::put('/status/{loanId}/{status}', LoanController::class . '@statusUpdate')->middleware('admin');
        Route::delete('/{loanId}', LoanController::class . '@destroy')->middleware('admin');
        // User
        Route::post('/apply', LoanController::class . '@apply')->middleware('user');
    });

    Route::group(['prefix' => 'card', 'as' => 'card.'], function() {
        Route::get('/', CardController::class . '@index')->middleware('user');
        Route::get('/all', CardController::class . '@all')->middleware('admin');
        Route::post('/pay-loan/{loan_id}/{card_id?}', CardController::class . '@payLoan')->middleware('user');
        Route::post('/save-card', CardController::class . '@saveCard')->middleware('user');
    });

    Route::get('/transactions', TransactionController::class . '@index')->middleware('user');
    Route::get('/transactions/all', TransactionController::class . '@all')->middleware('admin');
});
