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
        Schema::create('broker_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobSeekerId'); // Add this
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('boid')->unique();
            // Personal Details
            $table->string('referralCode')->nullable();
            $table->enum('clientType', ['individual', 'institutional', 'minor', 'foreign']);
            $table->string('mobileNumber');
            $table->string('branchName');
            $table->string('panNumber')->nullable();
            $table->string('emailAddress');
            $table->string('whatsappNumber')->nullable();
            $table->string('viberNumber')->nullable();
            $table->string('facebookLink')->nullable();

            // Bank Details
            $table->string('bankName');
            $table->string('bankBranch');
            $table->enum('accountType', ['saving', 'current', 'fixed']);
            $table->string('accountNumber');

            // Investment Information
            $table->string('investmentSource')->nullable();
            $table->string('companyName')->nullable();
            $table->integer('jobBusinessYears')->nullable();
            $table->decimal('investmentAmount', 15, 2)->nullable();
            $table->boolean('tradingKnowledge')->default(false)->nullable();

            // Permanent Address
            $table->string('permanentCountry');
            $table->string('permanentProvince');
            $table->string('permanentDistrict');
            $table->string('permanentMunicipality');
            $table->integer('permanentWard');
            $table->string('permanentCity');
            $table->string('permanentTole');
            $table->string('permanentStreet')->nullable();
            $table->string('permanentHouseNo')->nullable();

            // Temporary Address
            $table->boolean('sameAsPermanent')->default(false);
            $table->string('temporaryCountry');
            $table->string('temporaryProvince');
            $table->string('temporaryDistrict');
            $table->string('temporaryMunicipality');
            $table->integer('temporaryWard');
            $table->string('temporaryCity');
            $table->string('temporaryTole');
            $table->string('temporaryStreet')->nullable();
            $table->string('temporaryState')->nullable();
            $table->string('temporaryHouseNo')->nullable();

            // Document paths
            $table->string('kycForm')->nullable();
            $table->string('citizenCertificate');
            $table->string('birthCertificate')->nullable();
            $table->string('visaPassport')->nullable();
            $table->string('selfieWithId')->nullable();
            $table->string('guardianCitizenship')->nullable();
            $table->string('ppSizePhoto');
            $table->string('tradingAgreement')->nullable();
            $table->string('idCard')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
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
        Schema::dropIfExists('broker_accounts');
    }
};
