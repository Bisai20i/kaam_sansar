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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('jobTitle')->nullable();
            $table->string('companyName')->nullable();
            $table->string('location')->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->longText('experienceDescription')->nullable();

              // For the salary question
        $table->tinyInteger('salaryRating')->nullable();
        $table->longText('salaryFeedback')->nullable();

        // For the working environment question
        $table->tinyInteger('workingEnvironmentRating')->nullable();
        $table->longText('workingEnvironmentFeedback')->nullable();

        // For the extra benefits/allowances question
        $table->tinyInteger('benefitsRating')->nullable();
        $table->longText('benefitsFeedback')->nullable();
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
        Schema::dropIfExists('experiences');
    }
};
