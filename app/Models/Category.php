<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon_emoji',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    
    public function getTitleAttribute()
    {
        return $this->name;
    }

    public function getIconAttribute()
    {
        return $this->icon_emoji;
    }

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('sort_order', 'asc');
    }
}
