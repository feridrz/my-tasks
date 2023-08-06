<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'category'
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
