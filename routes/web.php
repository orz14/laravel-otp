<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'loginIndex'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');
    Route::get('/register', [AuthController::class, 'registerIndex'])->name('register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');
});

Route::middleware(['auth', 'otp'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::patch('/otp-setting', [DashboardController::class, 'otpSetting'])->name('otp.setting');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'otp.check'])->group(function () {
    Route::get('/otp', [OTPController::class, 'index'])->name('otp');
    Route::post('/otp', [OTPController::class, 'store'])->name('otp.store');
    Route::post('/otp/resend', [OTPController::class, 'resend'])->name('otp.resend');
});
