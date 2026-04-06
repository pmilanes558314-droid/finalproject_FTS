<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FinancialRecordController;
use App\Http\Controllers\UserController;       // ✅ For user management
use App\Http\Controllers\ReportController;     // ✅ For reports
use Illuminate\Support\Facades\Route;
use App\Models\FinancialRecord;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (role-based)
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        // Admin dashboard view
        return view('admin-dashboard');
    }

    // User dashboard view
    $income = FinancialRecord::where('user_id', auth()->id())
        ->where('type', 'income')
        ->sum('amount');

    $expense = FinancialRecord::where('user_id', auth()->id())
        ->where('type', 'expense')
        ->sum('amount');

    return view('dashboard', [
        'income' => $income,
        'expense' => $expense,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User routes → full CRUD for financial records
Route::middleware('auth')->group(function () {
    Route::resource('records', FinancialRecordController::class);
});

// Admin routes
Route::middleware('auth')->group(function () {
    // Admin can view all records
    Route::get('/admin/records', [FinancialRecordController::class, 'index'])->name('admin.records');

    // ✅ Admin user management routes
    Route::resource('users', UserController::class);

    // ✅ Reports route (fixes reports.index error)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';
