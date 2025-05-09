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
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->text('visaDetails');
            $table->date('visaExpire')->nullable();
            $table->string('country');
            $table->text('visaImage');

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
        Schema::dropIfExists('visas');
    }
};
