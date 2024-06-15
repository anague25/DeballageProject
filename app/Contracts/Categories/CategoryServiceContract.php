<?php

namespace App\Contracts\Categories;

use App\Models\Category;

interface CategoryServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Category attribute
     */
    public function show(Category $attribute);


    public function index();

    public function all();

    /**
     * @param Category attribute
     * @param array $data
     */
    public function update(Category $attribute, array $data);


    /**
     * @param Category attribute
     */
    public function delete(Category $attribute);
}
