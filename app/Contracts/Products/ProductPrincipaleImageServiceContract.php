<?php

namespace App\Contracts\Products;

use App\Models\Product;
use Illuminate\Http\UploadedFile;


interface ProductPrincipaleImageServiceContract
{
    public function uploadProductImage(Product $product, UploadedFile $file, string $fieldName, string $path);
}
