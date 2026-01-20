<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\PartnerPreferenceController;
use App\Http\Controllers\User\InterestController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\PhotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Guest Routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login']);
    });

    // Admin Authenticated Routes
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

        // User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminUserController::class, 'show'])->name('show');
            Route::post('/{id}/status', [AdminUserController::class, 'updateStatus'])->name('status');
            Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
        });

        // Profile Management
        Route::prefix('profiles')->name('profiles.')->group(function () {
            Route::get('/', [AdminProfileController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminProfileController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [AdminProfileController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [AdminProfileController::class, 'reject'])->name('reject');
        });
    });
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    // User Guest Routes
    Route::middleware('guest')->group(function () {
        Route::get('register', [UserAuthController::class, 'showRegister'])->name('register');
        Route::post('register', [UserAuthController::class, 'register']);
        Route::get('login', [UserAuthController::class, 'showLogin'])->name('login');
        Route::post('login', [UserAuthController::class, 'login']);
    });

    // User Authenticated Routes
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [UserAuthController::class, 'logout'])->name('logout');

        // Profile Routes
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [UserProfileController::class, 'show'])->name('show');
            Route::get('/edit', [UserProfileController::class, 'edit'])->name('edit');
            Route::post('/update', [UserProfileController::class, 'update'])->name('update');
            Route::get('/{id}', [UserProfileController::class, 'show'])->name('view');
        });

        // Partner Preference Routes
        Route::prefix('partner-preference')->name('partner-preference.')->group(function () {
            Route::get('/edit', [PartnerPreferenceController::class, 'edit'])->name('edit');
            Route::post('/update', [PartnerPreferenceController::class, 'update'])->name('update');
        });

        // Search Routes
        Route::get('search', [SearchController::class, 'index'])->name('search');

        // Interest Routes
        Route::prefix('interests')->name('interests.')->group(function () {
            Route::get('/', [InterestController::class, 'index'])->name('index');
            Route::post('/{userId}/send', [InterestController::class, 'send'])->name('send');
            Route::post('/{interestId}/respond', [InterestController::class, 'respond'])->name('respond');
            Route::delete('/{interestId}/cancel', [InterestController::class, 'cancel'])->name('cancel');
        });

        // Message Routes
        Route::prefix('messages')->name('messages.')->group(function () {
            Route::get('/', [MessageController::class, 'index'])->name('index');
            Route::get('/{userId}', [MessageController::class, 'show'])->name('show');
            Route::post('/{userId}/send', [MessageController::class, 'send'])->name('send');
        });

        // Photo Routes
        Route::prefix('photos')->name('photos.')->group(function () {
            Route::get('/', [PhotoController::class, 'index'])->name('index');
            Route::post('/', [PhotoController::class, 'store'])->name('store');
            Route::post('/{photoId}/set-profile', [PhotoController::class, 'setAsProfile'])->name('set-profile');
            Route::delete('/{photoId}', [PhotoController::class, 'destroy'])->name('destroy');
        });
    });
});

