<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained('gift_coupons')->cascadeOnDelete();
            $table->foreignId('jobSeekerId')->constrained('job_seekers')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
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
        Schema::dropIfExists('gift_carts');
    }
};
