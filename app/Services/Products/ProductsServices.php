<?php

namespace App\Services\Products;

use Exception;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Products\ProductsResource;
use App\Contracts\Products\ProductServiceContract;
use App\Http\Resources\Products\ProductsCollection;
use App\Contracts\ProductImages\ProductMultipleImageServiceContract;
use App\Models\Neighborhood;
use App\Models\Property;

class ProductsServices implements ProductServiceContract
{
    private $serviceMultipleImages;

    public function __construct(ProductMultipleImageServiceContract $serviceMultipleImages)
    {
        $this->serviceMultipleImages = $serviceMultipleImages;
    }

    /**
     * create an product
     * 
     * @param array $data.
     * @return ProductsResource.
     */
    public function create($validatedData): ProductsResource|JsonResponse
    {
        DB::beginTransaction();
        try {

            $product = new Product();
            $productImages = new ProductsImagesServices($validatedData);
            $data = $productImages->uploadImage($product, 'image');
            $product = Product::create($data);

            $attributePropertyPairs = collect($validatedData['attribute_fields'])
                ->mapWithKeys(function ($item) {
                    return [$item['attribute_id'] . '-' . $item['property_id'] => [
                        'attribute_id' => $item['attribute_id'],
                        'property_id' => $item['property_id']
                    ]];
                })
                ->values()
                ->toArray();


            $product->attributes()->attach($attributePropertyPairs);
            $this->serviceMultipleImages->create($product, $validatedData);

            DB::commit();

            return new ProductsResource($product);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
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
            ->mapWithKeys(function ($item) {
                return [$item['attribute_id'] . '-' . $item['property_id'] => [
                    'attribute_id' => $item['attribute_id'],
                    'property_id' => $item['property_id']
                ]];
            })
            ->values()
            ->toArray();

        $product->attributes()->sync($attributePropertyPairs);
        if (isset($validatedData['images'])) {

            $this->serviceMultipleImages->create($product, $validatedData);
        }
        return new ProductsResource($product);
    }


    /**
     * get all products
     * 
     * @return array.
     */

    public function index(): ProductsCollection
    {
        $products = Product::query()->when(request('query'), function ($query, $searchQuery) {
            $query->where('name', 'like', "%{$searchQuery}%")->get();
        })->with('shop', 'category', 'attributes')
            ->latest()->paginate(12);
        foreach ($products as $product) {
            foreach ($product->attributes as $attribute) {
                if ($attribute->pivot->property_id) {
                    $attribute->properties = Property::where('id', $attribute->pivot->property_id)->first();
                } else {
                    $attribute->properties = null;
                }
            }
        }


        return new ProductsCollection($products);
    }





    public function all(): ProductsCollection
    {
        return new ProductsCollection(Product::latest()->get());
    }





    /**
     * get an product
     * @param Product $product
     * @return ProductsResource.
     */

    public function show(Product $product): ProductsResource
    {
        $product =  $product->load('images', 'shop.cities', 'category', 'attributes');
        foreach ($product->shop->cities as $city) {
            $city->neighborhood = Neighborhood::find($city->pivot->neighborhood_id);
        }
        return new ProductsResource($product);
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
            Storage::disk('public')->delete($image->images);
            $image->delete();
        }

        $product->attributes()->sync([]);
        $product->delete();

        return response()->noContent();
    }
}
