<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_documents', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type', ['passport', 'citizenship', 'certificate', 'boarding_pass']);
            $table->foreignId('jobSeekerId')->constrained('job_seekers')->cascadeOnDelete();
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
        Schema::dropIfExists('my_documents');
    }
};
