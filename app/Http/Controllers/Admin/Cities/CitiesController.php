<?php

namespace App\Http\Controllers\Admin\Cities;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Contracts\Cities\CityServiceContract;
use App\Http\Requests\Cities\CitiesStoreRequest;
use App\Http\Requests\Cities\CitiesUpdateRequest;

class CitiesController extends Controller
{
    private $citiesService;

    public function __construct(CityServiceContract $citiesService)
    {
        $this->citiesService = $citiesService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->citiesService->index();
    }

    public function all()
    {
        return $this->citiesService->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitiesStoreRequest $request)
    {
        return  $this->citiesService->create($request->validated());
    }

    /**
     * Display the specified city.
     * 
     */
    public function show(City $city)
    {
        return $this->citiesService->show($city);
    }

    /**
     * Update the specified city in storage.
     */
    public function update(CitiesUpdateRequest $request, City $city)
    {
        return $this->citiesService->update($city, $request->validated());
    }

    /**
     * Remove the specified city from storage.
     */
    public function destroy(City $city)
    {
        return $this->citiesService->delete($city);
    }
}
