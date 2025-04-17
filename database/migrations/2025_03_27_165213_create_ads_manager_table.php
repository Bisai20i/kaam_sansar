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
        Schema::create('ads_manager', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->string('which_page');
            $table->enum('position', ['left', 'right', 'top', 'bottom', 'middle']);
            $table->boolean('publish_or_not')->default(0);
            $table->boolean('active')->default(1);
            $table->string('image')->nullable();
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
        Schema::dropIfExists('ads_manager');
    }
};
