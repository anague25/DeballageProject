<?php

namespace App\Contracts\ProductImages;

use App\Models\ProductImage;

interface ProductImageServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param ProductImage $productImage
     */
    public function show(ProductImage $productImage);


    public function index();

    /**
     * @param ProductImage $productImage
     * @param array $data
     */
    public function update(ProductImage $productImage, array $data);


    /**
     * @param ProductImage $productImage
     */
    public function delete(ProductImage $productImage);
}
