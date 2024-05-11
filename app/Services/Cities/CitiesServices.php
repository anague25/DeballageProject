<?php

namespace App\Services\Cities;

use App\Models\City;
use Illuminate\Http\Response;
use App\Contracts\Cities\CityServiceContract;
use App\Http\Resources\Cities\CitiesResource;
use App\Http\Resources\Cities\CitiesCollection;

class CitiesServices implements CityServiceContract
{

    /**
     * create an $attribute
     * 
     * @param array $data.
     * @return CitiesResource.
     */
    public function create($data): CitiesResource
    {
        return new CitiesResource(City::create($data));
    }

    /**
     * update an $attribute
     * 
     * @param City $attribute.
     * @return CitiesResource.
     */
    public function update(City $attribute, array $data): CitiesResource
    {
        $attribute->update($data);
        return new CitiesResource($attribute);
    }


    /**
     * get all $attributes
     * 
     * @return array.
     */

    public function index(): CitiesCollection
    {

        return new CitiesCollection(City::all());
    }


    /**
     * get an $attribute
     * @param City $attribute
     * @return CitiesResource.
     */

    public function show(City $attribute): CitiesResource
    {
        return new CitiesResource($attribute);
    }



    /**
     * delete an $attribute
     * 
     * @param City $attribute.
     * @return Illuminate\Http\Response.
     */

    public function delete(City $attribute): Response
    {
        $attribute->delete();

        return response()->noContent();
    }
}
