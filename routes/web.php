<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (in_array(auth()->user()->role, ['admin', 'superintendent'])) {
        return redirect()->route('admin.dashboard');
    }
    
    $userId = auth()->id();
    $totalComplaints = \App\Models\Complaint::where('user_id', $userId)->count();
    $pendingComplaints = \App\Models\Complaint::where('user_id', $userId)->where('status', 'Pending')->count();
    $resolvedComplaints = \App\Models\Complaint::where('user_id', $userId)->where('status', 'Resolved')->count();
    $recentComplaints = \App\Models\Complaint::where('user_id', $userId)->latest()->take(5)->get();

    return view('dashboard', compact('totalComplaints', 'pendingComplaints', 'resolvedComplaints', 'recentComplaints'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes are handled in the admin prefix group below
});

require __DIR__ . '/auth.php';

// ComplaintController
use App\Http\Controllers\ComplaintController;
Route::middleware(['auth'])->group(function () {
    Route::resource('complaints', ComplaintController::class);
});

// AdminController
use App\Http\Controllers\AdminController;
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/complaints', [AdminController::class, 'complaints'])->name('admin.complaints');
    Route::get('/complaints/{complaint}', [AdminController::class, 'show'])->name('admin.complaints.show');
    Route::put('/complaints/{complaint}', [AdminController::class, 'update'])->name('admin.complaints.update');
    Route::delete('/complaints/{complaint}', [AdminController::class, 'destroy'])->name('admin.complaints.destroy');
    
    // Category Management
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->names('admin.categories');

    // Analytics
    Route::get('/analytics', [\App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('admin.analytics');
});

// FeedbackController
use App\Http\Controllers\FeedbackController;
Route::middleware(['auth'])->group(function () {
    Route::get('/feedback/{complaint}', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback/{complaint}', [FeedbackController::class, 'store'])->name('feedback.store');
});
