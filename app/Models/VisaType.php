<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaType extends Model
{
    use HasFactory;

    protected $fillable = [
        'visaTypeName',
        'slug',
        'image',
        'publishStatus',
    ];


    public function visaCountryList()
    {
        return $this->hasMany(VisaCountryList::class);
    }

    public function visas()
    {
        return $this->hasMany(VisaDetails::class);
    }
}
