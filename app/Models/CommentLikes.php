<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLikes extends Model
{
    protected $fillable = ['commentId', 'userId'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
