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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postedId');
            $table->foreign('postedId')->references('id')->on('admins')->onDelete('cascade');
            $table->unsignedBigInteger('jobCategoryId');
            $table->foreign('jobCategoryId')->references('id')->on('job_categories')->onDelete('cascade');
            $table->unsignedBigInteger('jobCompanyId');
            $table->foreign('jobCompanyId')->references('id')->on('job_companies')->onDelete('cascade');
            $table->unsignedBigInteger('jobSeekerId')->nullable();
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('jobTitle');
            $table->string('jobSlug')->unique()->nullable();
            $table->string('jobLevel');
            $table->string('jobType');
            $table->string('noOfVacancy');
            $table->string('employeeTime');
            $table->string('jobLocation');
            $table->string('offeredSalary')->nullable();
            // $table->longText('qualification')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('skills')->nullable();
            $table->longText('jobDescription');
            // $table->longText('jobResponsibilities')->nullable();
            $table->string('jobBanner')->nullable();
            $table->date('jobDeadline');
            $table->string('jobApproval')->default('Approved');
            $table->integer('jobViewerCount')->nullable()->default('0');
            $table->enum('jobStatus', ['published', 'unpublished', 'expired'])->default('unpublished');
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
        Schema::dropIfExists('job_posts');
    }
};
