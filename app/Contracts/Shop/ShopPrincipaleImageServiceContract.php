<?php

namespace App\Contracts\Shop;

use App\Models\Shop;
use Illuminate\Http\UploadedFile;


interface ShopPrincipaleImageServiceContract
{
    public function uploadProductImage(Shop $product, UploadedFile $file, string $fieldName, string $path);
}
