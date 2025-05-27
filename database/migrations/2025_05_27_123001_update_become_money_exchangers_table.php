<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('become_money_exchangers', function (Blueprint $table) {
            // Drop these columns
            $table->dropColumn(['website_or_social', 'address', 'business_type']);
            
            // Add new column business_telephone after business_name
            $table->string('business_telephone')->after('business_name');
        });
    }

    public function down(): void
    {
        Schema::table('become_money_exchangers', function (Blueprint $table) {
            // Add back dropped columns
            $table->string('website_or_social')->nullable()->after('business_address');
            $table->string('address')->after('website_or_social');
            $table->string('business_type')->after('business_name');
            
            // Drop the business_telephone column
            $table->dropColumn('business_telephone');
        });
    }
};
