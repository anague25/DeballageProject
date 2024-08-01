<?php

namespace App\Contracts\Properties;

use App\Models\Property;

interface PropertyServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    public function getAttributeUser();

    /**
     * @param Property $property
     */
    public function show(Property $property);


    public function index();

    public function all();

    /**
     * @param Property $property
     * @param array $data
     */
    public function update(Property $property, array $data);


    /**
     * @param Property $property
     */
    public function delete(Property $property);
}
