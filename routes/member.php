<?php

use App\Http\Controllers\Member\CertificateController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\NotificationSettingsController;
use App\Http\Controllers\Member\OtherBrowserSessionsController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\SettingController;
use App\Http\Controllers\Member\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => 'leden',
    'as' => 'member.',
    'middleware' => ['web', 'auth', 'verified', 'active'],
], function () {
    // Dashboard
    Route::get('/', DashboardController::class)->name('dashboard');

    // Profile
    Route::group([
        'prefix' => 'profiel',
        'as' => 'profile.',
    ], function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/wijzig', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Certificate
    Route::group([
        'prefix' => 'brevetten',
        'as' => 'certificate.',
    ], function () {
        Route::get('/', [CertificateController::class, 'index'])->name('index');
        Route::get('/toevoegen', [CertificateController::class, 'create'])->name('create');
        Route::post('/', [CertificateController::class, 'store'])->name('store');
        Route::get('/{certificate_user}', [CertificateController::class, 'show'])->name('show');
        Route::get('/{certificate_user}/wijzig', [CertificateController::class, 'edit'])->name('edit');
        Route::patch('/{certificate_user}', [CertificateController::class, 'update'])->name('update');
        Route::delete('/{certificate_user}', [CertificateController::class, 'destroy'])->name('destroy');
    });

    // Users
    Route::group([
        'prefix' => 'ledenlijst',
        'as' => 'user.',
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user:uuid}', [UserController::class, 'show'])->name('show');
    });

    // Activities
    Route::group([
        'prefix' => 'agenda',
        'as' => 'activity.',
    ], function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');

    });

    // Subscriptions
    Route::group([
        'prefix' => 'aanmeldingen',
        'as' => 'subscription.',
    ], function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');

    });

    // Downloads
    Route::group([
        'prefix' => 'downloads',
        'as' => 'download.',
    ], function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');

    });

    // Settings
    Route::group([
        'prefix' => 'instellingen',
        'as' => 'setting.',
    ], function () {
        Route::get('/', [SettingController::class, 'edit'])->name('edit');
        Route::patch('/', [SettingController::class, 'update'])->name('update');
        Route::patch('/notificaties', [NotificationSettingsController::class, 'update'])->name('update_notifications');
        Route::delete('/sessies', [OtherBrowserSessionsController::class, 'destroy'])->name('destroy_sessions');
    });

});
