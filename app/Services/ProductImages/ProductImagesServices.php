<?php

namespace App\Services\ProductImages;

use App\Models\ProductImage;
use Illuminate\Http\Response;
use App\Contracts\ProductImages\ProductImageServiceContract;
use App\Http\Resources\ProductImages\ProductImagesResource;
use App\Http\Resources\ProductImages\ProductImagesCollection;

class ProductImagesServices implements ProductImageServiceContract
{

    /**
     * create a productImage
     * @param array $data.
     * @return ProductImagesResource.
     */
    public function create($data): ProductImagesResource
    {
        return new ProductImagesResource(ProductImage::create($data));
    }

    /**
     * update a productImage
     * 
     * @param ProductImage $productImage.
     * @return ProductImagesResource.
     */
    public function update(ProductImage $productImage, array $data): ProductImagesResource
    {
        $productImage->update($data);
        return new ProductImagesResource($productImage);
    }


    /**
     * get all productImages
     * 
     * @return array.
     */

    public function index(): ProductImagesCollection
    {

        return new ProductImagesCollection(ProductImage::all());
    }


    /**
     * get an productImage
     * @param ProductImage $productImage
     * @return ProductImagesResource.
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
        $productImage->delete();

        return response()->noContent();
    }
}
