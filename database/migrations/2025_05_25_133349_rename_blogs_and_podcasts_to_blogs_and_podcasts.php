<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Rename from blogsAndPodcasts to blogs_and_podcasts
        Schema::rename('blogsAndPodcasts', 'blogs_and_podcasts');
    }

    public function down()
    {
        // Revert back to original name
        Schema::rename('blogs_and_podcasts', 'blogsAndPodcasts');
    }
};
