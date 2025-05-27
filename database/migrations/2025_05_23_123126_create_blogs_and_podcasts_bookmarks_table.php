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
        Schema::create('blogs_and_podcasts_bookmarks', function (Blueprint $table) {
            $table->id();

            // Use snake_case for consistency
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->cascadeOnDelete();

            // Make sure the table name matches your actual table
            $table->foreignId('blogs_and_podcasts_id')->constrained('blogs_and_podcasts')->cascadeOnDelete();

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
        Schema::dropIfExists('blogs_and_podcasts_bookmarks');
    }
};
