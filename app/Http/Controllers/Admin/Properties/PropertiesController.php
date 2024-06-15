<?php

namespace App\Http\Controllers\Admin\Properties;

use App\Models\Property;
use App\Http\Controllers\Controller;
use App\Contracts\Properties\PropertyServiceContract;
use App\Http\Requests\Properties\PropertiesStoreRequest;
use App\Http\Requests\Properties\PropertiesUpdateRequest;

class PropertiesController extends Controller
{
    private $propertiesService;

    public function __construct(PropertyServiceContract $propertiesService)
    {
        $this->propertiesService = $propertiesService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->propertiesService->index();
    }

    public function all()
    {
        return $this->propertiesService->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertiesStoreRequest $request)
    {
        return  $this->propertiesService->create($request->validated());
    }

    /**
     * Display the specified property.
     * 
     */
    public function show(Property $property)
    {
        return $this->propertiesService->show($property);
    }

    /**
     * Update the specified property in storage.
     */
    public function update(PropertiesUpdateRequest $request, Property $property)
    {
        return $this->propertiesService->update($property, $request->validated());
    }

    /**
     * Remove the specified property from storage.
     */
    public function destroy(Property $property)
    {
        return $this->propertiesService->delete($property);
    }
}
