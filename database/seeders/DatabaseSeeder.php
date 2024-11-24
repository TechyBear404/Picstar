<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $users = [[
            'name' => 'seb',
            'email' => 'seb@gmail.com',
            'password' => bcrypt('azerty1234'),
            'role' => 'admin',
        ], [
            'name' => 'robert',
            'email' => 'robert@gmail.com',
            'password' => bcrypt('azerty1234'),
            'role' => 'user',
        ]];


        foreach ($users as $user) {
            User::factory()->create($user);
        }

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
