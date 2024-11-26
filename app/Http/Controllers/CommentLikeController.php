<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function store(Comment $comment)
    {
        // Check if user already liked the comment
        if (!Auth::user()->hasLikeComment($comment)) {
            CommentLikes::create([
                'commentId' => $comment->id,
                'userId' => Auth::id()
            ]);
        }

        return back();
    }

    public function destroy(Comment $comment)
    {
        Auth::user()->commentLikes()
            ->where('commentId', $comment->id)
            ->delete();

        return back();
    }
}
