<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['userId', 'content', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(PostLikes::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'postId', 'tagId');
    }
}
