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
        Schema::create('product_comments', function (Blueprint $table) {
            $table->id();

            // Foreign key for Advertisement
            $table->unsignedBigInteger('productId');
            $table->foreign('productId')->references('id')->on('aboards')->onDelete('cascade');
                         // Foreign key for Job Seekers
                         $table->unsignedBigInteger('jobSeekerId');
                         $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
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
        Schema::dropIfExists('product_comments');
    }
};
