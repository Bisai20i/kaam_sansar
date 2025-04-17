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
        Schema::create('horoscopes', function (Blueprint $table) {
            $table->id();
            $table->string('zodiacSignEnglish');
            $table->string('zodiacSignNepali');
            $table->string('birthMonth');
            $table->string('zodiacSignSlug')->nullable();
            $table->string('nameStartLetter');
            $table->longText('contentNp')->nullable();
            $table->longText('contentEn')->nullable();
            $table->string('publishDate');
            $table->enum('type', ['daily','weekly','monthly','yearly']);
            $table->string('typeSlug')->nullable();
            $table->string('zodiacImgNepali');
            $table->string('zodiacImgEnglish');



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
        Schema::dropIfExists('horoscopes');
    }
};
