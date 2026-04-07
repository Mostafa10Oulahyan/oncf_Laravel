<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'travel_time',
        'is_featured',
        'display_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->orderBy('display_order');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
