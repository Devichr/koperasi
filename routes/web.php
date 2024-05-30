<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TreasurerLoanController;
use App\Http\Controllers\ChairLoanController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    // Route for member
    Route::middleware([RoleMiddleware::class . ':anggota'])->group(function () {
        Route::get('loans/create', [LoanController::class, 'create'])->name('loans.create');
        Route::post('loans', [LoanController::class, 'store'])->name('loans.store');
    });

    // Route for treasurer
    Route::middleware([RoleMiddleware::class . ':bendahara'])->group(function () {
        Route::get('treasurer/loans', [TreasurerLoanController::class, 'index'])->name('treasurer.loans.index');
        Route::post('treasurer/loans/{loan}/submit', [TreasurerLoanController::class, 'submitToChair'])->name('treasurer.loans.submit');
    });

    // Route for chairman
    Route::middleware([RoleMiddleware::class . ':ketua'])->group(function () {
        Route::get('chair/loans', [ChairLoanController::class, 'index'])->name('chair.loans.index');
        Route::post('chair/loans/{loan}/approve', [ChairLoanController::class, 'approve'])->name('chair.loans.approve');
    });

    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

// Authentication routes
Route::get('/', [AuthController::class, 'showLoginForm']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
