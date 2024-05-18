<?php

namespace App\Http\Controllers\Admin\Products;

use App\Contracts\Products\ProductServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductsStoreRequest;
use App\Http\Requests\Products\ProductsUpdateRequest;
use App\Models\Product;

class ProductsController extends Controller
{
    private $productsService;

    public function __construct(ProductServiceContract $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->productsService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsStoreRequest $request)
    {
        return  $this->productsService->create($request->validated());
    }

    /**
     * Display the specified product.
     * 
     */
    public function show(Product $product)
    {
        return $this->productsService->show($product);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(ProductsUpdateRequest $request, Product $product)
    {
        return $this->productsService->update($product, $request->validated());
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        return $this->productsService->delete($product);
    }
}
