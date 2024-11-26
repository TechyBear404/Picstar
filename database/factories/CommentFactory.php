<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'postId' => Post::factory(),
            'userId' => User::factory(),
            'parentId' => null,
            'content' => $this->faker->sentence(rand(5, 15)),
            'created_at' => $this->faker->dateTimeThisYear(),
            'updated_at' => now(),
        ];
    }
}
