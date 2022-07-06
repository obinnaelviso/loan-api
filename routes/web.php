<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KycController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    Route::get('/kycs', [KycController::class, 'index'])->name('kycs.index');
    Route::get('/kycs/{id}', [KycController::class, 'show'])->name('kycs.show');
    Route::put('/kycs/{id}/approve', [KycController::class, 'approve'])->name('kycs.approve');
    Route::put('/kycs/{id}/reject', [KycController::class, 'reject'])->name('kycs.reject');
    Route::put('/kycs/{id}/revert', [KycController::class, 'revert'])->name('kycs.revert');
});
