<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
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
        static::creating(function (Book $book) {
            if (empty($book->slug)) {
                $book->slug = Str::slug($book->title);
            }
        });
    }

    public function coverUrl(): ?string
    {
        $img = trim((string) ($this->cover_image ?? ''));
        if ($img === '') {
            return null;
        }
        if (Str::startsWith($img, ['http://', 'https://', '//'])) {
            return $img;
        }

        return asset('public/admin/assets/images/page/' . $img);
    }
}
