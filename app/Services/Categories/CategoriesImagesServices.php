<?php

namespace App\Services\Categories;

use App\Models\Category;
use App\Traits\Categories\CategoriesImagesTrait;

class CategoriesImagesServices
{
    use CategoriesImagesTrait;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function uploadImage(Category $category, string $fieldName): array
    {
        //verifier si une image existe
        if (!isset($this->data[$fieldName])) {
            return $this->data;
        }
        // Supprime l'image existante si elle est définie
        if ($category->{$fieldName}) {
            $this->destroyImage($category->{$fieldName});
        }

        // get the path of the new image
        $this->data[$fieldName]  = $this->storeImage($this->data[$fieldName]);
        return $this->data;
    }

    public function deleteImage(Category $category, $fieldName): Void
    {

        if ($category->{$fieldName}) {
            $this->destroyImage($category->{$fieldName});
        }
    }
}
