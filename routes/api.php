<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceEssueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\BatchesController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DeviceTransferController;
use App\Http\Controllers\UserCategoryController;
use App\Http\Controllers\BatchDeviceExportController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('devices', DeviceController::class);
Route::get('/devicesByregionCode', [DeviceController::class, 'getDevicesByRegion']);
// reports
Route::get('/export-batch-devices', [BatchDeviceExportController::class, 'export']);

// Protect routes with the custom JWT middleware
Route::middleware('jwt.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/reports/transactions', [DashboardController::class, 'transactionsReport']);
    Route::get('/reports/issues', [DashboardController::class, 'issuesReport']);
    Route::get('/office-device-counts', [DashboardController::class, 'getOfficeDeviceCounts']);
    Route::get('/total-device-counts', [DashboardController::class, 'getTotalDeviceCounts']);
    Route::post('/import-excel', [DeviceController::class, 'importExcel']);
    Route::get('/export-devices', [DashboardController::class, 'exportDevices']);
    Route::get('/getStock/{batch_id}', [StockController::class, 'getStockByBatch'])->name('getStock');
    Route::get('/stats/{batch_id}', [StockController::class, 'stats']);
    Route::post('/transfer-device', [DeviceTransferController::class, 'transferDevice']);




    
    Route::apiResource('users', UserController::class);
    Route::apiResource('userCategory', UserCategoryController::class);
    Route::apiResource('devices', DeviceController::class);
    Route::apiResource('devices_issues', DeviceEssueController::class);
    Route::apiResource('officies', OfficeController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('batches', BatchesController::class);

    // Route::apiResource('miscellaneous', MiscellaneousController::class);




});
