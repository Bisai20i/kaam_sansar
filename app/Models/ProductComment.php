<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'productId',
        'jobSeekerId',
        'commentPersonName',
        'comment',
    ];
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }
    public function product()
    {
        return $this->belongsTo(Aboard::class, 'productId');
    }

}
