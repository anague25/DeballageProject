<?php

namespace App\Contracts\Shop;

use App\Models\Shop;

interface ShopServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Shop $Shop
     */
    public function show(Shop $shop);


    public function index();

    /**
     * @param Shop $Shop
     * @param array $data
     */
    public function update(Shop $shop, array $data);


    /**
     * @param Shop $Shop
     */
    public function delete(Shop $shop);
}
