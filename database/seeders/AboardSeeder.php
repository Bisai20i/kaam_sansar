<?php

namespace Database\Seeders;

use App\Models\Aboard;
use Illuminate\Database\Seeder;

class AboardSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 sample aboard records
        Aboard::factory()->count(50)->create();
    }
}
