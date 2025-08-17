<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DockerKubernetGuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');


// Auth routes
require __DIR__.'/auth.php';

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Post routes
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/my-posts', [PostController::class, 'my'])->name('posts.my');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Comment routes
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Reaction routes
    Route::post('/posts/{post}/reactions', [ReactionController::class, 'toggle'])->name('reactions.toggle');
});

Route::get('/posts/{post}', [HomeController::class, 'show'])->name('posts.show');

// Admin routes with admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/posts', [DashboardController::class, 'posts'])->name('posts');
    Route::post('/posts/{post}/approve', [DashboardController::class, 'approvePost'])->name('posts.approve');
    Route::post('/posts/{post}/reject', [DashboardController::class, 'rejectPost'])->name('posts.reject');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::post('/users/{user}/ban', [DashboardController::class, 'banUser'])->name('users.ban');
    Route::post('/users/{user}/unban', [DashboardController::class, 'unbanUser'])->name('users.unban');
});


// other route
Route::get('/guideline', [DockerKubernetGuideController::class, 'index']);
