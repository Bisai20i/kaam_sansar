<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('become_sellers', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp_number')->nullable();
            $table->string('country');
            
            // Bank Details
            $table->string('bank_name');
            $table->string('bank_holder_name');
            $table->string('bank_account_number');
            $table->string('iban_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('bank_country');
            $table->string('branch_location');
            
            // Business Details
            $table->string('business_name');
            $table->string('business_type');
            $table->string('business_address');
            $table->string('website_or_social')->nullable();
            $table->string('address');
            
            // Product Details
            $table->string('product_category');
            $table->string('delivery_time');
            $table->string('target_country');
            
            // Document paths (will store file paths)
            $table->string('citizen_document')->nullable();   // Path to citizen document (nullable)
            $table->string('passport_document')->nullable();  // Path to passport document (nullable)
            $table->string('visa_document')->nullable();      // Path to visa document (nullable)
            $table->string('resident_id_document')->nullable(); // Path to resident ID document (nullable)
            $table->string('registration_doc1')->nullable();  // Path to first registration document (nullable)
            $table->string('registration_doc2')->nullable();  // Path to second registration document (nullable)
            $table->string('registration_doc3')->nullable();  // Path to third registration document (nullable)
            $table->string('show_pic1')->nullable();          // Path to first show picture (nullable)
            $table->string('show_pic2')->nullable();          // Path to second show picture (nullable)
            $table->string('show_pic3')->nullable();          // Path to third show picture (nullable)
            
            // Terms acceptance
            $table->boolean('terms_accepted')->default(false);
            
            // Seller status
            $table->string('status')->default('pending'); // status options: pending, approved, rejected
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('become_sellers');
    }
};
