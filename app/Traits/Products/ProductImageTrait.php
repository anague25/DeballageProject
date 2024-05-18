<?php

namespace App\Traits\Products;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ProductImageTrait
{
    public function storeImage(UploadedFile $file, string $directory = 'images/products', string $disk = 'public'): string
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
