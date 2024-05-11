<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Http\Response;
use App\Contracts\Products\ProductServiceContract;
use App\Http\Resources\Products\ProductsResource;
use App\Http\Resources\Products\ProductsCollection;

class ProductsServices implements ProductServiceContract
{

    /**
     * create an product
     * 
     * @param array $data.
     * @return ProductsResource.
     */
    public function create($data): ProductsResource
    {
        return new ProductsResource(Product::create($data));
    }

    /**
     * update an product
     * 
     * @param Product $product.
     * @return ProductsResource.
     */
    public function update(Product $product, array $data): ProductsResource
    {
        $product->update($data);
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
        $product->delete();

        return response()->noContent();
    }
}
