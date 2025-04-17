<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobCategories = [
            'Software Development',
            'Marketing',
            'Finance & Accounting',
            'Human Resources',
            'Customer Support',
            'Sales',
            'Healthcare',
            'Engineering',
            'Education & Training',
            'Legal',
        ];

        foreach ($jobCategories as $category) {
            JobCategory::create([
                'jobCategoryName' => $category,
                'slug' => Str::slug($category),
                'status' => 'active',
                'publishStatus' => 'published',
            ]);
        }
    }
}
