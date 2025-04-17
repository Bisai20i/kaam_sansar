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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();

            // Foreign key for Advertisement Categories
            $table->unsignedBigInteger('adsCategoryId');
            $table->foreign('adsCategoryId')->references('id')->on('advertisement_categories')->onDelete('cascade');

            // Foreign key for Job Seekers
            $table->unsignedBigInteger('jobSeekerId');
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');

            // Advertisement details
            $table->string('adsTitle');
            $table->string('adsSlug')->nullable();
            $table->string('location');
            $table->string('country')->nullable();
            $table->enum('type',['Buy','Sell','Rent'])->nullable();
            
            $table->string('postedDuration');
            $table->longText('adsDescription')->nullable();
            $table->string('commentPersonName')->nullable();
            $table->text('comment')->nullable();
            $table->string('adsOwner')->nullable();
            $table->text('adsOwnerImg')->nullable();
            $table->string('contactNumber')->nullable();
            $table->string('pricing');
            $table->string('publishStatus')->default('unpublish');
            $table->string('status')->default('active');
            $table->string('adsThumbnail')->nullable();
          
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
        Schema::dropIfExists('advertisements');
    }
};
