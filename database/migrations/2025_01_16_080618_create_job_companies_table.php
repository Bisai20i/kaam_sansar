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
        Schema::create('job_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('industryCategoryId');
            $table->foreign('industryCategoryId')->references('id')->on('industry_categories')->onDelete('cascade');
            $table->string('companyName');
            $table->string('email')->unique();
            $table->string('phoneNumber')->unique();
            $table->string('password')->nullable();
            $table->string('link1')->nullable();
            $table->string('link2')->nullable();
            $table->string('link3')->nullable();
            $table->string('companyProfileImg');
            $table->longText('companyDescription')->nullable();
            $table->enum('reviewStatus', [0, 1, 2, 3, 4, 5])->default(0);



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
        Schema::dropIfExists('job_companies');
    }
};
