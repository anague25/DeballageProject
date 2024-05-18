<?php

namespace App\Traits\Shop;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ShopImageTrait
{
    public function storeImage(UploadedFile $file, string $directory = 'images/shops', string $disk = 'public'): string
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
