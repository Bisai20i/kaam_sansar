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
            Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_category_id')->constrained('subscription_categories')->onDelete('cascade');
            $table->string('title');
            $table->string('price');
            $table->json('feature');
            $table->string('no_of_service');
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
        Schema::dropIfExists('subscriptions');
    }
};
