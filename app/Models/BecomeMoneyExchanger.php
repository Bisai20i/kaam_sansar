<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BecomeMoneyExchanger extends Model
{
    use HasFactory;

    protected $fillable = [
    // Personal Information
    'first_name', 'last_name', 'email', 'phone', 'whatsapp_number', 'country',

    // Bank Details
    'bank_name', 'bank_holder_name', 'bank_account_number', 'iban_number',
    'swift_code', 'bank_country', 'branch_location',

    // Business Details
    'business_name', 'business_telephone', 'business_address',
    // Uploaded Documents
    'citizen_document', 'passport_document', 'visa_document', 'resident_id_document',
    'registration_doc1', 'registration_doc2', 'registration_doc3',

    // Terms
    'terms_accepted',

    // Optional status for admin review
    'status',
];

}
