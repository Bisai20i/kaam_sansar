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
        Schema::create('passport_renewals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->cascadeOnDelete();
            // Personal Information
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('date_of_birth_ad')->nullable();
            $table->date('date_of_bs')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('birth_country')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->integer('no_of_children')->nullable();
            $table->string('spouse_age')->nullable();

            // Citizenship Information
            $table->string('national_identify_no')->nullable();
            $table->string('citizenship_no')->nullable();
            $table->date('citizenship_issue_date')->nullable();
            $table->string('citizenship_issue_place')->nullable();
            $table->string('citizenship_issue_place_abroad')->nullable();

            // Current Passport Details
            $table->string('passport_no')->nullable();
            $table->string('passport_type')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->string('passport_issue_place')->nullable();
            $table->string('issuing_authority')->nullable();

            // Contact Information
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->string('emergency_contact_country')->nullable();
            $table->string('emergency_contact_state')->nullable();
            $table->string('emergency_contact_district')->nullable();
            $table->string('emergency_contact_city')->nullable();
            $table->string('emergency_contact_email')->nullable();
            $table->string('emergency_contact_phone')->nullable();

            // Required Documents
            $table->string('citizenship_front');
            $table->string('citizenship_back');
            $table->string('academic_certificate')->nullable();
            $table->string('marriage_registration')->nullable();
            $table->string('divorce_certificate')->nullable();
            $table->string('national_eid')->nullable();
            $table->string('other_document')->nullable();
            $table->string('previous_passport');

            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->enum('payment_staus',['paid','unpaid'])->default('unpaid');

            $table->enum('service_type',['apply','renewal', 'replacement'])->default('renewal');

            $table->enum('passport_pages',['34_pages','66_pages'])->default('34_pages');

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
        Schema::dropIfExists('passport_renewals');
    }
};
