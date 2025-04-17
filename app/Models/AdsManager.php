<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsManager extends Model
{
    use HasFactory;
    protected $table = 'ads_manager';

    protected $fillable = [
        'title',
        'link',
        'which_page',
        'position',
        'publish_or_not',
        'active',
        'image'
    ];
}
