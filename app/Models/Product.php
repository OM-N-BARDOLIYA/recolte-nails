<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'category',
        'slug',
        'title',
        'tagline',
        'badge_text',
        'price',
        'original_price',
        'rating',
        'reviews_count',
        'is_bestseller',
        'is_active',
        'sort_order',
        'main_image',
        'images',
        'description',
        'benefits',
        'key_ingredients',
        'how_to_use',
        'shades',
        'sizes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'reviews_count' => 'integer',
        'is_bestseller' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'images' => 'array',
        'benefits' => 'array',
        'shades' => 'array',
        'sizes' => 'array',
    ];

    public function categoryRef()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->original_price && $this->original_price > $this->price) {
            return round((($this->original_price - $this->price) / $this->original_price) * 100);
        }
        return 0;
    }
}
