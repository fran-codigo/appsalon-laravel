<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Verificar Usuario con email
Route::get('email/verify/{id}/{hash}', [VerifyEmail::class, 'verify'])->middleware('auth:sanctum')->name('verification.verify');
Route::get('email/resend', [VerifyEmail::class, 'resend'])->middleware('auth:sanctum')->name('verification.resend');

Route::post('/auth/register', [AuthController::class, 'register']);

Route::resource('services', ServiceController::class);
