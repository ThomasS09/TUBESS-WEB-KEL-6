<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WorkScheduleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    });

    // Employee routes
    Route::middleware(['role:employee'])->prefix('employee')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');
        Route::resource('work-schedules', WorkScheduleController::class);
        Route::resource('schedules', ScheduleController::class);
        Route::post('/employee/work-schedules', [WorkScheduleController::class, 'store'])->name('work-schedules.store');
        Route::get('/today-work', [WorkScheduleController::class, 'todayWork'])->name('employee.today-work');
        Route::get('/employee/edit/{id}', [App\Http\Controllers\WorkScheduleController::class, 'editEmployee'])->name('employee.edit');
        Route::put('/employee/update/{id}', [App\Http\Controllers\WorkScheduleController::class, 'updateEmployee'])->name('employee.update');
    });

    // Customer routes
    Route::middleware(['role:customer'])->group(function () {
        Route::resource('vehicles', VehicleController::class);
        Route::resource('bookings', BookingController::class);
    });

    // Transaction routes
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';