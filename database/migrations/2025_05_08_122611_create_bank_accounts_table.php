<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('applicantType');
            $table->string('salutation');
            $table->boolean('nepaleseCitizen')->default(true);
            $table->string('applicantPurpose');
            $table->string('preferredBank');
            $table->string('branch');

            // Personal Details
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->string('mobileNumber');
            $table->string('phoneNumber')->nullable();
            $table->string('email')->nullable();
            $table->date('nepaliDob');
            $table->date('englishDob')->nullable();
            $table->string('applyFromCountry')->nullable();
            $table->string('contactMedium')->nullable();
            $table->string('otherContactDetail')->nullable();

            // Family Details
            $table->string('fatherName');
            $table->string('motherName');
            $table->string('grandfatherName');
            $table->string('spouse')->nullable();

            // Permanent Address
            $table->string('permanentCountry');
            $table->string('permanentProvince');
            $table->string('permanentDistrict');
            $table->string('permanentMunicipality');
            $table->string('permanentCity');
            $table->string('permanentWardNo');
            $table->string('permanentStreet')->nullable();
            $table->string('permanentState')->nullable();
            $table->string('permanentTole'); 
            $table->string('permanentHouseNo')->nullable(); //added

            // Temporary Address
            $table->boolean('sameAsPermanent')->default(false);
            $table->string('temporaryCountry');
            $table->string('temporaryProvince');
            $table->string('temporaryDistrict');
            $table->string('temporaryMunicipality');
            $table->string('temporaryCity');
            $table->string('temporaryWardNo');
            $table->string('temporaryStreet')->nullable();
            $table->string('temporaryState')->nullable();
            $table->string('temporaryTole');    // added
            $table->string('temporaryHouseNo')->nullable();
            // Job Details
            $table->string('jobTitle')->nullable();
            $table->string('jobCity')->nullable();
            $table->string('companyName')->nullable();
            $table->decimal('yearlySalary', 10, 2)->nullable(); // Changed to camelCase
            $table->decimal('monthlySalary', 10, 2)->nullable(); // Changed to camelCase

            // Required Documents (File Uploads)
            $table->string('signature'); // Changed to camelCase
            $table->string('fingerPrint'); // Changed to camelCase
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
        Schema::dropIfExists('bank_accounts');
    }
};
