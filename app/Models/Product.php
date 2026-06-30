<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });
    }

    public function imageUrl(): ?string
    {
        $img = trim((string) ($this->image ?? ''));
        if ($img === '') {
            return null;
        }
        if (Str::startsWith($img, ['http://', 'https://', '//'])) {
            return $img;
        }

        return asset('public/admin/assets/images/page/' . $img);
    }

    public function scopePublished($query)
    {
        return $query->where('status', true);
    }
}
