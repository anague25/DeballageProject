<?php

namespace App\Services\Shop;

use App\Models\Shop;
use Illuminate\Http\Response;
use App\Http\Resources\Shop\ShopResource;
use App\Services\Shop\ShopsImagesServices;
use App\Contracts\Shop\ShopServiceContract;
use App\Http\Resources\Shop\ShopCollection;
use App\Contracts\Products\ProductServiceContract;
use App\Models\Category;
use App\Models\Neighborhood;

class ShopServices implements ShopServiceContract
{
    private $productsService;

    public function __construct(ProductServiceContract $productsService)
    {
        $this->productsService = $productsService;
    }

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
        $shop = Shop::create($data);
        $cityNeighborhoodPairs = collect($validatedData['city_fields'])
            ->mapWithKeys(function ($item) {
                return [$item['city_id'] . '-' . $item['neighborhood_id'] => [
                    'city_id' => $item['city_id'],
                    'neighborhood_id' => $item['neighborhood_id']
                ]];
            })
            ->values()
            ->toArray();


        $categorySubCategoryPairs = collect($validatedData['category_fields'])
            ->mapWithKeys(function ($item) {
                return [$item['category_id'] . '-' . $item['subCategory_id'] => [
                    'category_id' => $item['category_id'],
                    'subCategory_id' => $item['subCategory_id']
                ]];
            })
            ->values()
            ->toArray();

        $shop->cities()->attach($cityNeighborhoodPairs);
        $shop->categories()->attach($categorySubCategoryPairs);

        // Créer le shop avec les données mises à jour
        return new ShopResource($shop);
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
        $cityNeighborhoodPairs = collect($validatedData['city_fields'])
            ->mapWithKeys(function ($item) {
                return [$item['city_id'] . '-' . $item['neighborhood_id'] => [
                    'city_id' => $item['city_id'],
                    'neighborhood_id' => $item['neighborhood_id']
                ]];
            })
            ->values()
            ->toArray();

        $categorySubCategoryPairs = collect($validatedData['category_fields'])
            ->mapWithKeys(function ($item) {
                return [$item['category_id'] . '-' . $item['subCategory_id'] => [
                    'category_id' => $item['category_id'],
                    'subCategory_id' => $item['subCategory_id']
                ]];
            })
            ->values()
            ->toArray();

        $shop->cities()->sync($cityNeighborhoodPairs);
        $shop->categories()->sync($categorySubCategoryPairs);

        return new ShopResource($shop);
    }


    /**
     * get all employees
     * 
     * @return array.
     */

    // public function index(): ShopCollection
    // {
    //     $shops =  Shop::query()->when(request('query'), function ($query, $searchQuery) {
    //         $query->where('name', 'like', "%{$searchQuery}%");
    //     })->with('user', 'cities', 'products', 'categories')->latest()->paginate(5);
    //     return new ShopCollection($shops);
    // }
    public function index(): ShopCollection
    {
        $shops = Shop::query()
            ->when(request('city'), function ($query, $city) {
                $query->whereHas('cities', function ($query) use ($city) {
                    $query->where('name', $city);
                });
            })
            ->when(request('neighborhood'), function ($query, $neighborhood) {
                $query->whereHas('neighborhoods', function ($query) use ($neighborhood) {
                    $query->where('name', $neighborhood);
                });
            })
            // ->when(request('search'), function ($query, $search) {
            //     $query->where('name', 'like', '%' . $search . '%')
            //         ->orWhereHas('categories', function ($query) use ($search) {
            //             $query->where('name', 'like', '%' . $search . '%');
            //         });
            // })
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('categories', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->paginate(10);
        return new ShopCollection($shops);
    }




    public function all(): ShopCollection
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
        $shop = $shop->load('user', 'cities', 'categories', 'products.category');
        foreach ($shop->cities as $city) {
            $city->neighborhood = Neighborhood::find($city->pivot->neighborhood_id);
        }
        foreach ($shop->categories as $category) {
            $category->subCategory = Category::find($category->pivot->subCategory_id);
        }
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
        foreach ($shop->products as $product) {
            $this->productsService->delete($product);
        }

        $shopImages = new ShopsImagesServices($validatedData = []);
        $shopImages->deleteImage($shop, $fieldName = 'profile');
        $shopImages->deleteImage($shop, $fieldName = 'cover');
        $shop->cities()->sync([]);
        $shop->categories()->sync([]);
        $shop->delete();

        return response()->noContent();
    }
}
