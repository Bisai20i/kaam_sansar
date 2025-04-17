<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BlogsAndPodcast;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogsAndPodcastFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $isPodcast = $this->faker->boolean;
        return [
            'blogOrPodcast' => $isPodcast ? 'podcast' : 'blog',
            'slug' => Str::slug($title),
            'title' => $title,
            'description' => $this->faker->paragraph,
            'linkUrl' => $this->faker->optional()->url(),
            'podcastTime' => $isPodcast ? $this->faker->time('H:i:s') : null,
            'publishStatus' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
