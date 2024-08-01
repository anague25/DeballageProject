<?php

namespace App\Services\Categories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Products\ProductsResource;
use App\Http\Resources\Products\ProductsCollection;
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
        $categoryImages = new CategoriesImagesServices($data);
        $category = new Category();
        $data = $categoryImages->uploadImage($category, $fieldName = 'image');
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


        $categoryImages = new CategoriesImagesServices($data);
        $data = $categoryImages->uploadImage($category, $fieldName = 'image');
        $category->update($data);
        return new CategoriesResource($category);
    }


    /**
     * get all $attributes with pagination
     * 
     * @return array.
     */

    public function index(): CategoriesCollection
    {
        $categories =  Category::query()->when(request('query'), function ($query, $searchQuery) {
            $query->where('name', 'like', "%{$searchQuery}%");
        })->with(['children', 'products'])->latest()->paginate(10);
        return new CategoriesCollection($categories);
    }

    // public function productsByCategory(Category $category)
    // {
    //     // dd('aaaa');
    //     $products =  Product::where('category_id', $category->id)->with('attributes')->latest()->paginate(1);
    //     return new ProductsCollection($products);
    // }


    public function productsByCategory(Request $request, Category $category)
    {
        $query = Product::where('category_id', $category->id)->with('attributes');

        if ($request->has('properties')) {
            $properties = $request->get('properties');
            $query->whereHas('attributes', function ($q) use ($properties) {
                $q->whereIn('property_id', $properties);
            });
        }

        $products = $query->latest()->paginate(10);

        return new ProductsCollection($products);
    }



    /**
     * get all $attributes without pagination
     * 
     * @return array.
     */

    public function all(): CategoriesCollection
    {
        $categories = Category::with('children', 'products')->latest()->get();
        return new CategoriesCollection($categories);
    }


    /**
     * get an category
     * @param Category $category
     * @return CategoriesResource.
     */

    public function show(Category $category): CategoriesResource
    {

        return new CategoriesResource($category->load(['children', 'products']));
    }


    public function getCategoriesUser()
    {
        $user = Auth::user();
        // dd($user);
        $categories = Category::where('user_id', $user->id)->with('parent')->get();
        return response()->json(['categories' => $categories], 200);
    }




    /**
     * delete an $category
     * 
     * @param Category category.
     * @return Illuminate\Http\Response.
     */

    public function delete(Category $category): Response
    {
        $categoryImages = new CategoriesImagesServices($data = []);
        $categoryImages->deleteImage($category, $fieldName = 'image');
        foreach ($category->children as $children) {
            $children->parent()->dissociate();
            $children->save();
        }
        $category->delete();

        return response()->noContent();
    }
}
