<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasImageTrait
{
    public function uploadImage(UploadedFile $file, string $directory = 'images/shop', string $disk = 'public'): string
    {
        return $file->store($directory, $disk);
    }

    public function deleteImage(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
