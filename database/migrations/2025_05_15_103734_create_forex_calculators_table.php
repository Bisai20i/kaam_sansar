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
        Schema::create('forex_calculators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_admin_id')->constrained('admins')->onDelete('cascade');
            $table->date('date_of_validity');
            $table->string('base_currency');
            $table->string('target_currency');
            $table->float('buying_rate');
            $table->float('selling_rate');
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
        Schema::dropIfExists('forex_calculators');
    }
};
