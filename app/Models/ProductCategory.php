<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable =[
        'productId',
        'productCategoryTitle',
        'productCategorySlug'
    ];

    public function aboards()
    {
        return $this->hasMany(Aboard::class);
    }
}
