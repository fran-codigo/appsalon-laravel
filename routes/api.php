<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VerifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');

// Verificar Usuario con email
Route::get('email/verify/{id}/{hash}', [VerifyController::class, 'verify'])->middleware(['auth:sanctum', 'signed'])->name('verification.verify');
Route::get('email/resend', [VerifyController::class, 'resend'])->middleware('auth:sanctum')->name('verification.resend');

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::resource('services', ServiceController::class);
