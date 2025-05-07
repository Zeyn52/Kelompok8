<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{id}', [LetterController::class, 'show'])->name('dashboard.show');
    Route::get('/letters/create', [LetterController::class, 'create'])->name('letters.create');
    Route::post('/letters', [LetterController::class, 'store'])->name('letters.store');
    Route::patch('/letters/{id}/status', [LetterController::class, 'updateStatus'])->name('letters.updateStatus');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});