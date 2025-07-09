<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => 'beheer',
    'as' => 'admin.',
    'middleware' => ['web', 'auth', 'verified', 'active'],
], function () {
    // Dashboard
    Route::get('/', DashboardController::class)->name('dashboard');

    // Users
    Route::group([
        'prefix' => 'leden',
        'as' => 'user.'
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/toevoegen', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show')->withTrashed();
        Route::get('/{user}/wijzigen', [UserController::class, 'edit'])->name('edit')->withTrashed();
        Route::get('/{user:uuid}/activeren', [UserController::class, 'activate'])->name('activate');
        Route::patch('/{user}', [UserController::class, 'update'])->name('update')->withTrashed();
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::patch('/{user}/herstellen', [UserController::class, 'restore'])->name('restore')->withTrashed();
    });

    Route::post('/impersonate/leave', [ImpersonateController::class, 'logoutAs'])->name('impersonate.logout');
    Route::post('/impersonate/{user}', [ImpersonateController::class, 'loginAs'])->name('impersonate.login');
});
