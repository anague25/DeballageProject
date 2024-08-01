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
     * create a Neighborhood
     * 
     * @param array $data.
     * @return NeighborhoodsResource.
     */
    public function create($data): NeighborhoodsResource
    {
        return new NeighborhoodsResource(Neighborhood::create($data));
    }

    /**
     * update a Neighborhood
     * 
     * @param Neighborhood $neighborhood.
     * @return NeighborhoodsResource.
     */
    public function update(Neighborhood $neighborhood, array $data): NeighborhoodsResource
    {

        $neighborhood->update($data);
        return new NeighborhoodsResource($neighborhood);
    }


    /**
     * get all Neighborhoods
     * 
     * @return array.
     */

    public function index(): NeighborhoodsCollection
    {
        $neighborhood = Neighborhood::query()->when(request('query'), function ($query, $searchQuery) {
            $query->where('name', 'like', "%{$searchQuery}%")->get();
        })->with('city')->latest()->paginate(5);
        return new NeighborhoodsCollection($neighborhood);
    }

    public function all()
    {

        return new NeighborhoodsCollection(Neighborhood::latest()->get());
    }



    /**
     * get a Neighborhood
     * @param Neighborhood $neighborhood
     * @return NeighborhoodsResource.
     */

    public function show(Neighborhood $neighborhood): NeighborhoodsResource
    {
        return new NeighborhoodsResource($neighborhood);
    }



    /**
     * delete a Neighborhood
     * 
     * @param Neighborhood $neighborhood.
     * @return Illuminate\Http\Response.
     */

    public function delete(Neighborhood $neighborhood): Response
    {
        $neighborhood->delete();

        return response()->noContent();
    }
}
