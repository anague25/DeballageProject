<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Contracts\Categories\CategoryServiceContract;
use App\Http\Requests\Categories\CategoriesStoreRequest;
use App\Http\Requests\Categories\CategoriesUpdateRequest;

class CategoriesController extends Controller
{
    private $categoriesService;

    public function __construct(CategoryServiceContract $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->categoriesService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesStoreRequest $request)
    {
        return  $this->categoriesService->create($request->validated());
    }

    /**
     * Display the specified category.
     * 
     */
    public function show(Category $category)
    {
        return $this->categoriesService->show($category);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoriesUpdateRequest $request, Category $category)
    {
        return $this->categoriesService->update($category, $request->validated());
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        return $this->categoriesService->delete($category);
    }
}
