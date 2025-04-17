<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234567890'),
            'fullName' => 'Super Admin',  // camelCase applied
            'roleType' => 'superAdmin',   // camelCase applied     
            'emailVerifiedAt' => now(),   // camelCase applied
            'status' => 'active',
        ]);

    }
}
