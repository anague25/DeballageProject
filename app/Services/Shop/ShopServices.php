<?php

namespace App\Services\Shop;

use App\Models\Shop;
use Illuminate\Http\Response;
use App\Http\Resources\Shop\ShopResource;
use App\Contracts\Shop\ShopServiceContract;
use App\Http\Resources\Shop\ShopCollection;
use App\Services\Products\ShopsImagesServices;

class ShopServices implements ShopServiceContract
{

    /**
     * create an employee
     * 
     * @param array $data.
     * @return ShopResource.
     */
    public function create($validatedData): ShopResource
    {
        $shop = new Shop();
        $shopImages = new ShopsImagesServices($validatedData);
        $shopImages->uploadImage($shop, 'profile');
        $data = $shopImages->uploadImage($shop, 'cover');
        $data = Shop::create($data);
        $cityNeighborhoodPairs = collect($validatedData['city_fields'])->pluck('neighborhood_id', 'city_id')->toArray();
        $shop->cities()->sync($cityNeighborhoodPairs);

        // foreach ($validatedData['city_fields'] as $cityField) {
        //     $shop->cities()->attach($cityField['city_id'], ['neighborhood_id' => $cityField['neighborhood_id']]);
        // }

        // Créer le shop avec les données mises à jour
        return new ShopResource($data);
    }

    /**
     * update an employee
     * 
     * @param Shop $shop.
     * @return ShopResource.
     */
    public function update(Shop $shop, array $validatedData): ShopResource
    {
        $shopImages = new ShopsImagesServices($validatedData);
        $shopImages->uploadImage($shop, 'profile');
        $data = $shopImages->uploadImage($shop, 'cover');
        $shop->update($data);
        $cityNeighborhoodPairs = collect($validatedData['city_fields'])->pluck('neighborhood_id', 'city_id')->toArray();
        $shop->cities()->sync($cityNeighborhoodPairs);

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
        $shopImages = new ShopsImagesServices($validatedData = []);
        $shopImages->deleteImage($shop, $fieldName = 'profile');
        $shopImages->deleteImage($shop, $fieldName = 'cover');
        $shop->cities()->detach();
        $shop->neighborhoods()->detach();
        $shop->delete();

        return response()->noContent();
    }
}
