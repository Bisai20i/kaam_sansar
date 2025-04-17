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



    

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }


}
