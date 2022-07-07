<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LoanPackageController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UsersController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'user.status', 'admin']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

    Route::group(['prefix' => 'kycs', 'as' => 'kycs.'], function() {
        Route::get('/', [KycController::class, 'index'])->name('index');
        Route::get('/{id}', [KycController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [KycController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [KycController::class, 'reject'])->name('reject');
        Route::post('/{id}/revert', [KycController::class, 'revert'])->name('revert');
    });

    Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function() {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/{id}', [TransactionController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'loan-packages', 'as' => 'loan-packages.'], function() {
        Route::get('/', [LoanPackageController::class, 'index'])->name('index');
        Route::get('/create', [LoanPackageController::class, 'create'])->name('create');
        Route::post('/', [LoanPackageController::class, 'store'])->name('store');
        Route::get('/{id}', [LoanPackageController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LoanPackageController::class, 'update'])->name('update');
        Route::delete('/{id}', [LoanPackageController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'loans', 'as' => 'loans.'], function() {
        Route::get('/', [LoanController::class, 'index'])->name('index');
        Route::get('/{id}', [LoanController::class, 'show'])->name('show');
        Route::get('/{id}/approve', [LoanController::class, 'approve'])->name('approve');
        Route::get('/{id}/reject', [LoanController::class, 'reject'])->name('reject');
        Route::get('/{id}/completed', [LoanController::class, 'complete'])->name('complete');
        Route::get('/{id}/revert', [LoanController::class, 'revert'])->name('revert');
        Route::get('/{id}/delete', [LoanController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/{id}', [UsersController::class, 'show'])->name('show');
        Route::get('/{id}/suspend', [UsersController::class, 'suspend'])->name('suspend');
        Route::get('/{id}/activate', [UsersController::class, 'active'])->name('active');
        Route::get('/{id}/reset-password', [UsersController::class, 'resetPassword'])->name('reset-password');
    });
});
