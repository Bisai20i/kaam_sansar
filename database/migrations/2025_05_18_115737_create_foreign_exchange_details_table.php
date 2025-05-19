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
        Schema::create('foreign_exchange_details', function (Blueprint $table) {

            $table->id();
            $table->foreignId('jobseeker_id')->constrained('job_seekers')->cascadeOnDelete();
            $table->foreignId('forex_calculator_id')->constrained('forex_calculators')->cascadeOnDelete();
            $table->string('sender_bank_name');
            $table->string('receiver_bank_name');
            $table->integer('transfer_amount');
            $table->integer('receiver_amount');
            $table->string('base_currency');
            $table->bigInteger('sender_account_number');
            $table->bigInteger('receiver_account_number');
            $table->string('remarks');
            $table->enum('buy_or_sell', ['buy', 'sell']);
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
        Schema::dropIfExists('foreign_exchange_details');
    }
};
