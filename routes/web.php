<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ThesisGuidanceController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

// Rute untuk login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Rute untuk registrasi
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rute untuk reset password
Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/letters/create', [LetterController::class, 'create'])->name('letters.create');
    Route::post('/letters', [LetterController::class, 'store'])->name('letters.store');
    Route::patch('/letters/{id}/status', [LetterController::class, 'updateStatus'])->name('letters.updateStatus');
    Route::get('/thesis-guidances/create', [ThesisGuidanceController::class, 'create'])->name('thesis_guidances.create');
    Route::post('/thesis-guidances', [ThesisGuidanceController::class, 'store'])->name('thesis_guidances.store');
    Route::get('/thesis-guidances/supervisor', [ThesisGuidanceController::class, 'supervisor'])->name('thesis_guidances.supervisor');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/settings', [AdminController::class, 'systemSettings'])->name('admin.settings');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard/get-letter/{id}', [DashboardController::class, 'getLetterDetails'])->name('dashboard.getLetter');
});