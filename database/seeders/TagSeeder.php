<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(array $parameters = []): void
    {
        $tags = $parameters['tags'] ?? [
            'nature',
            'portrait',
            'street',
            'architecture',
            'travel',
            'food',
            'fashion',
            'art',
            'wildlife',
            'urban'
        ];

        $this->command->info('Creating tags...');
        $bar = $this->command->getOutput()->createProgressBar(count($tags));

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("\n✅ Tags created!");

        // Attacher les tags aux posts
        $this->command->info('Attaching tags to posts...');
        $posts = Post::all();
        $tagModels = Tag::all();
        $bar = $this->command->getOutput()->createProgressBar($posts->count());

        foreach ($posts as $post) {
            $randomTags = $tagModels->random(rand(1, 3));
            $post->tags()->sync($randomTags->pluck('id'));
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("\n✅ Tags attached to posts!");
    }
}
