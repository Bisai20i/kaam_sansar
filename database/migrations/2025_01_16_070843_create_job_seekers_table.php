<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->string('firstName'); // camelCase
            $table->string('lastName'); // camelCase
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('phoneNumber')->unique()->nullable(); // camelCase
            $table->string('password');
            $table->string('emailAddress')->unique()->nullable(); // camelCase
            $table->integer('otp')->nullable(); // Store the OTP
            $table->enum('whoAmI', ['student', 'worker', 'consultant'])->nullable();
            $table->enum('email_or_phone', ['email', 'phone', 'google'])->nullable();
            $table->boolean('otpVerified')->default(false); // OTP not verified yet (camelCase)
            $table->timestamp('otpExpiry')->nullable(); // camelCase
            $table->string('countryCode')->nullable(); // camelCase
            $table->json('userThumbnail')->nullable(); // camelCase
            $table->timestamp('emailVerifiedAt')->nullable(); // camelCase
            $table->string('country')->nullable(); // camelCase
            $table->string('rememberToken')->nullable();
            $table->string('socialMediaLogin')->nullable(); // camelCase
            $table->string('luckyNumber')->nullable(); // camelCase
            $table->string('dateOfBirth')->nullable(); // camelCase
            $table->string('temporaryLocation')->nullable(); // camelCase
            $table->string('permanentLocation')->nullable(); // camelCase
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('type', ['trainee', 'parttime', 'fulltime', 'user'])->default('user');
            $table->string('referralCode')->nullable()->unique(); // camelCase
            $table->string('expectedSalary')->nullable(); // camelCase
            $table->string('profession')->nullable(); // camelCase
            $table->string('qrCode')->nullable();
            $table->boolean('acceptedTerms')->default(false);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seekers');
    }
};
