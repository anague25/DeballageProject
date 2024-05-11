<?php

namespace App\Contracts\Properties;

use App\Models\Property;

interface PropertyServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Property $Property
     */
    public function show(Property $Property);


    public function index();

    /**
     * @param Property $Property
     * @param array $data
     */
    public function update(Property $Property, array $data);


    /**
     * @param Property $Property
     */
    public function delete(Property $Property);
}
