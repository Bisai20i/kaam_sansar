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
            $table->boolean('pinned')->default(false);
            $table->enum('category',["education","investment","scammer","office","other"])->default("other");
            $table->string('person_name')->nullable();
            $table->string('country')->nullable();
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
