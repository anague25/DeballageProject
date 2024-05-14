<?php

namespace App\Traits\Products\UploadImageTrait;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function productsImages(Product $product, string $pathImage, string $imageField): array
    {

        if (!isset($this->data[$imageField])) {
            return $this->data;
        }

        $this->deleteproductsImages($product);
        $this->data[$imageField] = $this->data[$imageField]->store('images/' . $pathImage, 'public');

        return $this->data;
    }

    public function deleteproductsImages(Product $product): Void
    {

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
    }
}
