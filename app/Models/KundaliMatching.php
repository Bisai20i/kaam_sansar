<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KundaliMatching extends Model
{
    use HasFactory;
    protected $fillable =[
     'jobSeekerId',
      'girlName',
       'girlDateOfBirth',
        'girlPlaceOfBirth', 
        'girlTimeOfBirth',
         'boyName',
          'boyDateOfBirth',
           'boyPlaceOfBirth', 
           'boyTimeOfBirth',
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
    return $this->hasMany(Astrologer::class, 'kundaliMatchingId');
}

}
