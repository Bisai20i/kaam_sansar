<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrokerAccount extends Model
{
    use HasFactory;
      protected $table = 'broker_accounts';
      protected $guarded = [];
  
      // Define relationships (if any)
      public function jobSeeker()
      {
          return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
      }
}
