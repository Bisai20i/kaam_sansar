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
        Schema::create('resume_helps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_desc');
            $table->string('image_preview')->nullable();
            $table->decimal('normal_price', 8, 2);
            $table->decimal('sell_price', 8, 2);
            $table->boolean('type')->default(0); // 0 = free, 1 = premium
            $table->boolean('publish_not_publish')->default(1);
            $table->string('feature_1')->nullable();
            $table->string('feature_2')->nullable();
            $table->string('feature_3')->nullable();
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
        Schema::dropIfExists('resume_helps');
    }
};
