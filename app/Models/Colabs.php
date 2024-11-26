<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colabs extends Model
{
    protected $fillable = ['postId', 'userId'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'postId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
