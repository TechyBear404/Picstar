<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;


    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'content' => $this->faker->paragraph(2),
            'image' => function () {
                try {
                    // Ensure the storage directory exists
                    Storage::makeDirectory('public/images');

                    // Array of different image sizes portrait and landscape
                    $sizes = [
                        // Standard 4:3 Aspect Ratio (Traditional)
                        ['width' => 640, 'height' => 480],
                        ['width' => 800, 'height' => 600],
                        ['width' => 1024, 'height' => 768],

                        // Wider Landscape
                        ['width' => 1280, 'height' => 720],
                        ['width' => 1920, 'height' => 1080],
                        ['width' => 2560, 'height' => 1440],

                        // Taller Portrait-like
                        ['width' => 600, 'height' => 800],
                        ['width' => 768, 'height' => 1024],
                        ['width' => 1080, 'height' => 1440],

                        // Square-ish
                        ['width' => 800, 'height' => 800],
                        ['width' => 1024, 'height' => 1024],

                        // Extreme Panoramic
                        ['width' => 2048, 'height' => 1024],

                        // Mobile-like Sizes
                        ['width' => 375, 'height' => 812],
                        ['width' => 812, 'height' => 375],

                        // Ultra Wide
                        ['width' => 3440, 'height' => 1440],
                    ];

                    // Randomly select a size
                    $size = $sizes[array_rand($sizes)];

                    $imageUrl = sprintf(
                        'https://picsum.photos/%d/%d?random=%d',
                        $size['width'],
                        $size['height'],
                        fake()->unique()->numberBetween(1, 10000)
                    );

                    $context = stream_context_create([
                        'http' => [
                            'header' => 'User-Agent: Mozilla/5.0',
                            'timeout' => 10 // 10 seconds timeout
                        ]
                    ]);

                    // Download image with timeout
                    $imageContent = @file_get_contents($imageUrl, false, $context);

                    if ($imageContent === false) {
                        // If download fails, throw an exception
                        throw new \Exception('Image download failed');
                    }

                    // Generate a unique filename with size information
                    $imageName = sprintf(
                        'images/%s_%dx%d.jpg',
                        uniqid(),
                        $size['width'],
                        $size['height']
                    );

                    // Store the image
                    $stored = Storage::disk('public')->put($imageName, $imageContent);

                    if (!$stored) {
                        throw new \Exception('Image storage failed');
                    }

                    return $imageName;
                } catch (\Exception $e) {
                    // Log the error
                    Log::error('Image processing failed: ' . $e->getMessage());

                    // Rethrow to prevent seeding with null/empty images
                    throw $e;
                }
            },
        ];
    }
}
