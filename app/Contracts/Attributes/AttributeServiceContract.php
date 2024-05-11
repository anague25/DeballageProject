<?php

namespace App\Contracts\Attributes;

use App\Models\Attribute;

interface AttributeServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Attribute $Attribute
     */
    public function show(Attribute $attribute);


    public function index();

    /**
     * @param Attribute $Attribute
     * @param array $data
     */
    public function update(Attribute $attribute, array $data);


    /**
     * @param Attribute $Attribute
     */
    public function delete(Attribute $attribute);
}
