<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\JobPost;
use App\Models\Admin;
use App\Models\JobCategory;
use App\Models\JobCompany;
use App\Models\JobSeeker;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jobTitle = $this->faker->jobTitle;
        return [
            'postedId' => Admin::inRandomOrder()->first()->id, 
            'jobCategoryId' => JobCategory::inRandomOrder()->first()->id ,
            'jobCompanyId' => JobCompany::inRandomOrder()->first()->id,
            'jobSeekerId' => JobSeeker::inRandomOrder()->first()->id ?? null, // Nullable
            'jobTitle' => $jobTitle,
            'jobSlug' => Str::slug($jobTitle),
            'jobLevel' => $this->faker->randomElement(['Entry Level', 'Mid Level', 'Senior Level']),
            'jobType' => $this->faker->randomElement(['Full Time', 'Part Time', 'Contract', 'Freelance']),
            'noOfVacancy' => $this->faker->numberBetween(1, 10),
            'employeeTime' => $this->faker->randomElement(['Day', 'Night', 'Flexible']),
            'jobLocation' => $this->faker->city,
            'offeredSalary' => $this->faker->randomElement(['Negotiable', '$30,000 - $50,000', '$50,000 - $80,000']),
            'experience' => $this->faker->paragraph,
            'skills' => $this->faker->sentence,
            'jobDescription' => $this->faker->paragraphs(3, true),
            'jobBanner' => null,
            'jobDeadline' => $this->faker->date(),
            'jobApproval' => 'Approved',
            'jobViewerCount' => $this->faker->numberBetween(0, 1000),
            'jobStatus' => $this->faker->randomElement(['published', 'unpublished', 'expired']),
        ];
    }
}
