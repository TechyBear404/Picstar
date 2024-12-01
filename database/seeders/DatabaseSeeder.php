<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Configuration globale pour tous les seeders
     * Définit les limites et valeurs par défaut
     * Ne fonctionne pas pour le moment
     */
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

    /**
     * Nettoie le répertoire de stockage des images
     */
    protected function cleanImageStorage(): void
    {
        $this->command->info('🧹 Cleaning image storage...');
        Storage::disk('public')->deleteDirectory('images');
        Storage::disk('public')->makeDirectory('images');
        $this->command->info('✅ Image storage cleaned!');
    }

    /**
     * Exécute tous les seeders dans un ordre spécifique
     * Initialise la base de données avec des données de test
     */
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
