<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IndustryCategory;
use Illuminate\Support\Str;

class IndustryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industries = [
            'Information Technology',
            'Healthcare',
            'Finance',
            'Education',
            'Retail',
            'Manufacturing',
            'Construction',
            'Real Estate',
            'Hospitality',
            'Transportation'
        ];

        foreach ($industries as $industry) {
            IndustryCategory::create([
                'industryName' => $industry,
                'slug' => Str::slug($industry)
            ]);
        }
    }
}
