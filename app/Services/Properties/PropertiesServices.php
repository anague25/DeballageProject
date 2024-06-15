<?php

namespace App\Services\Properties;

use App\Models\Property;
use Illuminate\Http\Response;
use App\Contracts\Properties\PropertyServiceContract;
use App\Http\Resources\Properties\PropertiesResource;
use App\Http\Resources\Properties\PropertiesCollection;

class PropertiesServices implements PropertyServiceContract
{

    /**
     * create an product
     * 
     * @param array $data.
     * @return PropertiesResource.
     */
    public function create($data): PropertiesResource
    {
        return new PropertiesResource(Property::create($data));
    }

    /**
     * update an product
     * 
     * @param Property $property.
     * @return PropertiesResource.
     */
    public function update(Property $property, array $data): PropertiesResource
    {
        $property->update($data);
        return new PropertiesResource($property);
    }


    /**
     * get all products
     * 
     * @return array.
     */

    public function index(): PropertiesCollection
    {
        $property = Property::query()->when(request('query'), function ($query, $searchQuery) {
            $query->where('name', 'like', "%{$searchQuery}%")->get();
        })->with('attribute')->latest()->paginate(5);

        return new PropertiesCollection($property);
    }

    public function all(): PropertiesCollection
    {
        return new PropertiesCollection(Property::all());
    }


    /**
     * get an product
     * @param Property $property
     * @return PropertiesResource.
     */

    public function show(Property $property): PropertiesResource
    {
        return new PropertiesResource(Property::with('attribute')->find($property));
    }



    /**
     * delete an product
     * 
     * @param Property $property.
     * @return Illuminate\Http\Response.
     */

    public function delete(Property $property): Response
    {
        $property->delete();

        return response()->noContent();
    }
}
