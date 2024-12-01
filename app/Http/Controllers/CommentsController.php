<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Créer un nouveau commentaire sur un post
     */
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255'
        ]);
        $post->comments()->create([
            'content' => $validatedData['content'],
            'userId' => Auth::id(),
            'postId' => $post->id
        ]);

        return back()->with('success', 'Commentaire ajouté avec succès');
    }

    /**
     * Ajouter une réponse à un commentaire existant
     */
    public function reply(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255'
        ]);
        Comment::create([
            'content' => $validatedData['content'],
            'userId' => Auth::id(),
            'postId' => $comment->postId,
            'parentId' => $comment->id
        ]);

        return back()->with('success', 'Réponse ajoutée avec succès');
    }

    /**
     * Basculer le like d'un commentaire pour l'utilisateur connecté
     */
    public function like(Comment $comment)
    {
        // Vérifie si l'utilisateur a déjà liké le commentaire
        // Si oui, supprime le like, sinon crée un nouveau like
        $like = $comment->commentLikes()->where('userId', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $comment->commentLikes()->create(['userId' => Auth::id()]);
        }

        return back();
    }

    /**
     * Supprimer un commentaire
     * Vérifie que l'utilisateur est bien l'auteur du commentaire
     */
    public function destroy(Comment $comment)
    {
        if ($comment->userId !== Auth::id()) {
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'Commentaire supprimé avec succès');
    }
}
