<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(array $parameters = []): void
    {
        $count = $parameters['count'] ?? 50;

        // Create admin users
        $adminUsers = [
            ['name' => 'seb', 'email' => 'seb@gmail.com', 'password' => bcrypt('azerty1234'), 'role' => 'admin'],
            ['name' => 'robert', 'email' => 'robert@gmail.com', 'password' => bcrypt('azerty1234'), 'role' => 'user'],
            ['name' => 'TestUser', 'email' => 'test@example.com', 'password' => bcrypt('password')],
        ];

        foreach ($adminUsers as $user) {
            User::factory()->create($user);
            $this->command->info("Created user: {$user['name']}");
        }

        $this->command->info("\nCreating {$count} regular users...");
        $bar = $this->command->getOutput()->createProgressBar($count);

        User::factory($count)->create();

        $bar->finish();
        $this->command->info("\n✅ Created {$count} regular users!");
    }
}
