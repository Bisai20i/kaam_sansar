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
        Schema::create('kundali_matchings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
           
            $table->string('girlDateOfBirth');
            $table->string('girlPlaceOfBirth');
            $table->string('girlTimeOfBirth');
            $table->string('boyName');
            $table->string('boyDateOfBirth');
            $table->string('boyPlaceOfBirth');
            $table->string('boyTimeOfBirth');
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
        Schema::dropIfExists('kundali_matchings');
    }
};
