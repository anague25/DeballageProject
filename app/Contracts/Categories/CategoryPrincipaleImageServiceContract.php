<?php

namespace App\Contracts\Categories;

use App\Models\Category;
use Illuminate\Http\UploadedFile;


interface CategoryPrincipaleImageServiceContract
{
    public function uploadProductImage(Category $product, UploadedFile $file, array $data);
}
