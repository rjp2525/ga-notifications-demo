<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CreateAnnouncementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Announcement;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/announcement/{announcement:slug}', AnnouncementController::class)
        ->name('announcement.view');
    Route::get('/new-announcement', [CreateAnnouncementController::class, 'create'])
        ->name('announcement.create')
        ->can('create', Announcement::class);
    Route::post('/new-announcement', [CreateAnnouncementController::class, 'store'])
        ->can('create', Announcement::class);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
