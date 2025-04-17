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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();


            // Foreign key for Advertisement
            $table->unsignedBigInteger('adsId');
            $table->foreign('adsId')->references('id')->on('advertisements')->onDelete('cascade');

             // Foreign key for Job Seekers
             $table->unsignedBigInteger('jobSeekerId');
             $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('commentPersonName')->nullable();
            $table->string('commentPersonImg')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('comments');
    }
};
