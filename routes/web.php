<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TreasurerLoanController;
use App\Http\Controllers\ChairLoanController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware('auth')->group(function () {
   // Rute untuk anggota
   Route::middleware('role:anggota')->group(function () {
       Route::get('loans/create', [LoanController::class, 'create'])->name('loans.create');
       Route::post('loans', [LoanController::class, 'store'])->name('loans.store');
   });

   // Rute untuk bendahara
   Route::middleware('role:bendahara')->group(function () {
       Route::get('treasurer/loans', [TreasurerLoanController::class, 'index'])->name('treasurer.loans.index');
       Route::post('treasurer/loans/{loan}/submit', [TreasurerLoanController::class, 'submitToChair'])->name('treasurer.loans.submit');
   });

   // Rute untuk ketua
   Route::middleware('role:ketua')->group(function () {
       Route::get('chair/loans', [ChairLoanController::class, 'index'])->name('chair.loans.index');
       Route::post('chair/loans/{loan}/approve', [ChairLoanController::class, 'approve'])->name('chair.loans.approve');
   });
});

//authentication routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
