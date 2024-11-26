<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Colabs;
use Illuminate\Database\Seeder;

class ColabSeeder extends Seeder
{
    public function run(array $parameters = []): void
    {
        $maxColabs = $parameters['maxColabs'] ?? 3;
        $this->command->info('Creating collaborations...');
        $posts = Post::all();
        $bar = $this->command->getOutput()->createProgressBar($posts->count());

        $posts->each(function ($post) use ($bar, $maxColabs) {
            $collaborators = User::where('id', '!=', $post->userId)
                ->inRandomOrder()
                ->limit(rand(0, $maxColabs))
                ->get();

            foreach ($collaborators as $collaborator) {
                Colabs::create([
                    'postId' => $post->id,
                    'userId' => $collaborator->id
                ]);
            }
            $bar->advance();
        });

        $bar->finish();
        $this->command->info("\n✅ Collaboration seeding completed!");
    }
}
