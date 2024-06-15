<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Contracts\Shop\ShopServiceContract;
use App\Http\Requests\Shop\ShopStoreRequest;
use App\Http\Requests\Shop\ShopUpdateRequest;

class ShopController extends Controller
{
    private $shopService;

    public function __construct(ShopServiceContract $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * Display a listing of the employees.
     * @return 
     */
    public function index()
    {
        return $this->shopService->index();
    }

    public function all()
    {
        return $this->shopService->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopStoreRequest $request)
    {
        // dd($request->validated());
        return  $this->shopService->create($request->validated());
    }

    /**
     * Display the specifiedshop.
     * 
     */
    public function show(Shop $shop)
    {
        return $this->shopService->show($shop);
    }

    /**
     * Update the specifiedshop in storage.
     */
    public function update(ShopUpdateRequest $request, Shop $shop)
    {
        return $this->shopService->update($shop, $request->validated());
    }

    /**
     * Remove the specifiedshop from storage.
     */
    public function destroy(Shop $shop)
    {
        return $this->shopService->delete($shop);
    }
}
