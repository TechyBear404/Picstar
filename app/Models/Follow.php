<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['followerId', 'followingId'];

    public function follower()
    {
        return $this->belongsTo(User::class, 'followerId');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'followingId');
    }
}
