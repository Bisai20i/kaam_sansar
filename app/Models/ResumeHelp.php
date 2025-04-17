<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeHelp extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_desc',
        'image_preview',
        'normal_price',
        'sell_price',
        'type',
        'publish_not_publish',
        'feature_1',
        'feature_2',
        'feature_3'
    ];
}
