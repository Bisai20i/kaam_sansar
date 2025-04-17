<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaApplication extends Model
{
    use HasFactory;

    protected $table = 'visa_applications';

    protected $fillable = [
        'jobSeekerId',
        'fullName',
        'passportNumber',
        'emailAddress',
        'phoneNumber',
        'visaTypeId',
        'citizenshipAsPassport',
        'dateOfEntry',
        'uploadedFiles'
    ];
}
