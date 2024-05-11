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
     * @param Neighborhood $Neighborhood
     */
    public function show(Neighborhood $Neighborhood);


    public function index();

    /**
     * @param Neighborhood $Neighborhood
     * @param array $data
     */
    public function update(Neighborhood $Neighborhood, array $data);


    /**
     * @param Neighborhood $Neighborhood
     */
    public function delete(Neighborhood $Neighborhood);
}
