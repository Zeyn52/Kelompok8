<?php

  use App\Http\Controllers\DashboardController;
  use Illuminate\Support\Facades\Route;
  use Illuminate\Support\Facades\Auth;

  Route::get('/', function () {
      return view('auth.login');
  });
  
  Auth::routes();

  Route::get('/dashboard', [DashboardController::class, 'index'])
      ->name('dashboard')
      ->middleware('auth');