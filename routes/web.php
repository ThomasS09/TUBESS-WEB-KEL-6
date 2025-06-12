<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Services Management
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
    Route::post('/services', [AdminController::class, 'storeService'])->name('admin.services.store');
    Route::put('/services/{service}', [AdminController::class, 'updateService'])->name('admin.services.update');
    Route::delete('/services/{service}', [AdminController::class, 'deleteService'])->name('admin.services.delete');
    
    // Reports & Statistics
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
    
    // Bookings Management
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::put('/bookings/{booking}/status', [AdminController::class, 'updateBookingStatus'])
        ->name('admin.bookings.status');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';