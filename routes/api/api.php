<?php

use App\Http\Controllers\FcmTokenController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    echo 'api';
});

Route::group([
    'middleware' => ['auth', 'active'],
], function () {
    Route::get('/user', function () {
        echo 'user';
    });

    // Notifications
    Route::group([
        'prefix' => 'notifications',
        'as' => 'notifications.',
    ], function () {
        Route::get('/get', [NotificationController::class, 'index'])->name('get');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('readAll');
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/mark-read', [NotificationController::class, 'markOneRead'])->name('markOneRead');
    });

    Route::group([
        'prefix' => 'fcm_tokens',
        'as' => 'fcm_tokens.',
    ], function () {
        Route::post('/', [FcmTokenController::class, 'store'])->name('store');
        Route::delete('/{fcm_token:token}', [FcmTokenController::class, 'destroy'])->name('destroy');
    });

});

