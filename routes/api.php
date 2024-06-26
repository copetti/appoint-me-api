<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\User\MeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class)->name('login');
Route::post('register', RegisterController::class)->name('register');
Route::post('verify-email', VerifyEmailController::class);
Route::post('forgot-password', ForgotPasswordController::class);
Route::post('reset-password', ResetPasswordController::class);

Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('me', [MeController::class, 'show']);
    //routes that needs a team
    Route::middleware(['team'])->group(function (){

    });
});
