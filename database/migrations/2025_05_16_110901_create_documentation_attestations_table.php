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
        Schema::create('documentation_attestations', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('documentType');
            $table->string('subType');

            // Step 2: Country Selection
            $table->string('applicantCountry');
            $table->string('attestationCountry');
            $table->string('applicantName');

            // Step 3: Attestation Details
            $table->string('countryAttestation');
            $table->string('purpose');

            // Delivery Address
            $table->string('deliveryCountry');
            $table->string('deliveryCity');
            $table->string('deliveryStreet');
            $table->string('deliveryApartment')->nullable();
            $table->string('deliveryLandmark')->nullable();
            $table->string('primaryContact');
            $table->string('secondaryContact')->nullable();
            $table->string('email');

            // Work Address (optional)
            $table->string('workCountry')->nullable();
            $table->string('workCity')->nullable();
            $table->string('workStreet')->nullable();
            $table->string('workApartment')->nullable();
            $table->string('workLandmark')->nullable();

            // Document Paths
            $table->string('identification')->nullable();
            $table->string('visa')->nullable();
            $table->string('citizenshipFront');
            $table->string('citizenshipBack');
            $table->string('passport')->nullable();
            $table->string('photo')->nullable();
            $table->string('document1')->nullable();
            $table->string('document2')->nullable();
            $table->string('document3')->nullable();
            $table->string('document4')->nullable();
            $table->enum('status',['pending','In-progress','approved','rejected'])->default('pending');
            $table->enum('payment',['unpaid','paid'])->default('unpaid');
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
        Schema::dropIfExists('documentation_attestations');
    }
};