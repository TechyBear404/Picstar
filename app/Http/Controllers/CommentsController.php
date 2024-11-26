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
    public function store(Request $request, Post $post)
    {
        $comment = $post->comments()->create([
            'content' => $request->content,
            'userId' => Auth::id(),
            'postId' => $post->id
        ]);

        return back()->with('success', 'Commentaire ajouté avec succès');
    }

    public function reply(Request $request, Comment $comment)
    {
        $reply = Comment::create([
            'content' => $request->content,
            'userId' => Auth::id(),
            'postId' => $comment->postId,
            'parentId' => $comment->id
        ]);

        return back()->with('success', 'Réponse ajoutée avec succès');
    }

    public function like(Comment $comment)
    {
        $like = $comment->commentLikes()->where('userId', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $comment->commentLikes()->create(['userId' => Auth::id()]);
        }

        return back();
    }

    public function destroy(Comment $comment)
    {
        if ($comment->userId !== Auth::id()) {
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'Commentaire supprimé avec succès');
    }
}
