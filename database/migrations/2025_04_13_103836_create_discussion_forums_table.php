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
        Schema::create('discussion_forums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobSeekerId')->constrained('job_seekers')->cascadeOnDelete();
            $table->string('topic');
            $table->longText('description');
            $table->json('images')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->enum('category',["education","investment","scammer","office","other"])->default("other");
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
        Schema::dropIfExists('discussion_forums');
    }
};
