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
            // Personal Information
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('date_of_birth_ad');
            $table->date('date_of_bs')->nullable();
            $table->string('birthplace');
            $table->string('gender');
            $table->integer('age');
            $table->string('nationality');
            $table->string('religion')->nullable();
            $table->string('birth_country');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('marital_status');
            $table->string('spouse_name')->nullable();
            $table->integer('no_of_children')->nullable();
            $table->string('spouse_age')->nullable();

            // Citizenship Information
            $table->string('national_identify_no');
            $table->string('citizenship_no');
            $table->date('citizenship_issue_date');
            $table->string('citizenship_issue_place');
            $table->string('citizenship_issue_place_abroad')->nullable();

            // Current Passport Details
            $table->string('passport_no');
            $table->string('passport_type');
            $table->date('passport_issue_date');
            $table->date('passport_expiry_date');
            $table->string('passport_issue_place');
            $table->string('issuing_authority');

            // Contact Information
            $table->string('email');
            $table->string('country');
            $table->string('state');
            $table->string('district');
            $table->string('city');
            $table->string('phone');

            // Emergency Contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relation');
            $table->string('emergency_contact_country');
            $table->string('emergency_contact_state');
            $table->string('emergency_contact_district');
            $table->string('emergency_contact_city');
            $table->string('emergency_contact_email');
            $table->string('emergency_contact_phone');

            // Required Documents
            $table->string('citizenship_front');
            $table->string('citizenship_back');
            $table->string('academic_certificate')->nullable();
            $table->string('marriage_registration')->nullable();
            $table->string('divorce_certificate')->nullable();
            $table->string('national_eid')->nullable();
            $table->string('other_document')->nullable();
            $table->string('previous_passport')->nullable();

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
