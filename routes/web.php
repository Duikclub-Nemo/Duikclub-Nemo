<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ReleaseNotesController;
use App\Http\Controllers\TermsController;
use App\Models\User;
use App\Services\FcmService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', HomeController::class)->name('home');

// News
Route::group(['prefix' => 'nieuws', 'as' => 'news.'], function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('{news:slug}', [NewsController::class, 'show'])->name('show');
});

// About
Route::group(['prefix' => 'over', 'as' => 'about.'], function () {
    Route::get('/', [AboutController::class, 'about'])->name('about');
    Route::get('leslocatie', [AboutController::class, 'location'])->name('location');
    Route::get('lidmaatschap', [AboutController::class, 'membership'])->name('membership');
    Route::get('nob', [AboutController::class, 'federation'])->name('federation');
    Route::get('proefles', [AboutController::class, 'trail'])->name('trail');
});

// Activities
Route::group(['prefix' => 'agenda', 'as' => 'activities.'], function () {
    Route::get('/', [ActivitiesController::class, 'index'])->name('index');
    Route::get('{activities}', [ActivitiesController::class, 'show'])->name('show');
});

// Certifications
Route::group(['prefix' => 'opleidingen', 'as' => 'certification.'], function () {
    Route::get('/', [CertificationController::class, 'index'])->name('index');
    Route::get('/1ster-specialties', [CertificationController::class, 'specialties1'])->name('specialties1');
    Route::get('/2ster-specialties', [CertificationController::class, 'specialties2'])->name('specialties2');
    Route::get('/3ster-specialties', [CertificationController::class, 'specialties3'])->name('specialties3');
    Route::get('/pvb-eigen-vaardigheden', [CertificationController::class, 'skills'])->name('skills');
    Route::get('/reanimatie', [CertificationController::class, 'cpr'])->name('cpr');
});

// Media
Route::group(['prefix' => 'galerij', 'as' => 'gallery.'], function () {
    Route::get('/', [GalleryController::class, 'index'])->name('index');
});

// Blog
Route::group(['prefix' => 'duiken', 'as' => 'blog.'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('{blog}', [BlogController::class, 'show'])->name('show');
});

// Contact
Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
    Route::get('/', [ContactController::class, 'create'])->name('create');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// Terms & Conditions
Route::get('/algemene-voorwaarden', TermsController::class)->name('terms');

// Privacy Policy
Route::get('/privacy-policy', PrivacyPolicyController::class)->name('privacy_policy');

// Release Notes
Route::get('/release-notes', ReleaseNotesController::class)->name('release_notes');


Route::get('/test/{id}', function (FcmService $fcmService, $id) {
    $fcmService->sendToUser(
        User::findOrFail($id),
        [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'url' => 'https://dev.dcnemo.nl/over',
            'messageId' => uniqid('user_reg_'),
            'imageUrl' => '/images/apple-touch-icon.png',
        ],
    );

    dump($fcmService);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/member.php';
