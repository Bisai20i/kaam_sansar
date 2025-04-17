<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobCompany;

class JobCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'industryCategoryId' => 1, // Ensure the industry category exists in `industry_categories`
                'companyName' => 'Tech Solutions Ltd.',
                'email' => 'contact@techsolutions.com',
                'phoneNumber' => '1234567890',
                'password' => 'password',
                'link1' => 'https://techsolutions.com',
                'link2' => 'https://linkedin.com/techsolutions',
                'link3' => 'https://twitter.com/techsolutions',
                'companyProfileImg' => 'uploads/company1.png',
                'companyDescription' => 'Leading software development company.',
                'reviewStatus' => 1,
            ],
            [
                'industryCategoryId' => 2,
                'companyName' => 'Healthcare Inc.',
                'email' => 'info@healthcare.com',
                'phoneNumber' => '9876543210',
                'password' => 'password',
                'link1' => 'https://healthcare.com',
                'link2' => null,
                'link3' => null,
                'companyProfileImg' => 'uploads/company2.jpg',
                'companyDescription' => 'Providing top-notch healthcare services.',
                'reviewStatus' => 3,
            ],
        ];

        foreach ($companies as $company) {
            JobCompany::create($company);
        }
    }
}
