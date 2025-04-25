<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboard extends Model
{
    use HasFactory;
    protected $fillable =[
        'productTitle',
        'productThumbnail',
        'productSlug',
        'productDescription',
        'productOwnerName',
        'contactNumber',
        'pricing',
        'publishStatus',
        'status',
        'jobSeekerId',
        'productCategoryId',
        'country',
        'location',
        'type',
        'postedDuration',
        'urlLink'

    ];

    

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'productCategoryId');
    }
    public function comments()
    {
        return $this->hasMany(ProductComment::class, 'productId');
    }


}
