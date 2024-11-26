<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function store(Post $post)
    {
        // Check if user already liked the post
        if (!Auth::user()->hasPostLike($post)) {
            PostLikes::create([
                'postId' => $post->id,
                'userId' => Auth::id()
            ]);
        }

        return back();
    }

    public function destroy(Post $post)
    {
        Auth::user()->postLikes()
            ->where('postId', $post->id)
            ->delete();

        return back();
    }
}
