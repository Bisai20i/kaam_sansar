<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'adsTitle',
        'adsSlug',
        'location',
        'adsDescription',
        'adsOwner',
        'adsOwnerImg',
        'contactNumber',
        'pricing',
        'publishStatus',
        'status',
        'adsCategoryId',
        'postedDuration',
        'adsThumbnail',
        'jobSeekerId',
        'comment',
        'commentPersonName',
        'country',
        'type'
 ];
    public function jobSeeker()
      {
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }
    public  function adsCategory()
    {
        return $this->belongsTo(AdvertisementCategory::class, 'adsCategoryId');
    }
    public  function comments()
    {
        return $this->hasMany(Comment::class, 'adsId');
    }
}
