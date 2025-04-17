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
        Schema::create('visa_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('fullName');
            $table->string('passportNumber');
            $table->string('emailAddress')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->unsignedBigInteger('visaTypeId');
            $table->foreign('visaTypeId')->references('id')->on('visa_types')->onDelete('cascade');
            $table->string('citizenshipAsPassport')->nullable();
            $table->date('dateOfEntry');
            $table->json('uploadedFiles')->nullable();
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
        Schema::dropIfExists('visa_applications');
    }
};
