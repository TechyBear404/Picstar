<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PostSeeder extends Seeder
{
    public function run(array $parameters = []): void
    {
        $totalPosts = $parameters['count'] ?? 100;
        $users = User::all();

        $this->command->info("Creating {$totalPosts} posts...");
        $bar = $this->command->getOutput()->createProgressBar($totalPosts);

        $postsCreated = 0;
        while ($postsCreated < $totalPosts) {
            foreach ($users as $user) {
                if ($postsCreated >= $totalPosts) break;

                Post::factory()->create([
                    'userId' => $user->id
                ]);

                $postsCreated++;
                $bar->advance();
            }
        }

        $bar->finish();
        $this->command->info("\n✅ Post seeding completed - {$totalPosts} posts created!");
    }
}
