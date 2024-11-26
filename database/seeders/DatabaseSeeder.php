<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    protected array $config = [
        'users' => 50,
        'maxFollowsPerUser' => 10,
        'posts' => 50,
        'maxLikesPerPost' => 30,
        'maxCommentsPerPost' => 10,
        'maxColabsPerPost' => 3,
        'tags' => [
            'Nature',
            'Portrait',
            'Street',
            'Architecture',
            'Travel',
            'Food',
            'Fashion',
            'Art',
            'Wildlife',
            'Urban'
        ]
    ];

    protected function cleanImageStorage(): void
    {
        $this->command->info('🧹 Cleaning image storage...');
        Storage::disk('public')->deleteDirectory('images');
        Storage::disk('public')->makeDirectory('images');
        $this->command->info('✅ Image storage cleaned!');
    }

    public function run(): void
    {
        $this->cleanImageStorage();
        $this->command->info('🌱 Starting database seeding...');

        $this->callWith(UserSeeder::class, ['count' => $this->config['users']]);
        $this->callWith(FollowSeeder::class, ['maxFollows' => $this->config['maxFollowsPerUser']]);
        $this->callWith(PostSeeder::class, ['count' => $this->config['posts']]);
        $this->callWith(TagSeeder::class, ['tags' => $this->config['tags']]);
        $this->callWith(CommentSeeder::class, ['maxComments' => $this->config['maxCommentsPerPost']]);
        $this->callWith(ColabSeeder::class, ['maxColabs' => $this->config['maxColabsPerPost']]);
        $this->callWith(PostLikeSeeder::class, ['maxLikes' => $this->config['maxLikesPerPost']]);

        $this->command->info('✅ Database seeding completed successfully!');
    }
}
