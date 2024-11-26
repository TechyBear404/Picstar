<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/home', [PostsController::class, 'index'])->name('home');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('posts', PostsController::class);

    Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user}', [FollowController::class, 'destroy'])->name('follow.destroy');

    // Post Likes Routes
    Route::post('/posts/{post}/like', [PostsController::class, 'like'])->name('posts.like');

    // Comment Likes Routes
    Route::post('/comments/{comment}/like', [CommentLikeController::class, 'store'])->name('comments.like');
    Route::delete('/comments/{comment}/like', [CommentLikeController::class, 'destroy'])->name('comments.unlike');

    // Comments Routes
    Route::post('/posts/{post}/comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/reply', [CommentsController::class, 'reply'])->name('comments.reply');
    Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/like', [CommentsController::class, 'like'])->name('comments.like');
});


require __DIR__ . '/auth.php';
