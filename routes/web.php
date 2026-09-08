<?php

// use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Employee\DepartmentController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\PositionController;
use App\Http\Controllers\Employee\ShiftController;
use Illuminate\Support\Facades\Route;

// ============================================
// 1. ROOT - Redirect ke halaman login
// ============================================
Route::get('/', function () {
    return redirect()->route('login');
});

// ============================================
// 2. ROUTE GOOGLE LOGIN (Socialite) - DIKOMMENTARI
// ============================================
// Route::get('/login/google', [SocialiteController::class, 'redirectToGoogle'])
//     ->name('login.google');
// Route::get('/login/google/callback', [SocialiteController::class, 'handleGoogleCallback'])
//     ->name('login.google.callback');

// ============================================
// 3. DASHBOARD (harus login)
// ============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// ============================================
// 4. MODUL HR (Department, Position, Shift, Employee)
// ============================================
Route::middleware(['auth'])->group(function () {

    // Department
    Route::resource('departments', DepartmentController::class)
        ->middleware('permission:employee.view|employee.create|employee.update|employee.delete')
        ->except(['show']);

    // Position
    Route::resource('positions', PositionController::class)
        ->middleware('permission:employee.view|employee.create|employee.update|employee.delete')
        ->except(['show']);

    // Shift
    Route::resource('shifts', ShiftController::class)
        ->middleware('permission:employee.view|employee.create|employee.update|employee.delete')
        ->except(['show']);

    // Employee
    Route::resource('employees', EmployeeController::class)
        ->middleware('permission:employee.view|employee.create|employee.update|employee.delete')
        ->except(['show']);
});

// ============================================
// 5. ROUTE PROFILE SEMENTARA (untuk menghindari error)
// ============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return redirect()->route('dashboard');
    })->name('profile.edit');
});

// ============================================
// 6. ROUTE AUTH BAWAAN BREEZE
// ============================================
require __DIR__.'/auth.php';
