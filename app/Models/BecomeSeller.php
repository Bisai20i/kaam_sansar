<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BecomeSeller extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'whatsapp_number',
        'country',
        'bank_name',
        'bank_holder_name',
        'bank_account_number',
        'iban_number',
        'swift_code',
        'bank_country',
        'branch_location',
        'business_name',
        'business_type',
        'business_address',
        'website_or_social',
        'address',
        'product_category',
        'delivery_time',
        'target_country',
        'citizen_document',
        'passport_document',
        'visa_document',
        'resident_id_document',
        'registration_doc1',
        'registration_doc2',
        'registration_doc3',
        'show_pic1',
        'show_pic2',
        'show_pic3',
        'terms_accepted',
        'status'
    ];
}