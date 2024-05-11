<?php

namespace App\Contracts\Cities;

use App\Models\City;

interface CityServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param City $City
     */
    public function show(City $city);


    public function index();

    /**
     * @param City $City
     * @param array $data
     */
    public function update(City $city, array $data);


    /**
     * @param City $City
     */
    public function delete(City $city);
}
