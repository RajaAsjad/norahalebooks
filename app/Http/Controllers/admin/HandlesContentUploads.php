<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HandlesContentUploads
{
    protected function uploadImage(?UploadedFile $file, string $subdir = 'content'): ?string
    {
        if (! $file) {
            return null;
        }

        $dir = public_path('admin/assets/images/' . $subdir);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = date('YmdHis') . '-' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $name);

        return $name;
    }

    protected function uniqueSlug(string $modelClass, string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i = 1;

        while ($modelClass::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
