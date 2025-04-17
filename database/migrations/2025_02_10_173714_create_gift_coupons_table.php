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
        Schema::create('gift_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('quantity');
            $table->boolean('type');
            $table->string('country');
            $table->string('city');
            $table->boolean('publishStatus');
            $table->string('thumbnail')->nullable();
            $table->integer('price')->nullable();
            $table->unsignedBigInteger('giftCategoryId');
            $table->foreign('giftCategoryId')->references('id')->on('gift_categories')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('jobSeekerId')->nullable();
            $table->foreign('jobSeekerId')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->foreignId('adminId')->constrained('admins')->cascadeOnDelete();
            $table->decimal('discount',5,2)->default(0)->check('discount BETWEEN 0 AND 100');
            $table->boolean('customApplied')->default(false);
            $table->string('itemCode')->unique()->nullable();
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
        Schema::dropIfExists('gift_coupons');
    }
};
