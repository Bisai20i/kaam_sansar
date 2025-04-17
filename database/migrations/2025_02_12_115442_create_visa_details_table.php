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
        Schema::create('visa_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visaTypeId');
            $table->foreign('visaTypeId')->references('id')->on('visa_types')->onDelete('cascade');
            $table->unsignedBigInteger('visaCountryId'); // Using camelCase
            $table->foreign('visaCountryId')->references('id')->on('visa_country_lists')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->string('demoVideoLink')->nullable(); // camelCase
            $table->string('demoVideoThumbnail')->nullable(); // 
            $table->string('embassyFee')->default('0');
            $table->string('serviceFee')->default('0');
            $table->boolean('publishStatus')->default(false);
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
        Schema::dropIfExists('visa_details');
    }
};
