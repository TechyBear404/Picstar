<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    public function run(array $parameters = []): void
    {
        $maxFollows = $parameters['maxFollows'] ?? 10;
        $users = User::all();
        $this->command->info('Creating follows...');
        $bar = $this->command->getOutput()->createProgressBar($users->count());

        $users->each(function ($user) use ($users, $bar, $maxFollows) {
            // Chaque utilisateur suit entre 1 et 5 autres utilisateurs aléatoirement
            $followings = $users->except($user->id)
                ->random(rand(1, $maxFollows));

            foreach ($followings as $following) {
                Follow::create([
                    'followerId' => $user->id,
                    'followingId' => $following->id,
                    'created_at' => now()
                ]);
            }

            $bar->advance();
        });

        $bar->finish();
        $this->command->info("\n✅ Follow relationships created!");
    }
}