<?php

namespace App\Traits\Products\UploadImageTrait;

trait UploadImageTrait
{
    public function uploadImage($image, $destinationPath)
    {
        // Logique de téléchargement et de traitement de l'image
        $uploadedImage = $image->store($destinationPath);

        return $uploadedImage;
    }
}
