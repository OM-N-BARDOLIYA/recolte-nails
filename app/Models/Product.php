<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'slug', 'title', 'tagline', 'category', 'price', 'original_price',
        'rating', 'reviews_count', 'is_bestseller', 'main_image', 'images',
        'description', 'benefits', 'key_ingredients', 'how_to_use', 'shades', 'sizes',
    ];

    protected $casts = [
        'images' => 'array',
        'benefits' => 'array',
        'key_ingredients' => 'array',
        'shades' => 'array',
        'sizes' => 'array',
        'is_bestseller' => 'boolean',
        'price' => 'float',
        'original_price' => 'float',
        'rating' => 'float',
    ];
}
