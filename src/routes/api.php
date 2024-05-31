<?php

use App\Http\Controllers\api\AttendanceController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/company/{id}', [CompanyController::class, 'show'])->middleware('auth:sanctum');
Route::post('/checkin', [AttendanceController::class, 'checkin'])->middleware('auth:sanctum');
Route::post('/checkout', [AttendanceController::class, 'checkout'])->middleware('auth:sanctum');
Route::get('/ischecked', [AttendanceController::class, 'isChecked'])->middleware('auth:sanctum');
//update profile
Route::post('/profile', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
Route::apiResource('permission', PermissionController::class)->middleware('auth:sanctum');
