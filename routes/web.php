<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Route for the home page (index)
Route::get('/', [PageController::class, 'index']);

// Route for the dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/login', [PageController::class, 'login']);
Route::get('/add-stock', [PageController::class, 'addStock'])->name('addStock');
Route::get('/stock-list', [PageController::class, 'stockList'])->name('stockList');
Route::get('/goToStock/{batch_id}', [PageController::class, 'goToStock'])->name('goToStock');
Route::get('/report-stock', [PageController::class, 'reportStock'])->name('report-stock');
Route::get('/transfers', [PageController::class, 'stockTransfer'])->name('stockTransfer');
Route::get('/transaction', [PageController::class, 'stockTransaction'])->name('stockTransaction');
Route::get('/returns', [PageController::class, 'stockReturns'])->name('returns');
Route::get('/revenue-report', [PageController::class, 'revenueReport'])->name('revenue-report');
Route::get('/users', [PageController::class, 'getUsers'])->name('getUsers');
Route::get('/office', [PageController::class, 'getOffice'])->name('getOffice');



