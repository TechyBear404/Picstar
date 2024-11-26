<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(array $parameters = []): void
    {
        $maxComments = $parameters['maxComments'] ?? 10;

        $this->command->info('Creating comments for posts...');
        $posts = Post::all();
        $totalPosts = $posts->count();
        $bar = $this->command->getOutput()->createProgressBar($totalPosts);

        $posts->each(function ($post) use ($bar, $maxComments) {
            $commentCount = rand(1, $maxComments);
            Comment::factory($commentCount)->create([
                'postId' => $post->id,
                'userId' => User::inRandomOrder()->first()->id,
            ])->each(function ($comment) use ($maxComments) {
                // Add replies (using 30% of max comments for replies)
                $maxReplies = max(3, floor($maxComments * 0.3));
                Comment::factory(rand(0, $maxReplies))->create([
                    'postId' => $comment->postId,
                    'userId' => User::inRandomOrder()->first()->id,
                    'parentId' => $comment->id
                ]);
            });
            $bar->advance();
        });

        $bar->finish();
        $this->command->info("\n✅ Comment seeding completed!");
    }
}
