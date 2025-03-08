<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Route for the home page (index)
Route::get('/', [PageController::class, 'index']);

// Route for the dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/login', [PageController::class, 'login']);
