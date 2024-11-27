<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

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
        Route::get('/followers', [FollowController::class, 'followers'])->name('profile.followers');
        Route::get('/following', [FollowController::class, 'following'])->name('profile.following');
    });

    // Voir les publications d'un utilisateur spécifique
    Route::get('/user/{user}/posts', [PostsController::class, 'userPosts'])->name('user.posts');

    // Afficher les publications par étiquette
    Route::get('/tags/{tag}', [PostsController::class, 'postsByTag'])->name('tags.posts');

    // Système d'abonnement/désabonnement
    Route::prefix('follow')->group(function () {
        Route::post('/{user}', [FollowController::class, 'store'])->name('follow.store');
        Route::delete('/{user}', [FollowController::class, 'destroy'])->name('follow.destroy');
    });

    // Gestion complète des publications
    Route::prefix('posts')->group(function () {
        // Routes ressources pour les autres opérations CRUD
        Route::resource('', PostsController::class)->except(['show'])->names('posts');
        // Interactions avec les publications
        Route::get('/search', [PostsController::class, 'search'])->name('posts.search');
        Route::post('/{post}/like', [PostsController::class, 'like'])->name('posts.like');
        Route::post('/{post}/comments', [CommentsController::class, 'store'])->name('comments.store');

        // Route spécifique pour voir un post
        Route::get('/{post}', [PostsController::class, 'show'])->name('posts.show');
    });


    // Gestion des commentaires
    Route::prefix('comments')->group(function () {
        Route::post('/{comment}/reply', [CommentsController::class, 'reply'])->name('comments.reply');
        Route::delete('/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
        Route::post('/{comment}/like', [CommentsController::class, 'like'])->name('comments.like');
    });
});


require __DIR__ . '/auth.php';
