<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'section_key',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    public static function getSection($page, $sectionKey, $default = [])
    {
        $item = static::where('page', $page)->where('section_key', $sectionKey)->first();
        return $item ? $item->content : $default;
    }

    public static function setSection($page, $sectionKey, $content)
    {
        return static::updateOrCreate(
            ['page' => $page, 'section_key' => $sectionKey],
            ['content' => $content]
        );
    }
}
