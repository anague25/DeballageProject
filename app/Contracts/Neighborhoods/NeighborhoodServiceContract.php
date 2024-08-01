<?php

namespace App\Contracts\Neighborhoods;

use App\Models\Neighborhood;

interface NeighborhoodServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Neighborhood $neighborhood
     */
    public function show(Neighborhood $neighborhood);


    public function index();


    public function all();

    /**
     * @param Neighborhood $neighborhood
     * @param array $data
     */
    public function update(Neighborhood $neighborhood, array $data);


    /**
     * @param Neighborhood $neighborhood
     */
    public function delete(Neighborhood $neighborhood);
}
