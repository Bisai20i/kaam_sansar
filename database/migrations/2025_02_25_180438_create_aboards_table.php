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
        Schema::create('aboards', function (Blueprint $table) {
            $table->id();

               // Foreign key for Advertisement Categories
               $table->unsignedBigInteger('productCategoryId');
               $table->foreign('productCategoryId')->references('id')->on('product_categories')->onDelete('cascade');
   
               // Foreign key for Job Seekers
               $table->unsignedBigInteger('jobSeekerId');
               $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
   
            $table->string('productTitle');
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('postedDuration')->nullable();
            $table->enum('type',['Item','Buy'])->nullable();
            $table->string('productThumbnail')->nullable();
            $table->string('productSlug')->nullable();
            $table->longText('productDescription')->nullable();
            $table->string('productOwnerName')->nullable();
            $table->string('contactNumber')->nullable();
            $table->string('pricing')->nullable();
            $table->string('urlLink')->nullable();

            $table->string('publishStatus')->default('publish');
            $table->string('status')->default('Available');
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
        Schema::dropIfExists('aboards');
    }
};
