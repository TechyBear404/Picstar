<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        $tags = [
            'Photography',
            'Nature',
            'Portrait',
            'Street',
            'Landscape',
            'Architecture',
            'Travel',
            'Fashion',
            'Food',
            'Art',
            'Black&White',
            'Wildlife',
            'Urban',
            'Macro',
            'Abstract'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($tags),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
