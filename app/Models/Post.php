<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'postId');
    }

    public function likes()
    {
        return $this->hasMany(PostLikes::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'postId', 'tagId');
    }

    public function colabs()
    {
        return $this->hasMany(Colabs::class, 'postId');
    }

    public function postLikes()
    {
        return $this->hasMany(PostLikes::class, 'postId');
    }

    public function isLikedBy(User $user)
    {
        return $this->postLikes()->where('userId', $user->id)->exists();
    }
}
