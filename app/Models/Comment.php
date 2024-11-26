<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'postId',
        'userId',
        'parentId',
        'content'
    ];

    // Updating relationship methods to match database columns
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postId');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parentId');
    }

    public function likes()
    {
        return $this->hasMany(CommentLikes::class);
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLikes::class, 'commentId');
    }

    public function isLikedBy(User $user)
    {
        return $this->commentLikes()->where('userId', $user->id)->exists();
    }

    public function likesCount()
    {
        return $this->commentLikes()->count();
    }
}
