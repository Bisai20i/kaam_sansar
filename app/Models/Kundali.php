<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kundali extends Model
{
    use HasFactory;
    protected $fillable =[
 'jobSeekerId', 
 'emailAddress',
 'phoneNumber',
 'personName',
  'personDateOfBirth', 
  'personPlaceOfBirth', 
 'personTimeOfBirth',
         'Query1',
          'Query2',
           'Query3'   
    ];

      // Define the relationship with the JobSeeker model
      public function jobSeeker()
      {
          return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
      }
      
      public function astrologers()
{
    return $this->hasMany(Astrologer::class, 'kundaliId');
}

}
