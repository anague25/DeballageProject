<?php

namespace App\Services\Products;

use App\Models\Shop;
use App\Traits\Shop\ShopImageTrait;

class ShopsImagesServices
{
    use ShopImageTrait;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function uploadImage(Shop $shop, string $fieldName): array
    {
        //verifier si une image existe
        if (!isset($this->data[$fieldName])) {
            return $this->data;
        }
        
        // Supprime l'image existante si elle est définie
       
            $this->deleteImage($shop,$fieldName);
        

        // get the path of the new image
        $this->data[$fieldName]  = $this->storeImage($this->data[$fieldName]);
        $this->updateData($this->data);
        return $this->data;
    }

    public function deleteImage(Shop $shop, $fieldName): Void
    {

        if ($shop->{$fieldName}) {
            $this->destroyImage($shop->{$fieldName});
        }
    }

    private function updateData(array $data): void
    {
        $this->data = $data;
    }
}
