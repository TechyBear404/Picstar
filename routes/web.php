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


// Toutes les routes sont protégées par l'authentification
Route::middleware('auth')->group(function () {
    // Page d'accueil principale
    Route::get('/home', [PostsController::class, 'index'])->name('home');

    // Gestion du profil utilisateur
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Affichage des publications personnelles
        Route::get('/posts', [PostsController::class, 'myPosts'])->name('profile.posts');
    });

    // Routes pour l'interaction entre utilisateurs
    Route::prefix('users')->group(function () {
        // Voir les publications d'un utilisateur spécifique
        Route::get('/{user}/posts', [PostsController::class, 'userPosts'])->name('users.posts');
    });

    // Système de gestion des étiquettes
    Route::prefix('tags')->group(function () {
        // Afficher les publications par étiquette
        Route::get('/{tag}', [PostsController::class, 'postsByTag'])->name('tags.posts');
    });

    // Système d'abonnement/désabonnement
    Route::prefix('follow')->group(function () {
        Route::post('/{user}', [FollowController::class, 'store'])->name('follow.store');
        Route::delete('/{user}', [FollowController::class, 'destroy'])->name('follow.destroy');
    });

    // Gestion complète des publications
    Route::prefix('posts')->group(function () {
        // Interactions avec les publications
        Route::post('/{post}/like', [PostsController::class, 'like'])->name('posts.like');
        Route::post('/{post}/comments', [CommentsController::class, 'store'])->name('comments.store');

        // Route spécifique pour voir un post
        Route::get('/{post}', [PostsController::class, 'show'])->name('posts.show');
        // Routes ressources pour les autres opérations CRUD
        Route::resource('', PostsController::class)->except(['show'])->names('posts');
    });

    // Gestion des commentaires
    Route::prefix('comments')->group(function () {
        Route::post('/{comment}/reply', [CommentsController::class, 'reply'])->name('comments.reply');
        Route::delete('/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
        Route::post('/{comment}/like', [CommentsController::class, 'like'])->name('comments.like');
    });
});


require __DIR__ . '/auth.php';
