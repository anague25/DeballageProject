<?php

namespace App\Services\Neighborhoods;

use App\Models\Neighborhood;
use Illuminate\Http\Response;
use App\Contracts\Neighborhoods\NeighborhoodServiceContract;
use App\Http\Resources\Neighborhoods\NeighborhoodsResource;
use App\Http\Resources\Neighborhoods\NeighborhoodsCollection;

class NeighborhoodsServices implements NeighborhoodServiceContract
{

    /**
     * create an $Neighborhood
     * 
     * @param array $data.
     * @return NeighborhoodsResource.
     */
    public function create($data): NeighborhoodsResource
    {
        return new NeighborhoodsResource(Neighborhood::create($data));
    }

    /**
     * update an $Neighborhood
     * 
     * @param Neighborhood $Neighborhood.
     * @return NeighborhoodsResource.
     */
    public function update(Neighborhood $Neighborhood, array $data): NeighborhoodsResource
    {
        $Neighborhood->update($data);
        return new NeighborhoodsResource($Neighborhood);
    }


    /**
     * get all $Neighborhoods
     * 
     * @return array.
     */

    public function index(): NeighborhoodsCollection
    {

        return new NeighborhoodsCollection(Neighborhood::all());
    }


    /**
     * get an $Neighborhood
     * @param Neighborhood $Neighborhood
     * @return NeighborhoodsResource.
     */

    public function show(Neighborhood $Neighborhood): NeighborhoodsResource
    {
        return new NeighborhoodsResource($Neighborhood);
    }



    /**
     * delete an $Neighborhood
     * 
     * @param Neighborhood $Neighborhood.
     * @return Illuminate\Http\Response.
     */

    public function delete(Neighborhood $Neighborhood): Response
    {
        $Neighborhood->delete();

        return response()->noContent();
    }
}
