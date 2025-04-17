<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GiftCoupon;
use App\Models\GiftCategory;
use App\Models\JobSeeker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GiftCoupon>
 */
class GiftCouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3), // Random title
            'quantity' => $this->faker->numberBetween(1, 100), // Random quantity between 1 and 100
            'type' => $this->faker->boolean(), // Random true/false
            'country' => $this->faker->country(), // Random country
            'city' => $this->faker->city(), // Random city
            'publishStatus' => 1,//$this->faker->boolean(), // Random publish status
            'thumbnail' => null,
            'price' => $this->faker->numberBetween(50, 1000), // Random price between 50 and 1000
            'giftCategoryId' => GiftCategory::inRandomOrder()->value('id') ?? 1, // Get random category ID
            'description' => $this->faker->paragraph(), // Random description
            'jobSeekerId' => JobSeeker::inRandomOrder()->value('id') ?? null, // Get random job seeker ID (nullable)
            'adminId' => 1, 
            'discount' => $this->faker->randomFloat(2, 0, 100), 
            'customApplied' => $this->faker->boolean, 
            'itemCode' => strtoupper($this->faker->unique()->bothify('ITEM###')), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
