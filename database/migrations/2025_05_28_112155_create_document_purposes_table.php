<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *p
     * @return void
     */
    public function up()
    {
        Schema::create('document_purposes', function (Blueprint $table) {
            $table->id();
            $table->string('documentPurpose');
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
        Schema::dropIfExists('document_purposes');
    }
};
