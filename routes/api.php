<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register'])->name('register.user');
Route::get('/auth/verify-account/{token}', [AuthController::class, 'verifyUser'])->name('verify.user');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.user');
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout.user');
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/auth/forgot-password/{token}', [AuthController::class, 'verifyPasswordResetToken'])->name('verify-password-reset-token');

Route::get('/user', [UserController::class, 'index'])->middleware('auth:sanctum')->name('user.index');
Route::get('/user/appointments', [UserController::class, 'getAppointments'])->middleware('auth:sanctum')->name('user.appointments');


Route::resource('services', ServiceController::class);

Route::apiResource('appointments', AppointmentController::class)->middleware('auth:sanctum');

Route::get('appointments-date', [AppointmentController::class, 'appointmentsByDate'])->middleware('auth:sanctum')->name('appointments.date');
