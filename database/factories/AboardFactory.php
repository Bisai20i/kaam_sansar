<?php

namespace Database\Factories;

use App\Models\Aboard;
use App\Models\JobSeeker;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aboard>
 */
class AboardFactory extends Factory
{
    protected $model = Aboard::class;

    public function definition()
    {
        $title = $this->faker->sentence(3);
        $slug = Str::slug($title) . '-' . Str::random(5);

        return [
            'productCategoryId' => 1,
            'jobSeekerId' => 1,
            'productTitle' => $title,
            'location' => $this->faker->city,
            'country' => $this->faker->country,
            'postedDuration' => $this->faker->numberBetween(1, 30) . ' days ago',
            'type' => $this->faker->randomElement(['Item', 'Buy']),
            'productThumbnail' => null,
            'productSlug' => $slug,
            'productDescription' => $this->faker->paragraph,
            'productOwnerName' => $this->faker->name,
            'contactNumber' => $this->faker->phoneNumber,
            'pricing' => $this->faker->randomFloat(2, 10, 1000),
            'publishStatus' => 'publish',
            'status' => 'Available',
        ];
    }
}
