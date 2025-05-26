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
        Schema::table('blogs_and_podcasts', function (Blueprint $table) {
            $table->unsignedBigInteger('views_count')->default(0)->after('publishStatus');
            $table->unsignedBigInteger('shares_count')->default(0)->after('views_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::table('blogs_and_podcasts', function (Blueprint $table) {
            $table->dropColumn(['views_count', 'shares_count']);
        });
    }
};
