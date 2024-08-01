<?php

namespace App\Http\Controllers\Admin\Favorites;

use App\Models\Favorite;
use App\Http\Controllers\Controller;
use App\Contracts\Favorites\FavoriteServiceContract;
use App\Http\Requests\Favorites\FavoritesStoreRequest;
use App\Http\Requests\Favorites\FavoritesUpdateRequest;

class FavoritesController extends Controller
{
    private $favoritesService;

    public function __construct(FavoriteServiceContract $favoritesService)
    {
        $this->middleware('auth:api');
        $this->favoritesService = $favoritesService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->favoritesService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FavoritesStoreRequest $request)
    {
        // dd('ddd');
        return  $this->favoritesService->create($request->validated());
    }

    public function removeFavorite($id)
    {

        return  $this->favoritesService->removeFavorite($id);
    }

    /**
     * Display the specified favorite.
     * 
     */
    public function show(Favorite $favorite)
    {
        return $this->favoritesService->show($favorite);
    }

    /**
     * Update the specified favorite in storage.
     */
    public function update(FavoritesUpdateRequest $request, Favorite $favorite)
    {
        return $this->favoritesService->update($favorite, $request->validated());
    }

    /**
     * Remove the specified favorite from storage.
     */
    public function destroy(Favorite $favorite)
    {
        return $this->favoritesService->delete($favorite);
    }
}
