<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model  // Change this to Model instead of Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'adsId',
        'jobSeekerId',
        'comment',
    ];

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'jobSeekerId');
    }

    public function ads()
    {
        return $this->belongsTo(Advertisement::class, 'adsId');
    }
}
