<?php

namespace App\Services\Categories;

use App\Models\Category;
use Illuminate\Http\Response;
use App\Contracts\Categories\CategoryServiceContract;
use App\Http\Resources\Categories\CategoriesResource;
use App\Http\Resources\Categories\CategoriesCollection;

class CategoriesServices implements CategoryServiceContract
{

    /**
     * create an $category
     * 
     * @param array $data.
     * @return CategoriesResource.
     */
    public function create($data): CategoriesResource
    {
        return new CategoriesResource(Category::create($data));
    }

    /**
     * update an $category
     * 
     * @param Category category.
     * @return CategoriesResource.
     */
    public function update(Category $category, array $data): CategoriesResource
    {
        $category->update($data);
        return new CategoriesResource($category);
    }


    /**
     * get all $attributes
     * 
     * @return array.
     */

    public function index(): CategoriesCollection
    {

        return new CategoriesCollection(Category::all());
    }


    /**
     * get an category
     * @param Category $category
     * @return CategoriesResource.
     */

    public function show(Category $category): CategoriesResource
    {
        return new CategoriesResource($category);
    }



    /**
     * delete an $category
     * 
     * @param Category category.
     * @return Illuminate\Http\Response.
     */

    public function delete(Category $category): Response
    {
        $category->delete();

        return response()->noContent();
    }
}
