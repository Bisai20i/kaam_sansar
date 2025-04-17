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
        Schema::create('blogsAndPodcasts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->enum('blogOrPodcast', ['blog', 'podcast']); // Type of content (blog or podcast)
            $table->string('slug')->unique(); // Unique slug for SEO-friendly URLs
            $table->string('title'); // Title of the blog or podcast
            $table->longText('description')->nullable(); // Detailed description, nullable
            $table->string('imageUrl')->nullable(); // URL for the image, nullable
            $table->string('linkUrl')->nullable(); // URL for the external link, nullable
            $table->string('podcastTime')->nullable(); // Duration or timestamp for podcasts, nullable
            $table->boolean('publishStatus')->default(false)->comment('0 = unpublished, 1 = published');
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs_and_podcasts');
    }
};
