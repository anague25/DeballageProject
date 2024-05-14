<?php

namespace App\Services\Products;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductsImagesServices
{
   
    
    use HasImageTrait;

    public function uploadProductImage(Product $product, UploadedFile $file, string $path): void
    {
        // Supprime l'image existante si elle est définie
        if ($product->image) {
            $this->deleteImage($product->image);
        }

        // Enregistre la nouvelle image et met à jour le chemin de l'image du produit
        $product->image = $this->uploadImage($file, $path);
        $product->save();
    }

}
