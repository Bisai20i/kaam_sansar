<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobSeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_seekers')->insert(
            [
                'firstName' => 'John',
                'lastName' => 'Doe',
                'gender' => 'male',
                'phoneNumber' => '1234567890',
                'password' => bcrypt('password'),
                'emailAddress' => 'john@example.com',
                'otp' => null,
                'whoAmI' => 'student',
                'email_or_phone' => 'email',
                'otpVerified' => true,
                'otpExpiry' => null,
                'countryCode' => '+1',
                'userThumbnail' => null,
                'emailVerifiedAt' => Carbon::now(),
                'rememberToken' => Str::random(10),
                'socialMediaLogin' => 'google',
                'luckyNumber' => '7',
                'dateOfBirth' => '1990-01-01',
                'temporaryLocation' => 'Temporary Address',
                'permanentLocation' => 'Permanent Address',
                'status' => 'active',
                'type' => 'user',
                'referralCode' => Str::random(6),
                'expectedSalary' => '50000',
                'profession' => 'Software Developer',
                'qrCode' => null,
                'acceptedTerms' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            

        );
        DB::table('job_seekers')->insert(
            [
                'firstName' => 'Test',
                'lastName' => 'User',
                'gender' => 'male',
                'phoneNumber' => '1234567090',
                'password' => bcrypt('1234567890'),
                'emailAddress' => 'test@user.com',
                'otp' => null,
                'whoAmI' => 'student',
                'email_or_phone' => 'email',
                'otpVerified' => true,
                'otpExpiry' => null,
                'countryCode' => '+977',
                'userThumbnail' => null,
                'emailVerifiedAt' => Carbon::now(),
                'rememberToken' => Str::random(10),
                'socialMediaLogin' => 'google',
                'luckyNumber' => '7',
                'dateOfBirth' => '1990-01-01',
                'temporaryLocation' => 'Temporary Address',
                'permanentLocation' => 'Permanent Address',
                'status' => 'active',
                'type' => 'user',
                'referralCode' => Str::random(6),
                'expectedSalary' => '50000',
                'profession' => 'Software Developer',
                'qrCode' => null,
                'acceptedTerms' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            

        );

        DB::table('job_seekers')->insert(
            [
                'firstName' => 'Rohan',
                'lastName' => 'Katwal',
                'gender' => 'male',
                'phoneNumber' => '1234566090',
                'password' => bcrypt('1234567890'),
                'emailAddress' => 'rohan@user.com',
                'otp' => null,
                'whoAmI' => 'student',
                'email_or_phone' => 'email',
                'otpVerified' => true,
                'otpExpiry' => null,
                'countryCode' => '+977',
                'userThumbnail' => null,
                'emailVerifiedAt' => Carbon::now(),
                'rememberToken' => Str::random(10),
                'socialMediaLogin' => 'google',
                'luckyNumber' => '7',
                'dateOfBirth' => '1990-01-01',
                'temporaryLocation' => 'Temporary Address',
                'permanentLocation' => 'Permanent Address',
                'status' => 'active',
                'type' => 'user',
                'referralCode' => Str::random(6),
                'expectedSalary' => '50000',
                'profession' => 'Flutter Developer',
                'qrCode' => null,
                'acceptedTerms' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ]
            

        );
    }
}
