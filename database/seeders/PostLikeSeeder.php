<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\PostLikes;
use Illuminate\Database\Seeder;

/**
 * Seeder pour générer des likes aléatoires sur les posts
 */
class PostLikeSeeder extends Seeder
{
    /**
     * Crée des likes aléatoires pour chaque post
     * @param array $parameters Paramètres optionnels (maxLikes: nombre maximum de likes par post)
     */
    public function run(array $parameters = []): void
    {
        $maxLikes = $parameters['maxLikes'] ?? 30;
        $this->command->info('Creating post likes...');
        $posts = Post::all();
        $bar = $this->command->getOutput()->createProgressBar($posts->count());

        $posts->each(function ($post) use ($bar, $maxLikes) {
            $likers = User::where('id', '!=', $post->userId)
                ->inRandomOrder()
                ->limit(rand(0, $maxLikes))
                ->get();

            foreach ($likers as $liker) {
                PostLikes::create([
                    'postId' => $post->id,
                    'userId' => $liker->id
                ]);
            }
            $bar->advance();
        });

        $bar->finish();
        $this->command->info("\n✅ Post likes seeding completed!");
    }
}
