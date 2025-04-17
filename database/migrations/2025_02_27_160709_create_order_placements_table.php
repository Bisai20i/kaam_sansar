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
        Schema::create('order_placements', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('alternative_phone')->nullable();
            $table->string('country');
            $table->string('city');
            $table->integer('appartment_no');
            $table->integer('house_no');
            $table->string('nearest_landmark');
            $table->date('expected_delivery_time')->nullable();
            $table->enum('status',['pending','confirmed','shipped','delivered','cancelled'])->nullable()->default('pending');
            $table->enum('preferred_time',['morning','day','evening','night'])->nullable();
            $table->enum('payment_method',['cod','e_wallet','e_bank'])->nullable();
            $table->string('transaction_code')->nullable();
            $table->longText('instructions')->nullable();
            $table->integer('discount_amount')->unsigned()->nullable();
            $table->integer('sub_total')->unsigned()->nullable();
            $table->foreignId('jobSeekerId')->constrained('job_seekers')->cascadeOnDelete();
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers')->cascadeOnDelete();
            $table->decimal('voucher_discount',5,2)->default(0)->check('voucher_discount BETWEEN 0 AND 100')->nullable();
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
        Schema::dropIfExists('order_placements');
    }
};
