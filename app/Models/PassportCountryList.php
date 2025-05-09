<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportCountryList extends Model
{
    use HasFactory;
    protected $table = 'passport_country_lists';
    protected $guarded = [];

    public function passportProviences()
    {
        return $this->hasMany(PassportProvience::class,'countryId');
    }
}
