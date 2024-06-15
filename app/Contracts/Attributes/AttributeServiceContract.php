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
     * @param Attribute $attribute
     */
    public function show(Attribute $attribute);


    public function index();

    public function all();

    /**
     * @param Attribute $attribute
     * @param array $data
     */
    public function update(Attribute $attribute, array $data);


    /**
     * @param Attribute $attribute
     */
    public function delete(Attribute $attribute);

   
}
