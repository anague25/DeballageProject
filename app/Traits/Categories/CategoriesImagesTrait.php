<?php

namespace App\Traits\Categories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait CategoriesImagesTrait
{
    public function storeImage(UploadedFile $file, string $directory = 'images/categories', string $disk = 'public'): string
    {
        return $file->store($directory, $disk);
    }

    public function destroyImage(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
