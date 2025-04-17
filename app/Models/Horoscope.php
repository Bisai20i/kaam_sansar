<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    use HasFactory;
    protected $fillable =[
'zodiacSignEnglish',
        'zodiacSignNepali',
                'zodiacSignSlug',
                'birthMonth',

        'nameStartLetter',
        'contentNp',
        'contentEn',
        'publishDate',
        'type',
        'typeSlug',
'zodiacImgNepali',
        'zodiacImgEnglish',    ];

    

}
