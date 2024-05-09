<?php

namespace App\Services\Shop;

use App\Models\Shop;
use Illuminate\Http\Response;
use App\Http\Resources\Shop\ShopResource;
use App\Contracts\Shop\ShopServiceContract;
use App\Http\Resources\Shop\ShopCollection;

class ShopServices implements ShopServiceContract
{

    /**
     * create an employee
     * 
     * @param array $data.
     * @return ShopResource.
     */
    public function create($data): ShopResource
    {
        return new ShopResource(Shop::create($data));
    }

    /**
     * update an employee
     * 
     * @param Shop $shop.
     * @return ShopResource.
     */
    public function update(Shop $shop, array $data): ShopResource
    {
        $shop->update($data);
        return new ShopResource($shop);
    }


    /**
     * get all employees
     * 
     * @return array.
     */

    public function index(): ShopCollection
    {

        return new ShopCollection(Shop::all());
    }


    /**
     * get an employee
     * @param Shop $shop
     * @return ShopResource.
     */

    public function show(Shop $shop): ShopResource
    {
        return new ShopResource($shop);
    }



    /**
     * delete an employee
     * 
     * @param Shop $shop.
     * @return Illuminate\Http\Response.
     */

    public function delete(Shop $shop): Response
    {
        $shop->delete();

        return response()->noContent();
    }
}
