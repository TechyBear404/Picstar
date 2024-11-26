<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'userId');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'followingId');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'followerId');
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('followingId', $user->id)->exists();
    }


    public function postLikes()
    {
        return $this->hasMany(PostLikes::class, 'userId');
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLikes::class, 'userId');
    }

    public function hasPostLike(Post $post)
    {
        return $this->postLikes()->where('postId', $post->id)->exists();
    }

    public function hasLikeComment(Comment $comment)
    {
        return $this->commentLikes()->where('commentId', $comment->id)->exists();
    }
}
