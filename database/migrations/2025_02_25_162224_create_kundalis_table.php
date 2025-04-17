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
        Schema::create('kundalis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('emailAddress')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('personName');
            $table->string('personDateOfBirth');
            $table->string('personPlaceOfBirth');
            $table->string('personTimeOfBirth');
            $table->longText('Query1')->nullable();
            $table->longText('Query2')->nullable();
            $table->longText('Query3')->nullable();


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
        Schema::dropIfExists('kundalis');
    }
};