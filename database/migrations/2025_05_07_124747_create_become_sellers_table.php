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
            $table->string('email')->nullable(); 
            $table->string('phone');
            $table->string('whatsapp_number')->nullable();
            $table->string('country');
            
            // Bank Details
            $table->string('bank_name')->nullable();
            $table->string('bank_holder_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('iban_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('bank_country')->nullable();
            $table->string('branch_location')->nullable();
            
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
            $table->string('citizen_document')->nullable();  
            $table->string('passport_document')->nullable(); 
            $table->string('visa_document')->nullable();     
            $table->string('resident_id_document')->nullable();
            $table->string('registration_doc1')->nullable(); 
            $table->string('registration_doc2')->nullable(); 
            $table->string('registration_doc3')->nullable(); 
            $table->string('show_pic1')->nullable();         
            $table->string('show_pic2')->nullable();         
            $table->string('show_pic3')->nullable();         
            
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