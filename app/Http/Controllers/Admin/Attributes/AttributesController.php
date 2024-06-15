<?php

namespace App\Http\Controllers\Admin\Attributes;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Attributes\AttributeServiceContract;
use App\Http\Requests\Attributes\AttributesStoreRequest;
use App\Http\Requests\Attributes\AttributesUpdateRequest;

class AttributesController extends Controller
{
    private $attributesService;

    public function __construct(AttributeServiceContract $attributesService)
    {
        $this->attributesService = $attributesService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
      return $this->attributesService->index();
    }

    public function all()
    {
      return $this->attributesService->all();
    }
  
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributesStoreRequest $request)
    {
      return  $this->attributesService->create($request->validated());
    }

    /**
     * Display the specified category.
     * 
     */
    public function show(Attribute $attribute)
    {
        return $this->attributesService->show($attribute);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(AttributesUpdateRequest $request, Attribute $attribute)
    {
      
       return $this->attributesService->update($attribute,$request->validated());
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Attribute $attribute)
    {
        return $this->attributesService->delete($attribute);
    }

   
}
