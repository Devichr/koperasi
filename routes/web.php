<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TreasurerLoanController;
use App\Http\Controllers\ChairLoanController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware('auth')->group(function () {
    // Rute untuk anggota
    Route::middleware([RoleMiddleware::class . ':anggota'])->group(function () {
        Route::get('loans/create', [LoanController::class, 'create'])->name('loans.create');
        Route::post('loans', [LoanController::class, 'store'])->name('loans.store');
    });

    // Rute untuk bendahara
    Route::middleware([RoleMiddleware::class . ':bendahara'])->group(function () {
        Route::get('treasurer/loans', [TreasurerLoanController::class, 'index'])->name('treasurer.loans.index');
        Route::post('treasurer/loans/{loan}/submit', [TreasurerLoanController::class, 'submitToChair'])->name('treasurer.loans.submit');
    });

    // Rute untuk ketua
    Route::middleware([RoleMiddleware::class . ':ketua'])->group(function () {
        Route::get('chair/loans', [ChairLoanController::class, 'index'])->name('chair.loans.index');
        Route::post('chair/loans/{loan}/approve', [ChairLoanController::class, 'approve'])->name('chair.loans.approve');
    });
});

// Authentication routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
