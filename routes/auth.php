<?php

use App\Http\Controllers\Admin\CKEditorImageUploadController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Member\AvatarController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login
    Route::get('inloggen', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('inloggen', [AuthenticatedSessionController::class, 'store'])->name('login');

    // Register
    Route::get('registreren', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('registreren', [RegisteredUserController::class, 'store'])->name('register');

    // Forgot Password
    Route::get('wachtwoord-vergeten', [PasswordResetLinkController::class, 'create'])->name('password.forgot');
    Route::post('wachtwoord-vergeten', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Reset Password
    Route::get('reset-wachtwoord/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-wachtwoord', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware(['auth'])->group(function () {
    // Verify email
    Route::get('bevestig-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('bevestig-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    // Password
    Route::get('bevestig-wachtwoord', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('bevestig-wachtwoord', [ConfirmablePasswordController::class, 'store'])->name('password.confirm');;
    Route::put('wachtwoord', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('uitloggen', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth', 'verified', 'active'])->group(function () {
    /* CKEditor */
    Route::post('/ck_upload/{folder?}', CKEditorImageUploadController::class)->name('ck_upload');

    /* Avatar */
    Route::post('/avatar_upload', [AvatarController::class, 'store'])->name('avatar.store');
    Route::delete('/avatar_delete', [AvatarController::class, 'destroy'])->name('avatar.destroy');
});
