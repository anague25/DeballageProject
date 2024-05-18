<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Products\ProductsResource;
use App\Contracts\Products\ProductServiceContract;
use App\Http\Resources\Products\ProductsCollection;
use App\Contracts\ProductImages\ProductImageServiceContract;

class ProductsServices implements ProductServiceContract
{
    protected $imageService;

    public function __construct(ProductImageServiceContract $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * create an product
     * 
     * @param array $data.
     * @return ProductsResource.
     */
    public function create($validatedData): ProductsResource
    {
        $validatedData['shop_id'] = Auth::user()->shop->id;
        $product = new Product();
        $productImages = new ProductsImagesServices($validatedData);
        $data = $productImages->uploadImage($product, 'image');
        $product = Product::create($data);
        $attributePropertyPairs = collect($validatedData['attribute_fields'])
            ->pluck('property_id', 'attribute_id')
            ->toArray();

        $product->attributes()->sync($attributePropertyPairs);
        return new ProductsResource($product);
    }

    /**
     * update an product
     * 
     * @param Product $product.
     * @return ProductsResource.
     */
    public function update(Product $product, array $validatedData): ProductsResource
    {
        $productImages = new ProductsImagesServices($validatedData);
        $data = $productImages->uploadImage($product, 'image');
        $product->update($data);
        $attributePropertyPairs = collect($validatedData['attribute_fields'])
            ->pluck('property_id', 'attribute_id')
            ->toArray();

        $product->attributes()->sync($attributePropertyPairs);
        return new ProductsResource($product);
    }


    /**
     * get all products
     * 
     * @return array.
     */

    public function index(): ProductsCollection
    {

        return new ProductsCollection(Product::all());
    }


    /**
     * get an product
     * @param Product $product
     * @return ProductsResource.
     */

    public function show(Product $product): ProductsResource
    {
        return new ProductsResource($product->load('images'));
    }



    /**
     * delete an product
     * 
     * @param Product $product.
     * @return Illuminate\Http\Response.
     */

    public function delete(Product $product): Response
    {
        $productImages = new ProductsImagesServices($validatedData = []);
        $productImages->deleteImage($product, $fieldName = 'image');

        foreach ($product->images as $image) {
            Storage::delete($image->images);
            $image->delete();
        }

        $product->delete();

        return response()->noContent();
    }
}
