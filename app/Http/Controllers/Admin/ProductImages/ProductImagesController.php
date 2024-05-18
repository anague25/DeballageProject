<?php

namespace App\Http\Controllers\Admin\ProductImages;

use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use App\Contracts\ProductImages\ProductImageServiceContract;
use App\Http\Requests\ProductImages\ProductImageStoreRequest;
use App\Http\Requests\ProductImages\ProductImageUpdateRequest;

class ProductImagesController extends Controller
{
    private $productImagesService;

    public function __construct(ProductImageServiceContract $productImagesService)
    {
        $this->productImagesService = $productImagesService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index($productId)
    {
        return $this->productImagesService->index($productId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductImageStoreRequest $request,Product $productId)
    {
        return  $this->productImagesService->create($productId,$request->validated());
    }

    /**
     * Display the specified productImage.
     * 
     */
    public function show(ProductImage $productImage)
    {
        return $this->productImagesService->show($productImage);
    }

    /**
     * Update the specified productImage in storage.
     */
    public function update(ProductImageUpdateRequest $request, ProductImage $productImage)
    {
        return $this->productImagesService->update($productImage, $request->validated());
    }

    /**
     * Remove the specified productImage from storage.
     */
    public function destroy(ProductImage $productImage)
    {
        return $this->productImagesService->delete($productImage);
    }
}
