<?php

namespace App\Services\ProductImages;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Response;
use App\Traits\ProductMultipleImages\ProductMultipleImagesTrait;
use App\Http\Resources\ProductImages\ProductImagesResource;
use App\Http\Resources\ProductImages\ProductImagesCollection;
use App\Contracts\ProductImages\ProductMultipleImageServiceContract;

class ProductMultipleImagesServices implements ProductMultipleImageServiceContract
{
    use ProductMultipleImagesTrait;

    /**
     * create a productImage
     * @param array $data.
     * @param Product $product.
     * @return ProductImagesResource.
     */
    public function create(Product $product, $data)
    {
        $uploadedImagePaths = [];

        foreach ($data as $image) {
            $uploadedImagePath = $this->storeImage($image);

            $product->images()->create(['images' => $uploadedImagePath]);

            $uploadedImagePaths[] = $uploadedImagePath;
        }

        return response()->json(['uploaded_images' => $uploadedImagePaths], 200);
    }

    /**
     * update a productImage
     * 
     * @param ProductImage $productImage.
     * @return ProductImagesResource.
     */
    public function update(ProductImage $productImage, array $data): ProductImagesResource
    {
        $this->destroyImage($productImage->images);
        $data['images'] = $this->storeImage($data['images']);
        $productImage->update($data);
        return new ProductImagesResource($productImage);
    }


    /**
     * get all productImages
     * 
     * @return array.
     */

     public function index($productId): ProductImagesCollection
     {
         // Trouver le produit par son ID
         $product = Product::findOrFail($productId);
 
         // Récupérer toutes les images liées au produit
         $images = $product->images;
 
         return new ProductImagesCollection($images);
     }


    /**
     * get an productImage
     * @param ProductImage $productImage
     * @return ProductImagesResource
     */

    public function show(ProductImage $productImage): ProductImagesResource
    {
        return new ProductImagesResource($productImage);
    }



    /**
     * delete an productImage
     * 
     * @param ProductImage $productImage.
     * @return Illuminate\Http\Response.
     */

    public function delete(ProductImage $productImage): Response
    {
        $this->destroyImage($productImage->images);
        $productImage->delete();

        return response()->noContent();
    }
}
