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
        Schema::create('order_placement_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_placement_id')->constrained('order_placements')->cascadeOnDelete();
            $table->foreignId('gift_coupon_id')->constrained('gift_coupons')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->decimal('unit_discount',5,2)->default(0)->check('discount BETWEEN 0 AND 100');
            $table->integer('unit_rate');
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
        Schema::dropIfExists('order_placement_items');
    }
};
