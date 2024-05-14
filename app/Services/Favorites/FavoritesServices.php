<?php

namespace App\Services\Favorites;

use App\Models\Favorite;
use Illuminate\Http\Response;
use App\Contracts\Favorites\FavoriteServiceContract;
use App\Http\Resources\Favorites\FavoritesResource;
use App\Http\Resources\Favorites\FavoritesCollection;

class FavoritesServices implements FavoriteServiceContract
{

    /**
     * create an favorite
     * 
     * @param array $data.
     * @return FavoritesResource.
     */
    public function create($data): FavoritesResource
    {
        return new FavoritesResource(Favorite::create($data));
    }

    /**
     * update an favorite
     * 
     * @param Favorite $favorite.
     * @return FavoritesResource.
     */
    public function update(Favorite $favorite, array $data): FavoritesResource
    {
        $favorite->update($data);
        return new FavoritesResource($favorite);
    }


    /**
     * get all $Favorites
     * 
     * @return array.
     */

    public function index(): FavoritesCollection
    {

        return new FavoritesCollection(Favorite::all());
    }


    /**
     * get an favorite
     * @param Favorite $favorite
     * @return FavoritesResource.
     */

    public function show(Favorite $favorite): FavoritesResource
    {
        return new FavoritesResource($favorite);
    }



    /**
     * delete an favorite
     * 
     * @param Favorite $favorite.
     * @return Illuminate\Http\Response.
     */

    public function delete(Favorite $favorite): Response
    {
        $favorite->delete();

        return response()->noContent();
    }
}
