<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;

class ValidPhoneNumber implements Rule
{
    protected $countryCode;

    public function __construct($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function passes($attribute, $value)
    {
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $phoneNumber = $phoneUtil->parse($value, strtoupper($this->countryCode));

            return $phoneUtil->isValidNumber($phoneNumber); // Check if valid for country code
        } catch (NumberParseException $e) {
            return false; // Invalid phone number format
        }
    }

    public function message()
    {
        return 'The phone number format is invalid.';
    }
}
