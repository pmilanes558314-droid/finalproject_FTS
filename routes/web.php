<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FinancialRecordController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Dashboard now uses DashboardController@index
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Transactions
    Route::resource('records', FinancialRecordController::class);

    // Monthly Report
    Route::get('/reports/monthly', [DashboardController::class, 'monthlyReport'])
        ->name('reports.monthly');
});

require __DIR__.'/auth.php';
