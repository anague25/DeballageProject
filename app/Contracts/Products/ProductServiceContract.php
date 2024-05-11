<?php

namespace App\Contracts\Products;

use App\Models\Product;

interface ProductServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Product $Product
     */
    public function show(Product $product);


    public function index();

    /**
     * @param Product $Product
     * @param array $data
     */
    public function update(Product $product, array $data);


    /**
     * @param Product $Product
     */
    public function delete(Product $product);
}
