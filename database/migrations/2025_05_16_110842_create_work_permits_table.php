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
        Schema::create('work_permits', function (Blueprint $table) {
            $table->id();
            $table->string('serviceType');
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');

            // Application details
            $table->string('appCountry');
            $table->string('appProvince');
            $table->string('appDistrict');
            $table->string('appLocation');

            // Personal details
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->date('dateOfBirthAd')->nullable();
            $table->text('dateOfBirthBs')->nullable();
            $table->text('birthplace')->nullable();
            $table->text('gender')->nullable();
            $table->integer('age')->nullable();
            $table->text('nationality')->nullable();
            $table->text('religion')->nullable();
            $table->text('birthCountry')->nullable();
            $table->text('fatherName')->nullable();
            $table->text('motherName')->nullable();
            $table->text('marriedStatus')->nullable();
            $table->text('spouseName')->nullable();
            $table->integer('numberOfChildren')->nullable();
            $table->integer('spouseAge')->nullable();

            // Bank Details
            $table->text('bankAccount')->nullable();
            $table->text('bankName')->nullable();
            $table->text('accountType')->nullable();
            $table->text('bankBranch')->nullable();
            $table->text('bankNo')->nullable();

            //Citizenship Information
            $table->text('nationalIdentityNo')->nullable();
            $table->text('citizenshipNumber')->nullable();
            $table->date('dateOfIssue')->nullable();
            $table->text('placeOfIssueDistrict')->nullable();
            $table->text('placeOfIssueAbroad')->nullable();
            
            //company Info
            $table->text('country')->nullable();
            $table->text('companyName')->nullable();
            $table->text('currency')->nullable();

            //Facility Details
            $table->text('skill')->nullable();
            $table->text('salary')->nullable();
            $table->text('workType')->nullable();
            $table->text('food')->nullable();
            $table->text('accommodation')->nullable();
            $table->text('dailyWorkHour')->nullable();
            $table->text('weeklyWorkDay')->nullable();
            $table->text('overTime')->nullable();
            $table->text('otherAllowance')->nullable();

            //  Other facilities
            $table->text('transportation')->nullable();
            $table->text('healthInsurance')->nullable();

            // VisaInfo
            $table->text('visaNo')->nullable();
            $table->date('citizenshipDateOfIssue')->nullable();
            $table->text('citizenshipPlaceOfIssueDistrict')->nullable();
            $table->text('citizenshipPlaceOfIssueAbroad')->nullable();

            // Nominee details
            $table->text('nominee')->nullable();
            $table->text('nomineeName')->nullable();
            $table->text('nomineeRelation')->nullable();
            $table->text('nomineeCountry')->nullable();
            $table->text('nomineeProvince')->nullable();
            $table->text('nomineeDistrict')->nullable();
            $table->text('nomineeCity')->nullable();
            $table->text('nomineeEmail')->nullable();
            $table->text('nomineePhone')->nullable();

            // Passport details
            $table->text('passportNumber')->nullable();
            $table->text('passportType')->nullable();
            $table->date('issueDate')->nullable();
            $table->date('expiryDate')->nullable();
            $table->text('placeOfIssue')->nullable();
            $table->text('issuingAuthority')->nullable();

            //contact Information
            $table->text('contCountry');
            $table->text('state');
            $table->text('contdistrict');
            $table->text('contCity')->nullable();
            $table->string('phoneNo', 20);
            $table->string('email', 100);


            // Address details
            $table->text('contactCountry')->nullable();
            $table->text('district')->nullable();
            $table->text('city')->nullable();
            $table->text('province')->nullable();
            $table->text('municipality')->nullable();
            $table->integer('wardNo')->nullable();
            $table->text('tole')->nullable();
            $table->text('street')->nullable();
            $table->text('houseNo')->nullable();

            // Temporary address
            $table->boolean('sameAsPermanent')->nullable();
            $table->text('tempCountry')->nullable();
            $table->text('tempProvince')->nullable();
            $table->text('tempDistrict')->nullable();
            $table->text('tempMunicipality')->nullable();
            $table->integer('tempWardNo')->nullable();
            $table->text('tempCity')->nullable();
            $table->text('tempTole')->nullable();
            $table->text('tempStreet')->nullable();
            $table->text('tempHouseNo')->nullable();

            // Emergency contact details
            $table->text('emergencyContactFullName')->nullable();
            $table->text('emergencyContactRelation')->nullable();
            $table->text('emergencyContactCountry')->nullable();
            $table->text('emergencyContactStateProvince')->nullable();
            $table->text('emergencyContactDistrict')->nullable();
            $table->text('emergencyContactCity')->nullable();
            $table->string('emergencyContactPhone', 20);
            $table->string('emergencyContactEmail', 100);

            $table->string('passportPhoto');
            $table->string('visaPhoto');
            $table->string('bankAccountPhoto')->nullable();
            $table->string('chequePhoto')->nullable();
            $table->string('agreementPhoto')->nullable();
            $table->string('arrivalStampPhoto')->nullable();
            $table->string('embassyLetterPhoto')->nullable();
            $table->string('departureStampPhoto')->nullable();
            $table->string('oldLaborApprovalPhoto')->nullable();
            $table->string('otherDocumentsPhoto')->nullable();
            $table->boolean('checkCorrect')->nullable();
            $table->boolean('checkTerms')->nullable();
            $table->enum('status', ['pending', 'In-progress','approved','rejected'])->default('pending');
            $table->enum('payment',['unpaid','paid'])->default('unpaid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_permits');
    }
};