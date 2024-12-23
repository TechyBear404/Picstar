<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['followerId', 'followingId'];

    public function user()
    {
        return $this->belongsTo(User::class, 'followerId');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'followingId');
    }
}
