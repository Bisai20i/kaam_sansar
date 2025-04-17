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
        Schema::create('visa_payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visaApplicationId');
            $table->foreign('visaApplicationId')->references('id')->on('visa_applications')->onDelete('cascade');
            $table->string('paymentMethod')->nullable();
            $table->string('paymentStatus')->default('pending');
            $table->decimal('totalAmount', 10, 2)->default(0);
            $table->string('transaction_id')->nullable();
            $table->string('transaction_code')->nullable();
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
        Schema::dropIfExists('visa_payment_details');
    }
};
