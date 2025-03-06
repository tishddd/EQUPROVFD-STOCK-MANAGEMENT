<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protect routes with the custom JWT middleware
Route::middleware('jwt.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getUser']);

    Route::apiResource('devices', DeviceController::class);
    Route::apiResource('devices_issues', DeviceController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('officies', OfficeController::class);
    Route::apiResource('dashbord', HomeController::class);
    Route::apiResource('miscellaneous', MiscellaneousController::class);
    Route::apiResource('users', UserController::class);
});


