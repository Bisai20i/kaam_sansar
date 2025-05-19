<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdvertisementCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'adsCategoryTitle',
        'adsCategorySlug',
    ];

    protected $table = 'advertisement_categories';  // Ensure the table name matches your migration


    

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }


}
