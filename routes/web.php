<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChairLoanController;
use App\Http\Controllers\TreasurerLoanController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\InstallmentController;
use App\Http\Middleware\CheckStep1;

Route::middleware('auth')->group(function () {
    // Route for member
    Route::middleware([RoleMiddleware::class . ':anggota'])->group(function () {

        //route untuk pinjaman
        Route::get('/loans/create/step1', [LoanController::class, 'createStep1'])->name('loans.create');
        Route::post('/loans/create/step1', [LoanController::class, 'storeStep1'])->name('loans.step1.store');

        Route::middleware([CheckStep1::class ])->group(function(){
            Route::get('/loans/create/step2', [LoanController::class, 'createStep2'])->name('loans.step2.create');
        });
        Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');

        //route untuk pembayaran
        Route::get('/savings/create', [SavingController::class, 'create'])->name('savings.create');
        Route::post('/savings', [SavingController::class, 'store'])->name('savings.store');

        //route untuk membayar angsuran
        Route::get('/installments/pay', [InstallmentController::class, 'pay'])->name('installments.pay');
        Route::post('/installments', [InstallmentController::class, 'store'])->name('installments.store');

        Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    });

    // Route for treasurer
    Route::middleware([RoleMiddleware::class . ':bendahara'])->group(function () {
        Route::get('treasurer/loans', [TreasurerLoanController::class, 'index'])->name('treasurer.loans.index');
        Route::post('treasurer/loans/{loan}/submit', [TreasurerLoanController::class, 'submitToChair'])->name('treasurer.loans.submit');
        Route::post('treasurer/loans/{loan}/reject', [TreasurerLoanController::class, 'reject'])->name('treasurer.loans.reject');
    });

    // Route for chairman
    Route::middleware([RoleMiddleware::class . ':ketua'])->group(function () {
        Route::get('chair/loans', [ChairLoanController::class, 'index'])->name('chair.loans.index');
        Route::post('chair/loans/{loan}/approve', [ChairLoanController::class, 'approve'])->name('chair.loans.approve');
        Route::post('chair/loans/{loan}/reject', [ChairLoanController::class, 'reject'])->name('chair.loans.reject');
    });

    

    Route::get('/loans/{loan}/detail', [LoanController::class, 'showDetail'])->name('loans.detail');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('loans/history', [HistoryController::class, 'index'])->name('loans.history');
});

// Authentication routes
Route::get('/', [AuthController::class, 'showLoginForm']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
