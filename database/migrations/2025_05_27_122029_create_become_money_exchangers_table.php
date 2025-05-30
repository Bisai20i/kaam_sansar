<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('become_money_exchangers', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('whatsapp_number')->nullable();
            $table->string('country');

            // Bank Details
            $table->string('bank_name');
            $table->string('bank_holder_name');
            $table->string('bank_account_number');
            $table->string('iban_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('bank_country')->nullable();
            $table->string('branch_location')->nullable();

            // Business Details
            $table->string('business_name');
            $table->string('business_telephone');
            $table->string('business_address');
            

            // Documents
            $table->string('citizen_document')->nullable();
            $table->string('passport_document')->nullable();
            $table->string('visa_document')->nullable();
            $table->string('resident_id_document')->nullable();
            $table->string('registration_doc1')->nullable();
            $table->string('registration_doc2')->nullable();
            $table->string('registration_doc3')->nullable();

            // Terms and status
            $table->boolean('terms_accepted')->default(false);
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }   

    public function down(): void
    {
        Schema::dropIfExists('become_money_exchangers');
    }
};
