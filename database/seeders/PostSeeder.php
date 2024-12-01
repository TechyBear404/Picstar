<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeder pour générer des posts de test dans la base de données
 */
class PostSeeder extends Seeder
{
    /**
     * Génère un nombre défini de posts pour chaque utilisateur
     * @param array $parameters Paramètres de configuration incluant le nombre de posts à créer
     */
    public function run(array $parameters = []): void
    {
        // Récupère le nombre total de posts à créer (par défaut 100)
        $totalPosts = $parameters['count'] ?? 100;
        $users = User::all();

        $this->command->info("Creating {$totalPosts} posts...");
        $bar = $this->command->getOutput()->createProgressBar($totalPosts);

        // Boucle de création des posts
        // Distribue les posts entre les utilisateurs jusqu'à atteindre le total demandé
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
