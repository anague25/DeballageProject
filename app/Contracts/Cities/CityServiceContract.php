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
     * @param City $city
     */
    public function show(City $city);


    public function index();

    public function all();

    /**
     * @param City $city
     * @param array $data
     */
    public function update(City $city, array $data);


    /**
     * @param City $city
     */
    public function delete(City $city);
}
