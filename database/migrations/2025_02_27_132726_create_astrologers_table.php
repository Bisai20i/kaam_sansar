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
        Schema::create('astrologers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kundaliId')->nullable();
            $table->foreign('kundaliId')->references('id')->on('kundalis')->onDelete('cascade');
            $table->unsignedBigInteger('kundaliMatchingId')->nullable();
            $table->foreign('kundaliMatchingId')->references('id')->on('kundali_matchings')->onDelete('cascade');
            $table->string('astrologerName')->nullable();
            $table->string('astrologerPhone')->nullable();
            $table->string('astrologerLocation')->nullable();
            $table->string('astroVideoLink')->nullable();
            $table->string('status')->default('Review');
            $table->string('publishStatus')->default('publish');

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
        Schema::dropIfExists('astrologers');
    }
};
