<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ResourceRequestController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/explore', [ResourceController::class, 'index'])->name('resources.index');
Route::get('/about', function() {
    return view('pages.about');
})->name('about');
Route::get('/resources/{resource}', [ResourceController::class, 'show'])->name('resources.show');
Route::get('/resources/{resource}/preview', [ResourceController::class, 'preview'])->name('resources.preview');

// Authenticated Student Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'student'])->name('dashboard');
    
    // Bookmarks
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks');
    Route::post('/bookmarks/{resource}/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    
    // Resource Management
    Route::get('/upload', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/upload', [ResourceController::class, 'store'])->name('resources.store');
    
    // Secure Download & Preview (signed URLs for security)
    Route::get('/resources/{resource}/download', [ResourceController::class, 'download'])->name('resources.download')->middleware('signed');

    // Resource Requests
    Route::get('/requests', [ResourceRequestController::class, 'index'])->name('resource-requests.index');
    Route::get('/requests/create', [ResourceRequestController::class, 'create'])->name('resource-requests.create');
    Route::post('/requests', [ResourceRequestController::class, 'store'])->name('resource-requests.store');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/resources/{resource}', [AdminController::class, 'destroy'])->name('admin.resources.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
