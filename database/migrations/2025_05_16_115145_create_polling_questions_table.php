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
        Schema::create('polling_questions', function (Blueprint $table) {
        $table->id();
$table->unsignedBigInteger('admin_id')->nullable(false);
$table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
$table->string('question')->nullable(false);
$table->enum('publishStatus', ['publish', 'unpublish'])->default('unpublish');
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
        Schema::dropIfExists('polling_questions');
    }
};
