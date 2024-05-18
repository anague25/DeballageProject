<?php

namespace App\Contracts\Favorites;

use App\Models\Favorite;

interface FavoriteServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Favorite $favorite
     */
    public function show(Favorite $favorite);


    public function index();

    /**
     * @param Favorite $favorite
     * @param array $data
     */
    public function update(Favorite $favorite, array $data);


    /**
     * @param Favorite $favorite
     */
    public function delete(Favorite $favorite);
}
